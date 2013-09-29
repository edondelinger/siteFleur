<div id="produits">
<?php
	
foreach( $lesProduits as $unProduit) 
{
	$id = $unProduit['id'];
	$description = $unProduit['description'];
	$prix=$unProduit['prix'];
	$image = $unProduit['image'];
	?>	
	<ul>
			<li><img src="<?php echo $image ?>" alt=image /></li>
			<li><?php echo $description ?></li>
            <form method="GET" name="FRM<?php echo $id;?>" action="index.php">
                <select name="quantite">
                    <?php
                        for($i=1; $i<=10; $i++){
                            echo "<option value='".$i."'>$i</option>";
                        }
                    ?>
                </select>
                <INPUT type="hidden" name ="uc" value = "voirProduits"/>
                <INPUT type="hidden" name ="categorie" value = "<?php echo $categorie; ?>">
                <INPUT type="hidden" name ="produit" value = "<?php echo $id ;?>">
                <INPUT type="hidden" name ="action" value = "ajouterAuPanier">

                <li><?php echo " : ".$prix." Euros" ?></li>
                <li>
                    <input type="submit" name="ajouterpanier" value="Ajouter au panier">
                </li>
            </form>

	</ul>
			
			
			
<?php			
}
?>
</div>
