<?php
/*
*
*
*
*
*/

$rootPath = dirname(dirname(dirname(__FILE__)));
set_include_path(get_include_path() . PATH_SEPARATOR . $rootPath . PATH_SEPARATOR);

require_once('Zend/Registry.php');
require_once('Doctrine/Common/ClassLoader.php');
require_once('Cweb/Db/ReadConfigurationDb.php');

class Cweb_Db_Adapter
{
	private $_connectionSettings;

	private $_registry;

	private static $CLASS_INSTANCE;

    private function __construct($pathConf)
    {
    	$this->_connectionSettings = new Cweb_Db_ReadConfigurationDb($pathConf);
    	$this->_initRegistry();
    	$this->_startDoctrine();
    }

    public static function getInstance($pathConf='../../application/configs/dataConnectDb.xml')
    {
	    if(!self::$CLASS_INSTANCE instanceof self)
	    {
	        self::$CLASS_INSTANCE = new self($pathConf);
	    }
	    return self::$CLASS_INSTANCE;
	}

    protected function _initRegistry(){
        $registry = Zend_Registry::getInstance();
        $this->_registry=$registry;
        return $registry;
    }

    protected function _startDoctrine() {
        $libApp = dirname(dirname(dirname(dirname(__FILE__)))) . '/application';
		$libProject = dirname(dirname(dirname(dirname(__FILE__))));	 	
	 	$libPath = $libProject . "/library/";
	 	
	 	
        $classLoader = new \Doctrine\Common\ClassLoader(
            'Doctrine', $libPath
        );
        
        $classLoader->register();
 			
        // create the Doctrine configuration
        $config = new \Doctrine\ORM\Configuration();
 			
        // setting the cache ( to ArrayCache. Take a look at
        // the Doctrine manual for different options ! )
        $cache = new \Doctrine\Common\Cache\ArrayCache;
        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);
 		 	
        // choosing the driver for our database schema
        // we'll use annotations
        $driver = $config->newDefaultAnnotationDriver(
            $libApp . '/models'
        );
        $config->setMetadataDriverImpl($driver);
 			
        // set the proxy dir and set some options
        $config->setProxyDir($libApp . '/models/Proxies');
        $config->setAutoGenerateProxyClasses(true);
        $config->setProxyNamespace('App\Proxies');
 			
        // now create the entity manager and use the connection
        // settings we defined in our dataConnectDb.xml
        $conn = array(
            'driver'    => $this->_connectionSettings->getDriver(),
            'user'      => $this->_connectionSettings->getUserName(),
            'password'  => $this->_connectionSettings->getPass(),
            'dbname'    => $this->_connectionSettings->getDbName(),
            'host'      => $this->_connectionSettings->getHost()
        );
        
        $entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);
 		
        
        $this->_registry->entitymanager = $entityManager;
 
        return $entityManager;
    }
		
	/**/    
    
    public function __clone()
    {
        trigger_error("Operacion Invalida: No puedes clonar una instancia de ". get_class($this) ." class.", E_USER_ERROR );
    }

    public function __wakeup()
    {
        trigger_error("No puedes deserializar una instancia de ". get_class($this) ." class.");
    }
}