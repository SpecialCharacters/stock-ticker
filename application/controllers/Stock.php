<?php

class Stock extends Application {

	/**
	 * Index Page for this controller.
	 */
	public function index($name = null)
	{ 
            
            $this->data['stockname'] = $name;
            $this->data['stockPriceHistory'] = $this->parseQuery($this->movement->getMovementsStock($name));
            //$this->data['stocksHistoryQuery'];
            $this->data['pagebody'] = 'stocks';
            $this->data['navigation'] = $this->createNavigation(3);
            $this->render();
	}
}
