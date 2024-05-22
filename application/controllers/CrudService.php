<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudService extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function loginService(){
		$this->load->model('ServiceModel');

		$mdp = $this->input->post('servicePassword');
		$idservice = $this->input->post('service');

		$auth = $this->ServiceModel->checkLogin($idservice,$mdp);
		var_dump($auth);
		if ($auth['logged']==1) {
			$this->session->set_userdata('service', $idservice);
			redirect('ViewService/demandeBesoin');

		} else {
			redirect('welcome');
		}
	}

	public function financeLogin(){
		redirect('ViewFinance/dashboard');
	}
	public function achatLogin(){
		redirect('ViewAchat/listeBesoin');
	}
	public function DGLogin(){
		redirect('ViewDG/listeBonCommande');
	}
	public function departementLogin(){
		$this->load->model('DepartementModel');

		$email = $this->input->post('email');
		$mdp = $this->input->post('mdpDepartement');
		// $idservice = $this->input->post('service');

		$auth = $this->DepartementModel->checkLogin($email,$mdp);
		var_dump($auth);
		if (count($auth)==1) {
			$this->session->set_userdata('departement', $auth['iddepartement']);
			redirect('ViewDepartement/listeBesoin');

		} else {
			redirect('welcome');
		}


		// redirect('ViewDepartement/listeBesoin');
	}


}
?>
