<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../randomGenerator.php';

use Docker\Docker;
use Docker\API\Model\ContainerConfig;
use Docker\API\Model\HostConfig;
use Docker\API\Model\PortBinding;

// Docker hub image
$docker_image = "drupal8/distros";

// Set the host ip
// Do not use the "http://" prefix
$hostIp = "0.0.0.0";

// Set you main domain here for the subdomains to be created
// For local development this can be "localhost"
// Do not use the "http://" prefix
$domain = "distros.loc";

// If server is not live (not 1) to not create a random port and a subdomain
$serverEnv = 1;

if ($serverEnv) {
  $port = "80";
}
else {
  $port = randomGenerator(4, "3456789");
}

$docker = new Docker();
$containerManager = $docker->getContainerManager();

//$proxy = $containerManager->find("proxy");
//if (!isset($proxy)) {
//  echo "Nginx proxy is not running.";
//  die;
//}
//var_dump($proxy);
//die;

// Get variables from url
if (isset($_GET['distro'])) {
  $distro = $_GET['distro'];
} else {
  echo "<h1>Error: Distro is not defined.</h1>";
  die;
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
} else {
  echo "<h1>Error: ID is not defined.</h1>";
  die;
}

// Set subdomain
if ($serverEnv) {
  $subdomain = $id . "." . $domain;
} else {
  $subdomain = $domain;
}

// Create new HostConfig
$hostConfig = new HostConfig();

// Set container volumes
//$volume = "/var/www/" . $id;
//$docker_volumes = [
//  $volume . "/mysql:/var/lib/mysql",
//  $volume . "/html:/var/www/html"
//];
//
//if (!file_exists($volume)) {
//  mkdir($volume, 0700);
//}
//$hostConfig->setBinds($docker_volumes);

// Set exposed ports
$mapPorts = new \ArrayObject();
$hostPortBinding = new PortBinding();
$hostPortBinding->setHostPort($port);
$hostPortBinding->setHostIp($hostIp);
$mapPorts['80/tcp'] = [$hostPortBinding];
$hostConfig->setPortBindings($mapPorts);

// New container config
$selected_image = $docker_image . ":" . $distro;

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
$container = $containerManager->create($containerConfig);
$containerId = $container->getId();

// Start container
$containerManager->start($container->getId());

echo "Rederecting to new subdomain " . $subdomain . ":" . $port;

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
