<?php

namespace Rootdown;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

class Articles{

    private $model;

    public function __construct($model){

        $this->model = $model;
        
        $files = new Finder();
        $articles = $files->files()->in('../data/articles');

        $feed = [];

        foreach($articles as $article){
            $feed[] = Yaml::parseFile($article->getRealPath());            
        }

        $this->model['articles'] = $feed;

        usort($this->model['articles'], function($a, $b){
            if ($a['date'] == $b['date']) {
                return 0;
            }
            return ($a['date'] > $b['date']) ? -1 : 1;
        });

        // var_dump($feed);

    }
    public function data(){
        return $this->model;
    }
}