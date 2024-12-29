<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Category;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class AdminController extends AControllerBase
{
    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        //todo pridaj kontrolu ze ci je to admin
        return $this->app->getAuth()->isLogged();
    }

    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index(): Response
    {
        return $this->html();
    }

    public function category(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        if (isset($formData['novaKategoria'])) {
            $newCategory = new Category();
            $newCategory->setName($formData['novaKategoria']);
            if (isset($formData['destination'])) {
                $newCategory->setDestinationOfPicture($formData['destination']);
            } else {
                return $this->html(['message'=> 'Zlá alebo žiadna url adresa!']);
            }
            $categories = Category::getAll();
            foreach ($categories as $category) {
                if ($category->getName() == $newCategory->getName()) {
                    return $this->html(['message'=> 'Kategória s týmto názvom už existuje!']);
                }
            }
            $newCategory->save();
            return $this->html(['message'=> 'Úspešne pridaná!']);
        }

        if (isset($formData['odstranenie'])) {
            $categories = Category::getAll();
            foreach ($categories as $category) {
                if ($category->getName() == $formData['odstranenie']) {
                    $category->delete();
                    return $this->html(['message'=> 'Kategória vymazaná!']);
                }
            }
        }
        return $this->html();
    }
}
