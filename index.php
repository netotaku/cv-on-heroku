<?php 
    
    require __DIR__ . '/vendor/autoload.php';

    use Michelf\Markdown;
    use Symfony\Component\Yaml\Yaml;

    $data = Yaml::parseFile('cv.yml');
    $data['last_updated'] = $last_updated;
    $data['cache_buster'] = $cache_buster;

    function format($dt){

    }

    ////////////

    $loader = new \Twig\Loader\FilesystemLoader('templates');

    $twig = new \Twig\Environment($loader, [
        'cache' => false // 'templates_cache',
    ]);


    // filters

    $filter = new \Twig\TwigFilter('format_date', function ($dt) {
        $o = "Current";
        if($dt != 'Current'){
            $o = gmdate("M, Y", $dt); 
        }
        return $o;
    });

    $twig->addFilter($filter);

    //////////

    $filter = new \Twig\TwigFilter('markdown', function ($string) {
        return Markdown::defaultTransform($string);
    });

    $twig->addFilter($filter);

    // render

    echo $twig->render('lowfi.twig', $data);

?>