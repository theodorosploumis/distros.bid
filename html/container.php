<?php

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/settings.php';

use Docker\Docker;
use Docker\API\Model\ContainerConfig;
use Docker\API\Model\HostConfig;
use ReCaptcha\ReCaptcha;
//use Docker\API\Model\RestartPolicy;

// Initialize Docker()
$docker = new Docker();
$containerManager = $docker->getContainerManager();

// Create nginx-proxy if not enabled
//if (!$containerManager->find("proxy")) {
//    echo "Nginx proxy is not running. Please try later.";
//    die;
//}

// Get variables from url
if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $name = strtolower($name);
    $name = str_replace(' ', '', $name);
    $name = preg_replace('/[^a-z0-9\-\']/', '', $name);
} else {
    header("HTTP/1.0 404 Not Found");
    die('Error: Site name is not defined.');
}

if (!isset($_GET['g-recaptcha-response']) || $_GET['g-recaptcha-response'] == "") {
    header("HTTP/1.0 404 Not Found");
    die('Error: Direct url submission are not allowed.');
} else {
    $g_captcha_response = $_GET['g-recaptcha-response'];
    $recaptcha = new ReCaptcha($recaptcha_secret);
    $recaptcha_resp = $recaptcha->verify($g_captcha_response);

    if (!$recaptcha_resp->isSuccess()) {
        header("HTTP/1.0 404 Not Found");
        die('Error: reCaptcha could not be verified.');
    }
}

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
    $subdomain = $name . "-" . $distro . "-" . $id . "." . $domain;
    $redirect = "http://" . $subdomain . ":" . $port;

    if (exec("docker inspect -f '{{.State.Running}}' " . $subdomain) == true) {
        echo "This site is already running. Redirecting...";
        header('Refresh:1; url=' . $redirect);
        exit();
    }

} else {
    header("HTTP/1.0 404 Not Found");
    die('Error: ID is not defined.');
}

/**
 * @TODO
 *
 * HostConfig needs Docker engine version to be 1.24
 * See this: https://github.com/docker-php/docker-php/issues/249#issuecomment-320155328
 *
 */
// Create new HostConfig
$hostConfig = new HostConfig();

// New container config
$containerConfig = new ContainerConfig();

// Set docker image
$containerConfig->setImage($selected_image);

// Set hostname
$containerConfig->setHostname($id);

// Set env used on proxy
$containerConfig->setEnv(["VIRTUAL_HOST=" . $subdomain]);

// Set restart policy
//$restartPolicy = new restartPolicy();
//$restartPolicy->setName('always')->setMaximumRetryCount(10);
//$hostConfig->setRestartPolicy($restartPolicy);

// Set container resources
//$hostConfig->setMemory(262144);

// Create container
$containerConfig->setHostConfig($hostConfig);

try {
    $container = $containerManager->create($containerConfig, ['name' => $subdomain]);
    // Start container
    $containerManager->start($container->getId());
} catch(Exception $exception) {
    echo $exception->getResponse()->getBody()->getContents();
}

$text = "";
$text .= "<html><head><title>Preparing your site...</title>";
$text .= "<style>.load {width:400px;height:300px;margin:0 auto;}</style>";
$text .= "</head><body><div class='load'><img src='loading.gif'></div></body></html>";

print $text;

// Redirect to the Docker container ui
header('Refresh:10; url=' . $redirect);
