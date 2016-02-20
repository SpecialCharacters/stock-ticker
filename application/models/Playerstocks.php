<?php

/**
 * model/Playerstocks.php
 *
 * Playerstocks model
 *
 * @author				Jaegar Sarauer, Allen Tsang, Dhivya Manohar
 * @copyright			2016-, Special Characters
 * ------------------------------------------------------------------------
 */

class Playerstocks extends MY_Model2 {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct('playerstocks','username','code');
    }
    
    /**
     * Get player's stocks based on user name
     * @param type $name user name of player
     * @return array of stocks of specified player
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
     * Get stock and name info of a player based on their user name
     * @param type $name user name of player
     * @return array of stock and name info
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