<?php

namespace App\Controllers;

use App\App;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Advert;
use App\Models\Category;

class AdvertController extends AControllerBase
{

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html();
    }

    public function add(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        if (isset($formData['submit']) && isset($formData['title']) && isset($formData['text']) &&  isset($formData['category']) && isset($formData['price'])) {
            //todo fotky...
            //todo && isset($formData['village'])
            $advert = new Advert();
            $advert->setTitle($formData['title']);
            $advert->setText($formData['text']);
            $advert->setPrice($formData['price']);
            $advert->setOwner($this->app->getAuth()->getLoggedUserEmail());
            $category = Category::getAll('`name` LIKE ?', [$formData['category']])[0];
            $advert->setVillageId(11);
            $advert->setCategoryId($category->getId());
            //$advert->setVillage($formData['village']);

            $advert->setMonday(isset($formData['monday']));
            $advert->setTuesday(isset($formData['tuesday']));
            $advert->setWednesday(isset($formData['wednesday']));
            $advert->setThursday(isset($formData['thursday']));
            $advert->setFriday(isset($formData['friday']));
            $advert->setSaturday(isset($formData['saturday']));
            $advert->setSunday(isset($formData['sunday']));

            $advert->save();        //tu mu nastavi auto increment ID
            $data = ['id' => $advert->getId()];

            return $this->redirect($this->url("advert.index", $data));
        }
        if (sizeof($formData) == 0) {
            return $this->html();
        }
        return $this->html($formData);
    }

    public function newest()
    {
        return $this->html();
    }

}