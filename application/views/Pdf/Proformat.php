<div style="border-top: 1px solid gray; margin-top: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <div style="padding: 20px;">
        <div style="margin-bottom: 30px; text-align: center;">
            <h2 style="margin: 0; text-transform: uppercase;">Facture Proforma</h2>
            <h2 style="margin: 0; text-transform: uppercase;"><?php echo $proformat['nom']; ?></h2>
        </div>
        <div style="margin-right: auto; margin-left: auto; max-width: 70%;">
            <p style="margin-bottom: 20px;">
                <strong>Information Fournisseur</strong><br /> <?php echo $proformat['adresse']; ?><br /> <?php echo $proformat['contact']; ?><br /> <?php echo $proformat['email']; ?><br />
            </p>
        </div>
        <table style="width: 100%; border-collapse: collapse; border: 1px solid #000; margin-bottom: 20px;">
            <thead>
                <tr style="background-color: #f5f5f5;">
                    <th scope="col">#</th>
                    <th scope="col" style="text-align: right;">Produit</th>
                    <th scope="col" style="text-align: right;">Quantite</th>
                    <th scope="col" style="text-align: right;">Unite</th>
                    <th scope="col" style="text-align: right;">Prix Unitaire</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($j = 0; $j < count($proformat['detail']); $j++) { ?>
                    <tr>
                        <td style="border: 1px solid #000;"></td>
                        <td style="text-align: right; border: 1px solid #000;"><?php echo $proformat['detail'][$j]['nomproduit']; ?></td>
                        <?php if ($proformat['detail'][$j]['sum'] < $proformat['detail'][$j]['quantitestock']) { ?>
                            <td style="text-align: right; border: 1px solid #000;"><?php echo $proformat['detail'][$j]['sum']; ?></td>
                        <?php } else { ?>
                            <td style="text-align: right; border: 1px solid #000; color: red;"><?php echo $proformat['detail'][$j]['quantitestock']; ?></td>
                        <?php } ?>
                        <td style="text-align: right; border: 1px solid #000;"><?php echo $proformat['detail'][$j]['unite']; ?></td>
                        <td style="text-align: right; border: 1px solid #000;"><?php echo $proformat['detail'][$j]['prixunitaire']; ?> MGA</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
