<?php

abstract class Entity
{
    private $pdo;
    private $tableName;
    private $request = null;
    public $object = null;
    public $objects = null;
    private $currentNum = 0;
    private $isSelect = false;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->pdo = DB::GetInstance();
    }

    public function save(){
        $class = get_class($this);
        $ref = new ReflectionClass($class);
        $arr = $ref->getProperties();
        $obj = new stdClass();
        foreach ($arr as $val) {
            if($val->class == $class){
                $name = $val->name;
                $obj->$name = $this->$name;
            }
        }
        if($this->id == null){
            $this->object = $obj;
            $this->insert()->execute();
        }else{
            $this->select()->where(['id'=>$this->id])->execute();
            if($this->object != null){
                $this->object = $obj;
                $this->update()->execute();
            }else{
                $this->object = $obj;
                $this->insert()->execute();
            }
        }
        return $this;
    }
    //подготавливает update-часть запроса
    private function update()
    {
        $this->isSelect = false;
        $this->request = new RequestUpdateBuilder($this->tableName);
        $this->request->setUpdateFields($this->object);
        return $this;
    }

    //подготавливает insert-часть запроса
    private function insert()
    {
        $this->isSelect = false;
        $this->request = new RequestInsertBuilder($this->tableName);
        $this->request->setInsertFields($this->object);
        return $this;
    }

    //подготавливает select-часть запроса
    public function select($fields = null)
    {
        $this->isSelect = true;
        if($this->request == null) {
            $this->request = new RequestSelectBuilder($this->tableName);
        }
        $this->request->setSelectFields($fields);
        return $this;
    }
    public function leftJoin($tableName, $field, $toField){
        $this->request->setLeftJoin($tableName, $field, $toField);
        return $this;
    }
    //добавляем поле count()
    public function count($fieldName){
        $this->request->setCountField($fieldName);
        return $this;
    }
    //добавляем секцию GROUP BY
    public function group($fields){
        $this->request->setGroupFields($fields);
        return $this;
    }
    //подготавливает where-часть запроса
    public function where($fields)
    {
        $this->request->setWhereFields($fields);
        return $this;
    }
    //выполняет запрос
    public function execute(){
        $request = $this->request->getRequest();
        //echo "REQUEST: $request<br>";
        try {
            if ($request == null) {
                throw new Exception("Empty request!");
            }
            $query = $this->pdo->prepare($request, array(
                PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY
            ));
            $query->execute();
            if($this->isSelect) {
                $this->objects = $query->fetchAll();
                $this->object = $this->getObject();
            }
            $this->request = null;
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
            $this->$key = $val;
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