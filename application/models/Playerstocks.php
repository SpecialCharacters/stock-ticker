<?php

/**
 * model/Playerstocks.php
 *
 * PlayerStock model
 *
 * @author		Jaegar Sarauer, Allen Tsang, Dhivya Manohar
 * @copyright           2016-, Special Characters
 * ------------------------------------------------------------------------
 */

class Playerstocks extends MY_Model2 {
    /**
     * Constructor.
     * @param string $tablename Name of the database table
     * @param string $keyfield  Name of the primary key of the table
     */
    function __construct() {
        parent::__construct('playerstocks','username','code');
    }
    
    /**
     * Get player's stocks base on user name
     * @param type $name user name of player
     * @return array of stocks of players
     */
    function getPlayerStocks($name) {
        $res = $this->some('username', $name);
        $newRes = array();
        foreach($res as $queryIndex) {
            $tmpRes = array();
            array_push($tmpRes, $queryIndex->code, $queryIndex->amount);
            array_push($newRes, $tmpRes);
        }
        return $newRes;
    }
    
    /**
     * Get stocks of players and their user name
     * @param type $name
     * @return array
     */
    function getPlayerStocksAndNames($name) {
        $res = $this->getPlayerStocks($name);
        $newRes = array();
        foreach($res as $queryIndex) {
            $tmpRes = array();
            array_push($tmpRes, $queryIndex[0], $this->stocks->getStockByCode($queryIndex[0])[0], $queryIndex[0], $queryIndex[1]);
            array_push($newRes, $tmpRes);
        }
        return $newRes;
    }
}