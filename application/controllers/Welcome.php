<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
            //var_dump($this->players->getDatabaseData());
            //$this->load->view('welcome_message');
            $this->data['playersQuery'] = $this->queryPlayers();
            //$this->load->('playersQuery', array('data' => $this->players->getDatabaseData()));
            $this->data['pagebody'] = 'index';//new DBQuery().getDatabaseData();//'index';
            $this->data['pagenavigation'] = 'navigation';
            $this->render();
	}
        
        public function queryPlayers() {
            $data = $this->players->getDatabaseData();
            $res = '';
            foreach($data as $player) {
                $res .= '<tr>  <td>' . $player["Player"] . '</td><td>' . $player["Cash"] . '</td></tr>';
            }
            return $res;
        }
}
