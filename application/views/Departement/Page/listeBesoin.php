
<link href="<?php echo base_url("assets/css/modal.css");?>" rel="stylesheet">
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="display-6 fw-bold"><span class="underline">Liste Demande Besoins</span></h2>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-10">
                    <div>
						<div class="container-fluid">
							<div class="card shadow">
								<div class="card-body">
									<div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
										<?php if(count($listeBesoin) != 0) { ?>
										<table class="table my-0 " id="dataTable">
											<thead>
												<tr>
													<th>Serivce</th>
													<th>Produit</th>
													<th>Quantite</th>

												</tr>
											</thead>
											<tbody>
												<?php for ($i=0; $i < count($listeBesoin); $i++) { ?>   
												<tr>
													<td><?php echo $listeBesoin[$i]['nomservice'] ?></td>
													<td><?php echo $listeBesoin[$i]['nomproduit'] ?></td>
													<td><?php echo $listeBesoin[$i]['quantite'] ?></td>
													<td>
														<a href="<?php echo site_url("ViewDepartement/accepterBesoin")."?besoin=".$listeBesoin[$i]['idbesoin'] ;  ?>">
															<button class="btn btn-primary">Valider</button>
														</a>
													</td>

												</tr>
												<?php } ?>
											</tbody>
										</table>
										<?php } else { ?>
											<h4 class="text-center text-info">Aucun demande de besoin pour le moment</h4>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

