<?php

/**
 * Generates a random string
 * @param string $length
 * @param string $keyspace
 * @return string
 */
function randomGenerator($length = '20', $keyspace = 'abcdefghijklmnopqrstuvwxyz') {
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;

    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[mt_rand(0, $max)];
    }
    return $str;
}

/**
 * @param array $array
 * @param integer $subdomainLength
 *
 * Example: $array =  = [agov" => ["name" =>"aGov", "path" => "https://www.drupal.org/project/agov"]];
 */
function showDistros($array, $subdomainLength = 10) {
    foreach ($array as $key => $value) {
        print '<li><a target="_blank" class="link-' . $key . ' .
        link" href="/container.php?distro=' . $key . '&id=' . randomGenerator($subdomainLength) . '">' . $value['name'] . '</a>
        <div class="project-url"><a target="_blank" href="' . $value["path"] . '">Project source</a></div></li>';
    }
}

/**
 * @param string $adsense
 * @return string
 */
function googleAdsense($adsense = "") {
    $text = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>';
    $text .= '<script>(adsbygoogle = window.adsbygoogle || []).push({';
    $text .= 'google_ad_client: "ca-pub-' . $adsense . ', enable_page_level_ads: true });</script>';

    return $text;
}


/**
 * @param string $code
 * @return string
 */
function googleAnalytics($code) {
    $script = "";

    $script .= '<script async src="https://www.googletagmanager.com/gtag/js?id=' . $code . '"></script>';
    $script .= '<script>';
    $script .= 'window.dataLayer = window.dataLayer || []; function gtag() { dataLayer.push(arguments); }';
    $script .= "gtag('js', new Date());";
    $script .= "gtag('config', '" . $code . "');";
    $script .= '</script>';

    return $script;
}

/**
 * @param string $id
 * @return string
 */
function shareThis($id) {
    $script = "";
    $script .= "<script type='text/javascript' ";
    $script .= "src='//platform-api.sharethis.com/js/sharethis.js#property=" . $id . "&product=sticky-share-buttons' ";
    $script .= "async='async'>";
    $script .= "</script>";

    return $script;
}

/**
 * @return string
 */
function footerMessage() {
    $text = "";
    $text .= '&copy; 2017 <a href="https://www.theodorosploumis.com/en">TheodorosPloumis</a>';
    $text .= ' | ';
    $text .= "<a href='https://github.com/theodorosploumis/drupal-docker-distros'>Github</a>";
    $text .= ' | ';
    $text .= 'Hosted on <a href="https://m.do.co/c/1123d0854c8f">DigitalOcean</a>';

    return $text;
}

function drupalMessage() {
    $text = "";
    $text .= '<a href="https://www.drupal.org">Drupal</a> ';
    $text .= 'is a <a href="http://drupal.com/trademark">registered trademark</a> ';
    $text .= 'of <a href="http://buytaert.net">Dries Buytaert</a>.';

    return $text;
}