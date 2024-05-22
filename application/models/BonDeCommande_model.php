<?php
// BonDeCommande_model.php

class BonDeCommande_model extends CI_Model {
    private $idBonCommande;
    private $idFournisseur;
    private $livraisonPartielle;
    private $typePaiement;
    private $dateBonCommande;
	private $etat;

    public function __construct() {
        parent::__construct();
    }

    // Setters
    public function setIdBonCommande($idBonCommande) {
        $this->idBonCommande = $idBonCommande;
    }

    public function setIdFournisseur($idFournisseur) {
        $this->idFournisseur = $idFournisseur;
    }

    public function setLivraisonPartielle($livraisonPartielle) {
        $this->livraisonPartielle = $livraisonPartielle;
    }

    public function setTypePaiement($typePaiement) {
        $this->typePaiement = $typePaiement;
    }

    public function setDateBonCommande($dateBonCommande) {
        $this->dateBonCommande = $dateBonCommande;
    }
	public function setEtat($state) {
        $this->etat = $state;
    }

    // Getters
    public function getIdBonCommande() {
        return $this->idBonCommande;
    }

    public function getIdFournisseur() {
        return $this->idFournisseur;
    }

    public function getLivraisonPartielle() {
        return $this->livraisonPartielle;
    }

    public function getTypePaiement() {
        return $this->typePaiement;
    }

    public function getDateBonCommande() {
        return $this->dateBonCommande;
    }

	public function getEtat() {
        return $this->etat;
    }

	public function newBondeCommande(BonDeCommande_model $bdc) {
		$data = array(
			'idfournisseur' => $bdc->getIdFournisseur(),
			'livraisonpartielle' => $bdc->getLivraisonPartielle(),
			'typepayement' => $bdc->getTypePaiement(),
			'dateboncommande' => $bdc->getDateBonCommande(),
			'etat' => $bdc->getEtat()
		);

		$this->db->insert('boncommande', $data);

		return 'BDC'.$this->db->insert_id();
	}

	public function getFournisseurBonCommande($id){
		$sql = "select * from boncommande where idboncommande = '%s'";
		$sql = sprintf($sql, $id);
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getBonCommmandeById($id){
		$sql = "select * from boncommandedetaille where idboncommande = '$id'";
		$sql = sprintf($sql);
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getBonCommmande($etat){
		$sql = "select * from boncommandedetaille where etat = $etat";
		$sql = sprintf($sql);
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getBonCommmande2($etat1,$etat2){
		$sql = "select * from boncommandedetaille where etat = $etat1 or etat = $etat2";
		$sql = sprintf($sql);
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function updateBonCommande($etatinit, $etatfin){
		$sql = "update boncommande set etat='$etatfin' where etat='$etatinit'";
    	$this->db->query($sql);
	}

	public function updateBonCommandeById($id, $etat){
		$sql = "update boncommande set etat='$etat' where idboncommande='$id'";
    	$this->db->query($sql);
	}

}
?>
