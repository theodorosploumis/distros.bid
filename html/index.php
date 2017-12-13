<?php

if (file_exists(__DIR__ . '/settings.php')) {
    require_once __DIR__ . '/settings.php';
} else {
    print "Settings.php file does not exist. Please copy default.settings.php to settings.php.";
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
    <link href="https://fonts.googleapis.com/css?family=Lato|Source+Sans+Pro:300,400" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon" />

    <?php print googleOptimize($google_optimize_code); ?>
    <?php print googleAnalyticsOptimize($google_analytics_code, $google_optimize_code); ?>
    <?php print shareThis($sharethis); ?>

</head>

<body>
<div class="logo"><img src="logo.png"></div>
<h1>Try Drupal Distributions<sup>beta</sup></h1>

<section class="wrapper">

    <p class="info">
        <b>Drupal Admin</b> (/user)<br>
        <br>
        <b>username:</b> admin<br>
        <b>password:</b> admin<br>
        <b>email:</b> admin@example.com<br>
    </p>
    <p class="info">
        <b>Adminer</b> (/adminer.php)<br>
        <br>
        <b>DB name:</b> drupal<br>
        <b>DB password:</b> drupal<br>
        <b>DB username:</b> drupal<br>
    </p>
    <p class="info">
        <b>Terminal</b> (/terminal.php)<br>
        <br>
        <br>
        <b>User:</b> www-data<br>
        <b>Password:</b> password<br>
    </p>

    <div class="starters">

        <form id="submit-form" class="form" action="container.php" method="get">

            <label class="hidden">Distribution:</label>
            <?php listDistros($distros, "distro"); ?>

            <label class="hidden">Site name*:</label>
            <input name="name" placeholder="Site name, eg 'My Drupal site'" value="" required="required">

            <label class="hidden">ID*:</label>
            <input type="hidden" name="id" required="required"
                   value="<?php echo randomGenerator(10); ?>" readonly="readonly">

            <?php reCaptcha($recaptcha_key); ?>

            <input id="submit-button" type="submit" value="Create site">

            <span><sup>*</sup>Notice: Sites are available for <b>59 minutes</b>.</span>
            <div><sup>**</sup>Currently running sites: <b><?php print exec("docker ps -q --format '{{.ID}} {{.Image}}' | grep 'drupal8' | wc -l"); ?> </b>.</div>
        </form>
    </div>

    <div>
        <h2>Available Drupal Distributions</h2>
        <?php plainDistros($distros); ?>
    </div>

    <p class="center">
        <?php print footerMessage(); ?>
    </p>
    <p class="center">
        <?php print drupalMessage(); ?>
    </p>

</section>

<footer>
    <p>
        <?php print footerSponsor(); ?>
    </p>
</footer>

<a href="https://github.com/theodorosploumis/drupal-docker-distros">
    <img class="forkme" src="forkme.png" alt="Fork me on GitHub">
</a>

</body>
</html>