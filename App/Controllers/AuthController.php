<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Core\Responses\ViewResponse;

/** @var \App\Core\LinkGenerator $link */


/**
 * Class AuthController
 * Controller for authentication actions
 * @package App\Controllers
 */
class AuthController extends AControllerBase
{
    /**
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->redirect(Configuration::LOGIN_URL);
    }

    public function edit(): Response
    {
        //todo Situacia ked si meni mail!!!
        $formData = $this->app->getRequest()->getPost();
        $data= null;
        $edit= null;
        //todo kontrola ze ci nie su null hodnoty
        if (isset($formData['submit'])) {
            if ($formData['passwordOld'] == $this->app->getAuth()->getLoggedUserPassword()) {
                if ($formData['passwordNew'] == $formData['passwordConfirm']) {
                    $edit = $this->app->getAuth()->edit($formData['login'], $formData['passwordNew'], $formData['name'], $formData['surname']);
                } else {
                    $data =['message' => "Heslá sa nezhodovali"];
                }
            } else {
                $data =['message' => "Nesprávne aktuálne heslo"];
            }

        } else {
            $data = ($edit === false ? ['message' => 'Neúspešná zmena!'] : []);
        }

        return $this->html($data);
    }

    public function register(): Response
    {
        //todo kontrola ze ci nie su null hodnoty
        $formData = $this->app->getRequest()->getPost();
        $register = null;
        if (isset($formData['submit'])) {
            $register = $this->app->getAuth()->register($formData['login'], $formData['password'], $formData['name'], $formData['surname']);
            if ($register) {
                return $this->redirect($this->url("user.profil"));
            }
        }
        $data = ($register === false ? ['message' => 'Neúspešná registrácia!'] : []);

        return $this->html($data);
    }

    /**
     * Login a user
     * @return Response
     */
    public function login(): Response
    {
        //todo kontrola ze ci nie su null hodnoty
        $formData = $this->app->getRequest()->getPost();
        $logged = null;
        if (isset($formData['submit'])) {
            $logged = $this->app->getAuth()->login($formData['login'], $formData['password']);
            if ($logged) {
                return $this->redirect($this->url("admin.index"));
            }
        }

        $data = ($logged === false ? ['message' => 'Zlý login alebo heslo!'] : []);
        return $this->html($data);
    }

    /**
     * Logout a user
     * @return ViewResponse
     */
    public function logout(): Response
    {
        $this->app->getAuth()->logout();
        return $this->html();
    }
}
