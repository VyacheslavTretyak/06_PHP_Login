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
        $this->selectFields[] = "count($this->lastTable.$fieldName) as count_$fieldName";
    }

    public function setGroupFields($field)
    {
        $this->groupFields[$this->lastTable] = "$this->lastTable.$field";
    }

    public function getRequest()
    {
        $request = "SELECT ";
        $countSelectFields = count($this->selectFields);
        $count = $countSelectFields;
        foreach ($this->selectFields as $val) {
            $request .= "$val ";
            if (--$count > 0) {
                $request .= ", ";
            }
        }

        $request .= "FROM $this->table ";
        $countLeftJoin = count($this->leftJoinFields);
        if ($countLeftJoin > 0) {
            foreach ($this->leftJoinFields as $val) {
                $request .= "LEFT JOIN $val[0] ON $val[0].$val[2] = $val[1].$val[3] ";

            }
        }

        $countWhereFields = count($this->whereFields);
        if ($countWhereFields > 0) {
            $request .= "WHERE ";
            $count = $countWhereFields;
            foreach ($this->whereFields as $val) {
                $request .= "$val ";
                if (--$count > 0) {
                    $request .= ", ";
                }
            }
        }
        $countGroupFields = count($this->groupFields);
        if ($countGroupFields > 0) {
            $request .= "GROUP BY ";
            $count = $countGroupFields;
            foreach ($this->groupFields as $key => $val) {
                $request .= "$val ";
                if (--$count > 0) {
                    $request .= ", ";
                }
            }
        }
        $request .= ";";
        return $request;
    }
}