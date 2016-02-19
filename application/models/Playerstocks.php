<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Playerstocks extends MY_Model2 {
    
    function __construct() {
        parent::__construct('playerstock','username','code');
    }
}