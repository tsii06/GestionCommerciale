<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewDG extends CI_Controller {
	public function listeBonCommande(){
		$this->load->model('BonDeCommande_model');
		$this->load->model('DetailBonDeCommande_model');
		
	    $data['boncommande'] = $this->BonDeCommande_model->getBonCommmande(2);    

	    for ($i = 0; $i < count($data['boncommande']); $i++) {
	        $bdcid = $data['boncommande'][$i]['idboncommande'];
	        $data['boncommande'][$i]['detail'] = $this->DetailBonDeCommande_model->getDetailBonCommmande($bdcid);
	    }

		$this->load->view('DG/Template/header');
        $this->load->view('DG/Page/listeBonCommande', $data);
        $this->load->view('DG/Template/footer');
	}

	public function listeBonCommandeSigner(){
		$this->load->model('BonDeCommande_model');
		$this->load->model('DetailBonDeCommande_model');
		
	    $data['boncommande'] = $this->BonDeCommande_model->getBonCommmande2(3,5);    

	    for ($i = 0; $i < count($data['boncommande']); $i++) {
	        $bdcid = $data['boncommande'][$i]['idboncommande'];
	        $data['boncommande'][$i]['detail'] = $this->DetailBonDeCommande_model->getDetailBonCommmande($bdcid);
	    }

		$this->load->view('DG/Template/header');
        $this->load->view('DG/Page/listeBonCommande', $data);
        $this->load->view('DG/Template/footer');
	}

	public function detailCommande($id) {
		$this->load->model('BonDeCommande_model');
		$this->load->model('DetailBonDeCommande_model');
		
	    $data['boncommande'] = $this->BonDeCommande_model->getBonCommmandeById($id)[0];    

		$bdcid = $data['boncommande']['idboncommande'];
		$data['boncommande']['detail'] = $this->DetailBonDeCommande_model->getDetailBonCommmande($bdcid);

		$this->load->view('DG/Template/header');
		$this->load->view('DG/Page/bonCommande', $data);
		$this->load->view('DG/Template/footer');
	}

	public function Signer($id) {
		$this->load->model('BonDeCommande_model');
		$this->load->model('DetailBonDeCommande_model');

	    $this->BonDeCommande_model->updateBonCommandeById($id,3); 
		
	    $data['boncommande'] = $this->BonDeCommande_model->getBonCommmandeById($id)[0];    

		$bdcid = $data['boncommande']['idboncommande'];
		$data['boncommande']['detail'] = $this->DetailBonDeCommande_model->getDetailBonCommmande($bdcid);

		$this->load->view('DG/Template/header');
		$this->load->view('DG/Page/bonCommande', $data);
		$this->load->view('DG/Template/footer');
	}

	public function Envoyer($id) {
		$this->load->model('BonDeCommande_model');
		$this->load->model('DetailBonDeCommande_model');

	    $this->BonDeCommande_model->updateBonCommandeById($id,5); 
		
	    $data['boncommande'] = $this->BonDeCommande_model->getBonCommmandeById($id)[0];    

		$bdcid = $data['boncommande']['idboncommande'];
		$data['boncommande']['detail'] = $this->DetailBonDeCommande_model->getDetailBonCommmande($bdcid);

		$this->load->view('DG/Template/header');
		$this->load->view('DG/Page/Info', $data);
		$this->load->view('DG/Template/footer');
	}
}
