<?php
class User extends Entity
{
    const TABLE = 'users';
    public $id;
    public $email;
    public $active;
    public $password;
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}