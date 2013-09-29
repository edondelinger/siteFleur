<?php
if(isset($_REQUEST['action'])){
    $action = $_REQUEST['action'];
}else{
    $action='connexion';
}

// si on est pas connecté, on redirige sur la connexion
if (!estConnecter()){
	$action='connexion';
}else{
	if ($action == 'connexion'){
		$action = 'liste_categorie';
	}
}


switch($action)
{
    case 'connexion':
    {
        if(isset($_POST['pseudo']) && isset($_POST['mdp'])){
                $pseudo = $_POST['pseudo'];
                $mdp = $_POST['mdp'];
                $resu = $pdo->testLogAdmin($pseudo, $mdp);
                if($resu[0]== 0){
                    include('vues/v_connexion.php');
                }else{
                    $_SESSION['login'] = $_POST['pseudo'];
                    header("location: index.php?uc=administrer&action=liste_categorie");

                }
                echo 'connexion en cours...';
        }else{
                include("vues/v_connexion.php");
        }
        break;
    }

    case 'liste_categorie':
    {
        $lesCategories = $pdo->getLesCategories();
        include("vues/v_adminCat.php");
        break;
    }

    case 'liste_produit':
    {
        $lesCategories = $pdo->getLesCategories();
        include("vues/v_adminCat.php");
        $categorie = $_REQUEST['categorie'];
        $lesProduits = $pdo->getLesProduitsDeCategorie($categorie);
        include("vues/v_adminProduit.php");
        break;
    }

    case 'ajout_produit':
    {
        $lesCategories = $pdo->getLesCategories();
        include("vues/v_adminCat.php");
        include("vues/v_ajoutProd.php");
        if(isset($_POST["valider"])){
                $categorie = $_POST['categorie'];
                $description = $_POST['description'];
                $prix = $_POST['prix'];
                $image = $_POST['image'];
                $pdo->ajoutproduit($categorie, $description, $prix, $image);
        }
        break;
    }

    case 'modif_produit':
    {
            $lesCategories = $pdo->getLesCategories();
            include("vues/v_adminCat.php");
            $lesCategories = $pdo->getLesCategorie();
            $idproduit = $_GET['idproduit'];
            $nomproduit = $pdo->getNomProduit($idproduit);
            if(isset($_POST['valider'])){
                $id = $_POST['idproduit'];
                $desc = $_POST['description'];
                $prix = $_POST['prix'];
                $cat = $_POST['categorie'];
                $pdo -> modifierProduit($id, $desc, $prix, $cat);
            }
            include("vues/v_modifProd.php");
        break;
    }

    case 'suppr_produit':
    {
            $lesCategories = $pdo->getLesCategories();
            include("vues/v_adminCat.php");
            $idproduit = $_GET['idproduit'];
            $nomproduit = $pdo->getNomProduit($idproduit);

            if(isset($_POST['idproduit'])){
                $id = $_POST['idproduit'];
                $pdo->supprProduit($id);
            }
            include("vues/v_supprProd.php");
        break;
    }

    case 'deconnexion':
    {
        seDeconnecter();
    }
}
?>