<?php

// Docker hub image
$docker_image = "drupal8/distros";

// Set the host ip
// Do not use the "http://" prefix
//$hostIp = "0.0.0.0";

$subdomainLength = "10";

// Set you main domain here for the subdomains to be created
// For local development this can be "localhost"
// Do not use the "http://" prefix
$domain = "example.com";

//$port = randomGenerator(4, "3456789");

// Set nginx proxy port
$port = "8055";

// Set debugging variable
$debug = FALSE;

if ($debug) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}

// Google Analytics code
$google_analytics_code = "";

// Sharethis property
$sharethis = "";
