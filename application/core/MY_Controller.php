<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 * @author		Carson Roscoe, Jaegar Sarauer, Dhivya Manohar
 * @copyright           2016-, Carson Roscoe, Jaegar Sarauer, Dhivya Manohar
 * ------------------------------------------------------------------------
 */

class Application extends CI_Controller {

    protected $data = array();      // parameters for view components
    protected $id;                  // identifier for our content
    protected $choices = array(     // controllers choices
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
        $this->data['bootstrapStyle'] = base_url("assets/css/bootstrap.css");
        $this->data['jQueryScript'] = base_url("assets/js/jquery-2.2.3.min.js");
        $this->data['bootstrapScript'] = base_url("assets/js/bootstrap.js");
    }

    /**
     * Render this page
     * Used on all. We need to load data into content in the controller
     */
    function render() {
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
        $this->data['data'] = &$this->data;
        $this->parser->parse('_template', $this->data);
    }
    
    /**
     * Parsing query fom database
     * @param type $queryData data received from database
     * @param type $ignoreIndex 
     * @return string parsed data
     */
    function parseQuery($queryData, $ignoreIndex = -1) {
            $res = '';
            
            if ($queryData == NULL) {
                return '';
            }
            
            foreach($queryData as $queryIndex) {
                $res .= '<tr>';
                for ($index = 0; $index < count($queryIndex); $index++) {
                    if ($ignoreIndex !== $index) {
                        $res .= '<td>' . $queryIndex[$index] . '</td>';
                    }
                }
                $res .= '</tr>';
            }
            return $res;
    }
    
        function parseQueryClickable($queryData, $linkto, $IgnoreIndex = 0) {
            $res = '';
            
            if ($queryData == NULL) {
                return '';
            }
            
            foreach($queryData as $queryIndex) {
                $res .= '<tr>';
                for ($index = $IgnoreIndex; $index < count($queryIndex); $index++) {
                    $res .= '<td>';
                    if ($index === $IgnoreIndex) {
                        $res .= '<a id="clickable" href="/'. $linkto. '/' . $queryIndex[0] . '">' . $queryIndex[$index] . '</a>';
                    } else {
                        $res .= $queryIndex[$index];
                    }
                    $res .= '</td>';
                }
            }
            return $res;
    }
    
    /**
     * Creates the dynamic navigation bar
     * @param type $page which controller you're in
     * @return string the html to be printed to screen
     */
    protected function createNavigation($page) {
        $counter = 1;
        
        $result = '<div id="loginDiv">';
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            //$this->data['loginForm'] = '<p class="navbar-text">Welcome, '.$session_data['username'].'!</p>';

            $this->data['loginForm'] = '<form class="navbar-form navbar-left" role="search" id="loginForm" method="post"action="/login">
                <div class="navbar-text" id="minimal-nav-text">Welcome, ' . $session_data['username'] . '!</div>
                <button type="submit" value="Submit" class="btn btn-default">Log Out</button>
            </form>';  

            if ($page === 1) {
                $this->data['navLinks'] = '<li class="active"><a href="/">Homepage</a></li>
                <li><a href="/profile">Profile</a></li>
                <li><a href="/stock">Stock</a></li>';
            } else if ($page === 2) {
                $this->data['navLinks'] = '<li><a href="/">Homepage</a></li>
                <li class="active"><a href="/profile">Profile</a></li>
                <li><a href="/stock">Stock</a></li>';
            } else if ($page === 3) {
                $this->data['navLinks'] = '<li><a href="/">Homepage</a></li>
                <li><a href="/profile">Profile</a></li>
                <li class="active"><a href="/stock">Stock</a></li>';
            }
        } else {
            $this->data['loginForm'] = '
                    <form class="navbar-form navbar-left" role="search" id="loginForm" method="post"action="/login">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="Username">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <button type="submit" name="Submit" value="Submit" class="btn btn-default">Login</button>
                        <button type="submit" name="Submit" value="Register" class="btn btn-default">Register</button>
                  </form>';
       $this->data['navLinks'] = '<div class="navbar-text">Please login or register to browse the website.</div>';
        }
       $result .= '</div><div id="pageSelection"><ul>';
        
                
        $result .= '</ul></div>';
        
        return $result;
    }
    
    /**
     * Creates a dynamic dropdown list
     * @param type $dropdowndata
     * @param type $pagename
     * @return string
     */
    function createDropDown($dropdowndata = null, $pagename = null) {
        $URI = "$_SERVER[REQUEST_URI]"; //reloading page
        
        //error check URI is right
        if (strlen($URI) > 1) {
            $arr = explode('/', $URI);
            $URI = $arr[0].'/'.$arr[1];
        }
        
        $URI.='/';
        
        //populates the dropdown & if you change the item it will reload page
        $result = '<select onchange="window.location=\''."http://$_SERVER[HTTP_HOST]$URI".'\' + this.value;">';
        foreach($dropdowndata as $item) {
            $result .= '<option value="'.$item[0].'"';
            if ($item[0]==$pagename) {
                $result .= ' selected="selected"';
            }
            $result .= '>'.$item[1] . ' [' . $item[0] . ']' . '</option>';
        }
        $result .= '</select>';
        return $result;
    }
    
    /**
     * Creates tables for page to hold content
     * @param type $columnNames name of columns
     * @return string html string to draw to screen
     */
    function createTableColumns($columnNames) {
        $result = '<tr>';
        foreach($columnNames as $column) {
            $result .= '<td><h3>'.$column.'</h3></td>';
        }
        $result .= '</tr>';
        return $result;
    }
}
