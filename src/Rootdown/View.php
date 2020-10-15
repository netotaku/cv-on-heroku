<?php namespace Rootdown;

use Michelf\Markdown;

class View {

   public function __construct(){  
   
      $this->twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader('../templates'), [
         'cache' => false // 'templates_cache',
      ]);

      // filters

      $this->twig->addFilter(new \Twig\TwigFilter('format_date', function ($dt) {
            $o = "Current";
            if($dt != 'Current'){
               $o = gmdate("M, Y", $dt); 
            }
            return $o;
      }));

      //////////

      $this->twig->addFilter(new \Twig\TwigFilter('markdown', function ($string) {
            return Markdown::defaultTransform($string);
      }));

   }

   public function render($model){
     // echo $twig->render('cv.twig', $model);
   }
   
}