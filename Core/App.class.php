<?php

use Bundles\BundlesRegistration;
use Core\ClassReader\SaveEntityReader;
use \Core\Config\Config;
use \Core\Controller\Controller;
use \Core\Cookie\Cookie;
use \Core\Database\Database;
use \Core\Authentification\Authentification;
use Core\Installation\Installation;
use Core\Model\Model;
use Core\ORM\databaseInteraction;
use Core\ORM\generateDatabaseScript;
use \Core\Router\Router;
use \Core\Session\Session;
use \Core\Request\Request;
use \Core\Query\Query;
use \Core\Parameters\Parameters;
use \Core\Server\Server;
use Core\Translations\Translations;
use \Core\Upload\FileManager;
use \Core\Utils\Utils;

class App
{

    public static $routeInstance;
    private static $_instance;

    //private static $fileManager_instance;
    private static $controller_instance;

    public static function initialize()
    {
        error_reporting(E_ALL & ~E_NOTICE);
        session_start();

        $inst = self::getInstance();
        $inst->InitRequirementConfig();
        $inst->loadAutoloader();
        $inst->installHtaccess();

        ob_start();
    }

    public function loadAutoloader()
    {
        require ROOT . '/Core/Autoloader.class.php';
        Core\Autoloader::register();

        require ROOT . '/Bundles/Autoloader.class.php';
        Bundles\Autoloader::register();

    }

    public function InitRequirementConfig()
    {
        if (version_compare(phpversion(), '7.1', '<')) {
            die('Please install php version > PHP7.1');
        }

        date_default_timezone_set(@date_default_timezone_get());
    }

    public function installHtaccess()
    {
        if (!file_exists(ROOT . '/.htaccess')) {
            file_put_contents(ROOT . "/.htaccess", file_get_contents(ROOT . '/Core/Router/htaccess.txt'));
            header('Location: ../');
        }
    }

    public static function loadBundles()
    {
        BundlesRegistration::registerBundles();
    }

    public static function getBaseUrl()
    {
        $protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';
        $domain = $_SERVER['SERVER_NAME'];
        $port = $_SERVER['SERVER_PORT'];
        $request = $_SERVER['REQUEST_URI'];
        $port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
        $url = dirname(dirname($_SERVER['SCRIPT_NAME']));
        $url = $protocol . "://" . $domain . $port . $url;
        return $url;
    }

    public static function getDefaultRoute()
    {
        return self::getConfig()::get('app:defaultHomePageUrl');
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }


    /*
     *
     * Method Get Classes
     *
     */

    public static function getController()
    {
        if (is_null(self::$controller_instance)) {
            self::$controller_instance = new Controller();
        }
        return self::$controller_instance;
    }

    public static function getAuthentification(): Authentification
    {
        return Authentification::getInstance();
    }

    public static function getDb(): Database
    {
        return Database::getInstance();
    }

    public static function getRouter(): Router
    {
        return Router::getInstance();
    }

    public static function getSession(): Session
    {
        return Session::getInstance();
    }

    public static function getCookie(): Cookie
    {
        return Cookie::getInstance();
    }

    public static function getConfig(): Config
    {
        return Config::getInstance();
    }

    public static function getRequest(): Request
    {
        return Request::getInstance();
    }

    public static function getServer(): Server
    {
        return Server::getInstance();
    }

    public static function getQuery(): Query
    {
        return Query::getInstance();
    }

    public static function getTranslations(): Translations
    {
        return Translations::getInstance();
    }

//    public function getFileManager(){
//        if (is_null(self::$fileManager_instance)) {
//            self::$fileManager_instance = new FileManager();
//        }
//        return self::$fileManager_instance;
//    }


    /*
     *
     * Utils Method
     *
     */

    public static function forbidden($message = 'Erreur , Vous n\'avez le droit d\'accéder à cette page !')
    {
        echo '<div class="alert alert-danger">' . $message . '</div>';
        exit;
    }

    public static function notFound($message = 'Erreur 404, la page demandé est introuvable !')
    {
        echo '<div class="alert alert-danger">' . $message . '</div>';
        header("HTTP/1.0 404 Not Found");
        exit;
    }

    public static function isAjaxRequest()
    {
        return Request::is('XmlHttpRequest');
    }

    public static function isGetRequest()
    {
        return Request::is('get');
    }

    public static function isPostRequest()
    {
        return Request::is('post');
    }


    /*
     *
     * Router method utils
     *
     */


    public static function redirectToPreviousRoute()
    {
        Router::redirectToPreviousRoute();
    }

    public static function redirectToRoute($routeName, $params = [], $absoluthPath = true)
    {
        Router::redirectToRoute($routeName, $params, $absoluthPath);
    }

    public static function generateUrl($routeName, $params = [], $absoluthPath = true)
    {
        return Router::generateUrl($routeName, $params, $absoluthPath);
    }

    public static function redirect($url)
    {
        Router::redirect($url);
    }

    public static function getCurrentUrl($absoluthPath = true)
    {
        return Router::getCurrentUrl($absoluthPath);
    }

    public static function getCurrentRouteName()
    {
        return Router::getCurrentRouteName();
    }

    public static function getCurrentRoute()
    {
        return Router::getCurrentRoute();
    }


    /*
     *
     * Model Method
     *
     */

    public function getModel($table): Model
    {

        $table = str_replace('Entity', '', $table);

        list($moduleName, $nomModel) = explode(':', $table);

        $nomModel = ucfirst($nomModel) . 'Model';
        $formClass = implode('\\', ['Bundles', ucfirst($moduleName), 'Model', $nomModel]);

        if (file_exists(ROOT . '/' . str_replace("\\", '/', $formClass . ".class.php"))) {
            return new $formClass(self::getDb());
        } else {
            throw new Exception('Erreur ! Le model ' . $nomModel . ' dans le bundle ' . ucfirst($moduleName) . ' n\'éxiste pas !');
        }
    }

    public static function getTable($table)
    {
        return self::getInstance()->getModel($table);
    }

    public static function getManager($table)
    {
        return self::getInstance()->getModel($table);
    }


    /*
     *
     * User / Security Method
     *
     */

    public static function getUser()
    {
        return self::getAuthentification()->getUser();
    }


    /*
     *
     * Controller Method
     *
     */

    public static function renderController($callable, $datas = [])
    {
        return self::getInstance()->getController()->renderController($callable, $datas);
    }

    public static function render($template, $params = [])
    {
        return self::getInstance()->getController()->render($template, $params);
    }

    public static function getRessource($ressource)
    {
        return self::getInstance()->getController()->getRessource($ressource);
    }

    public static function translate($key, $params = [])
    {
        return self::getTranslations()->get($key, $params);
    }


    /*
     *
     * Database method
     *
     */

    public static function database($action, $setDatabaseConnection = true, $DBConnection = false)
    {
        return new databaseInteraction($action, $setDatabaseConnection, $DBConnection);
    }
}