<?php
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Url;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Config;
use Phalcon\Config\ConfigFactory;

$config = new Config([]);

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

// Register an autoloader
$loader = new Loader();
$loader->registerDirs(
    [
        APP_PATH . "/controllers/",
        APP_PATH . "/models/",
    ]
);
$loader->register();

$container = new FactoryDefault();
$container->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/views/');
        return $view;
    }
);
$container->set(
    'url',
    function () {
        $url = new Url();
        $url->setBaseUri('/');
        return $url;
    }
);
$application = new Application($container);
$container->set(
    'config',
    function () {
        $flocation = "../app/etc/config.php";
        $factory = new ConfigFactory();
        return $factory->newInstance('php', $flocation);
    }
);

$container->set(
    'app_details',
    function () {
        $flocation = "../app/config/app.php";
        $factory = new ConfigFactory();
        return $factory->newInstance('php', $flocation);
    }
);

$container->set(
    'db',
    function () {
        return new Mysql(
            $this['config']->db->toArray()
        );
    }
);
try {
    // Handle the request
    $response = $application->handle(
        $_SERVER["REQUEST_URI"]
    );

    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}
