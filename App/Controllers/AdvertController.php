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
            case 'remove' :
            case 'edit' :
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
        $data = $this->app->getRequest()->getGet()['0'];
        if (isset($data['id'])) {
            $advert = Advert::getOne($data['id']);
            $advert->setViews($advert->getViews() + 1);
            $advert->save();
            return $this->html($data);
        }
        return $this->redirect($this->url(('home.index')));
    }

    public function remove(): Response
    {
        //todo mozno presmeruj na vsetky moje inzeraty
        $advertId = $this->app->getRequest()->getGet()['0'];
        if (isset($advertId['0'])) {
            $advert = Advert::getOne($advertId['0']);
            $advert->delete();
        }
        return $this->redirect($this->url('home.index'));
    }

    public function edit(): Response
    {
        $formdata = $this->app->getRequest()->getPost();
        if (isset($formdata['submitPhoto'])) {
            $advertId = $this->app->getRequest()->getGet()['0'];
            if ($advertId != null) {
                $photo = new Photo();
                $photo->setAdvertId($advertId);
                if (trim($formdata['url']) != '') {
                    $photo->setUrl($formdata['url']);
                    $photo->save();
                    $data['id'] = $advertId;
                    $data['message'] = 'Fotka úspšene pridaná';

                    return $this->redirect($this->url('advert.index', [$data]));
                } else {
                    return $this->html($advertId);
                }
            }
        }

        if (isset($formdata['submitRemovePhoto'])) {
            $advertId = $this->app->getRequest()->getGet()['0'];
            if ($advertId != null) {
                if (trim($formdata['url']) != '') {
                    $photo = Photo::getAll(whereClause: '`advertId` LIKE ? && `url` LIKE ?', whereParams: [$advertId, $formdata['url']])[0];
                    $photo->delete();
                    $data['id'] = $advertId;
                    $data['message'] ='Fotka úspšene odstránená';

                    return $this->redirect($this->url('advert.index', [$data]));
                } else {
                    return $this->html($advertId);
                }
            }
        }

        if (isset($formdata['submitAll']) && $this->checkData($formdata)) {
            $formdata = $this->checkDataContinue($formdata);
            $advertId = $this->app->getRequest()->getGet()['0'];
            if ($advertId != null) {
                if (!isset($foarmData['message'])) {
                    $advert = Advert::getOne($advertId);
                    $advert->setTitle($formdata['title']);
                    $advert->setText($formdata['text']);
                    $advert->setPrice($formdata['price']);
                    $advert->setVillageId($formdata['villageId']);
                    $advert->setCategoryId($formdata['categoryId']);

                    $advert->setMonday(isset($formdata['monday']));
                    $advert->setTuesday(isset($formdata['tuesday']));
                    $advert->setWednesday(isset($formData['wednesday']));
                    $advert->setThursday(isset($formdata['thursday']));
                    $advert->setFriday(isset($formdata['friday']));
                    $advert->setSaturday(isset($formdata['saturday']));
                    $advert->setSunday(isset($formdata['sunday']));

                    $advert->save();

                    $data['id'] = $advertId;
                    $data['message'] = 'Inzerát úspšene upravený';
                    return $this->redirect($this->url('advert.index', [$data]));
            } else {
                    return $this->html($advertId);
                }
            }

        }

        $advertId = $this->app->getRequest()->getGet()['0'];
        $advert = Advert::getOne($advertId);
        if ($this->app->getAuth()->isLogged() && $this->app->getAuth()->getLoggedUserId() == $advert->getOwnerId()) {
            return $this->html($advertId);
        }
        return $this->redirect($this->url(('home.index')));
    }

    private function checkData($formData): bool
    {
        if (isset($formData['title']) && isset($formData['text']) &&
            isset($formData['category']) && isset($formData['price'])  && isset($formData['city'])) {
            return true;
        }
        return false;
    }

    private function checkDataContinue($formData): array
    {
        if ($formData['price'] < 0) {
            $formData += ['message' => 'Cena nemôže byť záporné číslo!'];
        }

        if (ctype_space($formData['title'])) {
            $formData += ['message' => 'Nebol zadaný názov inzerátu!'];
        }
        $category = Category::getAll('`name` LIKE ?', [$formData['category']])[0];

        if (!isset($category)) {
            $formData += ['message' => 'Nebola zvolená správna kategória!'];
        } elseif ($category->getName() != $formData['category']) {
            $formData += ['message' => 'Nebola zvolená správna kategória!'];
        }
        $formData += ['categoryId' => $category->getId()];

        $village = Village::getAll('`name` LIKE ?', [$formData['city']], limit: 1)[0];

        if (!isset($village)) {
            $formData += ['message' => 'Dané mesto neexistuje!'];
        } elseif ($village->getName() != $formData['city']) {
            $formData += ['message' => 'Dané mesto neexistuje!'];
        }

        $formData += ['villageId' => $village->getId()];

        return $formData;
    }

    public function add(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        if (sizeof($formData) == 0) {
            return $this->html();
        }


        if (isset($formData['submit']) && $this->checkData($formData)) {
            $formData = $this->checkDataContinue($formData);
            if (!isset($formData['message'])) {
                $advert = new Advert();
                $advert->setTitle($formData['title']);
                $advert->setText($formData['text']);
                $advert->setPrice($formData['price']);
                $advert->setOwnerId($this->app->getAuth()->getLoggedUserId());
                $advert->setVillageId($formData['villageId']);
                $advert->setCategoryId($formData['categoryId']);
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
                        $photo->setAdvertId($advert->getId());
                        $photo->save();
                    }
                    $i++;
                }
                return $this->redirect($this->url("advert.index", [$data]));
            } else {
                return $this->html($formData);
            }
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
        $adverts = Advert::getAll(orderBy: '`dateOfCreate` desc', limit: $inzeratyNaStrane,offset: ($page-1) * $inzeratyNaStrane);
        $dataSent['text'] = 'Najnovšie inzeráty';
        $dataSent['adverts'] = $adverts;
        $dataSent['count'] = $this->getCounfOfAllAdverts();
        $dataSent['pagination'] = $this->createPagination($page, $dataSent['count']/$inzeratyNaStrane, 'newest');
        return $this->html($dataSent);
    }

    private function getCounfOfCategoryAdverts($catId)
    {
        $con = Connection::connect();
        $stmt = $con->prepare("SELECT count(*) FROM `adverts` where `categoryId` like ?");
        $stmt->execute([$catId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count(*)'];
    }

    private function getCounfOfTitleAdverts($title)
    {
        $con = Connection::connect();
        $stmt = $con->prepare("SELECT count(*) FROM `adverts` where `title` like ?");
        $stmt->execute([$title]);
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


    private function createPagination($current_page, $total_pages, $type): string
    {
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