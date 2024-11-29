<?php

namespace App\Auth;

use App\Core\IAuthenticator;
use App\Models\User;
use App\Core\DB\Connection;
use PDO;

class DbAuthenticator implements IAuthenticator
{
    /**
     * DummyAuthenticator constructor
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * Pokusi sa prihlasit s parametrami, ak sa zhoduju hesla a loginy tak prihlasi
     *
     * @param $login
     * @param $password
     * @return bool
     * @throws \Exception
     */
    public function login($login, $password): bool
    {
        $user = User::getOne($login);
        if ($user != null) {
            if ($user->getPassword() == $password) {
                $_SESSION['user'] = $login;
                return true;
            }
        }
        return false;
    }

    /**
     * Skontroluje ze ci neexistuje uzivatel s danym emailom ak nie tak ho vytvori a ulozi do DB
     * @param $login
     * @param $password
     * @param $name
     * @param $surname
     * @return bool
     */
    public function register($login, $password, $name, $surname): bool
    {
        $users = User::getAll();
        foreach ($users as $user) {
            if ($user->getEmail() == $login) {
                return false;
            }
        }
        $novy = new User();
        $novy->setEmail($login);
        $novy->setPassword($password);
        $novy->setName($name);
        $novy->setSurname($surname);
        $novy->save();
        return true;
    }

    /**
     * Logout the user
     */
    public function logout(): void
    {
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            session_destroy();
        }
    }

    /**
     * Get the name of the logged-in user
     * @return string
     * @throws \Exception
     */
    public function getLoggedUserName(): string
    {
        return isset($_SESSION['user']) ? $_SESSION['user'] : throw new \Exception("User not logged in");
    }

    /**
     * Get the context of the logged-in user
     * @return string
     */
    public function getLoggedUserContext(): mixed
    {
        return null;
    }

    /**
     * Return if the user is authenticated or not
     * @return bool
     */
    public function isLogged(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user'] != null;
    }

    /**
     * Return the id of the logged-in user
     * @return mixed
     */
    public function getLoggedUserId(): mixed
    {
        return $_SESSION['user'];
    }


}