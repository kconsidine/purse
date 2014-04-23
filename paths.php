<?php

// Environments
$environments = array(
  'your-hostname' => array(
    'url' => '/your/subpath',
    'debug' => true
  )
);

// Paths
$GLOBALS['paths']['views'] = 'views';
$GLOBALS['paths']['libraries'] = 'libraries';
$GLOBALS['paths']['libraries-jade'] = 'libraries/jade-php/src';

// ===== End of configurable options ==========================

// The path is the location of this file
define('PATH', realpath(dirname(__FILE__)));

// Find out if we have an environment defined
$hostname = php_uname('n');

if(array_key_exists($hostname, $environments)) {
  define("BASE_URL", $environments[$hostname]['url']);
  if($environments[$hostname]['debug']) define("DEBUG", true);
}else{
  define("BASE_URL", "");
}

// Debug stuff
if(defined("DEBUG")) {
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
}

// Helper functions for paths
function path($resource){
  $pathToTest = PATH . '/' . $resource;
  $path = realpath($pathToTest);
  if($path === false){
    throw new Exception('Invalid path: ' . $pathToTest);
  }
  return $path;
}

function url($resource, $options = array()){
  return BASE_URL.'/'.$resource;
}
