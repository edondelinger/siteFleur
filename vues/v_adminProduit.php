<div id="produits">
       <a class="boutonAdd" href="index.php?uc=administrer&action=ajout_produit&categorie=<?php echo $categorie ?> "> + Ajouter produit dans cette catégorie</a>

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
            <li><?php echo " : ".$prix." Euros" ?></li>

        </ul>
        <p class="button"><a  href="index.php?uc=administrer&action=modif_produit&idproduit=<?php echo $id ?>">Modifier ce produit</a></p>
        <p class="button"><a  href="index.php?uc=administrer&action=suppr_produit&idproduit=<?php echo $id ?>">Supprimer ce produit</a></p>


    <?php
    }
    ?>
</div>