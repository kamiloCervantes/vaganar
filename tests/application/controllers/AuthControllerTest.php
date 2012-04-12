<?php

class AuthControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testIndexAction()
    {
        $params = array('action' => 'index', 'controller' => 'Auth', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        
        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        
    }

    public function testLoginAction()
    {
        /*
        $testuser = new Application_Model_Users();
        $testuser->setFirstName('Kamilo');
        $testuser->setLastName('Cervantes');
        $testuser->setBirthday('1989-03-31');
        $testuser->setCity('Montería');
        $testuser->setEmail('cacesa8931@gmail.com');
        $testuser->setUserName('testuser');
        $testuser->setPassword('pwd123');
        $testuser->setGender(1);
        
        $this->_em->persist($testuser);
        $this->_em->flush(); 
        
        
        $params = array('action' => 'login', 'controller' => 'Auth', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
         
        $this->getRequest()->setPost(array(
                'username' => 'testuser',
                'pass' => 'pwd123'
        ));
        
        $this->getRequest()->setMethod('POST');

        $this->dispatch($url);
       
        $this->auth = Zend_Auth::getInstance(); 
        echo $this->getResponse()->getBody();
        // assertions
        $this->assertTrue($this->auth->hasIdentity());   
        $this->assertModule($urlParams['module']);
        $this->assertController('index');
        $this->assertAction('index');
        */
        
        $params = array('action' => 'login', 'controller' => 'Auth', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        
        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        
        
    }


}





