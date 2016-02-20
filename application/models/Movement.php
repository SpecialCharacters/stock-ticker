<?php

/**
 * model/Movement.php
 *
 * Movement model
 *
 * @author				Jaegar Sarauer, Allen Tsang, Dhivya Manohar,
 * @copyright			2016-, Special Characters
 * ------------------------------------------------------------------------
 */

class Movement extends MY_Model {
    
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct('stockmovements','movementID');
    }
    
    /**
     * Gets movements of specified stock
     * @param type $name name of stock
     * @return array containing movement data
     */
    function getMovementsStock($name) {
        $res = $this->some('code', $name);
        $newRes = array();
        
        $index = count($res) - 1;
        
        //stores queried data into array
        while($index > 0) {
            $tmpRes = array();
            array_push($tmpRes, $res{$index}->datetime, $res{$index}->action, $res{$index}->amount);
            array_push($newRes, $tmpRes);
            $index--;
        }
        return $newRes;
    }
    
    /**
     * Gets the code of the most recent stock that moved
     * @return code of the most recent stock that moved
     */
    function getMostRecentCodeMovement() {
        $res = $this->all();
        $index = count($res) - 1;
        return $res{$index}->code;
    }
}