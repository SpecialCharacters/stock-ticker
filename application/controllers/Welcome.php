<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * controllers/Welcome.php
 *
 * Welcome controller
 *
 * @author				Carson Roscoe, Jaegar Sarauer
 * @copyright			2016-, Special Characters
 * ------------------------------------------------------------------------
 */
class Welcome extends Application {

    function __construct() {
	parent::__construct();
	$this->data['pageheader'] = 'W E L C O M E';
	$this->data['contentTitle'] = 'W E L C O M E'; //set page title
	
    }

    /**
     * Index Page for this controller.
     */
    public function index() {
	//$this->stocks->getStocksFromServer();
	$this->data['pagebody'] = 'twotablepage'; //setting pagebody to be the two table view
	$this->data['dropdowndata'] = ''; //create drop down - MY_CONTROLLER.php
	
	$userRole = $this->session->userdata('logged_in')['userRole'];
	if($userRole == ROLE_ADMIN)
	    $this->data['links'] = $this->createNavigation(4); //create navigation bar - MY_CONTROLLER.php  
	else if ($userRole == ROLE_PLAYER || !isset($userRole))
	    $this->data['links'] = $this->createNavigation(1); //create navigation bar - MY_CONTROLLER.php  


	//set left table with data from query            
	$this->data['leftTableColumns'] = $this->createTableColumns(['Name', 'Code', 'Value']);
	//$this->data['leftTableQuery'] = $this->parseQueryClickable($this->stocks->getStocks(), 'stock', 1);

	//set right table with data from query
	$this->data['rightTableColumns'] = $this->createTableColumns(['Name', 'Equity', 'Cash']);
	//$this->data['rightTableQuery'] = $this->parseQueryClickable($this->players->getPlayers(), 'profile', 1);

	$this->render();
    }

}
