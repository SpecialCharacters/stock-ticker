<?php
/**
 * controllers/Stock.php
 *
 * Stock model
 *
 * @author		Jaegar Sarauer, Dhivya Manohar
 * @copyright           2016-, Special Characters
 * ------------------------------------------------------------------------
 */

class Stock extends Application {

	/**
	 * Index Page for this controller.
	 */
	public function index($name = null)
	{ 
            $realName = ($name === NULL) ? $this->movement->getMostRecentCodeMovement() : $name;
            //$stockItemNames = 
            $this->data['pagebody'] = 'twotablepage';//setting pagebody to be the two table view
            $this->data['navigation'] = $this->createNavigation(3);//create navigation bar - MY_CONTROLLER.php
            $this->data['dropdowndata'] = $this->createDropDown($this->stocks->getStocksList(), $realName);//create drop down - MY_CONTROLLER.php
            
            $fullName = $this->stocks->getStockByCode($realName);//query database
            $this->data['contentTitle'] = $fullName[0] . ' [' . $fullName[1] . ']';//set page title            

            //populating right table with data from query
            $this->data['leftTableColumns'] = $this->createTableColumns(['Timestamp', 'Action', 'Up/Down']);
            $this->data['leftTableQuery'] = $this->parseQuery($this->movement->getMovementsStock($realName));            
            
            $this->data['rightTableColumns'] = $this->createTableColumns(['Player', 'Amount', 'Type', 'Timestamp']);
            $this->data['rightTableQuery'] = $this->parseQuery($this->transaction->getTransactionByCode($realName));
            
            $this->render();
	}
}
