<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\LinkGenerator;
use App\Core\Responses\Response;
use App\Core\Responses\ViewResponse;
use App\Models\User;

/** @var LinkGenerator $link */


/**
 * Class AuthController
 * Controller for authentication actions
 * @package App\Controllers
 */
class AuthController extends AControllerBase
{
    public function authorize(string $action): bool
    {
        switch ($action) {
            case 'edit' :
            case 'logout' :
                return $this->app->getAuth()->isLogged();
            case 'login':
            case 'register':
            case 'index':
                return !$this->app->getAuth()->isLogged();
            default:
                return false;
        }    }


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
        $formData = $this->app->getRequest()->getPost();
        $data = null;

        if (isset($formData['remove'])) {
            $user = User::getOne($this->app->getAuth()->getLoggedUserId());
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
            $user = User::getOne($this->app->getAuth()->getLoggedUserId());
            if ($formData['oldPassword'] == $user->getPassword()) {
                if ($formData['name'] != null && $formData['surname'] != null && !ctype_space($formData['name']) &&
                    !ctype_space($formData['surname'])) { //ctype_space funkcia vrati podla toho ci je su medzery
                    if (sizeof($formData) == 5) {
                        // zmena mailu
                        if ($formData['newLogin'] != $user->getEmail()) {
                            $userWithEmail = User::getAll('`email` LIKE ?', [$formData['newLogin']], limit: 1)[0];
                            if (isset($userWithEmail) && $userWithEmail->getEmail() == $formData['newLogin']) {
                                $data = ['message' => 'Daný mail už je použitý pri inom užívateľovi!'];
                                return $this->html($data);
                            }
                            $user->setEmail($formData['newLogin']);
                            $user->save();
                            $data = ['message' => 'Úspešná zmena!'];
                        } else {
                            $data = ['message' => "Starý a nový mail sú rovnaké"];
                        }
                        return $this->html($data);
                    } else if ($formData['newLogin'] == null && $formData['newPassword'] != null &&
                        $formData['confirmPassword'] != null) {
                        if ($formData['newPassword'] == $formData['confirmPassword']) {
                            if ($formData['oldPassword'] != $formData['newPassword']) {
                                //ked nemenim mail ale menim hesla
                                $this->app->getAuth()->edit($user->getEmail(), $formData['newPassword'],
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
                        $this->app->getAuth()->edit($user->getEmail(), $formData['oldPassword'],
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
        $formData = $this->app->getRequest()->getPost();
        $register = null;
        $data = null;
        if (isset($formData['submit'])) {
            if ($formData['login'] != null && $formData['password'] != null && $formData['name'] != null && $formData['surname'] != null) {
                $register = $this->app->getAuth()->register($formData['login'], $formData['password'], $formData['name'], $formData['surname']);
                if ($register) {
                    return $this->redirect($this->url("auth.edit"));
                } else {
                    $data = ['message' => 'Užívateľ s danou emailovou adresou už existuje!',
                        'name' => $formData['name'],
                        'surname' => $formData['surname'],
                        ];
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
                    return $this->redirect($this->url("advert.add"));
                }
                $data = ['login'=>$formData['login']];
            }
            $data += ($logged === false ? ['message' => 'Zlý login alebo heslo!'] : []);
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
