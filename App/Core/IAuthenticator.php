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

    public function getLoggedUserId(): int;

    /**
     * Return, if a user is logged or not
     * @return bool
     */
    public function isLogged(): bool;

    public function edit(mixed $login, mixed $password, mixed $name, mixed $surname): bool;

    public function getPermissionLevel(): int;
}
