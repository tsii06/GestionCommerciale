<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewDepartement extends CI_Controller {

	public function listeBesoin(){
		$this->load->model('BesoinModel');

		$idDep = $_SESSION['departement'];

		$data['listeBesoin'] = $this->BesoinModel->getAllBesoinAttenteByDepartement($idDep);

		$this->load->view('Departement/Template/header');
        $this->load->view('Departement/Page/listeBesoin',$data);
        $this->load->view('Departement/Template/footer');
	}

	public function accepterBesoin(){
		$this->load->model('BesoinModel');

		$idBesoin = $this->input->get('besoin');

		$this->BesoinModel->accepteBesoinDep($idBesoin);
		redirect('ViewDepartement/listeBesoin');
	}


}
?>
