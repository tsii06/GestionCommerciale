 <?php 
	$valTotal = 0;
 ?>
 <main class="container" style="height: 70vh; margin-top: 30px" role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="row">
                <div class="col-md-6 col-xl-4 mb-4">
                  <div class="card shadow border-0">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-3 text-center">
                          <span class="circle circle-sm bg-primary-light">
                            <i class="fe fe-16 fe-shopping-bag text-white mb-0"></i>
                          </span>
                        </div>
                        <div class="col pr-0">
                          <p class="small text-muted mb-0">Capital</p>
                          <span class="h3 mb-0">82 500 000,00 MGA</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
  
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
													<a href="<?php echo site_url("ViewFinance/detailCommande/".$boncommande[$i]['idboncommande']);?>"><button class="btn btn-primary">Details</button></a>
													<a href="<?php echo site_url("ViewFinance/ValiderCommande/".$boncommande[$i]['idboncommande']);?>"><button class="btn btn-success">Valider</button></a>
												</td>
                      </tr>
											<?php } ?>
                    </tbody>
                  </table>
								</div>
							</div>
							<div class="col-md-6 col-xl-4 mt-4">
                  <div class="card shadow border-0">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-3 text-center">
                          <span class="circle circle-sm bg-primary">
                            <i class="fe fe-16 fe-shopping-cart text-white mb-0"></i>
                          </span>
                        </div>
                        <div class="col pr-0">
                          <p class="small text-muted mb-0">Valeur Total Commande</p>
                          <span class="h3 mb-0"><?=number_format($valTotal, 0, ',', ' ').',00 MGA' ?></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
      </main> <!-- main -->
