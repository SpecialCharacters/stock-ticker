<?php

class Stock extends Application {

	/**
	 * Index Page for this controller.
	 */
	public function index($name = null)
	{ 
            $stockItemNames = ['A', 'B', 'C', 'Oil'];
            $this->data['pagebody'] = 'twotablepage';//new DBQuery().getDatabaseData();//'index';
            $this->data['navigation'] = $this->createNavigation(3);
            $this->data['dropdowndata'] = $this->createDropDown($stockItemNames, $name);
            $this->data['stockname'] = $name;
            
            $this->data['leftTableColumns'] = $this->createTableColumns(['Timestamp', 'Up/Down']);
            $this->data['leftTableQuery'] = $this->parseQuery($this->movement->getMovementsStock($name));
            
            $this->data['rightTableColumns'] = $this->createTableColumns(['Player', 'Amount', 'Timestamp']);
            //$this->data['rightTableQuery'] = $this->jaegarsRightTableQueryFunction();
            
            $this->render();
	}
}
