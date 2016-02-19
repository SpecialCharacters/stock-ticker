<?php

class Stock extends Application {

	/**
	 * Index Page for this controller.
	 */
	public function index($name = null)
	{ 
            $stockItemNames = ['A', 'B', 'C'];
            $this->data['pagebody'] = 'stocks';//new DBQuery().getDatabaseData();//'index';
            
            $this->data['stockname'] = $name;
            $this->data['stockPriceHistory'] = $this->parseQuery($this->movement->getMovementsStock($name));
            
            $this->data['navigation'] = $this->createNavigation(3);
            $this->data['dropdowndata'] = $this->createDropDown($stockItemNames, $name);
            $this->render();
	}
}
