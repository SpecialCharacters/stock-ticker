<?php

class Stock extends Application {

	/**
	 * Index Page for this controller.
	 */
	public function index($name = null)
	{ 
            $realName = ($name === NULL) ? $this->movement->getMostRecentCodeMovement() : $name;
            //$stockItemNames = 
            $this->data['pagebody'] = 'twotablepage';//new DBQuery().getDatabaseData();//'index';
            $this->data['navigation'] = $this->createNavigation(3);
            $this->data['dropdowndata'] = $this->createDropDown($this->stocks->getStocksList(), $realName);
            
            
            
            $fullName = $this->stocks->getStockByCode($realName);
            $this->data['contentTitle'] = $fullName[0] . ' [' . $fullName[1] . ']';
            
            $this->data['leftTableColumns'] = $this->createTableColumns(['Timestamp', 'Action', 'Up/Down']);
            $this->data['leftTableQuery'] = $this->parseQuery($this->movement->getMovementsStock($realName));
            
            $this->data['rightTableColumns'] = $this->createTableColumns(['Player', 'Amount', 'Type', 'Timestamp']);
            $this->data['rightTableQuery'] = $this->parseQuery($this->transaction->getTransactionByCode($realName));
            
            $this->render();
	}
}
