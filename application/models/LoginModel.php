<?php

if ( ! defined('BASEPATH')) exit('No direct script acces allowed');

class LoginModel extends CI_Model
{

    public function is_logged($mdp,$service)
    {
        $requete = $this->db->query("select count(*) as logged from service where mdp='$mdp' and idservice='$service' ");
        return $requete;
    }
    public function id($code,$service)
    {
        $resultat=array(); 
        $sql="select * from service where mdp=%s and idservice=%s limit 1";
	    $sql=sprintf($sql,$this->db->escape($code),$this->db->escape($service));
	    $query=$this->db->query($sql);
        $resultat=$query->row_array();        
        return $resultat['idservice'];      
    }  
}