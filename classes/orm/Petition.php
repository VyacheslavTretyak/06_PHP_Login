<?php

class Petition extends Entity
{
    const TABLE = 'petitions';
    public $id;
    public $id_autor;
    public $subject;
    public $body;
    public $active;
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

}