<?php 

namespace Rootdown;

use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;
use Purl\Url;

class Router {

   public function __construct(){
      // echo 'Router<br>';        

      $finder = new Finder();

      $finder->files()->in('../pages')->exclude('system');

      foreach ($finder as $file) {         
         // echo $file->getRelativePathname() . '<br>';
         $yml = Yaml::parseFile($file->getRealPath());
         if($yml['path'] == Url::fromCurrent()->path){
            echo "hit";
         }

     }

   }

}