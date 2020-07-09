<?php 
    
    require __DIR__ . '/vendor/autoload.php';

    use Michelf\Markdown;

    $data = yaml_parse_file("cv.yml"); 

?>
<html>
    <head>
        <title><?=$data["name"]?>, <?=$data["title"]?>, <?=$data["location"]?></title>
    </head>

    <body>

        <header>
            <h1><?=$data["name"]?></h1>
            <h2><?=$data["title"]?></h2>
            <h3><?=$data["location"]?></h3>
        </header>

        <?=Markdown::defaultTransform($data["personal_statement"])?>    

        <article> 
            <h1>Work experience</h1>
            <?php foreach($data["work_experience"] as $job) : ?>        
                <h2><?=$job["company"]?></h2>
                <?=$job["company"]?> 
                <?=Markdown::defaultTransform($job["description"])?>         
            <?php endforeach ?>
        </article>

        <footer>
            https://stark-temple-23774.herokuapp.com/
        </footer>

    </body>
</html>
