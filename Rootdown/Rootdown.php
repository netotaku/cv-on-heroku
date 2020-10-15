<?php 

namespace Rootdown;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;
use Purl\Url;
use Michelf\Markdown;

class Rootdown {


    public function __construct(){        
        $this->boot_up();
    }

    private function boot_up(){

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

        $model  = $this->model($file);

        echo '<pre>';
            var_dump($model);
        echo '</pre>';

        $twig   = $this->twig();

        echo $twig->render($model["template"] . '.twig', $model);

    }

    private function model($file){

        $model = Yaml::parseFile($file);
        $model['last_updated'] = filemtime($file);
        $model['cache_buster'] = filemtime('assets/css/main.css');
        
        $globals = Yaml::parseFile('../config/system/globals.yml');

        // var_dump($globals);

        $model = array_merge($model, $globals);

        return $model;
    }

    private function twig(){

        $twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader('../templates'), [
            'cache' => false // 'templates_cache',
        ]);
   
        // filters
   
        $twig->addFilter(new \Twig\TwigFilter('format_date', function ($dt) {
            $o = "Current";
            if($dt != 'Current'){
                $o = gmdate("M, Y", $dt); 
            }
            return $o;
        }));
   
        //////////
   
        $twig->addFilter(new \Twig\TwigFilter('markdown', function ($string) {
            return Markdown::defaultTransform($string);
        }));      

        return $twig;

    }
}