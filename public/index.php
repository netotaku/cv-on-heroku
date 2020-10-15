<?php 

    require '../vendor/autoload.php';

    $router = new Rootdown\Router();
    
    $model = new Rootdown\Model($router);
    $model = new Rootdown\Middleware($model);
    $model = new Rootdown\Controller($model);
    
    new Rootdown\View($model);

    // dd();

    // $data = Yaml::parseFile('data/cv.yml');

    // $data['last_updated'] = filemtime('data/cv.yml');
    // $data['cache_buster'] = filemtime('assets/css/main.css');

    // ////////////



    // // render

    // 

?>