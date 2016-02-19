<?php

class Portfolio extends Application {

	/**
	 * Index Page for this controller.
	 */
	public function index($name = null)
	{ 
            //$name is the name of the user's data being passed in
            $this->data['pagebody'] = 'profile';//new DBQuery().getDatabaseData();//'index';
            $this->data['pagenavigation'] = 'navigation';
            $this->render();
	}
}
