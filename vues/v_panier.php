<img src="images/panier.gif"	alt="Panier" title="panier"/>
<?php
$totalpanier = 0;
foreach( $lesProduitsDuPanier as $unProduit) 
{
	$id = $unProduit['id'];
	$description = $unProduit['description'];
	$image = $unProduit['image'];
	$prix = $unProduit['prix'];
	
	?>
    <p>
	<img src="<?php echo $image ?>" alt=image width=100	height=100 />
	<?php
        echo 'Quantité : '.$_SESSION[$id]. ' ';
		echo	$description."($prix Euros)";
        $total = $_SESSION[$id]*$prix;
        $totalpanier += $total;
        echo 'Total : '.$_SESSION[$id]*$prix;

	?>	
	<a href="index.php?uc=gererPanier&produit=<?php echo $id ?>&action=supprimerUnProduit" onclick="return confirm('Voulez-vous vraiment retirer cet article frais?');">
	<img src="images/retirerpanier.png" TITLE="Retirer du panier" ></a>
	
	
	</p>
	<?php
}
echo 'Total panier : '.$totalpanier;
?>
<br>
<a href=index.php?uc=gererPanier&action=passerCommande><img src="images/commander.jpg" TITLE="Passer commande" ></a>
