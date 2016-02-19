<?php

class Portfolio extends Application {

	/**
	 * Index Page for this controller.
	 */
	public function index($name = null)
	{ 
            $realName = ($name === NULL)? $this->session->userdata('logged_in') : $name;
            if ($realName === NULL) {
                //handle nobody logged in and no profile username request
            }
            
            $this->data['pagebody'] = 'twotablepage';//new DBQuery().getDatabaseData();//'index';
            $this->data['navigation'] = $this->createNavigation(2);
            $this->data['dropdowndata'] = $this->createDropDown($this->players->getPlayersNames(), $realName);
            
            $fullName = $this->players->getPlayerNamesByUsername($realName);
            $this->data['contentTitle'] = $fullName[0] . ' ' . $fullName[1] . ' [' . $realName . ']';
            
            $this->data['leftTableColumns'] = $this->createTableColumns(['Name', 'Amount']);
            //$this->data['leftTableColumns'] = $this->jaegarsLeftTableQueryFunction();
            
            $this->data['rightTableColumns'] = $this->createTableColumns(['Stock', 'Amount', 'Timestamp']);
            //$this->data['rightTableQuery'] = $this->jaegarsRightTableQueryFunction();
            
            $this->render();
	}
}
