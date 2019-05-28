<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type , Accept");
include_once 'DbConfig.php';
class Crud extends DbConfig{

    //Construct
    public function __construct(){
        parent::__construct();
    }
    
    //Method For Get Data
    public function getData($query){
        $result=$this->connection->query($query);
        if($result==false){
            echo $this->connection->error;
            return false;
        }
        
        $rows=array();
        while($row=$result->fetch_assoc()){
            $rows[]=$row;
        }
        return $rows;
    }

    //Method For Execute Query
    public function execute($query){
        $full_result = array();
        $result=$this->connection->query($query);
        if($result==false){
            $full_result['CODE'] = 4;
            $full_result['TOPIC'] = "QUERY ERROR";
            $full_result['MSG'] =  $this->connection->error;
        }else{
            $full_result['CODE'] = 2;
            $full_result['TOPIC'] = "SUCCESS";
            $full_result['MSG'] =  "QUERY SUCCESS";  
        }
        return $full_result;
    }


    //Method For Escape String
    public function escape_string($value){
        return $this->connection->real_escape_string($value);
    }


    

}