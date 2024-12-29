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
            case 'inzeraty':
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

        if (isset($formData['submit']) && isset($formData['title']) && isset($formData['text']) &&  isset($formData['category']) && isset($formData['price'])  && isset($formData['village'])) {
            if ($formData['price'] < 0) {
                $formData = ['message' => 'Cena nemôže byť záporné číslo!'];
                return $this->html($formData);
            }

            if (ctype_space($formData['title'])) {
                $formData = ['message' => 'Nebol zadaný názov inzerátu!'];
                return $this->html($formData);
            }
            $category = Category::getAll('`name` LIKE ?', [$formData['category']])[0];

            if (!isset($category)) {
                $formData = ['message' => 'Nebola zvolená správna kategória!'];
                return $this->html($formData);
            } elseif ($category->getName() != $formData['category']) {
                $formData = ['message' => 'Nebola zvolená správna kategória!'];
                return $this->html($formData);
            }

            $village = Village::getAll('`name` LIKE ?', [$formData['village']], limit: 1)[0];

            if (!isset($village)) {
                $formData = ['message' => 'Dané mesto neexistuje!'];
                return $this->html($formData);
            } elseif ($village->getName() != $formData['village']) {
                $formData = ['message' => 'Dané mesto neexistuje!'];
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
            }
            return $this->redirect($this->url("advert.index", $data));
        }
        return $this->html($formData);
    }

    public function inzeraty()
    {
        return $this->html();
    }

}