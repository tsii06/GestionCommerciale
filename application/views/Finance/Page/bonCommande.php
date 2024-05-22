
<?php 
	// include('D:\UwAmp\www\Gestion_Commerciale\application\models\ChiffresEnLettres.php');

include('C:\wamp64\www\Gestion_Commerciale\application\models\ChiffresEnLettres.php');

	$lettre = new ChiffreEnLettre();
?>
<main role="main" class="container" class="main-content" style="margin-bottom: 50px;">
	<div class="card shadow " style="border-top-color: gray; margin-top: 25px" >
		<h3 class="text-center p-4">Bon de Commande</h3>
		<div class="card-body p-5">
			<small class="small text-muted text-uppercase"><?= $lettre->formatterDateEnLettres($boncommande['dateboncommande'])?></small><br />
			<small class="small text-muted text-uppercase">N° Bon de Commande : <?= $boncommande['idboncommande']?></small><br /><br>
			<p>
				<small class="small text-muted text-uppercase">Company Codex</small><br />
				<small class="small text-muted text-uppercase">Andoharanofotsy</small><br />
				<small class="small text-muted text-uppercase">Antananarivo 102</small><br>
				<small class="small text-muted text-uppercase">NIF:  102150234535131</small><br>
				<small class="small text-muted text-uppercase">STAT:  565120321846313</small><br><br>
			</p>
			<p>
				<small class="small text-muted text-uppercase">Fournisseur : <?= $boncommande['nom']?></small><br />
				<small class="small text-muted text-uppercase">Adresse : <?= $boncommande['adresse']?></small><br />
				<small class="small text-muted text-uppercase">Contact : <?= $boncommande['contact']?></small><br />
				<small class="small text-muted text-uppercase">Email : <?= $boncommande['email']?></small><br />
			</p>

			<table class="table table-borderless table-striped">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col" class="text-right">Designation</th>
						<th scope="col" class="text-right">Quantite</th>
						<th scope="col" class="text-right">unite</th>
						<th scope="col" class="text-right">Prix Unitaire HT</th>
						<th scope="col" class="text-right">Prix Unitaire TVA</th>
						<th scope="col" class="text-right">Prix Unitaire TTC</th>
						<th scope="col" class="text-right">Total</th>
					</tr>
				</thead>
				<tbody>
					<?php					
					$total = 0;
					$totalHT = 0;
					$totalTVA = 0; 
					for ($j=0; $j < count($boncommande['detail']); $j++) { 
					?>
					<tr>
						<th scope="row">1</th>
						<td class="text-right"><?=$boncommande['detail'][$j]['nomproduit'] ?></td>
						<td class="text-right"><?=$qte=$boncommande['detail'][$j]['quantite'] ?></td>
						<td class="text-right"><?=$boncommande['detail'][$j]['unite'] ?></td>
						<td class="text-right"><?=number_format($ht=$boncommande['detail'][$j]['prixunitaire'], 0, ',', ' ').',00'; $totalHT+=($ht*$qte) ?></td>
						<td class="text-right"><?php
							if($boncommande['detail'][$j]['tva'] == 1) {
								echo number_format($tva=(($boncommande['detail'][$j]['prixunitaire']*20)/100), 0, ',', ' ').',00'; 
								$totalTVA+=($tva*$qte); 
							} else {
								$tva = 0;
								echo "0,00";
							}
						?></td>
						<td class="text-right"><?=number_format($ttc=$boncommande['detail'][$j]['prixunitaire']+$tva, 0, ',', ' ').',00' ?></td>
						<td class="text-right"><?=number_format($ttc*$qte, 0, ',', ' ').',00'; $total+=$ttc*$qte ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<div class="row mt-5">
				<div class="col-2 text-center">
				</div>
				<div class="col-md-5">
				</div>
				<div class="col-md-5">
					<div class="text-right mr-2">
						<p class="mb-2 h6">
							<span class="text-muted">Total HT : </span>
							<strong><?=number_format($totalHT, 0, ',', ' ').',00 MGA' ?></strong>
						</p>
						<p class="mb-2 h6">
							<span class="text-muted">Total TVA : </span>
							<strong><?=number_format($totalTVA, 0, ',', ' ').',00 MGA' ?></strong>
						</p>
						<p class="mb-2 h6">
							<span class="text-muted">Total à payer : </span>
							<strong><?=number_format($total, 0, ',', ' ').',00 MGA' ?></strong>
						</p>
					</div>
				</div>
				<div class="mt-4">
						<p><strong>Arrêtez à la somme de </strong><?=$lettre->Conversion($total); ?> Ariary</p>
				</div>
			</div> 
		</div> 
	</div> 
		<a href="<?php echo site_url("ViewAchat/EnvoiBonCommande");?>"><button class="btn btn-primary" style="margin-top: 30px; float">Valider</button></a>
</main>

