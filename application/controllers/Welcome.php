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
            $this->data['pagebody'] = 'index';//new DBQuery().getDatabaseData();//'index';
            $this->data['pagenavigation'] = 'navigation';
            $this->render();
	}
}
