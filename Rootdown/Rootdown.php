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
        $files->files()->in('../config')->exclude('system');
        
        foreach ($files as $f) {                  
           $yml = Yaml::parseFile($f->getRealPath());      
           if(rtrim($yml['path'], '/\\') == rtrim(Url::fromCurrent()->path, '/\\')){
              $file = $f->getRealPath();
           }
        }

        if(!$file){
            $file = '../config/system/404.yml';
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
        $model['cache_buster'] = filemtime('assets/css/main.css');
        
        $globals = Yaml::parseFile('../config/system/globals.yml');

        $model = array_merge($model, $globals);

        return $model;
    }

    private function view(){

        $view = new \Twig\Environment(new \Twig\Loader\FilesystemLoader('../templates'), [
            'cache' => (getenv('ENV') == 'local' ? false : '../templates_cache') ]);
   
        // filters
   
        $view->addFilter(new \Twig\TwigFilter('format_date', function ($dt) {
            $o = "Current";
            if($dt != 'Current'){
                $o = gmdate("M, Y", $dt); 
            }
            return $o;
        }));
   
        //////////
   
        $view->addFilter(new \Twig\TwigFilter('markdown', function ($string) {
            return Markdown::defaultTransform($string);
        }));      

        return $view;

    }
}