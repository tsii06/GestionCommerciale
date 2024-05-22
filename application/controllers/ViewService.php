<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewService extends CI_Controller {

	public function listeBesoin() {
		$this->load->model('BesoinModel');

		$idservice = $_SESSION['service'];

		$data['listeBesoin'] = $this->BesoinModel->getAllBesoinAttente($idservice);
		 
		$this->load->view('Service/Template/header');
		$this->load->view('Service/Page/listeBesoin',$data);
		$this->load->view('Service/Template/footer');
	}

	public function demandeBesoin(){
		$this->load->model('ProduitModel');
		$data['produit'] = $this->ProduitModel->getAll();

		// var_dump($data);
		$this->load->view('Service/Template/header');
        $this->load->view('Service/Page/CreationOffre',$data);
        $this->load->view('Service/Template/footer');
	}

	public function demandeBesoinProcess() {
		$idproduit = $this->input->post('produit');
		$quantite = $this->input->post('quantite');
		$datedemande = $this->input->post('datedemande');
		$dateexpiration = $this->input->post('dateexpiration');

		$idservice = $_SESSION['service'];

		$this->load->model('BesoinModel');
		$this->BesoinModel->insert($idproduit,$idservice,$quantite,$datedemande,$dateexpiration);

		redirect('ViewService/listeBesoin');

	}

}
