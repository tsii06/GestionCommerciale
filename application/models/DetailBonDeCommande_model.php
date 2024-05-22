<?php
// DetailBonDeCommande_model.php

class DetailBonDeCommande_model extends CI_Model {
    private $idDetailBonCommande;
    private $idBonCommande;
    private $idProduit;
    private $quantite;

    public function __construct() {
        parent::__construct();
    }

    // Setters
    public function setIdDetailBonCommande($idDetailBonCommande) {
        $this->idDetailBonCommande = $idDetailBonCommande;
    }

    public function setIdBonCommande($idBonCommande) {
        $this->idBonCommande = $idBonCommande;
    }

    public function setIdProduit($idProduit) {
        $this->idProduit = $idProduit;
    }

    public function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    // Getters
    public function getIdDetailBonCommande() {
        return $this->idDetailBonCommande;
    }

    public function getIdBonCommande() {
        return $this->idBonCommande;
    }

    public function getIdProduit() {
        return $this->idProduit;
    }

    public function getQuantite() {
        return $this->quantite;
    }

	public function newDetail(DetailBonDeCommande_model $det) {
		$data = array(
			'idboncommande' => $det->getIdBonCommande(),
			'idproduit' => $det->getIdProduit(),
			'quantite' => $det->getQuantite()
		);

		$this->db->insert('detailboncommande', $data);

		return 'DTB'.$this->db->insert_id();
	}

	public function getDetailBonCommmande($iddbc){
		$sql = "select * from detailbdc where idboncommande = '$iddbc'";
		$sql = sprintf($sql);
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
?>
