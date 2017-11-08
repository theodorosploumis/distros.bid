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
 * @param $distros_array
 * @param integer $subdomainLength
 *
 * Example: $array =  = [agov" => ["name" =>"aGov", "path" => "https://www.drupal.org/project/agov", "version" => "8.x"]];
 */
function showDistros($distros_array, $subdomainLength = 10) {
    foreach ($distros_array as $key => $value) {
        print '<li><a target="_blank" class="link-' . $key . ' .
        link" href="/container.php?distro=' . $key . '&id=' . randomGenerator($subdomainLength) . '">' .
            $value['name'] . "<br>" . $value['version'] . '</a>
        <div class="project-url"><a target="_blank" href="' . $value["path"] . '">Project source</a></div></li>';
    }
}

/**
 * @param $distros_array
 * @param $select_name
 */
function listDistros($distros_array, $select_name) {
    print "<select id='distros' name='".$select_name."' required='required'>";
    print "<option value='' selected='selected'>-- Select Distribution --</option>";
    foreach ($distros_array as $key => $value) {
        print '<option value="'.$key.'">' . $value['name'] . ' - ' . $value['version'] . '</option>';
    }
    print "</select>";
}

/**
 * @param array $distros_array
 */
function plainDistros($distros_array) {
    print "<ul class='plain-distros'>";
    foreach ($distros_array as $key => $value) {
        print '<li><a href="'.$value["path"].'">' . $value['name'] . ' - ' . $value['version'] . '</a></li> ';
    }
    print "</ul>";
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
    $text .= '<a href="https://www.vultr.com/?ref=7258956"><img src="https://www.vultr.com/media/banner_1.png" width="728" height="90"></a>';

    return $text;
}

function drupalMessage() {
    $text = "";
    $text .= '<a href="https://www.drupal.org">Drupal</a> ';
    $text .= 'is a <a href="http://drupal.com/trademark">registered trademark</a> ';
    $text .= 'of <a href="http://buytaert.net">Dries Buytaert</a>.';

    return $text;
}

/**
 * @param string $recaptcha_key
 */
function reCaptcha($recaptcha_key) {
    print '<script src="https://www.google.com/recaptcha/api.js"></script>';
    print '<div class="g-recaptcha" data-sitekey="'.$recaptcha_key.'"></div>';
}
