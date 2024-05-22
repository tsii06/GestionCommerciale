      <main role="main" class="container" class="main-content" style="margin-bottom: 50px;">

        <?php for ($i=0; $i < count($proformat); $i++) { 
          if(!empty($proformat[$i]['detail'])){
         ?>

      	<div class="card shadow " style="border-top-color: gray; margin-top: 10px" >

                <div class="card-body p-5" >
                  <div class="row mb-5">
                    <div class="col-12 text-center mb-4">
                      <h2 class="mb-0 text-uppercase">Facture Proforma</h2>
                      <h2 class="mb-0 text-uppercase"><?php echo $proformat[$i]['nom']; ?></h2>
                    </div>
                    <div class="col-md-7">
                      <p class="mb-4">
                        <strong>Information Fournisseur</strong><br /> <?php echo $proformat[$i]['adresse']; ?><br /> <?php echo $proformat[$i]['contact']; ?> <br /> <?php echo $proformat[$i]['email']; ?><br /> 
                      </p>
                    </div>
                  </div> <!-- /.row -->
                  <table class="table table-borderless table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-right">Produit</th>
                        <th scope="col" class="text-right">Quantite</th>
                        <th scope="col" class="text-right">Unite</th>
                        <th scope="col" class="text-right">Prix Unitaire</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?php for ($j=0; $j< count($proformat[$i]['detail']); $j++) {  ?>
                      <tr>
                        <th scope="row"></th>
                        <td class="text-right"><?php echo $proformat[$i]['detail'][$j]['nomproduit']; ?></td>
                        <?php if ($proformat[$i]['detail'][$j]['sum']<$proformat[$i]['detail'][$j]['quantitestock']) {?>
                        <td class="text-right"><?php echo $proformat[$i]['detail'][$j]['sum']; ?></td>
                        <?php } else{  ?>
                        <td class="text-right" style="color: red"><?php echo $proformat[$i]['detail'][$j]['quantitestock']; ?></td><?php 
                        } ?>
                        <td class="text-right"><?php echo $proformat[$i]['detail'][$j]['unite']; ?></td>
                        <td class="text-right"><?php echo $proformat[$i]['detail'][$j]['prixunitaire']; ?></td>
                      </tr>
                        <?php } ?>
                     
                    </tbody>
                  </table>
                  <a href="<?php echo site_url("Pdf/proformat/".$proformat[$i]['idfournisseur']);?>"><button class="btn btn-primary" style="margin-top: 30px; float">Generer PDF</button></a>

                  </div> 

                </div> 

               
            </div> 
    <?php } }?>
 <a href="<?php echo site_url("ViewAchat/BonCommande");?>"><button class="btn btn-primary" style="margin-top: 30px; float">Generer Bon de Commande</button></a>        
      </main>
