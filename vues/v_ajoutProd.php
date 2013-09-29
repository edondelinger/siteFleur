<form name="ajoutproduit" method="POST" action="index.php?uc=administrer&action=ajout_produit&categorie=<?php echo $_GET['categorie']?>">
    <fieldset>
        <legend>Ajout produit dans la catégorie "<?php echo $_GET['categorie']?>"</legend>
        <p>
            <label for="description">Description :</label>
            <input id="description" type="text" name="description" size="30" maxlength="45">
        </p>
        <p>
            <label for="prix">Prix produit :</label>
            <input id="prix" type="text" name="prix" size="30" maxlength="45">
        </p>
            <input id="categorie" type="hidden" name="categorie" value="<?php echo $_GET['categorie'] ?>">
            <input id="image" type="hidden" name="image" value="images/nondisponible.gif">
        <p>
            <input type="submit" value="Valider" name="valider">
            <input type="reset" value="Annuler" name="annuler">
        </p>
</form>