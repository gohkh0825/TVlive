<?php
    $id = $_GET["id"];
    
    $substring = $iqu[$qu];
$qu = $_GET['qu'];

$iqu = array(
          "480p"=>"94",
          "720p"=>"95",
          "720p60"=>"300",
          "1080p"=>"96",
          "1080p60"=>"301",
        );

    function get_data($url) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, "facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)");
        curl_setopt($ch, CURLOPT_REFERER, "http://facebook.com");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    $string = get_data('https://www.youtube.com/'.$id.'/live');
    preg_match_all('/hlsManifestUrl(.*m3u8)/',$string,$matches, PREG_PATTERN_ORDER);
    $rawURL=str_replace("\/", "/", substr($matches[1][0],3));
    preg_match_all('/(https:\/.*\/'.$iqu[$qu].'\/.*index.m3u8)/',get_data($rawURL),$playURL,PREG_PATTERN_ORDER);
    header("Content-type: application/vnd.apple.mpegurl");
    header("Location: ".$playURL[1][0]);

?>