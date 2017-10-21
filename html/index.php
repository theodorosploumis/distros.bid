<?php

require_once __DIR__ . '/settings.php';
require_once __DIR__ . '/randomGenerator.php';

$images = [
  "agov",
  "bear",
  "brainstorm",
  "drupal",
  "druppio",
  "lightning",
  "opendoor",
  "openchurch",
  "openrestaurant",
  "panopoly",
  "presto",
  "social",
  "thunder",
  "varbase",
  "vardoc"
];

?>

<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <title>Try Drupal 8.x Distributions</title>
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" sizes="20x20" href="favicon.png">
    <link>
</head>

<body>
<h1>Try Drupal 8.x Distributions<sup>beta</sup></h1>

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

    <ul class="starters">
      <?php
      foreach ($images as $image) {
        print '<li><a target="_blank" class="link-' . $image . ' .
        link" href="/container.php?distro=' . $image . '&id=' .
          randomGenerator($subdomainLength) . '">' . $image . '</a></li>';
      }
      ?>
    </ul>

</section>

<footer>
    <p>
        Created by <a href="https://www.theodorosploumis.com/en">TheodorosPloumis</a>
        | Hosted on <a href="https://m.do.co/c/1123d0854c8f">DigitalOcean</a>
    </p>
    <p>
        <a href="https://www.drupal.org">Drupal</a> is a
        <a href="http://drupal.com/trademark">registered trademark</a> of
        <a href="http://buytaert.net">Dries Buytaert</a>.</p>
</footer>

</body>

</html>