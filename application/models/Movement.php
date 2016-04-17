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
    public $url = 'http://bsx.jlparry.com/data/movement';
    //Sequence | Datetime | Code | Action | Amount
    public $movements = array();
    private $displayAmount = 20;
    
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct('stockmovements','movementID');
        $this->getRecentMovements();
    }
    
    /**
     * Gets the code of the most recent stock that moved
     * @return code of the most recent stock that moved
     */
    function getMostRecentCodeMovement() {
        $index = count($this->movements) - 1;
        return $this->movements[$index][2];
    }
    
    function getRecentMovements() {
        $result = array();
        $site = fopen($this->url, 'r');
        if($site == false)  {
            return $result;
        } else {
            $data = fgetcsv($site, 1024, ',', '"');
            while($data != false) {
                $result[] = array($data[0], $data[1], $data[2], $data[3], $data[4]);
                $data = fgetcsv($site, 1024, ',', '"');
            }
            fclose($site);
        }
        array_shift($result);
        $result = array_slice($result, 0, $this->displayAmount);
        $this->movements = $result;
        return $result;
    }
    
    function getRecentMovementsByStock($code)
    {
        $movements = array();
        $site = fopen($this->url, 'r');
        if($site != false) {
            $data = fgetcsv($site, 1024, ',', '"');
            while($data !== false) {
                if($data[2] == $code) {
                    $movements[] = array($data[1], $data[3], $data[4]);
                }
                $data = fgetcsv($site, 1024, ',', '"');
            }
            fclose($site);
        }
        array_shift($movements);
        $movements = array_slice($movements, 0, $this->displayAmount);
        return $movements;
    }
}