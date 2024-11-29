<?php
namespace App\Models;
use App\Core\Model;

class User extends Model
{
    protected $email;
    protected $password;


    /**
     * Vrati primarny kluc modelu z databazy
     * @return string
     */
    public static function getPkColumnName(): string
    {
        return "email";
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
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



}