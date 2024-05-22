<?php 

class ServiceModel extends CI_Model {

	public function getAllService(){
	    $query = $this->db->get('service');
	    return $query->result_array();
	}	

	public function checkLogin($idService,$mdp){
		$query = $this->db->query("select count(*) as logged from service where idservice='$idService' and mdp = '$mdp'");
	    return $query->row_array();
	}

}

?>