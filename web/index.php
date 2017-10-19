<?php

require __DIR__ . '/vendor/autoload.php';

use Docker\Docker;

$docker = new Docker();

$containers = $docker->getContainerManager()->findAll();

//var_dump($containers);
//die;

function randomStr($length = '20', $keyspace = '0123456789abcdefghijklmnopqrstuvwxyz')
{
  $str = '';
  $max = mb_strlen($keyspace, '8bit') - 1;
  for ($i = 0; $i < $length; ++$i) {
    $str .= $keyspace[random_int(0, $max)];
  }
  return $str;
}

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
  <title>Try Drupal 8.x Distributions</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <h1>Try Drupal 8.x Distributions</h1>

  <section class="wrapper">
    <p>
      <b>Drupal username:</b>admin<br>
      <b>Drupal password:</b>admin<br>
    </p>
    
    <ul class="starters">
      <?php
        foreach ($images as $image) {
          print '<li><a class="link-'.$image.' link" href="/containers?distro=' . $image .
            '&id='. randomStr() . '">' . $image . '</a></li>';
        }
      ?>
    </ul>
    
  </section>
</body>

</html>