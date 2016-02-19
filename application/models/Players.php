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
    
    function getPlayers() {
        $res = $this->all();
        $newRes = array();
        foreach($res as $queryIndex) {
            $tmpRes = array();
            array_push($tmpRes, $queryIndex->firstname . ' ' . $queryIndex->lastname, $queryIndex->cash);
            array_push($newRes, $tmpRes);
        }
        return $newRes;
    }

}