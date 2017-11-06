<?php

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/settings.php';

use Docker\Docker;
use Docker\API\Model\ContainerConfig;
use Docker\API\Model\HostConfig;
use Docker\API\Model\ResourceUpdate;
use Docker\API\Model\RestartPolicy;

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
  header("HTTP/1.0 404 Not Found");
  die('Error: Distro is not defined.');
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $id = preg_replace('/[^a-z]/', '', $id);
  // Set subdomain
  $subdomain = $id . "." . $domain;
  $redirect = "http://" . $subdomain . ":" . $port;
} else {
  header("HTTP/1.0 404 Not Found");
  die('Error: ID is not defined.');
}

// Create new HostConfig
$hostConfig = new HostConfig();

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

// Set restart policy
$restartPolicy = new restartPolicy();
$restartPolicy->setName('always')->setMaximumRetryCount(10);
$hostConfig->setRestartPolicy($restartPolicy);

// Set container resources
//$hostConfig->setMemory(262144);

// Create container
$containerConfig->setHostConfig($hostConfig);
$container = $containerManager->create($containerConfig,
  ['name' => $subdomain ]
);

// Start container
$containerManager->start($container->getId());

echo "<html><head><title>Preparing your site...</title><style>
.load {width:400px;height:300px;margin:0 auto;}</style></head>
<body><div class='load'><img src='loading.gif'></div></body>
</html>";

// Redirect to the Docker container ui
header('Refresh:14; url=' . $redirect);
