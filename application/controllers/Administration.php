<?php

/**
 * controllers/Administration.php
 *
 * Administration controller
 *
 * @author				Dhivya Manohar
 * @copyright			2016-, Special Characters
 * ------------------------------------------------------------------------
 */
class Administration extends Application {

    /**
     * Index Page for this controller.
     */
    function __construct() {
	parent::__construct();
	$this->data['contentTitle'] = 'A D M I N I S T R A T I O N';
	$this->restrict(array(ROLE_ADMIN));
    }

    public function index($name = null) {
	$realName = ($name === NULL) ? $this->session->userdata('logged_in')['username'] : $name;

	$this->data['pagebody'] = 'admin'; //setting pagebody to be the two table view
	$this->data['navigation'] = $this->createNavigation(2); //create navigation bar
	$this->render();
    }
    
    //TODO - parse data and put it in table
    //TODO - add functionality to delete from table and database

}
