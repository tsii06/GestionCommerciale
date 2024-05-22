<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewFinance extends CI_Controller {
	public function detailCommande($id) {
		$this->load->model('BonDeCommande_model');
		$this->load->model('DetailBonDeCommande_model');
		
	    $data['boncommande'] = $this->BonDeCommande_model->getBonCommmandeById($id)[0];    

		$bdcid = $data['boncommande']['idboncommande'];
		$data['boncommande']['detail'] = $this->DetailBonDeCommande_model->getDetailBonCommmande($bdcid);

		$this->load->view('Finance/Template/header');
		$this->load->view('Finance/Page/bonCommande', $data);
		$this->load->view('Finance/Template/footer');
	}

	public function ValiderCommande($id) {
		$this->load->model('BonDeCommande_model');

	    $this->BonDeCommande_model->updateBonCommandeById($id,2); 

		redirect('ViewFinance/dashboard');
	}

	public function dashboard() {
		$this->load->model('BonDeCommande_model');
		$this->load->model('DetailBonDeCommande_model');
		
	    $data['boncommande'] = $this->BonDeCommande_model->getBonCommmande(1);    

	    for ($i = 0; $i < count($data['boncommande']); $i++) {
	        $bdcid = $data['boncommande'][$i]['idboncommande'];
	        $data['boncommande'][$i]['detail'] = $this->DetailBonDeCommande_model->getDetailBonCommmande($bdcid);
	    }

		$this->load->view('Finance/Template/header');
		$this->load->view('Finance/Page/dashbord', $data);
		$this->load->view('Finance/Template/footer');
	}

}
