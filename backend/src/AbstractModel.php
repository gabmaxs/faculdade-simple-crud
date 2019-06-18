<?php

namespace App;

use App\Connection;

class AbstractModel {
    protected $connection;
    protected $table_name;
    protected $fillable = [];
    protected $attributes = [];
    protected $id;

    public function __construct(Array $att = null) {
        $this->connection = new Connection();
        if(!empty($att))
        foreach($att as $att_name => $att_value) {
            $this->putValueInAttributes($att_name, $att_value);
            if(in_array($att_name,$this->fillable) == 1) {
                $this->attributes[$att_name] = $att_value;
            }
        }
    }

    public function all(){
        $con = $this->connection->openConnection();
        $query = "select * from {$this->table_name} order by id";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $this->connection->closeConnection();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function save($id = null){
        if(empty($this->attributes))
            return;

        if(empty($id)) {
            $this->createRecord();
            $record = $this->getLastRecord();
        }
        else {
            $this->updateRecord($id);
            $record = $this->find($id);
        }
        $this->id = $record['id'];
        return $record;
    }

    public function find($id) {
        $con = $this->connection->openConnection();
        $query = "select * from {$this->table_name} where id = {$id}";
        $stmt = $con->query($query);
        $record = $stmt->fetch(\PDO::FETCH_ASSOC);
        $this->id = $record['id'];
        return $record ;
    }

    public function delete($id) {
        if (!$this->find($id)) return false;
        $con = $this->connection->openConnection();
        $query = "delete from {$this->table_name} where id = {$id};";
        $stmt = $con->query($query);
        return true;
    }

    private function putValueInAttributes($att_name, $att_value) {
        if(in_array($att_name,$this->fillable)) {
            $this->attributes[$att_name] = $att_value;
        }
    }

    private function updateRecord($id) {
        $this->id = $id;
        $con = $this->connection->openConnection();
        $query = "update {$this->table_name} set ";
        foreach($this->fillable as $key) {
            $query .= "{$key} = '{$this->attributes[$key]}',";
        }
        $query = substr($query, 0, -1);
        $query .= " where id = {$id};";
        $stmt = $con->prepare($query);
        $stmt->execute();
    }

    private function createRecord() {
        $con = $this->connection->openConnection();
        $at = implode(', ',array_keys($this->attributes));
        $va = "'" . implode("', '", $this->attributes) . "'";
        $query = "insert into {$this->table_name} ({$at}, created_at) values ({$va}, current_timestamp);";
        $stmt = $con->prepare($query);
        $stmt->execute();
    }

    private function getLastRecord() {
        $con = $this->connection->openConnection();
        $query = "select * from {$this->table_name} order by created_at desc limit 1;";
        $stmt = $con->prepare($query);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
