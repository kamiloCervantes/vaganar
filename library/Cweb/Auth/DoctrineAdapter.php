<?php
 
/**
 * An application resource for initializing your Doctrine2 environment
 *
 * @category   Zend
 * @package    Cweb_Auth
 * @author     Loïc Frering <loic.frering@gmail.com>
 */

$rootPath = dirname(dirname(dirname(__FILE__)));
set_include_path(get_include_path() . PATH_SEPARATOR . $rootPath . PATH_SEPARATOR);

require_once ('Zend/Auth/Adapter/Interface.php');
require_once ('Zend/Auth/Adapter/Exception.php');

class Cweb_Auth_DoctrineAdapter implements Zend_Auth_Adapter_Interface
{
    /**
     * Doctrine EntityManager
     *
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * The entity name to check for an identity.
     *
     * @var string
     */
    protected $entityName;

    /**
     * Field to be used as identity.
     *
     * @var string
     */
    protected $identityField;

    /**
     * The field to be used as credential.
     *
     * @var string
     */
    protected $credentialField;

    /**
     * Constructor sets configuration options.
     *
     * @param  Doctrine\ORM\EntiyManager
     * @param  string
     * @param  string
     * @param  string
     * @return void
     */
    public function __construct($em, $entityName = null, $identityField = null, $credentialField = null)
    {
        $this->em = $em;

        if (null !== $entityName) {
            $this->setEntityName($entityName);
        }

        if (null !== $identityField) {
            $this->setIdentityField($identityField);
        }

        if (null !== $credentialField) {
            $this->setCredentialField($credentialField);
        }
    }

    /**
     * Set entity name.
     *
     * @param  string
     * @return Cweb_Auth_DoctrineAdapter
     */
    public function setEntityName($entityName)
    {
        $this->entityName = $entityName;
        return $this;
    }

    /**
     * Set identity field.
     *
     * @param  string
     * @return Cweb_Auth_DoctrineAdapter
     */
    public function setIdentityField($identityField)
    {
        $this->identityField = $identityField;
        return $this;
    }

    /**
     * Set credential field.
     *
     * @param  string
     * @return Cweb_Auth_DoctrineAdapter
     */
    public function setCredentialField($credentialField)
    {
        $this->credentialField = $credentialField;
        return $this;
    }

    /**
     * Set the value to be used as identity.
     *
     * @param  string
     * @return Cweb_Auth_DoctrineAdapter
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;
        return $this;
    }

    /**
     * Set the value to be used as credential.
     *
     * @param  string
     * @return Cweb_Auth_DoctrineAdapter
     */
    public function setCredential($credential)
    {
        $this->credential = $credential;
        return $this;
    }

    /**
     * Defined by Zend_Auth_Adapter_Interface.  This method is called to
     * attempt an authentication.  Previous to this call, this adapter would have already
     * been configured with all necessary information to successfully connect to a database
     * table and attempt to find a record matching the provided identity.
     *
     * @throws Zend_Auth_Adapter_Exception if answering the authentication query is impossible
     * @return Zend_Auth_Result
     */
    public function authenticate()
    {
        $this->_authenticateSetup();
        $query = $this->_getQuery();

        $authResult = array(
            'code'     => Zend_Auth_Result::FAILURE,
            'identity' => null,
            'messages' => array()
        );

        try {
            $result = $query->getArrayResult();
            $resultCount = count($result);
            if ($resultCount > 1) {
                $authResult['code'] = Zend_Auth_Result::FAILURE_IDENTITY_AMBIGUOUS;
                $authResult['messages'][] = 'More than one entity matches the supplied identity.';
            } else if ($resultCount < 1) {
                $authResult['code'] = Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND;
                $authResult['messages'][] = 'A record with the supplied identity could not be found.';
            } else if (1 == $resultCount) {
                if ($result[0][$this->credentialField] != $this->credential) {
                    $authResult['code'] = Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID;
                    $authResult['messages'][] = 'Supplied credential is invalid.';
                } else {
                    $authResult['code'] = Zend_Auth_Result::SUCCESS;
                    $authResult['identity'][] = $this->identity;
                    $authResult['identity']['role'] = $result[0]['role'];
                    $authResult['messages'][] = 'Authentication successful.';
                }
            }
        } catch (\Doctrine\ORM\Query\QueryException $qe) {
            $authResult['code'] = Zend_Auth_Result::FAILURE_UNCATEGORIZED;
            $authResult['messages'][] = $qe->getMessage();
        }

        return new Zend_Auth_Result(
            $authResult['code'],
            $authResult['identity'],
            $authResult['messages']
        );
    }

    /**
     * This method abstracts the steps involved with
     * making sure that this adapter was indeed setup properly with all
     * required pieces of information.
     *
     * @throws Zend_Auth_Adapter_Exception - in the event that setup was not done properly
     */
    protected function _authenticateSetup()
    {
        $exception = null;

        if (null === $this->em || !$this->em instanceof \Doctrine\ORM\EntityManager) {
            $exception = 'A Doctrine2 EntityManager must be supplied for the Zend_Auth_Adapter_Doctrine2 authentication adapter.';
        } elseif (empty($this->identityField)) {
            $exception = 'An identity field must be supplied for the Zend_Auth_Adapter_Doctrine2 authentication adapter.';
        } elseif (empty($this->credentialField)) {
            $exception = 'A credential field must be supplied for the Zend_Auth_Adapter_Doctrine2 authentication adapter.';
        } elseif (empty($this->identity)) {
            $exception = 'A value for the identity was not provided prior to authentication with Zend_Auth_Adapter_Doctrine2.';
        } elseif (empty($this->credential)) {
            $exception = 'A credential value was not provided prior to authentication with Zend_Auth_Adapter_Doctrine2.';
        }

        if (null !== $exception) {
            /**
             * @see Zend_Auth_Adapter_Exception
             */
            throw new Zend_Auth_Adapter_Exception($exception);
        }
    }

    /**
     * Construct the Doctrine query.
     *
     * @return Doctrine\ORM\Query
     */
    protected function _getQuery()
    {
        $qb = $this->em->createQueryBuilder()
            ->add('select','e')
            ->add('from',$this->entityName. ' e')
            ->add('where','e.' . $this->identityField . ' = ?1')
            ->setParameter(1,$this->identity);
        return $qb->getQuery();
    }
}