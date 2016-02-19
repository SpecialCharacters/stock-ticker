<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Application {
    
    public function index(){
        setNavBarLogin($username,$password);
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
        
    public function setNavBarLogin($username,$password){

        $result = $this->user->queryLogin($username,$password);

        if($result)
        {
            //however we want to set the navbar if they are successful
            $sess_array = array();
            foreach($result as $row)
            {
                $sess_array = array(
                    'username' => $row->username,
                    'firstname' => $row->firstname
                );
            }
            $this->session->set_userdata('logged_in', $sess_array);
            redirect('portfolio', 'refresh'); //just to test if it works
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





