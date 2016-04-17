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
    private $url = 'http://bsx.jlparry.com/data/stocks';
    private $stocks = array();
    
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
        $this->getStocksFromServer();
        $newRes = array();
        foreach($this->stocks as $res) {
            $tmpRes = array();
            array_push($tmpRes, $res[0], $res[1], $res[0], $res[2]);
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
        $this->getStocksFromServer();
        foreach($this->stocks as $stock) {
            if ($stock[0] == $code) {
                return $stock;
            }
        }
        return array('N/A', 'N/A', 'N/A');
    }
    
    /**
     * Get all stocks and list them
	 * @return array of all stocks's code and name
     */
    function getStocksList() {
        $this->getStocksFromServer();
        $newRes = array();
        foreach($this->stocks as $queryIndex) {
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
        $this->getStocksFromServer();
        $res = $this->some('code', $code);
        return $res{0}->stockvalue;
    }
    
    function getStocksFromServer() {
        $this->stocks = array();
        $site = fopen($this->url, 'r');
        if($site == false) {
            return $this->stocks;
        } else {
            $data = fgetcsv($site, 1024, ',', '"');
            while($data !== false) {
                $this->stocks[] = array((string)$data[0], (string)$data[1], (string)$data[3]);
                $data = fgetcsv($site, 1024, ',', '"');
            }
            fclose($site);
        }
        array_shift($this->stocks);
        return $this->stocks;
    }
}