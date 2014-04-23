<?php namespace Purse; use Jade;

// Purse time.
require_once(path('purse/database.php'));

class Purse {
  private $route;
  public function __construct() {
    // Get route from URL
    // The following code is adapted from the Slim framework (thank you!)
    if (strpos($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']) === 0) {
        $scriptName = $_SERVER['SCRIPT_NAME']; //Without URL rewrite
    } else {
        $scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']) ); //With URL rewrite
    }
    $pathInfo = substr_replace($_SERVER['REQUEST_URI'], '', 0, strlen($scriptName));
    if (strpos($pathInfo, '?') !== false) {
        $pathInfo = substr_replace($pathInfo, '', strpos($pathInfo, '?')); //query string is not removed automatically
    }
    $scriptName = rtrim($scriptName, '/');
    $pathInfo = '/' . ltrim($pathInfo, '/');
    $this->route = $pathInfo;

    // Register Jade.
    spl_autoload_register(function($class) {
      if(!strstr($class, 'Jade')) return;
      include(path($GLOBALS['paths']['libraries-jade'] . '/' .
                    str_replace("\\", DIRECTORY_SEPARATOR, $class) . '.php'));
    });
  }
  public function action($path, \Closure $callback) {
    if($path == $this->route) {
      $jade = new Jade\Jade;
      $vars = $callback($path) ?: [];
      $jade->render(path($GLOBALS['paths']['views'] . '/' . $path . '.jade'), $vars);
    }
  }
}
