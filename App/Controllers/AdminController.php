<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Category;
use http\Client\Curl\User;

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
    public function authorize($action): bool
    {
        switch ($action) {
            case 'index':
            case 'category':
            case 'users':
            case 'givePermission':
            case 'takePermission':
            case 'deleteUser':
                return $this->app->getAuth()->isLogged() && $this->app->getAuth()->getPermissionLevel() > 0;
            default: return false;
        }
    }

    public function index(): Response
    {
        return $this->html();
    }

    public function users()
    {
        return $this->html();
    }

    public function givePermission(): Response
    {
        $userId = $this->app->getRequest()->getGet()['0'];
        $user = \App\Models\User::getOne($userId);
        $user->setPermissions(1);
        $user->save();
        return $this->redirect($this->url('admin.users'));
    }

    public function takePermission(): Response
    {
        $userId = $this->app->getRequest()->getGet()['0'];
        $user = \App\Models\User::getOne($userId);
        $user->setPermissions(0);
        $user->save();
        return $this->redirect($this->url('admin.users'));
    }

    public function deleteUser(): Response
    {
        $userId = $this->app->getRequest()->getGet()['0'];
        $user = \App\Models\User::getOne($userId);
        $user->delete();
        return $this->redirect($this->url('admin.users'));
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

        if (isset($formData['novyNazov'])) {
            $categories = Category::getAll();
            if (isset($formData['staraKategoria'])) {
                foreach ($categories as $category) {
                    if ($category->getName() == $formData['staraKategoria']) {
                        $category->setName($formData['novyNazov']);
                        $category->save();
                        return $this->html(['message'=> 'Kategória zmenená!']);
                    }
                }
            } else {
                return $this->html(['message'=> 'Neúspešné zmenenie!']);
            }
        }

        if (isset($formData['novaUrl'])) {
            $categories = Category::getAll();
            if (isset($formData['staraUrl'])) {
                foreach ($categories as $category) {
                    if ($category->getName() == $formData['staraUrl']) {
                        $category->setDestinationOfPicture($formData['novaUrl']);
                        $category->save();
                        return $this->html(['message'=> 'Kategória zmenená!']);
                    }
                }
            } else {
                return $this->html(['message'=> 'Neúspešné zmenenie!']);
            }
        }
        return $this->html();
    }
}
