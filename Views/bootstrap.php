<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 29/10/2017
 * Time: 18:07
 */


const DEFAULT_APP = 'Frontend';

// Si l'application n'est pas valide, on va charger l'application par défaut qui se chargera de générer une erreur 404
if (!isset($_GET['app']) || !file_exists(__DIR__.'/../App/'.$_GET['app'])) $_GET['app'] = DEFAULT_APP;
//echo '<p>L\'appli a ete chargée</p>';



// On commence par inclure la classe nous permettant d'enregistrer nos autoload
require __DIR__.'/../lib/framework/SplClassLoader.php';
//echo '<p>Autoloader trouvé</p>';


// On va ensuite enregistrer les autoloads correspondant à chaque vendor (framework, App, Model, etc.)
$frameworkLoader = new SplClassLoader('framework', __DIR__.'/../lib');
$frameworkLoader->register();
//echo '<p>framework enregistré</p>';


$appLoader = new SplClassLoader('App', __DIR__.'/..');
$appLoader->register();
//echo '<p>App enregistré</p>';


$modelLoader = new SplClassLoader('Model', __DIR__.'/../lib/vendors');
$modelLoader->register();
//echo '<p>Model enregistré</p>';


$entityLoader = new SplClassLoader('Entity', __DIR__.'/../lib/vendors');
$entityLoader->register();
//echo '<p>Entity enregistré</p>';


$formBuildersLoader = new SplClassLoader('Forms', __DIR__.'/../lib/vendors');
$formBuildersLoader->register();
//echo '<p>FormBuilder enregistré</p>';


// Il ne nous suffit plus qu'à déduire le nom de la classe et à l'instancier
$appClass = 'App\\'.$_GET['app'].'\\'.$_GET['app'].'Application';

//echo '<p>Deduction du nom de la classe réussie</p>';

$app = new $appClass;
//echo '<p>Instanciation réussie</p>';
$app->run();
//echo '<p>run ok!</p>';