<?php

/**
 * model/Stocks.php
 *
 * Stocks model
 *
 * @author				Jaegar Sarauer, Allen Tsang, Dhivya Manohar
 * @copyright			2016-, Special Characters
 * ------------------------------------------------------------------------
 */

class Stocks extends MY_Model {
    
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct('stocks','code');
    }
    
    /**
     * Get all stocks from database (every column)
     * @return array of all stocks
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
     * Get stock information of a given stock, specified by code
     * @param type $code Stock code
     * @return array of specified stock's info
     */
    function getStockByCode($code) {
        $res = $this->some('code', $code);
        return array($res{0}->stockname, $res{0}->code, $res{0}->stockvalue);
    }
    
    /**
     * Get all stocks and list them
	 * @return array of all stocks's code and name
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
    
	/**
     * Get price of stock 
     * @param type $code Stock code
     * @return type all stocks
     */
    function getStockPrice($code) {
        $res = $this->some('code', $code);
        return $res{0}->stockvalue;
    }
}