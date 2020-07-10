<?php 
    
    require __DIR__ . '/vendor/autoload.php';

    use Michelf\Markdown;
    use Symfony\Component\Yaml\Yaml;

    $data = Yaml::parseFile('cv.yml');

    $cache_buster = filemtime('assets/css/main.css');
    $last_updated = filemtime('cv.yml');

    // echo $cache_buster;
    // echo $last_updated;

?>
<!DOCTYPE html>
<html lang="en-GB" class="html ">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?=$data["name"]?>, <?=$data["title"]?>, <?=$data["location"]?></title>
        <meta name="description" content="<?=$data["title"]?>">
        <meta name="generator" content="ZX Spectrum 128 +2" />
        <meta name="author" content="<?=$data["name"]?>">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@t_pk" />
        <meta name="twitter:creator" content="@t_pk" />
        <link rel="icon" type="image/png" href="" /> <!-- @todo -->

        <link rel="stylesheet" href="/assets/css/main.css?<?=$cache_buster?>">

        <meta property="og:image" content=""/>  <!-- @todo -->
        <meta property="og:title" content="<?=$data["name"]?>"/>
        <meta property="og:description" content="<?=$data["title"]?>"/>
        <meta property="og:site_name" content="<?=$data["name"]?>"/>
        <meta property="og:url" content="https://clar.ky"/>
        <meta property="og:type" content="website" />
        <meta property="fb:app_id" content="1592717320815147" /> 
    </head>

    <body>

        <div class="page">

            <header>
                <h1 class="u-no-gutter"><?=$data["name"]?></h1>
                <h2 class="u-no-gutter"><?=$data["title"]?></h2>
                <h3><?=$data["location"]?></h3>
            </header>

            <section>
                <?=Markdown::defaultTransform($data["personal_statement"])?>    
            </section>
            
            <section>
                <h2>Social</h2>
                <ul>
                    <li><a href="<?=$data['contact']['twitter']?>"><?=$data['contact']['twitter']?></a></li>
                    <li><a href="<?=$data['contact']['instagram']?>"><?=$data['contact']['instagram']?></a></li>
                    <li><a href="<?=$data['contact']['strava']?>"><?=$data['contact']['strava']?></a></li>
                </ul>
            </section>

            <h2>Work experience</h2>
            
            <?php foreach($data["work_experience"] as $job) : ?>    
                <section>     
                    <h3 class="u-no-gutter"><?=$job["company"]?></h3>
                    <h4><?=$job["position"]?></h4>
                    <p><?=$job["start"]?> - <?=$job["end"]?></p>
                    <?=Markdown::defaultTransform($job["description"])?>         
                </section>
            <?php endforeach ?>

            <section>
                <h2>Skills</h2>
                <div class="v2g">
                    <?php foreach($data["skills"] as $key => $cloud) : ?> 
                        <div class="skill-set v2g__box v2g__box--sml-haf v2g__box--lrg-thd">                        
                            <h3><?=$key?></h3>
                            <ul>
                                <?php foreach($cloud as $skill) : ?>    
                                    <li><?=$skill?></li>
                                <?php endforeach ?>
                            </ul>                    
                        </div>
                    <?php endforeach ?>
                </div>
            </section>
            
            <footer>
                <?=$last_updated?><br />
                https://stark-temple-23774.herokuapp.com/
            </footer>

        </div>

    </body>
</html>
