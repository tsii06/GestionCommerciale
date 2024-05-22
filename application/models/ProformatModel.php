<?php 

class ProformatModel extends CI_Model {

	public function getProformat($id){
		$sql = "select * from proformats where idfournisseur = '%s'";
		$sql = sprintf($sql, $id);
		$query = $this->db->query($sql);
		return $query->result_array();
	}

}

?>