<?php

class RequestSelectBuilder
{
    private $table;
    private $selectFields = [];
    private $whereFields = [];
    private $groupFields = [];
    private $leftJoinFields = [];
    private $lastTable;
    private $mainTable;

    public function __construct($table)
    {
        $this->table = $table;
        $this->lastTable = $table;
        $this->mainTable = $table;
    }

    public function setSelectFields($fields)
    {
        if($fields == null){
            $this->selectFields[] = "$this->lastTable.*";
        }elseif(is_array($fields)){
            foreach ($fields as $val){
                $this->selectFields[] = "$this->lastTable.$val as $this->lastTable"."_$val";
            }
        }else {
            $this->selectFields[] = "$this->lastTable.$fields as $this->lastTable"."_$fields";
        }
    }

    public function setLeftJoin($tableName, $field, $toField)
    {
        $this->leftJoinFields[] = array($tableName, $this->mainTable, $field, $toField);
        $this->lastTable = $tableName;
    }

    public function setWhereFields($fields)
    {
        foreach ($fields as $key=>$val) {
            $this->whereFields[] = "$this->lastTable.$key='$val'";
        }
    }

    public function setCountField($fieldName)
    {
        $this->selectFields[] = " count($this->lastTable.$fieldName) as count_$fieldName ";
    }

    public function setGroupFields($field)
    {
        $this->groupFields[$this->lastTable] = "$this->lastTable.$field";
    }

    public function getRequest()
    {
        $request = " SELECT ";
        $request.=implode(', ', $this->selectFields);
        $request .= " FROM $this->table ";
        foreach ($this->leftJoinFields as $val) {
            $request .= " LEFT JOIN $val[0] ON $val[0].$val[2] = $val[1].$val[3] ";
        }
        if (count($this->whereFields) > 0) {
            $request .= " WHERE ";
            $request.=implode(' AND ', $this->whereFields);
        }
        if (count($this->groupFields) > 0) {
            $request .= " GROUP BY ";
            $request.=implode(', ', $this->groupFields);
        }
        $request .= ";";
        return $request;
    }
}