<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Transaction extends MY_Model {
    
    function __construct() {
        parent::__construct('transactions','transactionID');
    }
    
    function getTransactionByCode($code) {
        $res = $this->some('code' , $code);
        $newRes = array();
        
        $index = count($res) - 1;

        while($index > 0) {
            $tmpRes = array();
            $name = $this->players->getPlayerNamesByUsername($res{$index}->username);
            array_push($tmpRes, $name[0] . ' ' . $name[1], $res{$index}->amount, $res{$index}->type, $res{$index}->datetime);
            array_push($newRes, $tmpRes);
            $index--;
        }
        return $newRes;
    }
}