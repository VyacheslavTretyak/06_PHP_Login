<?php

class Session extends Entity
{
    const TABLE = 'sessions';
    public $id;
    public $hash;
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

}