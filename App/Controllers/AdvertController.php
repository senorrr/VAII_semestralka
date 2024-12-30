<?php

namespace App\Controllers;

use App\App;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Advert;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Village;

class AdvertController extends AControllerBase
{

    public function authorize($action): bool
    {
        switch ($action) {
            case 'add' :
                return $this->app->getAuth()->isLogged();
            case 'index':
            case 'all':
                return true;
            default:
                return false;
        }
    }


    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        $advert = Advert::getOne($_GET['id']);
        $advert->setViews($advert->getViews() + 1);
        $advert->save();
        return $this->html();
    }

    public function add(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        if (sizeof($formData) == 0) {
            return $this->html();
        }

        if (isset($formData['submit']) && isset($formData['title']) && isset($formData['text']) &&  isset($formData['category']) && isset($formData['price'])  && isset($formData['city'])) {
            if ($formData['price'] < 0) {
                $formData += ['message' => 'Cena nemôže byť záporné číslo!'];
                return $this->html($formData);
            }

            if (ctype_space($formData['title'])) {
                $formData += ['message' => 'Nebol zadaný názov inzerátu!'];
                return $this->html($formData);
            }
            $category = Category::getAll('`name` LIKE ?', [$formData['category']])[0];

            if (!isset($category)) {
                $formData += ['message' => 'Nebola zvolená správna kategória!'];
                return $this->html($formData);
            } elseif ($category->getName() != $formData['category']) {
                $formData += ['message' => 'Nebola zvolená správna kategória!'];
                return $this->html($formData);
            }

            $village = Village::getAll('`name` LIKE ?', [$formData['city']], limit: 1)[0];

            if (!isset($village)) {
                $formData += ['message' => 'Dané mesto neexistuje!'];
                return $this->html($formData);
            } elseif ($village->getName() != $formData['city']) {
                $formData += ['message' => 'Dané mesto neexistuje!'];
                return $this->html($formData);
            }

            $advert = new Advert();
            $advert->setTitle($formData['title']);
            $advert->setText($formData['text']);
            $advert->setPrice($formData['price']);
            $advert->setOwner($this->app->getAuth()->getLoggedUserEmail());
            $advert->setVillageId($village->getId());
            $advert->setCategoryId($category->getId());
            $advert->setViews(0);

            $advert->setMonday(isset($formData['monday']));
            $advert->setTuesday(isset($formData['tuesday']));
            $advert->setWednesday(isset($formData['wednesday']));
            $advert->setThursday(isset($formData['thursday']));
            $advert->setFriday(isset($formData['friday']));
            $advert->setSaturday(isset($formData['saturday']));
            $advert->setSunday(isset($formData['sunday']));

            $advert->save();        //tu mu nastavi auto increment ID
            $data = ['id' => $advert->getId()];

            $i = 1;
            while (isset($formData['photo' . $i])) {
                if (!empty($formData['photo' . $i])) {
                    $photo = new Photo();
                    $photo->setUrl($formData['photo' . $i]);
                    $photo->setAdvert($advert->getId());
                    $photo->save();
                }
                $i++;
            }
            return $this->redirect($this->url("advert.index", $data));
        }
        $formData += ['message' => 'Údaje neboli správne vyplnené!'];

        return $this->html($formData);
    }

    public function all(): Response
    {
        $dataSent = [];
        if (!isset($page)) {
            $page = 1;
        } else {
            $page++;
        }
        $dataSent['page'] = $page;
        $dataGet = $this->app->getRequest()->getPost();
        if (sizeof($dataGet) > 0) {
            $vyhladanie = '%' . $dataGet['search'] . '%';
            $adverts = Advert::getAll(whereClause: '`title` like ?', whereParams: [$vyhladanie], limit: 100);
            $dataSent['text'] = 'Inzeráty pre hľadanie: ' . $dataGet['search'];
            $dataSent['adverts'] = $adverts;
            return $this->html($dataSent);
        }
        $dataGet = $this->app->getRequest()->getGet()['0'];

        if (is_numeric($dataGet)) {
            $adverts = Advert::getAll(whereClause: '`categoryId` like ?', whereParams: [$dataGet], limit: 100);
            $dataSent['text'] = 'Inzeráty pre kategóriu ' . Category::getOne($dataGet)->getName();
            $dataSent['adverts'] = $adverts;
            return $this->html($dataSent);
        }
        $adverts = Advert::getAll(orderBy: '`dateOfCreate` asc', limit: 100);
        $dataSent['text'] = 'Najnovšie inzeráty';
        $dataSent['adverts'] = $adverts;
        return $this->html($dataSent);
    }
}