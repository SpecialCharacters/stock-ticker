<?php

class Stock extends Application {

	/**
	 * Index Page for this controller.
	 */
	public function index($name = null)
	{ 
            $this->data['pagebody'] = 'stocks';//new DBQuery().getDatabaseData();//'index';
            $this->data['navigation'] = $this->createNavigation(3);
            $this->render();
	}
}
