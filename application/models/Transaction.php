<?php

/**
 * model/Transaction.php
 *
 * Transaction model
 *
 * @author				Jaegar Sarauer, Allen Tsang, Dhivya Manohar
 * @copyright			2016-, Special Characters
 * ------------------------------------------------------------------------
 */

class Transaction extends MY_Model {    
    public $url = "http://bsx.jlparry.com/data/transactions";
    /**
     * Constructor
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
        $columns = array();
        $rows = array();
        $newRes = array();
        $site = fopen($this->url, "r");
        if($site == FALSE) {
            echo "failed to open";
            return $newRes;
        } else {
            $rowCounter = 0;
            $data = fgetcsv($site, 0, ",");
            while ($data != FALSE) {
                if( 0 === $rowCounter) {
                    $columns = $data;
                } else {
                    foreach($data as $key => $value) {
                            $rows[ $rowCounter - 1][ $columns[ $key] ] = $value;
                    }
                }
                $rowCounter++;
                $data = fgetcsv($site, 0, ",");
            }
            fclose($site);
        }
        
        for ($i = 0; $i < count($rows); $i ++) {
            if($rows[$i]["stock"] == $code) {
                $tmpRes = array();
                array_push($tmpRes, $rows[$i]["player"], $rows[$i]["player"], $rows[$i]["quantity"], $rows[$i]["trans"], $this->millisecondsToDatetime($rows[$i]["datetime"]));
                array_push($newRes, $tmpRes);
            }
        }
        return $newRes;
    }
    
    /**
     * Get list of transactions by user name
     * @param type $name player user name
     * @return array list of transaction
     */
    function getTransactionByUsername($name) {
        $columns = array();
        $rows = array();
        $newRes = array();
        $site = fopen($this->url, "r");
        if($site == FALSE) {
            echo "failed to open";
            return $newRes;
        } else {
            $rowCounter = 0;
            $data = fgetcsv($site, 0, ",");
            while ($data != FALSE) {
                if( 0 === $rowCounter) {
                    $columns = $data;
                } else {
                    foreach($data as $key => $value) {
                            $rows[ $rowCounter - 1][ $columns[ $key] ] = $value;
                    }
                }
                $rowCounter++;
                $data = fgetcsv($site, 0, ",");
            }
            fclose($site);
        }
        
        for ($i = 0; $i < count($rows); $i ++) {
            if($rows[$i]["player"] == $name) {
                $tmpRes = array();
                array_push($tmpRes, $rows[$i]["stock"], $rows[$i]["stock"], $rows[$i]["quantity"], $rows[$i]["trans"], $this->millisecondsToDatetime($rows[$i]["datetime"]));
                array_push($newRes, $tmpRes);
            }
        }
        return $newRes;
    }
}