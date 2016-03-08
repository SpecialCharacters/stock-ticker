<?php

/**
 * model/Players.php
 *
 * Player model
 *
 * @author				Jaegar Sarauer, Allen Tsang, Dhivya Manohar
 * @copyright			2016-, Special Characters
 * ------------------------------------------------------------------------
 */


class Players extends MY_Model {
    
    /**
     * Constructor.
     * @param string $tablename Name of the database table
     * @param string $keyfield  Name of the primary key of the table
     */
    function __construct() {
        parent::__construct('players','username');
    }
    
    /**
     * Calculates the equity after querying the right data
     * @param type $username of player
     * @return int equity amount
     */    
    function calcEquity($username) {
        $res = $this->playerstocks->getPlayerStocks($username);
        $total = 0;
        if ($res == NULL)
            return 0;
        foreach($res as $queryIndex) {
            $total += ((int)$queryIndex[1] * (int)$this->stocks->getStockByCode($queryIndex[0])[2]);
        }
        return $total;
    }
    
    /**
     * Get all players that are in the database
     * @return array all players
     */
    function getPlayers() {
        $res = $this->all();
        $newRes = array();
        foreach($res as $queryIndex) {
            $tmpRes = array();
            array_push($tmpRes, $queryIndex->username, $queryIndex->firstname . ' ' . $queryIndex->lastname, $this->calcEquity($queryIndex->username), $queryIndex->cash);
            array_push($newRes, $tmpRes);
        }
        return $newRes;
    }
    
    /**
     * Get all player names (first and last)
     * @return array players names (first and last)
     */
    function getPlayersNames() {
        $res = $this->all();
        $newRes = array();
        foreach($res as $queryIndex) {
            $tmpRes = array();
            array_push($tmpRes, $queryIndex->username, $queryIndex->firstname . ' ' . $queryIndex->lastname);
            array_push($newRes, $tmpRes);
        }
        return $newRes;
    }
    
    /**
     * Get all player names by username
     * @param type $username of player
     * @return type array of all players
     */
    function getPlayerNamesByUsername($username) {
        $res = $this->some('username', $username);
        $retName = array($res[0]->firstname, $res[0]->lastname);
        return $retName;
    }
}