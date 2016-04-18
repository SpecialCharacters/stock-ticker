<?php

/**
 * controllers/Portfolio.php
 *
 * Portfolio controller
 *
 * @author				Carson Roscoe, Jaegar Sarauer
 * @copyright			2016-, Special Characters
 * ------------------------------------------------------------------------
 */
class Portfolio extends Application {

    function __construct() {
	parent::__construct();
	$fullName = $this->players->getPlayerNamesByUsername($realName); //query players 
	$this->data['contentTitle'] = $fullName[0] . ' ' . $fullName[1] . ' [' . $realName . ']'; //set page title
	$this->restrict(array(ROLE_PLAYER, ROLE_ADMIN));
    }

    /**
     * Index Page for this controller.
     */
    public function index($name = null) {
	$realName = ($name === NULL) ? $this->session->userdata('logged_in')['username'] : $name;
	if ($realName === NULL) {
	    //handle nobody logged in and no profile username request
	    echo '<script>alert("Please log in first.")</script>';
	    redirect('/', 'refresh');
	}

	$this->data['pageheader'] = $realName . "'s Profile";

	$this->data['links'] = $this->createNavigation(2); //create navigation bar - MY_CONTROLLER.php   
	$this->data['pagebody'] = 'twotablepage'; //setting pagebody to be the two table view
	//$this->data['dropdowndata'] = $this->createDropDown($this->players->getPlayersNames(), $realName); //create drop down
	//populating tables with data from query
	$this->data['leftTableColumns'] = $this->createTableColumns(['Name', 'Code', 'Amount']);
	//$this->data['leftTableQuery'] = $this->parseQueryClickable($this->playerstocks->getPlayerStocksAndNames($realName), 'stock', 1);

	$this->data['rightTableColumns'] = $this->createTableColumns(['Stock', 'Amount', 'Type', 'Timestamp']);
	//$this->data['rightTableQuery'] = $this->parseQueryClickable($this->transaction->getTransactionByUsername($realName), 'stock', 1);

	$this->render();
    }

}
