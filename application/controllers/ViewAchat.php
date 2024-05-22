<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewAchat extends CI_Controller {

	public function listeBesoin(){
		$this->load->model('BesoinModel');

		//$idDep = $_SESSION['departement'];

		$data['listeBesoin'] = $this->BesoinModel->getAllBesoinAchat();

		$this->load->view('Achat/Template/header');
        $this->load->view('Achat/Page/listeAchat',$data);
        $this->load->view('Achat/Template/footer');
	}

	public function proformat(){
	    $this->load->view('Achat/Template/header');
	    $this->load->model('ProformatModel');
	    $this->load->model('FournisseurModel');
	    $data = array();
	    $data['proformat'] = $this->FournisseurModel->getAllFournisseur();    

	    for ($i = 0; $i < count($data['proformat']); $i++) {
	        $fournisseurId = $data['proformat'][$i]['idfournisseur'];
	        $data['proformat'][$i]['fournisseur'] = $this->FournisseurModel->getFournisseur($fournisseurId);

	        $data['proformat'][$i]['detail'] = $this->ProformatModel->getProformat($fournisseurId);
	        
	    }
	    
	    $this->load->view('Achat/Page/proformat', $data);
	    $this->load->view('Achat/Template/footer');

	}

	function supprimerDoublons($array) {
		$occurences = array_count_values(($array));
		$result = array_filter($occurences, function ($value) {
			return $value=1;
		});
		return array_keys($result);
	}

	public function bonCommande(){	
		$this->load->model('BesoinModel');
		$this->load->model('ProduitModel');
		$this->load->model('BonDeCommande_model');
		$this->load->model('DetailBonDeCommande_model');

		$besoin = $this->BesoinModel->getAllBesoinAchat();
		
		// Recuperer tous les liste de fournisseur qui a le prix moins disant
		$listeFourni = array();
		for ($i=0; $i < count($besoin); $i++) { 
			$f = $this->ProduitModel->getProduitMinPrix($besoin[$i]['idproduit']);
			$qteb = $besoin[$i]['qte'];
			for ($j=0; $j < count($f); $j++) { 
				if($qteb<=$f[$j]['quantite']) {
					$listeFourni[] = $f[$j]['idfournisseur'];
					$j=100;
				} else {
					$listeFourni[] = $f[$j]['idfournisseur'];
					$qteb-=$f[$j]['quantite'];
				}
			}
		}
		$fournisseur = $this->supprimerDoublons($listeFourni);
		$idbdc = array();
		for ($i=0; $i < count($fournisseur); $i++) { 
			$bon1 = new BonDeCommande_model();
			$bon1->setIdFournisseur($fournisseur[$i]);
			$bon1->setLivraisonPartielle(0);
			$bon1->setTypePaiement('Espece');
			$bon1->setDateBonCommande('2023-11-18');
			$bon1->setEtat(0);

			$idbdc[] = $this->BonDeCommande_model->newBondeCommande($bon1);
		}
		
		for ($i=0; $i < count($idbdc); $i++) { 
			for ($j=0; $j < count($besoin); $j++) {
				$f = $this->ProduitModel->getProduitMinPrix($besoin[$j]['idproduit']);
				$qtebesoin = $besoin[$j]['qte'];
				for ($k=0; $k < count($f); $k++) {
					if($qtebesoin<=$f[$k]['quantite']) {
						if($this->BonDeCommande_model->getFournisseurBonCommande($idbdc[$i])[0]['idfournisseur']==$f[$k]['idfournisseur']) {
							$bon1 = new DetailBonDeCommande_model();
							$bon1->setIdBonCommande($idbdc[$i]);
							$bon1->setIdProduit($besoin[$j]['idproduit']);
							$bon1->setQuantite($qtebesoin);

							$this->DetailBonDeCommande_model->newDetail($bon1);
						}
						$k = 90;
					} else {
						if($this->BonDeCommande_model->getFournisseurBonCommande($idbdc[$i])[0]['idfournisseur']==$f[$k]['idfournisseur']) {
							$bon1 = new DetailBonDeCommande_model();
							$bon1->setIdBonCommande($idbdc[$i]);
							$bon1->setIdProduit($besoin[$j]['idproduit']);
							$bon1->setQuantite($f[$k]['quantite']);

							$this->DetailBonDeCommande_model->newDetail($bon1);
						}
						$qtebesoin-=$f[$k]['quantite'];
					}
				}
			} 
		}

		$data = array();
	    $data['boncommande'] = $this->BonDeCommande_model->getBonCommmande(0);    

	    for ($i = 0; $i < count($data['boncommande']); $i++) {
	        $bdcid = $data['boncommande'][$i]['idboncommande'];
	        $data['boncommande'][$i]['detail'] = $this->DetailBonDeCommande_model->getDetailBonCommmande($bdcid);
	    }

		for ($i=0; $i < count($besoin); $i++) { 
			$this->BesoinModel->updateBesoin(2);
		}

		$this->load->view('Achat/Template/header');
        $this->load->view('Achat/Page/bonCommande', $data);
        $this->load->view('Achat/Template/footer');
	}

	public function EnvoiBonCommande() {
		$this->load->model('BonDeCommande_model');

	    $this->BonDeCommande_model->updateBonCommande(0,1); 

		$this->load->view('Achat/Template/header');
        $this->load->view('Achat/Page/Info');
        $this->load->view('Achat/Template/footer');
	}
}
?>
