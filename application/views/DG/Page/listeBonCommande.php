<?php 
	$valTotal = 0;
 ?>
 <main class="container" style="height: 70vh; margin-top: 30px" role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">

              <div class="row">
                <!-- Recent orders -->
                <div class="col-md-12">
                  <h6 class="mb-3">Bon de Commande en attende</h6>
                  <table class="table table-borderless table-striped">
                    <thead>
                      <tr role="row">
                        <th>ID</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Type Payement</th>
                        <th>Fournisseur</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
											<?php 
											for ($i=0; $i < count($boncommande); $i++) { 
												$total = 0;
												for ($j=0; $j < count($boncommande[$i]['detail']); $j++) { 
													$qte=$boncommande[$i]['detail'][$j]['quantite'];
													$tva=(($boncommande[$i]['detail'][$j]['prixunitaire']*20)/100);
													$ttc=$boncommande[$i]['detail'][$j]['prixunitaire']+$tva;
													$total+=$ttc*$qte;
												}
												$valTotal+=$total;
											?>
                      <tr>
                        <th scope="col"><?=$boncommande[$i]['idboncommande'] ?></th>
                        <td><?=$boncommande[$i]['dateboncommande'] ?></td>
                        <td><?=number_format($total, 0, ',', ' ').',00 MGA' ?></td>
                        <td><?=$boncommande[$i]['typepayement'] ?></td>
                        <td><?=$boncommande[$i]['nom'] ?></td>
                        <td>
													<a href="<?php echo site_url("ViewDG/detailCommande/".$boncommande[$i]['idboncommande']);?>"><button class="btn btn-primary">Details</button></a>
													<?php if($boncommande[$i]['etat'] == 2) { ?>
														<a href="<?php echo site_url("ViewDG/Signer/".$boncommande[$i]['idboncommande']);?>"><button class="btn btn-success">Signer</button></a>
													<?php } ?>
												</td>
                      </tr>
											<?php } ?>
                    </tbody>
                  </table>
								</div>
							</div>

						</div>
				</div>
      </main> <!-- main -->
