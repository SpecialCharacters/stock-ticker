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
        
        public function queryLogin($username, $password){
            
            $this -> db -> select('username, password');
            $this -> db -> from('players');
            $this -> db -> where('username', $username);
            $this -> db -> where('password', $password);
            
            $result = $this-> db ->get();
            
            if($result -> num_rows() == 1){
                return true;
            }
            else{
                return false;
            }
        }
        
        public function setNavBarLogin($password){
            
            $result = $this->user->queryLogin($username,$password);
            
            if($result)
            {
                //however we want to set the navbar if they are successful
                $sess_array = array();
                foreach($result as $row)
                {
                    $sess_array = array(
                        'id' => $row->id,
                        'username' => $row->username
                    );
                }
                $this->session->set_userdata('logged_in', $sess_array);
                return true;
            }else{
                //how ever we want to set the navbar if they type in a wrong password
                //$this->form_validation->set_message('check database', 'invalid password');
                return false;
            }
            
        }
        
        public function setNavBarLogout(){
            $this->session->unset_userdata('logged_in');
            session_destroy();
            redirect('home', 'refresh');
        }
        
}
