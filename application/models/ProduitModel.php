<?php

class ProduitModel extends CI_Model {
	public function getAll(){
		$query = $this->db->query("select * from produit");
	    return $query->result_array();
	}

	public function getProduitMinPrix($idproduit) {
		$query = $this->db->query("select * from stock where idproduit = '$idproduit' ORDER BY idproduit,prixunitaire");
	    return $query->result_array();
	}
}

?>
