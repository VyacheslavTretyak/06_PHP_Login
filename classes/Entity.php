<?php

class Entity
{
    private $pdo;
    private $tableName;
    private $requestSelect = null;
    public $object = null;
    public $objects = null;
    private $currentNum = 0;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->pdo = DB::GetInstance();
    }
    //подготавливает select-часть запроса
    public function select($fields = null)
    {
        if($this->requestSelect == null) {
            $this->requestSelect = new RequestSelectBuilder($this->tableName);
        }
        $this->requestSelect->setSelectFields($fields);
        return $this;
    }
    public function leftJoin($tableName, $field, $toField){
        $this->requestSelect->setLeftJoin($tableName, $field, $toField);
        return $this;
    }
    //добавляем поле count()
    public function count($fieldName){
        $this->requestSelect->setCountField($fieldName);
        return $this;
    }
    //добавляем секцию GROUP BY
    public function group($fields){
        $this->requestSelect->setGroupFields($fields);
        return $this;
    }
    //подготавливает where-часть запроса
    public function where($fields)
    {
        $this->requestSelect->setWhereFields($fields);
        return $this;
    }
    //выполняет запрос
    public function execute(){
        $request = $this->requestSelect->getRequest();
      //  echo "REQUEST: $request<br>";
        try {
            if ($request == null) {
                throw new Exception("Empty request!");
            }
            $query = $this->pdo->prepare($request, array(
                PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY
            ));
            $query->execute();
            $this->objects = $query->fetchAll();
            if (count($this->objects) == 0) {
                throw new Exception("Empty result!");
            }
            $this->object = $this->getObject();
            $this->requestSelect = null;
        }catch (Exception $ex){
            echo $ex->getMessage();
        }
    }
    //создает объект из массива
    private function getObject(){
        if(count($this->objects) == 0){
            return null;
        }
        $object = new stdClass();
        foreach ($this->objects[$this->currentNum] as $key=>$val){
            if(is_int($key )){
                continue;
            }
            $object->$key = $val;
        }
        return $object;
    }
    //если возвращает false значит перебор начался заново
    public function next(){
        $this->currentNum++;
        $isNext = true;
        if($this->currentNum>=count($this->objects)){
            $this->currentNum = 0;
            $isNext = false;
        }
        $this->object = $this->getObject();
        return $isNext;
    }


}