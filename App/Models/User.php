<?php
namespace App\Models;
use App\Core\Model;

class User extends Model
{
    protected int $id;
    protected string $name;
    protected string$surname;
    protected string$email;
    protected $password;

    protected int $permissions;


    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return int
     */
    public function getPermissions(): int
    {
        return $this->permissions;
    }

    /**
     * @param int $permissions
     */
    public function setPermissions(int $permissions): void
    {
        $this->permissions = $permissions;
    }

}