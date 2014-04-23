<?php namespace Purse;
// open purse
require_once('../paths.php');
require_once(path('purse/purse.php'));
require_once(path('purse/database.php'));

$purse = new Purse();

$purse->action('/', function(&$view) {
  $view = 'index';

  return array(
    'baseURL' => BASE_URL
  );
});
