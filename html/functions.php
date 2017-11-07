<?php

/**
 * Generates a random string
 * @param string $length
 * @param string $keyspace
 * @return string
 */
function randomGenerator($length = '20', $keyspace = 'abcdefghijklmnopqrstuvwxyz') {
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;

    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[mt_rand(0, $max)];
    }
    return $str;
}

/**
 * @param array $array
 * @param integer $subdomainLength
 *
 * Example: $array =  = [agov" => ["name" =>"aGov", "path" => "https://www.drupal.org/project/agov"]];
 */
function showDistros($array, $subdomainLength = 10) {
    foreach ($array as $key => $value) {
        print '<li><a target="_blank" class="link-' . $key . ' .
        link" href="/container.php?distro=' . $key . '&id=' . randomGenerator($subdomainLength) . '">' . $value['name'] . '</a>
        <div class="project-url"><a target="_blank" href="' . $value["path"] . '">Project source</a></div></li>';
    }
}
