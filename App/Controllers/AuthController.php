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

        if (isset($formData['remove'])) {
            $user = $this->app->getAuth()->getLoggedUser();
            if ($user->getPassword() == $formData['passwordOld']) {
                $this->app->getAuth()->logout();
                $user->delete();
                return $this->redirect($this->url("home.index"));
            } else {
                $data =['message' => "Nesprávne heslo!"];
                return $this->html($data);
            }
        }
        if (isset($formData['submit'])) {
            if ($formData['passwordOld'] == $this->app->getAuth()->getLoggedUserPassword()) {
                if ($formData['name'] != null && $formData['surname'] != null  && ctype_space($formData['name']) &&
                        ctype_space($formData['surname']) ) { //ctype_space vymaze medzery
                    if ($formData['passwordOld'] != $formData['passwordNew']) {
                        if ($formData['passwordNew'] == $formData['passwordConfirm']) {
                            if ($formData['newEmail'] == null) {
                                $edit = $this->app->getAuth()->edit($this->app->getAuth()->getLoggedUser(), $formData['passwordNew'],
                                    $formData['name'], $formData['surname']);
                            } else {
                                if ($formData['newEmail'] != $this->app->getAuth()->getLoggedUser()) {
                                    $edit = $this->app->getAuth()->edit($formData['newEmail'], $formData['passwordNew'],
                                        $formData['name'], $formData['surname']);
                                    if ($edit) {
                                        $user = $this->app->getAuth()->getLoggedUser();
                                        $this->app->getAuth()->logout();
                                        $user->delete();
                                        $this->app->getAuth()->login($formData['newEmail'], $formData['passwordNew'],);
                                    }
                                } else {
                                    $data =['message' => "Starý a nový mail sú rovnaké"];
                                }
                            }
                            if ($edit) {
                                $data =['message' => "Úspešná zmena!"];
                            }
                        } else {
                            $data =['message' => "Heslá sa nezhodovali"];
                        }
                    } else {
                        $data =['message' => "Staré a nové heslo sú rovnaké"];
                    }
                } else {
                    $data =['message' => "Neúspešná zmena!"];
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
        $data = null;
        if (isset($formData['submit'])) {
            if ($formData['login'] != null && $formData['password'] != null && $formData['name'] != null && $formData['surname'] != null) {
                $register = $this->app->getAuth()->register($formData['login'], $formData['password'], $formData['name'], $formData['surname']);
                if ($register) {
                    return $this->redirect($this->url("auth.edit"));
                }
            } else {
                $data = ['message' => 'Údaje neboli vyplnené!'];
            }
        } else {
            $data = ($register === false ? ['message' => 'Neúspešná registrácia!'] : []);
        }

        return $this->html($data);
    }

    /**
     * Login a user
     * @return Response
     */
    public function login(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        $logged = null;
        $data = null;
        if (isset($formData['submit'])) {
            if ($formData['login'] != null && $formData['password'] != null) {
                $logged = $this->app->getAuth()->login($formData['login'], $formData['password']);
                if ($logged) {
                    return $this->redirect($this->url("admin.index"));
                }
            } else {
                $data = ['message' => 'Údaje neboli vyplnené!'];
            }
        } else {
            $data = ($logged === false ? ['message' => 'Zlý login alebo heslo!'] : []);
        }

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
