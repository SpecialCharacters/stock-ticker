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
        $res = $this->some('code', $name);
        $newRes = array();
        
        $index = count($res) - 1;

        while($index > 0) {
            $tmpRes = array();
            array_push($tmpRes, $res{$index}->datetime, $res{$index}->action, $res{$index}->amount);
            array_push($newRes, $tmpRes);
            $index--;
        }
        return $newRes;
    }
    
    function getMostRecentCodeMovement() {
        $res = $this->all();
        $index = count($res) - 1;
        return $res{$index}->code;
    }
}