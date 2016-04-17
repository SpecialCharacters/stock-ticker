<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Certificates
 *
 * @author Carson
 */
class Certificates extends MY_Model {
    public $url = array('buy' => 'http://bsx.jlparry.com/buy',
                        'sell' => 'http://bsx.jlparry.com/sell',
                        'register' => 'http://bsx.jlparry.com/register');
    
    function __construct() {
        parent::__construct('certificates','certificateID');
    }
    
    function buyStock($team, $token, $player, $stock, $quantity) {
        $data = array('team' => $team, 
                      'token' => $token,
                      'player' => $player,
                      'stock' => $stock,
                      'quantity' => $quantity);

        return $this->submitPostRequest($data, $this->url['buy']);
    }
    
    function sellStock($team, $token, $player, $stock, $quantity, $certificates) {
        $data = array('team' => $team, 
                      'token' => $token,
                      'player' => $player,
                      'stock' => $stock,
                      'quantity' => $quantity);
        foreach($certificates as $certificate) {
            $newArray = array('certificate' => $certificate);
            array_push($data, $newArray);
        }

        return $this->submitPostRequest($data, $this->url['sell']);
    }
    
    function registerAgent($password) {
        $data = array('team' => 'O07', 
                      'name' => 'SpecialCharacters',
                      'password' => $password);
        
        return $this->submitPostRequest($data, $this->url['register']);
    }
    
    function submitPostRequest($array, $url) {
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($array)
            )
        );
        
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { 
            /* Handle error */ 
        }

        //Handle the XML certificate return
        return simplexml_load_file($result);
    }
    
    function getGameState() {
        return simplexml_load_file("http://bsx.jlparry.com/status");
    }
}
