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
        $this->data['data'] = &$this->data;
        $this->parser->parse('_template', $this->data);
    }
    
    function parseQuery($queryData) {
            $res = '';
            
            if ($queryData == NULL) {
                return '';
            }
            
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
            
            if ($queryData == NULL) {
                return '';
            }
            
            foreach($queryData as $queryIndex) {
                $res .= '<tr>';
                $first = TRUE;
                foreach($queryIndex as $singular) {
                    if ($first) {
                        $res .= '<td><a id="clickable" href="/stock/' . $singular . '">' . $singular . '</a></td>';
                        $first = FALSE;
                    } else {
                        $res .= '<td>' . $singular . '</td>';
                    }
                }
                $res .= '</a>';
            }
            return $res;
    }
    
    //To be removed and replaced with below version.
    protected function createNavigation($page) {
        $counter = 1;
        $result = '
        <div id="loginDiv">
            <form id="loginForm" action="loginAttempt.php">
                Username:<br>
                <input type="text" name="firstname"><br>
                Password:<br>
                <input type="password" name="password"><br>
                <input type="submit" value="Submit">
            </form>
        </div>
        <div id="pageSelection">
            <ul>';
        
        $result .= '
                <li><a href="/">Homepage</a></li>
                <li><a href="/profile">Profile</a></li>
                <li><a href="/stock">Stock</a></li>';
                
        $result .= '</ul></div>';
        
        return $result;
    }
    
    //Unfinished attempt at dynamically generating navigation & selected.
    /*protected function createNavigation($name) {
        $result = '';
        $counter = 1;
        
        foreach($this->choices as $choice) {
            $result .= '<li';
            if ($page == $counter++) {
                $result .= ' id=currentpage';
            }
            $result .= '><a hreh=\"' . $choice-> . ">" . "Homepage" . "</a></li>";
        }
        
        return $result;
    }*/
    
    function createDropDown($dropdowndata = null, $pagename = null) {
        $URI = "$_SERVER[REQUEST_URI]";
        if (strlen($URI) > 1) {
            $arr = explode('/', $URI);
            $URI = $arr[0].'/'.$arr[1];
        }
        $URI.='/';
        $result = '<select onchange="window.location=\''."http://$_SERVER[HTTP_HOST]$URI".'\' + this.value;">';
        foreach($dropdowndata as $item) {
            $result .= '<option value="'.$item.'"';
            if ($item==$pagename) {
                $result .= ' selected="selected"';
            }
            $result .= '>'.$item.'</option>';
        }
        $result .= '</select>';
        return $result;
    }
    
    function createTableColumns($columnNames) {
        $result = '<tr>';
        foreach($columnNames as $column) {
            $result .= '<td><h3>'.$column.'</h3></td>';
        }
        $result .= '</tr>';
        return $result;
    }
}
