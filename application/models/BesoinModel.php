<?php

class BesoinModel extends CI_Model {


	public function insert($idproduit,$idservice,$quantite,$datedemande,$dateexpiration){
	    $sql = "INSERT INTO besoin(idproduit,idservice,quantite,datedemande,dateexpiration,etat) VALUES('%s','%s',%d,'%s','%s',0);";
	    $sql = sprintf($sql,$idproduit,$idservice,$quantite,$datedemande,$dateexpiration);
    	$this->db->query($sql);
	}

	public function getAllBesoinAttente($idservice){
		$query = $this->db->query("select * from detailBesoin where dateexpiration>'now' and etat=0 and idservice='$idservice'");
	    return $query->result_array();
	}

	public function getAllBesoinAttenteByDepartement($idDep){
		$query = $this->db->query("select * from detailBesoin where dateexpiration>'now' and etat=0 and iddepartement='$idDep'");
	    return $query->result_array();
	}

	public function getAllBesoinAchat(){
		$query = $this->db->query("select idproduit,nomproduit,sum(quantite) as qte from detailBesoin where etat=1 and dateexpiration>'now' GROUP BY idproduit,nomproduit");
	    return $query->result_array();
	}

	public function accepteBesoinDep($idBesoin){
		$sql = "update besoin set etat=1 where idBesoin='$idBesoin'";
    	$this->db->query($sql);
	}

	public function updateBesoin($etat){
		$sql = "update besoin set etat='$etat' where etat='1'";
    	$this->db->query($sql);
	}
}
