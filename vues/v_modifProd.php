<?php if(!isset($_POST['idproduit'])){ ?>
<form name="ajoutproduit" method="POST"">
    <fieldset>
        <legend>Modifier le produit : <?php echo $nomproduit['description']?></legend>
        <p>
            <label for="description">Description :</label>
            <input id="description" type="text" name="description" size="30" maxlength="45" value="<?php echo $nomproduit['description'] ?>">
        </p>
        <p>
            <label for="prix">Prix produit :</label>
            <input id="prix" type="text" name="prix" size="30" maxlength="45" value="<?php echo $nomproduit['prix'] ?>">
        </p>
        <p>
            <label for="prix">Catégorie</label>
            <select name="categorie">
                <?php
                foreach($lesCategories as $uneCategorie)
                {
                    $categorie = $uneCategorie['idCategorie'];
                    if($categorie != $nomproduit['idCategorie']){ /* Selectionne par defaut la catégorie du produit */
                        echo '<option value="'.$categorie.'">'.$categorie.'</option>';
                    }else{
                        echo '<option selected="'.$categorie.'" value="'.$categorie.'">'.$categorie.'</option>';
                    }
                }
                ?>

            </select>
        </p>
        <p>
            <input type="hidden" name="idproduit" value="<?php echo $idproduit ?>">
            <input type="submit" value="Valider" name="valider">
            <input type="reset" value="Annuler" name="annuler">
        </p>
    </fieldset>
</form>
<?php } ?>