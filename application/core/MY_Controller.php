<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 * @author		JLP
 * @copyright           2010-2015, James L. Parry
 * ------------------------------------------------------------------------
 */
class Application extends CI_Controller {

    protected $data = array();      // parameters for view components
    protected $id;                  // identifier for our content
    protected $choices = array(
        'Homepage' => '/', 'Profile' => '/profile', 'Stock' => '/stock'
    );

    /**
     * Constructor.
     * Establish view parameters & load common helpers
     */

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->data['pagetitle'] = "StockWatch";
        $this->data['pageheader'] = "StockWatch";
    }

    /**
     * Render this page
     * Used on all. We need to load data into content in the controller
     */
    function render() {
        //$this->data['navbar'] = build_menu_bar($this->choices);
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
        $this->data['navigation'] = $this->parser->parse($this->data['pagenavigation'], $this->data, true);
        $this->data['data'] = &$this->data;
        $this->parser->parse('_template', $this->data);
    }
    
    function parseQuery($queryData) {
            $res = '';
            
            if ($queryData == NULL)
                return '';
            
            foreach($queryData as $queryIndex) {
                $res .= '<tr>';
                foreach($queryIndex as $singular) {
                    $res .= '<td>' . $singular . '</td>';
                }
                $res .= '</tr>';
            }
            return $res;
    }
    
        function parseQueryClickable($queryData) {
            $res = '';
            $first = TRUE;
            
            if ($queryData == NULL)
                return '';
            
            foreach($queryData as $queryIndex) {
                $res .= '<tr>';
                $first = TRUE;
                foreach($queryIndex as $singular) {
                    if ($first) {
                        $res .= '<td><a href="/stock/' . $singular . '">' . $singular . '</a></td>';
                        $first = FALSE;
                    } else {
                        $res .= '<td>' . $singular . '</td>';
                    }
                }
                $res .= '</a>';
            }
            return $res;
    }
}
