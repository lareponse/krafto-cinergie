<?php
$start_time = hrtime(true);

require_once 'vendor/autoload.php';

set_include_path(implode(PATH_SEPARATOR, [get_include_path(),  __DIR__.'/']));

use \HexMakina\kadro\Auth\{Operator as Host};
use \HexMakina\kadro\Auth\{AccessRefusedException};
use \HexMakina\Crudites\{Crudites};

try
{

  // eval allow to catch SyntaxErrors
  eval('$settings = require_once("configs/settings.php");');
  $app = new \HexMakina\kadro\kadro($settings);

  //--- Setup routes
  $app->container()->get('HexMakina\BlackBox\RouterInterface')->addRoutes(
    require_once 'app/Routes/routes.php'
  );
  //--- Setup database
  $database = $app->container()->get('HexMakina\BlackBox\Database\DatabaseInterface');
  Crudites::setDatabase($database); // removable ?

  //--- Handle the request
  $app->container()->get('Controllers\Reception')->welcome(new Host(), $app->container());

}
catch(\HexMakina\Hopper\RouterException $e)
{
  $app->container()->get('Psr\Log\LoggerInterface')->warning($e->getMessage(), [$_SERVER['REQUEST_URI']]);
  $app->container()->get('HexMakina\BlackBox\RouterInterface')->hop();
}
catch(\HexMakina\kadro\Auth\AccessRefusedException $e)
{
  $app->container()->get('Psr\Log\LoggerInterface')->warning('KADRO_operator_ERR_PERMISSION_NEEDED');
  $app->container()->get('HexMakina\BlackBox\RouterInterface')->hopBack();
}
catch(\Throwable $e)
{
  header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);

  if(isset($app) && $app->isDevelopment()){
    ddt($e);
  }

  $message = '';
  if($e instanceof \PDOException){
    $message = 'Data server is down, contact <a href="mailto:touch@hexmakina.be">HexMakina</a>';
  }
  else{
    $message = $e->getMessage();
    $message .= PHP_EOL.'<!-- '.PHP_EOL.var_export($e, true).' -->'.PHP_EOL;
  }
  require_once('500.php');
}
finally
{
  if(isset($app))
    $app->container()->get('HexMakina\BlackBox\StateAgentInterface')->resetMessages();

  echo("<!-- krafto by https://HexMakina.be -->");
  echo(sprintf("\n<!-- %0.4fms-->", (hrtime(true) - $start_time)/1e+6));
}
