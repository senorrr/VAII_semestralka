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
        $user = User::getAll('`email` LIKE ?', [$login], limit: 1)[0];
        if ($user != null) {
            if ($user->getPassword() == $password) {
                $_SESSION['user'] = $user->getId();
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
        $_SESSION['user'] = $novy->getId();
        return true;
    }

    public function edit($login, $password, $name, $surname): bool
    {
        $users = User::getAll();
        foreach ($users as $user) {
            if ($user->getEmail() == $login) {
                $user->setEmail($login);
                $user->setPassword($password);
                $user->setName($name);
                $user->setSurname($surname);
                $user->save();
                return true;
            }
        }
        return false;
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
        return User::getOne($_SESSION['user'])->getName();
    }
    public function getLoggedUserSurname(): string
    {
        return User::getOne($_SESSION['user'])->getSurname();
    }


    public function getLoggedUserEmail(): string
    {
        return User::getOne($_SESSION['user'])->getEmail();
    }
    public function getLoggedUserId(): int
    {
        return $_SESSION['user'];
    }

    public function getIfLogged(): bool
    {
        return isset($_SESSION['user']);
    }


    /**
     * Get the context of the logged-in user
     * @return string
     */
    public function getLoggedUser(): User
    {
        $user = User::getAll('`email` LIKE ?', [$this->getLoggedUserEmail()], limit: 1)[0];
        return $user;
    }

    /**
     * Return if the user is authenticated or not
     * @return bool
     */
    public function isLogged(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user'] != null;
    }


    public function getLoggedUserPassword(): string
    {
        return User::getOne($_SESSION['user'])->getPassword();
    }
}