<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/settings.php';

use Docker\Docker;
use Docker\API\Model\ContainerConfig;
use Docker\API\Model\HostConfig;
//use Docker\API\Model\PortBinding;

// Initialize Docker()
$docker = new Docker();
$containerManager = $docker->getContainerManager();

// Create nginx-proxy if not enabled
if (!$containerManager->find("proxy")) {
  echo "Nginx proxy is not running. Please try later.";
  die;
}

// Get variables from url
if (isset($_GET['distro'])) {
  $distro = $_GET['distro'];
  $distro = preg_replace('/[^a-z]/', '', $distro);
  $selected_image = $docker_image . ":" . $distro;
} else {
  echo "<h1>Error: Distro is not defined.</h1>";
  header("HTTP/1.0 404 Not Found");
  die('Error: Distro is not defined.');
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $id = preg_replace('/[^a-z]/', '', $id);
  // Set subdomain
  $subdomain = $id . "." . $domain;
} else {
  echo "<h1>Error: ID is not defined.</h1>";
  header("HTTP/1.0 404 Not Found");
  die('Error: ID is not defined.');
}

// Create new HostConfig
$hostConfig = new HostConfig();

// Set exposed ports - Not used
/**
$mapPorts = new \ArrayObject();
$hostPortBinding = new PortBinding();
$hostPortBinding->setHostPort($port);
$hostPortBinding->setHostIp($hostIp);
$mapPorts['80/tcp'] = [$hostPortBinding];
$hostConfig->setPortBindings($mapPorts);
*/

// New container config
$containerConfig = new ContainerConfig();

// Set docker image
$containerConfig->setImage($selected_image);

// Set hostname
$containerConfig->setHostname($id);

// Set env used on proxy
$containerConfig->setEnv([
  "VIRTUAL_HOST=".$subdomain
]);

// Create container
$containerConfig->setHostConfig($hostConfig);
$container = $containerManager->create($containerConfig,
  ['name' => $subdomain ]
);
$containerId = $container->getId();

// Start container
$containerManager->start($container->getId());

echo "Rederecting to subdomain " . $subdomain . ":" . $port;

//// Log container
//$response = $containerManager->logs($containerId, [
//  'stderr' => true,
//  'stdout' => true
//]);
//
//print($response);

// Redirect to the Docker container ui
sleep(5);
header('Location: ' . "http://" . $subdomain . ":" . $port, true, $permanent ? 301 : 302);
