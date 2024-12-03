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
        $data = null;
        $edit = null;
        //todo kontrola ze ci nie su null hodnoty

        if (isset($formData['remove'])) {
            $user = $this->app->getAuth()->getLoggedUser();
            if ($user->getPassword() == $formData['oldPassword']) {
                $this->app->getAuth()->logout();
                $user->delete();
                return $this->redirect($this->url("home.index"));
            } else {
                $data = ['message' => "Nesprávne heslo!"];
                return $this->html($data);
            }
        }
        if (isset($formData['submit'])) {
            if ($formData['oldPassword'] == $this->app->getAuth()->getLoggedUserPassword()) {
                if ($formData['name'] != null && $formData['surname'] != null && !ctype_space($formData['name']) &&
                    !ctype_space($formData['surname'])) { //ctype_space funkcia vrati podla toho ci je su medzery
                    if (sizeof($formData) == 5) {
                        // zmena mailu
                        if ($formData['newLogin'] != $this->app->getAuth()->getLoggedUserEmail()) {
                            $user = $this->app->getAuth()->getLoggedUser();
                            $edit = $this->app->getAuth()->register($formData['newLogin'], $formData['oldPassword'],
                                $formData['name'], $formData['surname']);
                            //todo pozor ak budu nejake data naviazane na daky mail,
                            // tak ich bude treba prehodit tiez... napr recenzie
                            if ($edit) {
                                $user->delete();
                                $data = ['message' => 'Úspešná zmena!'];
                                return $this->html($data);
                            }
                        } else {
                            $data = ['message' => "Starý a nový mail sú rovnaké"];
                            return $this->html($data);
                        }
                    } else if ($formData['newLogin'] == null && $formData['newPassword'] != null &&
                        $formData['confirmPassword'] != null) {
                        if ($formData['newPassword'] == $formData['confirmPassword']) {
                            if ($formData['oldPassword'] != $formData['newPassword']) {
                                //ked nemenim mail ale menim hesla
                                $this->app->getAuth()->edit($this->app->getAuth()->getLoggedUserEmail(), $formData['newPassword'],
                                    $formData['name'], $formData['surname']);
                                $data = ['message' => 'Úspešná zmena!'];
                                return $this->html($data);
                            } else {
                                $data = ['message' => "Staré heslo a nové heslo sú rovnaké!"];
                            }
                        } else {
                            $data = ['message' => "Heslá sa nezhodovali"];
                        }
                    } else {
                        $this->app->getAuth()->edit($this->app->getAuth()->getLoggedUserEmail(), $formData['oldPassword'],
                            $formData['name'], $formData['surname']);
                        $data = ['message' => 'Úspešná zmena!'];
                        return $this->html($data);
                    }
                } else {
                    $data = ['message' => 'Neúspešná zmena!'];
                }
            } else {
                $data = ['message' => "Nesprávne aktuálne heslo"];

            }
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
