<?php if(!isset($_POST['idproduit'])){ ?>
<p>
    Voulez vous vraiment supprimer <?php echo $nomproduit['description'] ?> ?
    <form method="POST">
        <input type="submit" name="oui" value="oui">
        <a href="index.php?uc=administrer&action=liste_categorie"><input type="button" name="non" value="non"></a>
        <input type="hidden" name="idproduit" value="<?php echo $idproduit ?>">
    </form>
</p>
<?php } ?>