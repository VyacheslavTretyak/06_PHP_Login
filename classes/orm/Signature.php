<?php
class Signature extends Entity
{
    const TABLE = 'signatures';
    public $id;
    public $id_user;
    public $id_petition;
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}