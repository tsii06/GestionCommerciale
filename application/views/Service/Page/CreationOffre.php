    <div class="col-md-10 col-lg-8 mx-auto mt-4">
        <div class="project-card-no-image" style="border-top-color: gray;">
            <h3>Nouveau Besoin</h3>
        <form method="post" action="<?php echo site_url("ViewService/demandeBesoinProcess")  ?>" >
                <div class="mb-4">
                    <label for="poste">Produit</label>
                    <select class="form-control" name="produit">
                        <?php for ($i=0; $i < count($produit); $i++) { ?>                                
                        <option value="<?php echo $produit[$i]['idproduit'] ?>"><?php echo $produit[$i]['nomproduit'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="poste">Quantite</label>
                    <input type="number" name="quantite" class="form-control">
                </div>
                <div class="mb-4">
					<label for="lieu">Date de demande</label>
					<input type="date" name="datedemande" class="form-control">
                </div>
                <div class="mb-4">
                    <label for="lieu">Date d'expiration</label>
                    <input type="date" name="dateexpiration" class="form-control">
                </div>

            <div style="overflow:auto;" class="mb-4">
                <button  class="btn btn-primary" style="float:right;">Valider</button>
            </div>
        </div>
    </div>
     
            
        </form>
    </section>
</body>

</html>
