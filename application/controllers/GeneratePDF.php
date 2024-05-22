<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('C:\wamp64\www\Gestion_Commerciale\application\models\ChiffresEnLettres.php');
// include('D:\UwAmp\www\Gestion_Commerciale\application\models\ChiffresEnLettres.php');

require_once APPPATH . 'models/fpdf.php';

class GeneratePDF extends CI_Controller {

    public function genererPDF($id) {
		$lettre = new ChiffreEnLettre();
		$this->load->model('BonDeCommande_model');
		$this->load->model('DetailBonDeCommande_model');
		
	    $boncommande = $this->BonDeCommande_model->getBonCommmandeById($id)[0];    

		$bdcid = $boncommande['idboncommande'];
		$boncommande['detail'] = $this->DetailBonDeCommande_model->getDetailBonCommmande($bdcid);
		$datebdc = $lettre->formatterDateEnLettres($boncommande['dateboncommande']);

		// Instancier la classe FPDF
		$pdf = new FPDF('P', 'mm', 'A4');
		$pdf->AddPage();

		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(0, 6, $datebdc, 0, 1);
		$pdf->Cell(0, 6, 'N BON DE COMMANDE : '.$boncommande['idboncommande'], 0, 1);
		$pdf->Ln(8); // Saut de ligne

		// Informations de l'entreprise
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(0, 6, 'COMPANY CODEX', 0, 1);
		$pdf->Cell(0, 6, 'ANDOHARANOFOTSY', 0, 1);
		$pdf->Cell(0, 6, 'ANTANANARIVO 102', 0, 1);
		$pdf->Cell(0, 6, 'NIF: 102150234535131', 0, 1);
		$pdf->Cell(0, 6, 'STAT: 565120321846313', 0, 1);
		$pdf->Ln(8); // Saut de ligne
		
		// Titre du bon de commande
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 10, 'Bon de Commande', 0, 1, 'C');
		$pdf->Ln(8); // Saut de ligne

		// Informations du fournisseur
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 6, 'Informations du Fournisseur', 0, 1);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(0, 6, 'FOURNISSEUR : '.$boncommande['nom'], 0, 1);
		$pdf->Cell(0, 6, 'ADRESSE : '.$boncommande['adresse'], 0, 1);
		$pdf->Cell(0, 6, 'CONTACT : '.$boncommande['contact'], 0, 1);
		$pdf->Cell(0, 6, 'EMAIL : '.$boncommande['email'], 0, 1);
		$pdf->Ln(8); // Saut de ligne

		// Tableau de liste de commandes
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 8, '#', 1);
		$pdf->Cell(30, 8, 'Designation', 1);
		$pdf->Cell(15, 8, 'Qte', 1);
		$pdf->Cell(15, 8, 'Unite', 1);
		$pdf->Cell(30, 8, 'P.U HT', 1);
		$pdf->Cell(25, 8, 'P.U TVA', 1);
		$pdf->Cell(30, 8, 'P.U TTC', 1);
		$pdf->Cell(40, 8, 'TOTAL', 1);
		$pdf->Ln();

		$pdf->SetFont('Arial', '', 12);
		$i = 1;	
		$total = 0;
		$totalHT = 0;
		$totalTVA = 0; 
		foreach($boncommande['detail'] as $detail) {
			$pdf->Cell(10, 8, $i, 1);
			$pdf->Cell(30, 8, $detail['nomproduit'], 1);
			$qte = $detail['quantite'];
			$pdf->Cell(15, 8, $qte, 1, 0, 'R');
			$pdf->Cell(15, 8, $detail['unite'], 1);
			$ht = $detail['prixunitaire'];
			$pdf->Cell(30, 8, number_format($ht, 0, ',', ' ').',00', 1, 0, 'R');
			$totalHT+=($ht*$qte);
			if($detail['tva'] == 1) {
				$tva=(($detail['prixunitaire']*20)/100);
				$pdf->Cell(25, 8, number_format($tva, 0, ',', ' ').',00', 1, 0, 'R');
				$totalTVA+=($tva*$qte); 
			} else {
				$tva=0;
				$pdf->Cell(25, 8, number_format($tva, 0, ',', ' ').',00', 1, 0, 'R');
			}
			$ttc=$detail['prixunitaire']+$tva;
			$pdf->Cell(30, 8, number_format($ttc, 0, ',', ' ').',00', 1, 0, 'R');
			$total+=$ttc*$qte;
			$pdf->Cell(40, 8, number_format($total, 0, ',', ' ').',00', 1, 0, 'R');

			$pdf->Ln();
			$i+=1;
		}

		$pdf->Ln(8); // Saut de ligne
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(0, 6, 'Total HT : '.number_format($totalHT, 0, ',', ' ').',00', 0, 1, 'R');
		$pdf->Cell(0, 6, 'Total TVA : '.number_format($totalTVA, 0, ',', ' ').',00', 0, 1, 'R');
		$pdf->Cell(0, 6, 'Total a payer  : '.number_format($total, 0, ',', ' ').',00', 0, 1, 'R');
		
		$pdf->Ln(15); // Saut de ligne
		$pdf->Cell(0, 6, 'Arretez la presente bon de commande a la somme de : '.$lettre->Conversion($total).' Ariary', 0, 1, 'C');
			
		
		$pdf->Ln(20); // Saut de ligne
        // Premier texte aligné à gauche
		$pdf->Cell(10, 10, ' ', 0, 0);
        $pdf->Cell(70, 10, 'Signature DG', 0, 0);

        // Ajouter un espace
        $pdf->Cell(30, 10, '', 0, 0);

        // Deuxième texte aligné à droite
        $pdf->Cell(70, 10, 'Le Fournisseur', 0, 1, 'R');
		$pdf->Cell(10, 0, ' ', 0, 1);

		$pdf->Cell(10, 10, ' ', 0, 0);
        $pdf->Cell(70, 10, ' ', 0, 0);

        // Ajouter un espace
        $pdf->Cell(30, 10, '', 0, 0);
		$pdf->Cell(70, 6, $boncommande['nom'], 0, 1, 'R');
		$pdf->Cell(10, 0, ' ', 0, 1);

		// Nom du fichier PDF de sortie
		$nom_fichier = 'BonCommande'.$boncommande['idboncommande'].'.pdf';

		// Sortie du PDF au navigateur
		$pdf->Output($nom_fichier, 'I');
    }
}
