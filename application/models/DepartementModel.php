<?php

class DepartementModel extends CI_Model {
	
	public function checkLogin($mail,$mdp){
		$sql = "select iddepartement from detaildepartement where email = '$mail' and mdp = '$mdp'";
		$query = $this->db->query("select iddepartement from detaildepartement where email = '$mail' and mdp = '$mdp'");
		echo $sql;
	    return $query->row_array();
	}

}

?>
