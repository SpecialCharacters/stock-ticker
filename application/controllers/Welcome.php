<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

	/**
	 * Index Page for this controller.
	 */
	public function index()

	{ 
            //$this->data['playersQuery'] = $this->queryPlayers();
            $this->data['pagebody'] = 'index';//new DBQuery().getDatabaseData();//'index';
            $this->data['navigation'] = $this->createNavigation(1);//$this->navigation(1);
            $this->render();
	}
        

        /*
        public function queryPlayers() {
            $data = $this->players->getDatabaseData();
            $res = '';
            foreach($data as $player) {
                $res .= '<tr>  <td>' . $player["Player"] . '</td><td>' . $player["Cash"] . '</td></tr>';
            }
            return $res;
        }*/
}
