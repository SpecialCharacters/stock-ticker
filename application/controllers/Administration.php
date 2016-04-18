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
	$this->restrict(ROLE_ADMIN);
    }

    public function index($name = null) {
	$this->data['pagebody'] = 'admin'; //setting pagebody to be the two table view
	$this->data['links'] = $this->createNavigation(5); //create navigation bar
	$this->render();
    }
    
    //TODO - parse data and put it in table
    //TODO - add functionality to delete from table and database

}
