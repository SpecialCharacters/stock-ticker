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
    
    function __construct() {
        parent::__construct('certificates','certificateID');
    }
    
    function buyStock($team, $token, $player, $stock, $quantity) {
        $data = array('team' => $team, 
                      'token' => $token,
                      'player' => $player,
                      'stock' => $stock,
                      'quantity' => $quantity);

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        
        $context  = stream_context_create($options);
        $result = file_get_contents($this->buyUrl, false, $context);
        if ($result === FALSE) { 
            /* Handle error */ 
        }

        //Handle the XML certificate return
        var_dump($result);
        return $result;
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

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        
        $context  = stream_context_create($options);
        $result = file_get_contents($this->buyUrl, false, $context);
        if ($result === FALSE) { 
            /* Handle error */ 
        }

        //Handle the XML certificate return
        var_dump($result);
        return $result;
    }
}
