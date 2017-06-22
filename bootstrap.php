<?php

require_once 'vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\EventManager as EventManager;
use Doctrine\ORM\Events;
use Doctrine\ORM\Configuration;
use Doctrine\Common\Cache\ArrayCache as Cache;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\ClassLoader;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\HttpFoundation\Request;

$cache = new Doctrine\Common\Cache\ArrayCache;
$annotationReader = new Doctrine\Common\Annotations\AnnotationReader;

$cachedAnnotationReader = new Doctrine\Common\Annotations\CachedReader($annotationReader, $cache);

$annotationDriver = new Doctrine\ORM\Mapping\Driver\AnnotationDriver(
    $cachedAnnotationReader, // our cached annotation reader
    array(__DIR__ . DIRECTORY_SEPARATOR . 'src')
);

$driverChain = new Doctrine\ORM\Mapping\Driver\DriverChain();
$driverChain->addDriver($annotationDriver, 'n0va1s');

$config = new Doctrine\ORM\Configuration;
$config->setProxyDir('/tmp');
$config->setProxyNamespace('Proxy');
$config->setAutoGenerateProxyClasses(true); // this can be based on production config.
// register metadata driver
$config->setMetadataDriverImpl($driverChain);
// use our allready initialized cache driver
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);

AnnotationRegistry::registerFile(__DIR__. DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'doctrine' . DIRECTORY_SEPARATOR . 'orm' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Doctrine' . DIRECTORY_SEPARATOR . 'ORM' . DIRECTORY_SEPARATOR . 'Mapping' . DIRECTORY_SEPARATOR . 'Driver' . DIRECTORY_SEPARATOR . 'DoctrineAnnotations.php');

$evm = new Doctrine\Common\EventManager();
$em = EntityManager::create(
    array(
        'driver'  => 'pdo_mysql',
        'host'    => '127.0.0.1',
        'port'    => '3306',
        'user'    => 'root',
        'password'  => 'root',
        'dbname'  => 'cofrinho',
    ),
    $config,
    $evm
);
/*
ini_set('display_errors', 1);
error_reporting(-1);
ErrorHandler::register();
if ('cli' !== php_sapi_name()) {
    ExceptionHandler::register();
}
*/
$app = new \Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/web/view',
));

$app->register(new Silex\Provider\AssetServiceProvider(), array(
    'assets.version' => 'v1',
    'assets.version_format' => '%s?version=%s',
    'assets.named_packages' => array(
        'css' => array('version' => 'css2', 'base_path' => '/css'),
        'img' => array('base_path' => '/img'),
        'js' => array('base_path' => '/js'),
    ),
));

$app->register(new Silex\Provider\SessionServiceProvider());
/*
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'login_path' => array(
            'pattern' => '^/login$',
            'anonymous' => true
        ),
        'default' => array(
            'pattern' => '^/.*$',
            'anonymous' => true,
            'form' => array(
                'login_path' => '/login',
                'check_path' => '/login_check',
            ),
            'logout' => array(
                'logout_path' => '/logout',
                'invalidate_session' => false
            ),
            'users' => function ($app) use ($em) {
                return new \n0va1s\QuadroMagico\Provider\UserProvider($em);
            },
        )
    ),
    'security.access_rules' => array(
        array('^/login$', 'IS_AUTHENTICATED_ANONYMOUSLY'),
        array('^/.+$', 'ROLE_ADMIN')
    )
));
*/
//Menu
$app->get('/', function () use ($app) {
    return $app['twig']->render('inicio.twig');
})->bind('index');

//Login
/*
$app->get('/login', function (Request $req) use ($app) {
    return $app['twig']->render('login.twig', array(
        'error' => $app['security.last_error']($req),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('indexLogin');
*/
$app->get('/dica', function () use ($app) {
    return $app['twig']->render('dica.twig');
})->bind('indexDica');

$app->get('/contato', function () use ($app) {
    return $app['twig']->render('contato.twig');
})->bind('indexContato');

$app->post('/contato', function (Request $req) use ($app) {
    return Response('Enviar email', 200);
})->bind('contatoEnviar');

$app->mount('/quadro', new n0va1s\QuadroMagico\Controller\QuadroController($em));
$app->mount('/responsavel', new n0va1s\QuadroMagico\Controller\ResponsavelController($em));
