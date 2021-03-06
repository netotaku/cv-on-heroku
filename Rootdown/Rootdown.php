<?php 

namespace Rootdown;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Dotenv\Dotenv;
use Purl\Url;
use Michelf\Markdown;

use Rootdown\Controllers;

class Rootdown {

    public function __construct(){  
        
        if(file_exists('../.env')){
            $dotenv = new Dotenv();
            $dotenv->load('../.env');    
        }  

        $model = $this->model();
        $view = $this->view();
        $this->controller($model, $view);
        
    }

    private function file(){

        $file = false;

        $files = new Finder();
        $files->files()->in('../data')->exclude('system');
        
        foreach ($files as $f) {                  
           $yml = Yaml::parseFile($f->getRealPath());      
           if(rtrim($yml['path'], '/\\') == rtrim(Url::fromCurrent()->path, '/\\')){
              $file = $f->getRealPath();
           }
        }

        if(!$file){
            $file = '../data/system/404.yml';
            header("HTTP/1.0 404 Not Found");
        }

        return $file;
    }

    private function controller($model, $view){   
        
        if(isset($model["controller"])){
            foreach($model["controller"] as $controller){
                $cls = "Rootdown\\" . $controller;
                $c = new $cls($model);
                $model = $c->data();
            }            
        }

        echo $view->render($model["template"] . '.twig', $model);        

    }

    private function model(){

        $file   = $this->file();

        $model = Yaml::parseFile($file);
        $model['last_updated'] = filemtime($file);
        $model['cache_buster'] = filemtime('assets/css/style.css');
        
        $globals = Yaml::parseFile('../data/system/globals.yml');

        $model = array_merge($model, $globals);

        return $model;
    }

    private function view(){

        $view = new \Twig\Environment(new \Twig\Loader\FilesystemLoader('../templates'), [
            'cache' => (getenv('ENV') == 'local' ? false : '../templates_cache'),
            'debug' => true ]);
   
        // filters
   
        $view->addFilter(new \Twig\TwigFilter('format_date', function ($dt) {
            $o = "Current";
            if($dt != 'Current'){
                $o = gmdate("M, Y", $dt); 
            }
            return $o;
        }));

        $view->addFilter(new \Twig\TwigFilter('handle_empty', function ($string) {
            return ($string == "") ? "&#8212;" : $string;
        }));
   
        //////////
   
        $view->addFilter(new \Twig\TwigFilter('markdown', function ($string) {
            return Markdown::defaultTransform($string);
        }));     
        
        $view->addFilter(new \Twig\TwigFilter('format_money', function ($string) {
            $int = (int)$string/100;
            \setlocale(LC_MONETARY, 'en_GB.UTF-8');
            return \money_format('%n', $int);
        })); 
        
        $view->addFilter(new \Twig\TwigFilter('stars', function ($rating) {

            $rating = (int)$rating;
            $stars = "";

            for($i=0; $i < $rating; $i++){
                $stars .= "&#9733; ";
            }  
            
            for($i=0; $i < (5-$rating); $i++){
                $stars .= "&#9734; ";
            }  

            return $stars;

        }));         

        $view->addExtension(new \Twig\Extension\DebugExtension());

        return $view;

    }

}