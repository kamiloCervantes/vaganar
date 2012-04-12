<?php

class Cweb_Validators_NoRecordExists extends Zend_Validate_Abstract
{
    private $_table;
    private $_field;
    private $_em;

    const OK = '';

    protected $_messageTemplates = array(
        self::OK => "'%value%' ya está en la base de datos"
    );

    public function __construct($table, $field, $em) {
        $this->_table = $table;
        $this->_field = $field;
        $this->_em = $em;
    }

    public function isValid($value)
    {
        $this->_setValue($value);

        //$funcName = 'findBy' . $this->_field;
        $qbl = $this->_em->createQueryBuilder();
        $qbl->add('select','t')
            ->add('from', $this->_table.' t')
            ->add('where', 't.'.$this->_field.' = ?1')
            ->setParameter(1,$value);
        $query = $qbl->getQuery();

        if(count($query->getArrayResult())>0) {
            $this->_error();
            return false;
        }

        return true;
    }
}
