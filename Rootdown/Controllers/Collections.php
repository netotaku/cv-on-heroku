<?php

namespace Rootdown;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

class Collections{

    private $model;

    public function __construct($model){

        $url = getenv('JAWSDB_MARIA_URL');
        $parts = parse_url($url);

        $this->model = $model;
        $this->model["collectables"] = [];

        // echo $parts['host'] . "<br>";
        // echo $parts['user'] . "<br>";
        // echo $parts['pass'] . "<br>";
        // echo ltrim($parts['path'],'/');

        $mysqli = new \mysqli(
            $parts['host'], 
            $parts['user'], 
            $parts['pass'], 
            ltrim($parts['path'],'/'));



        if ($results = $mysqli -> query("
                            
            SELECT * FROM collectables
            
            left outer join collections ON collectable_collection = collection_id 
            left outer join collected on collected_collectable = collectable_id
            left outer join nerds on collected_nerd = nerd_id
            left outer join sources on collected_source = source_id;

        ")) {

            while($result = $results->fetch_array()){
                $this->model["collectables"][] = $result;
            }
        
            $results -> free_result();

        } 


        $this->model["collections"] = [];


        if ($results = $mysqli -> query('SELECT SUM(`collected_price`) FROM `collected`')) {

            while($result = $results->fetch_array()){
                $this->model["collections"]['total'] = $result[0];
            }
        
            $results -> free_result();

        } 


        if ($results = $mysqli -> query('SELECT * FROM `collections` LIMIT 50')) {

            while($result = $results->fetch_array()){
                $this->model["collections"]['collections'][] = $result;
            }
        
            $results -> free_result();

        }     
        
        if ($results = $mysqli -> query('SELECT * FROM `sources` LIMIT 50')) {

            while($result = $results->fetch_array()){
                $this->model["collections"]['sources'][] = $result;
            }
        
            $results -> free_result();

        }  
        
        if ($results = $mysqli -> query('SELECT * FROM `nerds` LIMIT 50')) {

            while($result = $results->fetch_array()){
                $this->model["collections"]['nerds'][] = $result;
            }
        
            $results -> free_result();

        }  

        // SELECT * FROM `collections` LIMIT 50

        // var_dump($this->model["collections"]['list']);

        // 

        // echo "Collections";
        
    }
    public function data(){
        return $this->model;
    }
}