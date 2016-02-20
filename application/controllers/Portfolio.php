<?php

/**
 * controllers/Portfolio.php
 *
 * Portfolio model
 *
 * @author		Carson Roscoe,Jaegar Sarauer
 * @copyright           2016-, Special Characters
 * ------------------------------------------------------------------------
 */

class Portfolio extends Application {

	/**
	 * Index Page for this controller.
	 */
	public function index($name = null)
	{ 
            //checking to see if logged in, otherwise redirect
            $realName = ($name === NULL)? $this->session->userdata('logged_in') : $name;
            
             //handle nobody logged in and no profile username request
            if ($realName === NULL) {               
		echo '<script>alert("Please log in first.")</script>';
                redirect('/', 'refresh');
            }
            
            $this->data['pagebody'] = 'twotablepage'; //setting pagebody to be the two table view
            $this->data['navigation'] = $this->createNavigation(2); //create navigation bar
            $this->data['dropdowndata'] = $this->createDropDown($this->players->getPlayersNames(), $realName); //create drop down
            
            $fullName = $this->players->getPlayerNamesByUsername($realName); //query players          

            $this->data['contentTitle'] = $fullName[0] . ' ' . $fullName[1] . ' [' . $realName . ']'; //set page title

            //populating tables with data from query
            $this->data['leftTableColumns'] = $this->createTableColumns(['Name', 'Code', 'Amount']);
            $this->data['leftTableQuery'] = $this->parseQueryClickable($this->playerstocks->getPlayerStocksAndNames($realName), 'stock', 1);
            
            $this->data['rightTableColumns'] = $this->createTableColumns(['Stock', 'Amount', 'Type', 'Timestamp']);
            $this->data['rightTableQuery'] = $this->parseQueryClickable($this->transaction->getTransactionByUsername($realName), 'stock', 1);

            
            $this->render();
	}
}
