<?php

require_once __DIR__ . '/settings.php';

// Get variables from url
if (isset($_GET['distro'])) {
    $distro = $_GET['distro'];
    $distro = preg_replace('/[^a-z]/', '', $distro);
    $selected_image = $docker_image . ":" . $distro;
} else {
    header("HTTP/1.0 404 Not Found");
    die('Error: Distro is not defined.');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = preg_replace('/[^a-z]/', '', $id);
    // Set subdomain
    $subdomain = $id . "." . $domain;
    $redirect = "http://" . $subdomain . ":" . $port;

    if ($containerManager->find($id)) {
        echo "This site is already running. Redirecting...";
        header('Refresh:14; url=' . $redirect);
    }

} else {
    header("HTTP/1.0 404 Not Found");
    die('Error: ID is not defined.');
}

// Build docker run

// Set env used on proxy
$env = " --env VIRTUAL_HOST=" . $subdomain . " ";

// Set restart policy
$restart = " --restart on-failure ";

// Memory limit
$memory = " --memory 256M ";

// Container name
$name = " --name " . $subdomain . " ";

// Run command
$run = "docker run " . $name . $memory . $restart . $env . $selected_image;

// Run container
exec($run);

$text = "";
$text .= "<html><head><title>Preparing your site...</title>";
$text .= "<style>.load {width:400px;height:300px;margin:0 auto;}</style>";
$text .= "</head><body><div class='load'><img src='loading.gif'></div></body></html>";

print $text;

// Redirect to the Docker container ui
header('Refresh:14; url=' . $redirect);
