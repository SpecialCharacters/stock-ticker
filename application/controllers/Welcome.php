<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{ 
            $this->data['pagebody'] = 'twotablepage';//new DBQuery().getDatabaseData();//'index';
            $this->data['navigation'] = $this->createNavigation(1);//$this->navigation(1);
            $this->data['dropdowndata'] = '';
            
            $this->data['leftTableColumns'] = $this->createTableColumns(['Name', 'Code', 'Value']);
            $this->data['rightTableQuery'] = $this->parseQuery($this->players->getPlayers());
            
            $this->data['rightTableColumns'] = $this->createTableColumns(['Name', 'Equity', 'Cash']);
            $this->data['leftTableQuery'] = $this->parseQueryClickable($this->stocks->getStocks());
            
            $this->render();
	}        
}
