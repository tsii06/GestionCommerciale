<?php 

class FournisseurModel extends CI_Model {

	public function getAllFournisseur(){
	    $query = $this->db->get('fournisseur');
	    return $query->result_array();
	}	
	public function getFournisseur($id){
		$sql = "select * from fournisseur where idfournisseur = '%s'";
		$sql = sprintf($sql, $id);
		$query = $this->db->query($sql);
		return $query->row_array();
	}

}

?>