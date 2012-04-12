<?php

/**
* @Entity 
* @Table(name="users")
*/

class Application_Model_Users
{
	/**
     * @id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
    * @Column(type="string")
    */
	private $firstname;

	/**
    * @Column(type="string")
    */
	private $lastname;

    /**
    * @Column(type="integer")
    */
    private $gender;

    /**
    * @Column(type="string")
    */
    private $username;

	/**
    * @Column(type="string")
    */
    private $email;

    /**
    * @Column(type="string")
    */
    private $password;

    /**
    * @Column(type="string")
    */
    private $birthday;

    /**
    * @Column(type="string")
    */
    private $city;

    public function getId(){
    	return $this->id;
    }

    public function setFirstName($firstName)
    {
    	$this->firstname = $firstName;
    }

    public function setLastName($lastName)
    {
    	$this->lastname = $lastName;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function setUserName($userName)
    {
        $this->username = $userName;
    }

    public function setEmail($email)
    {
    	$this->email = $email;
    }

    public function setPassword($password)
    {
    	$this->password = $password;
    }

    public function setBirthday($birthday)
    {
    	$this->birthday = $birthday;
    }

    public function setCity($city)
    {
    	$this->city = $city;
    }
}