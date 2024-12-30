<?php

namespace App\Core;

use App\Models\User;

/**
 * Interface IAuthenticator
 * Interface for authentication
 * @package App\Core
 */
interface IAuthenticator
{
    /**
     * Perform user login
     * @param $login
     * @param $password
     * @return bool
     */
    public function login($login, $password): bool;

    /**
     * Perform user login
     * @return void
     */
    public function logout(): void;

    public function register($login, $password, $name, $surname): bool;

    /**
     * Return name of a logged user
     * @return string
     */
    public function getLoggedUserName(): string;
    public function getLoggedUserSurname(): string;
    public function getLoggedUserEmail(): string;
    public function getLoggedUserPassword(): string;
    public function getLoggedUserId(): int;
    public function getIfLogged(): bool;


    /**
     * Return a context of logged user, e.g. user class instance
     * @return mixed
     */
    public function getLoggedUser(): User;
    /**
     * Return, if a user is logged or not
     * @return bool
     */
    public function isLogged(): bool;

    public function edit(mixed $login, mixed $password, mixed $name, mixed $surname): bool;
}
