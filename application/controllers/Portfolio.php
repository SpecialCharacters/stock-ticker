<?php

class Portfolio extends Application {

	/**
	 * Index Page for this controller.
	 */
	public function index($name = null)
	{ 
            //$realName = $this->session
            //$name is the name of the user's data being passed in
            $playerNames = ['Jaegar', 'Carson', 'George'];
            $this->data['pagebody'] = 'twotablepage';//new DBQuery().getDatabaseData();//'index';
            $this->data['navigation'] = $this->createNavigation(2);
            $this->data['dropdowndata'] = $this->createDropDown($this->players->getPlayersNames(), $name);
            
            $this->data['leftTableColumns'] = $this->createTableColumns(['Name', 'Amount']);
            //$this->data['leftTableColumns'] = $this->jaegarsLeftTableQueryFunction();
            
            $this->data['rightTableColumns'] = $this->createTableColumns(['Stock', 'Amount', 'Timestamp']);
            //$this->data['rightTableQuery'] = $this->jaegarsRightTableQueryFunction();
            
            $this->render();
	}
}
