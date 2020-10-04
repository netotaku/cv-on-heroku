<?php 
    
    if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
        $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $location);
        exit;
    }

    require __DIR__ . '/vendor/autoload.php';

    use Michelf\Markdown;
    use Symfony\Component\Yaml\Yaml;

    $data = Yaml::parseFile('cv.yml');

    $data['last_updated'] = filemtime('cv.yml');
    $data['cache_buster'] = filemtime('assets/css/main.css');

    ////////////

    $twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader('templates'), [
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

    // render

    echo $twig->render('hifi.twig', $data);

?>