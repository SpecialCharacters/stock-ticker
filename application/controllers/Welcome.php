<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{ 
            $this->data['playersQuery'] = $this->parseQuery($this->players->getPlayers());
            $this->data['stocksQuery'] = $this->parseQueryClickable($this->stocks->getStocks());
            $this->data['pagebody'] = 'twotablepage';//new DBQuery().getDatabaseData();//'index';
            $this->data['navigation'] = $this->createNavigation(1);//$this->navigation(1);
            $this->data['leftTableColumns'] = $this->createTableColumns(['Name', 'Code', 'Value']);
            $this->data['rightTableColumns'] = $this->createTableColumns(['Name', 'Equity', 'Cash']);
            $this->data['dropdowndata'] = '';
            $this->render();
	}
}
