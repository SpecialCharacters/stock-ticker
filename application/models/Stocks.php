<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Stocks extends MY_Model {
    
    function __construct() {
        parent::__construct('stocks','code');
    }
    
    function getStocks() {
        $res = $this->all();
        $newRes = array();
        foreach($res as $queryIndex) {
            $tmpRes = array();
            array_push($tmpRes, $queryIndex->stockname, $queryIndex->code, $queryIndex->stockvalue);
            array_push($newRes, $tmpRes);
        }
        return $newRes;
    }
    
        function getStockByCode($code) {
        $res = $this->some('code', $code);
        $newRes = array();
        foreach($res as $queryIndex) {
            $tmpRes = array();
            array_push($tmpRes, $queryIndex->stockname, $queryIndex->code, $queryIndex->stockvalue);
            array_push($newRes, $tmpRes);
        }
        return $newRes;
    }
}