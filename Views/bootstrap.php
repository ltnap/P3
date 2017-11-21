<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 29/10/2017
 * Time: 18:07
 */


const DEFAULT_APP = 'Frontend';

if (!isset($_GET['app']) || !file_exists(__DIR__.'/../App/'.$_GET['app'])) $_GET['app'] = DEFAULT_APP;

require __DIR__.'/../lib/framework/SplClassLoader.php';

$frameworkLoader = new SplClassLoader('framework', __DIR__.'/../lib');
$frameworkLoader->register();

$appLoader = new SplClassLoader('App', __DIR__.'/..');
$appLoader->register();

$modelLoader = new SplClassLoader('Model', __DIR__.'/../lib/vendors');
$modelLoader->register();

$entityLoader = new SplClassLoader('Entity', __DIR__.'/../lib/vendors');
$entityLoader->register();

$formBuildersLoader = new SplClassLoader('Forms', __DIR__.'/../lib/vendors');
$formBuildersLoader->register();

$appClass = 'App\\'.$_GET['app'].'\\'.$_GET['app'].'Application';


$app = new $appClass;

$app->run();
