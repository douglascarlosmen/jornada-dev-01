<?php
require_once('./config/database.php');

class Model
{

    protected static $tabelaNome = "";
    protected static $colunas = [];
    protected $values = [];


    public function salvar()
    {
        $sql = "INSERT INTO " . static::$tabelaNome . " (" . implode(",", static::$colunas) . ") VALUES (";
        
        foreach(static::$colunas as $col){
            $sql .= static::getFormataValores($this->$col) . ",";
        }
        $sql[strlen($sql) - 1] = ")";

        $id = $sql = DataBase::executeSql($sql);
        $this->id = $id;
    }

    //Method format valus in string
    private static function getFormataValores($value) {
        if(is_null($value)) {
           return "null";
        } else if(gettype($value) === 'string') {
           return "'${value}'";
        } else {
           return $value;
        }
     }
}
