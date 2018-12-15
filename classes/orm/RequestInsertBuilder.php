<?php

class RequestInsertBuilder
{
    private $tableName;
    private $insertFields;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    public function setInsertFields($fields)
    {
        $this->insertFields = (array)$fields;
        return $this;
    }
    public function getRequest(){

        $request = "INSERT INTO $this->tableName(";
        $keys = array_keys($this->insertFields);
        $request.=implode(', ', $keys);
        $request.=") VALUES (";
        $vals = array_values($this->insertFields);
        foreach ($vals as $key=>$val){
            $vals[$key] = "'$val'";
        }
        $request.=implode(', ', $vals);
        $request.=");";
        return $request;
    }

}