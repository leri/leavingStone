<?php
session_start();
spl_autoload_register(function ($class) {
    $classFile = str_replace('Twitter\\', '', $class);
    $classFile = __DIR__.'/'.str_replace('\\', DIRECTORY_SEPARATOR, $classFile).'.php';

    require_once $classFile;
});

define('TEMPLATE_DIR', __DIR__.'/../res/templates');
define('CONTROLLER_NAMESPACE', 'Twitter\\Application\\Controllers\\');

$config = require_once(__DIR__.'/config.php');

$pdo = new PDO($config['dsn'], $config['username'], $config['password'], array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
));

$request = new \Twitter\Http\DefaultPhpRequest($_SERVER, $_GET, $_POST, $_FILES, $_COOKIE);
$session = new \Twitter\Http\DefaultSession();
$urlGenerator = new \Twitter\Helpers\BasicUrlGenerator($config['baseUrl']);
$dispatcherBuilder = new \Twitter\Routing\RegexDispatcherBuilder();
$injectorBuilder = new \Twitter\DependencyInjection\SimpleInjectorBuilder();

$app = new \Twitter\Application\App($request, $dispatcherBuilder, $injectorBuilder);
$app->buildDispatcher(function (\Twitter\Routing\RouteCollection $r) {
    $r->addRoute('GET', '/', CONTROLLER_NAMESPACE.'Home::index');
    $r->addRoute('GET', '/user/sign', CONTROLLER_NAMESPACE.'User::loginRegister');
    $r->addRoute('GET', '/user/logout', CONTROLLER_NAMESPACE.'User::logout');
    $r->addRoute('POST', '/user/login', CONTROLLER_NAMESPACE.'User::login');
    $r->addRoute('POST', '/user/register', CONTROLLER_NAMESPACE.'User::register');
    $r->addRoute('GET', '/user/follow/{id:\d+}', CONTROLLER_NAMESPACE.'User::follow');
    $r->addRoute('GET', '/user/unfollow/{id:\d+}', CONTROLLER_NAMESPACE.'User::unfollow');
    $r->addRoute('GET', '/user/users', CONTROLLER_NAMESPACE.'User::users');
    $r->addRoute('POST', '/tweet/post', CONTROLLER_NAMESPACE.'Tweet::post');
    $r->addRoute('GET', '/tweet/following_tweets', CONTROLLER_NAMESPACE.'Tweet::friendTweets');
});
$app->setNotFoundHandler(array(
   'controller' => 'Twitter\Application\Controllers\Error',
   'action' => 'notFound'
));
$app->buildInjector(function (\Twitter\DependencyInjection\DependencyCollection $dic)
                        use($request, $pdo, $session, $urlGenerator) {
    $loginBinder = new \Twitter\Application\Binders\Login($request);
    $registrationBinder = new \Twitter\Application\Binders\Registration($request);
    $tweetBinder = new \Twitter\Application\Binders\Tweet($request);

    $dic->registerObject($request, 'Twitter\Http\Request');
    $dic->registerObject($session, 'Twitter\Http\Session');
    $dic->registerObject($pdo);
    $dic->registerObject($urlGenerator, 'Twitter\Helpers\UrlGenerator');
    $dic->registerDependency('Twitter\Application\PresentationModels\Login', null, true, $loginBinder);
    $dic->registerDependency('Twitter\Application\PresentationModels\Registration', null, true, $registrationBinder);
    $dic->registerDependency('Twitter\Application\PresentationModels\Tweet', null, true, $tweetBinder);
    $dic->registerDependency('Twitter\Application\Validators\RegistrationPresentationModelValidatorImpl',
                             'Twitter\Application\Validators\RegisterPresentationModelValidator');
    $dic->registerDependency('Twitter\Application\Validators\LoginPresentationModelValidatorImpl',
                             'Twitter\Application\Validators\LoginPresentationModelValidator');
    $dic->registerDependency('Twitter\Application\Validators\TweetPresentationModelValidatorImpl',
                             'Twitter\Application\Validators\TweetPresentationModelValidator');
    $dic->registerDependency('Twitter\Application\Services\UserServiceImpl',
                             'Twitter\Application\Services\UserService');
    $dic->registerDependency('Twitter\Application\Services\TweetServiceImpl',
                             'Twitter\Application\Services\TweetService');
    $dic->registerDependency('Twitter\Application\Repositories\UserRepositoryImpl',
                             'Twitter\Application\Repositories\UserRepository');
    $dic->registerDependency('Twitter\Application\Repositories\TweetRepositoryImpl',
                             'Twitter\Application\Repositories\TweetRepository');
});

$app->run($config['ignorePath']);