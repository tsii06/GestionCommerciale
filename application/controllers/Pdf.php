<?php
require_once(APPPATH . 'third_party/tcpdf.php');

class Pdf extends CI_Controller {
    public function proformat($idFournisseur) {
		
		date_default_timezone_set('Indian/Antananarivo');
        
        $this->load->model('ProformatModel');
        $this->load->model('FournisseurModel');
        $data = array();
        $data['proformat'] = $this->FournisseurModel->getFournisseur($idFournisseur);    
        $data['proformat']['detail'] = $this->ProformatModel->getProformat($idFournisseur);
        
        // Créez une instance de la classe TCPDF
        $pdf = new TCPDF();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);

        // Ajoutez une page
        $pdf->AddPage();

        // Incluez le fichier PHP que vous souhaitez convertir en PDF
        $html = $this->load->view('Pdf/Proformat', $data, true); // Charge la vue en tant que chaîne

        // Écrivez le contenu HTML dans le PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Générez le PDF et affichez-le ou enregistrez-le dans un fichier
        $pdf->Output('fiche_de_paie.pdf', 'I'); // 'I' signifie afficher le PDF, 'D' signifie enregistrer dans un fichier
    }
}
?>
