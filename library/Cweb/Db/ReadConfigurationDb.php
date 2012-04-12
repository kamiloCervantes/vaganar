<?php
/*
*
*
*
*
*/
$rootPath = dirname(dirname(dirname(__FILE__)));
$app = dirname(dirname(dirname(dirname(__FILE__))));
set_include_path(get_include_path() . PATH_SEPARATOR . $rootPath . PATH_SEPARATOR . $app . PATH_SEPARATOR);


class Cweb_Db_ReadConfigurationDb
{

	//Path data to a database connection.
	private $_path;

	 //connection variables.
	
	/*
	* connection driver of the database.
	*/
	private $_driver;

	/*
	* host of the database.
	*/
	private $_host;

	/*
	* name of the database.
	*/
	private $_dbName;

	/*
	* username of the database
	*/
	private $_userName;

	/*
	* password of the database
	*/
	private $_pass;

	//End connection variables.

    public function __construct($pathConf)
    {
        $this->_path=$pathConf;
        $this->_readConf();    
    }

    // Get Methods.
    public function getPath()
    {
        return $this->_path;
    }

    public function getDriver()
    {
    	return $this->_driver;
    }

    public function getHost()
    {
    	return $this->_host;
    }

    public function getDbName()
    {
    	return $this->_dbName;
    }

    public function getUserName()
    {
    	return $this->_userName;
    }

    public function getPass()
    {
        return $this->_pass;
    }
    //End Get Methods.

    protected function _readConf(){
        $xml = simplexml_load_file($this->_path);
        $counter = 0;
        foreach ($xml->database as $db){
            $conf = utf8_decode($db['conf']);
                if(strcasecmp($conf, "default")==0)
                {
                    if($counter==0)
                    {
                        $this->_driver=utf8_decode($db->driver);
                        $this->_host=utf8_decode($db->host);
                        $this->_dbName=utf8_decode($db->dbname);
                        $this->_userName=utf8_decode($db->username);
                        $this->_pass=utf8_decode($db->pass);
                    }
                    $counter++;
                }
        }
        if($counter>1)
        {
            echo "<b class=msgError>Error: Se han configurado mas de una base de datos como default</b><br/>";
            echo "<b class=msgAdvertencia>Abvertencia: Se tomara la primera configuracion hallada.</b><br/>";
        }
        else{
            if($counter<1)
            {
                echo "<b class=msgError>Error de conexion: No se configuro ninguna base de datos como default</b><br/>";
            }
        }    
    }
}