<?php
$rootPath = dirname(dirname(dirname(__FILE__)));
set_include_path(get_include_path() . PATH_SEPARATOR . $rootPath . PATH_SEPARATOR);

require_once ('Zend/Session/Namespace.php');

class Cweb_Auth_Storage
{
	public function save($name = 'default', $data) {

        $session = new Zend_Session_Namespace($name);
        $session->data = $data;

        return true;
    }

    public function load($name = 'default', $part = null) {

        $session = new Zend_Session_Namespace($name);

        if (!isset($session->data))
            return null;

        $data = $session->data;

        if ($part && isset($data[$part]))
            return $data[$part];

        return $data;
    }

    public function clear($name = 'default') {

        $session = new Zend_Session_Namespace($name);

        if (isset($session->data))
            unset($session->data);

        return true;
    }
}