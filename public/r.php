<?php

    $urls = [
        "linkedin" => "https://www.linkedin.com/company/halo-media-communications-ltd/",
        "twitter" => "https://twitter.com/weare_halo",
        "facebook" => "https://www.facebook.com/wearehalo/",
        "instagram" => "https://www.instagram.com/wearehalo_bristol/",
        "WARC" => "https://www.warc.com/newsandopinion/opinion/do-you-mean-brand-brand-or-brand/4010",
        "home" => "https://wearehalo.co.uk"
    ];

    $redirect = $_GET["url"];

    $file = "../click.log";

    $data = json_decode(file_get_contents($file),TRUE);

    $data[$redirect] = $data[$redirect]+1;
    
    // var_dump($data);

    file_put_contents($file, json_encode($data));
    
    header("Location: $urls[$redirect]");
    
    exit;

?>