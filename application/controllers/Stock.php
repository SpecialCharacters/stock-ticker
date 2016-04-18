<?php

/**
 * controllers/Stock.php
 *
 * Stock controller
 *
 * @author				Carson Roscoe, Jaegar Sarauer
 * @copyright			2016-, Special Characters
 * ------------------------------------------------------------------------
 */
class Stock extends Application {

    function __construct() {
	parent::__construct();
	$fullName = $this->stocks->getStockByCode($realName); //query database
	$this->data['contentTitle'] = $fullName[0] . ' [' . $fullName[1] . '] = $' . $this->stocks->getStockPrice($realName); //set page title  
	
    }

    /**
     * Index Page for this controller.
     */
    public function index($name = null) {
	$this->stocks->getStocksFromServer();
	$realName = ($name === NULL) ? $this->movement->getMostRecentCodeMovement() : $name;

	$this->data['pagebody'] = 'twotablepage'; //setting pagebody to be the two table view
	$this->data['links'] = $this->createNavigation(3); //create navigation bar - MY_CONTROLLER.php   

	$this->data['pageheader'] = $realName . " Stock History";
	$this->data['dropdowndata'] = $this->createDropDown($this->stocks->getStocksList(), $realName); //create drop down - MY_CONTROLLER.php        
	//populating tables with data from queries
	$this->data['leftTableColumns'] = $this->createTableColumns(['Timestamp', 'Action', 'Up/Down']);
	$this->data['leftTableQuery'] = $this->parseQuery($this->movement->getRecentMovementsByStock($realName));

	$this->data['rightTableColumns'] = $this->createTableColumns(['Player', 'Amount', 'Type', 'Timestamp']);
	$this->data['rightTableQuery'] = $this->parseQueryClickable($this->transaction->getTransactionByCode($realName), 'profile', 1);

	$this->render();
    }

}
