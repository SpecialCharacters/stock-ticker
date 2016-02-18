<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
            var_dump($this->players->getDatabaseData());
            //$this->load->view('welcome_message');
            $this->data['pagebody'] = 'index';//new DBQuery().getDatabaseData();//'index';
            $this->data['pagenavigation'] = 'navigation';
            $this->render();
	}
}
