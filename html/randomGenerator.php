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