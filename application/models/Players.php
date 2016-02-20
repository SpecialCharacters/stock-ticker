<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Players extends MY_Model {
    
    function __construct() {
        parent::__construct('players','username');
    }
    
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
    
    function getPlayerNamesByUsername($username) {
        $res = $this->some('username', $username);
        $retName = array($res[0]->firstname, $res[0]->lastname);
        return $retName;
    }

}