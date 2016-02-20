<?php

/**
 * model/Stocks.php
 *
 * Stocks model
 *
 * @author		Jaegar Sarauer, Allen Tsang, Dhivya Manohar
 * @copyright           2016-, Special Characters
 * ------------------------------------------------------------------------
 */

class Stocks extends MY_Model {
    
    /**
     * Constructor.
     * @param string $tablename Name of the database table
     * @param string $keyfield  Name of the primary key of the table
     */
    function __construct() {
        parent::__construct('stocks','code');
    }
    
    /**
     * Get all stocks from database (every column)
     * @return array all stocks
     */
    function getStocks() {
        $res = $this->all();
        $newRes = array();
        foreach($res as $queryIndex) {
            $tmpRes = array();
            array_push($tmpRes, $queryIndex->code, $queryIndex->stockname, $queryIndex->code, $queryIndex->stockvalue);
            array_push($newRes, $tmpRes);
        }
        return $newRes;
    }
    
    /**
     * Get all stocks by code (stock name, code, stock value)
     * @param type $code Stock code
     * @return type all stocks
     */
    function getStockByCode($code) {
        $res = $this->some('code', $code);
        return array($res{0}->stockname, $res{0}->code, $res{0}->stockvalue);
    }
    
    /*
     * Get all stocks and list them
     */
    function getStocksList() {
        $res = $this->getStocks();
        $newRes = array();
        foreach($res as $queryIndex) {
            $tempArray = array();
            array_push($tempArray, $queryIndex[0], $queryIndex[1]);
            array_push($newRes, $tempArray);
        }
        return $newRes;
    }
}