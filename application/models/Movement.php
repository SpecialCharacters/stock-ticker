<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Movement extends MY_Model {
    
    function __construct() {
        parent::__construct('stockmovements','movementID');
    }
    
    function getMovementsStock($name) {
        $codeQuery = $this->stocks->getStocks();
        $code = '';
        foreach($codeQuery as $tmpStock) {
            if ($tmpStock[0] == $name) {
                $code = $tmpStock[1];
            }
        }
        $res = $this->some('code', $code);
        $newRes = array();
        
        $index = count($res) - 1;

        while($index > 0) {
            $tmpRes = array();
            array_push($tmpRes, $res{$index}->datetime, $res{$index}->amount);
            array_push($newRes, $tmpRes);
            $index--;
        }
        return $newRes;
    }
}