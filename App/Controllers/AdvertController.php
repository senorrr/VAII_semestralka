<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Core\Responses\Response;
use App\Models\Advert;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Village;
use PDO;

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
        $inzeratyNaStrane = 20; //pocet inzeratov na jednu stranu
        $dataSent = [];
        if (isset($_GET['1'])) {
            $page = $_GET['1'];
        } else {
            $page = 1;
        }
        $dataSent['page'] = $page;
        $dataGet = $this->app->getRequest()->getPost();
        if (sizeof($dataGet) > 0) {
            if (strlen($dataGet['search']) <=50) {
                $vyhladanie = '%' . $dataGet['search'] . '%';
                $adverts = Advert::getAll(whereClause: '`title` like ?', whereParams: [$vyhladanie], limit: 20);
                $dataSent['text'] = 'Inzeráty pre hľadanie: ' . $dataGet['search'];
                $dataSent['adverts'] = $adverts;
                $dataSent['count'] = $this->getCounfOfTitleAdverts($vyhladanie);
                return $this->html($dataSent);
            }
            return $this->redirect('index');
        }
        $dataGet = $this->app->getRequest()->getGet()['0'];

        if (is_numeric($dataGet)) {
            $adverts = Advert::getAll(whereClause: '`categoryId` like ?', whereParams: [$dataGet],
                limit: $inzeratyNaStrane,offset: ($page-1) * $inzeratyNaStrane);
            $category = Category::getOne($dataGet);
            $dataSent['text'] = 'Inzeráty pre kategóriu ' . $category->getName();
            $dataSent['adverts'] = $adverts;
            $dataSent['count'] = $this->getCounfOfCategoryAdverts($dataGet);
            $dataSent['pagination'] = $this->createPagination($page, $dataSent['count']/$inzeratyNaStrane, $category->getId());
            return $this->html($dataSent);
        }
        $adverts = Advert::getAll(orderBy: '`dateOfCreate` asc', limit: $inzeratyNaStrane,offset: ($page-1) * $inzeratyNaStrane);
        $dataSent['text'] = 'Najnovšie inzeráty';
        $dataSent['adverts'] = $adverts;
        $dataSent['count'] = $this->getCounfOfAllAdverts();
        $dataSent['pagination'] = $this->createPagination($page, $dataSent['count']/$inzeratyNaStrane, 'newest');
        return $this->html($dataSent);
    }

    private function getCounfOfCategoryAdverts($catId)
    {
        $con = Connection::connect();
        $stmt = $con->prepare("SELECT count(*) FROM `adverts` where `categoryId` like $catId");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count(*)'];
    }

    private function getCounfOfTitleAdverts($title)
    {
        $con = Connection::connect();
        $stmt = $con->prepare("SELECT count(*) FROM `adverts` where `title` like $title");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count(*)'];
    }

    public function getCounfOfAllAdverts()
    {
        $con = Connection::connect();
        $stmt = $con->prepare("SELECT count(*) FROM `adverts`");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count(*)'];
    }


    private function createPagination($current_page, $total_pages, $type) {
        $range = 2;
        $total_pages = ceil($total_pages);
        $pagination = '<nav aria-label="Page navigation example"><ul class="pagination">';

        // tlacidlo predosle
        if ($current_page > 1) {
            $url = $this->url("advert.all", [$type, $current_page-1]);
            $pagination .= '<li class="page-item"><a class="page-link" href="' . $url .'  " tabindex="-1">Predošlá</a></li>';
        } else {
            $pagination .= '<li class="page-item disabled"><a class="page-link" tabindex="-1">Predošlá</a></li>';
        }

        //prva strana
        if ($current_page > $range + 1) {
            $url = $this->url("advert.all", [$type]);
            $pagination .= '<li class="page-item"><a class="page-link" href=" '. $url .' ">1</a></li>';
            if ($current_page > $range + 2) {
                $pagination .= '<li class="page-item disabled"><a class="page-link" >...</a></li>';
            }
        }

        // cisla stran podla range upravene
        for ($i = max(1, $current_page - $range); $i <= min($total_pages, $current_page + $range); $i++) {
            if ($i == $current_page) {
                $pagination .= '<li class="page-item active"><a class="page-link">' . $i . '</a></li>';
            } else {
                $url = $this->url("advert.all", [$type, $i]);
                $pagination .= '<li class="page-item"><a class="page-link" href="' . $url . '">' . $i . '</a></li>';
            }
        }

        // posledna strana
        if ($current_page < $total_pages - $range) {
            if ($current_page < $total_pages - $range - 1) {
                $pagination .= '<li class="page-item disabled"><a class="page-link">...</a></li>';
            }
            $url = $this->url("advert.all", [$type, $total_pages]);
            $pagination .= '<li class="page-item"><a class="page-link" href="' . $url . '">' . $total_pages . '</a></li>';
        }


        // dalsia strana tlacidlo
        if ($current_page < $total_pages) {
            $url = $this->url("advert.all", [$type, $current_page+1]);
            $pagination .= '<li class="page-item"><a class="page-link" href="' . $url . ' ">Ďalšia</a></li>';
        } else {
            $pagination .= '<li class="page-item disabled"><a class="page-link" href="#">Ďalšia</a></li>';
        }

        $pagination .= '</ul></nav>';
        return $pagination;
    }
}