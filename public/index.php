<?php 

    require '../vendor/autoload.php';

    new Rootdown\Controller();
    new Rootdown\View();
    new Rootdown\Model();

    // dd();

    // $data = Yaml::parseFile('data/cv.yml');

    // $data['last_updated'] = filemtime('data/cv.yml');
    // $data['cache_buster'] = filemtime('assets/css/main.css');

    // ////////////

    // $twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader('templates'), [
    //     'cache' => false // 'templates_cache',
    // ]);

    // // filters

    // $twig->addFilter(new \Twig\TwigFilter('format_date', function ($dt) {
    //     $o = "Current";
    //     if($dt != 'Current'){
    //         $o = gmdate("M, Y", $dt); 
    //     }
    //     return $o;
    // }));

    // //////////

    // $twig->addFilter(new \Twig\TwigFilter('markdown', function ($string) {
    //     return Markdown::defaultTransform($string);
    // }));

    // // render

    // echo $twig->render('cv.twig', $data);

?>