<?php

class Portfolio extends Application {

	/**
	 * Index Page for this controller.
	 */
	public function index($name = null)
	{ 
            $realName = ($name === NULL)? $this->session->userdata('logged_in')['username'] : $name;
            if ($realName === NULL) {
                //handle nobody logged in and no profile username request
				echo '<script>alert("Please log in first.")</script>';
                redirect('/', 'refresh');
            }
            
            $this->data['pagebody'] = 'twotablepage';//new DBQuery().getDatabaseData();//'index';
            $this->data['navigation'] = $this->createNavigation(2);
            $this->data['dropdowndata'] = $this->createDropDown($this->players->getPlayersNames(), $realName);
            
            $fullName = $this->players->getPlayerNamesByUsername($realName);
            $this->data['contentTitle'] = $fullName[0] . ' ' . $fullName[1] . ' [' . $realName . ']';
            
            $this->data['leftTableColumns'] = $this->createTableColumns(['Name', 'Code', 'Amount']);
            $this->data['leftTableQuery'] = $this->parseQueryClickable($this->playerstocks->getPlayerStocksAndNames($realName), 'stock', 1);
            
            $this->data['rightTableColumns'] = $this->createTableColumns(['Stock', 'Amount', 'Type', 'Timestamp']);
            $this->data['rightTableQuery'] = $this->parseQueryClickable($this->transaction->getTransactionByUsername($realName), 'stock', 1);
            
            $this->render();
	}
}
