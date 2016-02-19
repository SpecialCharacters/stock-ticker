<?php

class Portfolio extends Application {

	/**
	 * Index Page for this controller.
	 */
	public function index($name = null)
	{ 
            //$name is the name of the user's data being passed in
            $playerNames = ['Jaegar', 'Carson', 'George'];
            $this->data['pagebody'] = 'twotablepage';//new DBQuery().getDatabaseData();//'index';
            $this->data['navigation'] = $this->createNavigation(2);
            $this->data['dropdowndata'] = $this->createDropDown($playerNames, $name);
            $this->data['leftTableColumns'] = $this->createTableColumns(['Name', 'Amount']);
            $this->data['rightTableColumns'] = $this->createTableColumns(['Stock', 'Amount', 'Timestamp']);
            $this->render();
	}
}
