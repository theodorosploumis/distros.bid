<?php

if (file_exists(__DIR__ . '/settings.php')) {
    require_once __DIR__ . '/settings.php';
} else {
    print "Setting file does not exist. Please copy default.settings.php to settings.php.";
    exit();
}

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/distributions.php';

?>

<html>

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <title>Try Drupal Distributions</title>

    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Cutive+Mono" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="20x20" href="favicon.png">

    <?php print googleAnalytics($google_analytics_code); ?>
    <?php print googleAnalytics($sharethis); ?>
    <?php print googleAdsense($adsense); ?>

</head>

<body>
<h1>Try Drupal Distributions<sup>beta</sup></h1>

<section class="wrapper">

    <p class="info">
        <b>Drupal Admin</b><br>
        <br>
        <br>
        <b>username:</b>admin<br>
        <b>password:</b>admin<br>
    </p>
    <p class="info">
        <b>Adminer</b> (/adminer.php)<br>
        <br>
        <b>DB name:</b>drupal<br>
        <b>DB password:</b>drupal<br>
        <b>DB username:</b>drupal<br>
    </p>

    <h2>8.x version</h2>
    <ul class="starters">
        <?php showDistros($images8, $subdomainLength); ?>
    </ul>

    <h2>7.x version</h2>
    <ul class="starters">
        <?php showDistros($images7, $subdomainLength); ?>
    </ul>

</section>

<footer>
    <p>
        <?php print footerMessage(); ?>
    </p>
    <p>
        <?php print drupalMessage(); ?>
    </p>
</footer>

</body>
</html>