<?php

/**
 * model/Transaction.php
 *
 * Transaction model
 *
 * @author		Jaegar Sarauer, Allen Tsang, Dhivya Manohar
 * @copyright           2016-, Special Characters
 * ------------------------------------------------------------------------
 */

class Transaction extends MY_Model {    
    /**
     * Constructor.
     * @param string $tablename Name of the database table
     * @param string $keyfield  Name of the primary key of the table
     */
    function __construct() {
        parent::__construct('transactions','transactionID');
    }
    
    /**
     * Get list of transactions by stock code
     * @param type $code stock code
     * @return list of transactions
     */
    function getTransactionByCode($code) {
        $res = $this->all();
        $newRes = array();
        
        $index = count($res) - 1;

        while($index > 0) {
            $tmpRes = array();
                if ($res{$index}->code === $code) {
                $name = $this->players->getPlayerNamesByUsername($res{$index}->username);
                array_push($tmpRes, $name[0] . ' ' . $name[1], $res{$index}->amount, $res{$index}->type, $res{$index}->datetime);
                array_push($newRes, $tmpRes);
            }
            $index--;
        }
        return $newRes;
    }
    
    /**
     * Get list of transactions by user name
     * @param type $name player user name
     * @return array list of transaction
     */
    function getTransactionByUsername($name) {
        $res = $this->some('username', $name);
        $newRes = array();
        foreach($res as $queryIndex) {
            $tmpRes = array();
            array_push($tmpRes, $queryIndex->code, $this->stocks->getStockByCode($queryIndex->code)[0], $queryIndex->amount, $queryIndex->type, $queryIndex->datetime);
            array_push($newRes, $tmpRes);
        }
        return $newRes;
    }
}