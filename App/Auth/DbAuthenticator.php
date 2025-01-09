<?php
namespace App\Auth;

use App\Core\IAuthenticator;
use App\Models\User;

class DbAuthenticator implements IAuthenticator
{
    public function __construct()
    {
        session_start();
    }

    public function login($login, $password): bool
    {
        $users = User::getAll('`email` LIKE ?', [$login], limit: 1);
        if (sizeof($users) > 0) {
            $user = $users[0];
            if (password_verify($password, $user->getPassword())) {
                $_SESSION['user'] = $user->getId();
                return true;
            }
        }
        return false;
    }

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
        $novy->setPassword(password_hash($password, PASSWORD_DEFAULT));
        $novy->setName($name);
        $novy->setSurname($surname);
        $novy->setPermissions(0);
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
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $user->setName($name);
                $user->setSurname($surname);
                $user->save();
                return true;
            }
        }
        return false;
    }

    public function logout(): void
    {
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            session_destroy();
        }
    }

    public function isLogged(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user'] != null;
    }

    public function getLoggedUserId(): int
    {
        return $_SESSION["user"];
    }

    public function getPermissionLevel(): int
    {
        return User::getOne($this->getLoggedUserId())->getPermissions();
    }
}