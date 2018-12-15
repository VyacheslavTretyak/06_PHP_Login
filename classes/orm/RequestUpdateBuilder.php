<?php

class RequestUpdateBuilder
{
    private $tableName;
    private $updateFields;
    private $fields;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    public function setUpdateFields($fields)
    {
        $this->fields = $fields;
        $this->updateFields = [];
        foreach ($fields as $key=>$val) {
            if($key !="id") {
                $this->updateFields[] = " $key = '$val' ";
            }
        }
        return $this;
    }
    public function getRequest(){
        $request = "UPDATE $this->tableName SET ";
        $request.=implode(', ', $this->updateFields);
        $id = $this->fields->id;
        $request.=" WHERE id='$id';";
        return $request;
    }

}