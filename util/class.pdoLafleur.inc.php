<?php
/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application lafleur
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 *
 * @package default
 * @author Patrice Grand
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoLafleur
{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=lafleur';   		
      	private static $user='root' ;    		
      	private static $mdp='' ;	
		private static $monPdo;
		private static $monPdoLafleur = null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct()
	{
    		PdoLafleur::$monPdo = new PDO(PdoLafleur::$serveur.';'.PdoLafleur::$bdd, PdoLafleur::$user, PdoLafleur::$mdp); 
			PdoLafleur::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoLafleur::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 *
 * Appel : $instancePdolafleur = PdoLafleur::getPdoLafleur();
 * @return l'unique objet de la classe PdoLafleur
 */
	public  static function getPdoLafleur()
	{
		if(PdoLafleur::$monPdoLafleur == null)
		{
			PdoLafleur::$monPdoLafleur= new PdoLafleur();
		}
		return PdoLafleur::$monPdoLafleur;  
	}
/**
 * Retourne toutes les catégories sous forme d'un tableau associatif
 *
 * @return le tableau associatif des catégories 
*/
	public function getLesCategories()
	{
		$req = "select * from categorie";
		$res = PdoLafleur::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

/**
 * Retourne sous forme d'un tableau associatif tous les produits de la
 * catégorie passée en argument
 * 
 * @param $idCategorie 
 * @return un tableau associatif  
*/

	public function getLesProduitsDeCategorie($idCategorie)
	{
	    $req="select * from produit where idCategorie = '$idCategorie'";
		$res = PdoLafleur::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
/**
 * Retourne les produits concernés par le tableau des idProduits passée en argument
 *
 * @param $desIdProduit tableau d'idProduits
 * @return un tableau associatif 
*/
	public function getLesProduitsDuTableau($desIdProduit)
	{
		$nbProduits = count($desIdProduit);
		$lesProduits=array();
		if($nbProduits != 0)
		{
			foreach($desIdProduit as $unIdProduit)
			{
				$req = "select * from produit where id = '$unIdProduit'";
				$res = PdoLafleur::$monPdo->query($req);
				$unProduit = $res->fetch();
				$lesProduits[] = $unProduit;
			}
		}
		return $lesProduits;
	}
/**
 * Crée une commande 
 *
 * Crée une commande à partir des arguments validés passés en paramètre, l'identifiant est
 * construit à partir du maximum existant ; crée les lignes de commandes dans la table contenir à partir du
 * tableau d'idProduit passé en paramètre
 * @param $nom 
 * @param $rue
 * @param $cp
 * @param $ville
 * @param $mail
 * @param $lesIdProduit
 
*/
	public function creerCommande($nom,$rue,$cp,$ville,$mail, $lesIdProduit)
	{
		$req = "select max(id) as maxi from commande";
		echo $req."<br>";
		$res = PdoLafleur::$monPdo->query($req);
		$laLigne = $res->fetch();
		$maxi = $laLigne['maxi'] ;
		$maxi++;
		$idCommande = $maxi;
		echo $idCommande."<br>";
		echo $maxi."<br>";
		$date = date('Y/m/d');
		$req = "insert into commande values ('$idCommande','$date','$nom','$rue','$cp','$ville','$mail')";
		echo $req."<br>";
		$res = PdoLafleur::$monPdo->exec($req);
		foreach($lesIdProduit as $unIdProduit)
		{
            $quantiteproduit=$_SESSION[$unIdProduit];
			$req = "insert into contenir values ('$idCommande','$unIdProduit','$quantiteproduit')";
			echo $req."<br>";
			$res = PdoLafleur::$monPdo->exec($req);
		}
		
	
	}

    /**
     * Verification du login et du mdp
     * Retourne 0 si pas trouvé, 1 si ok
     * @param $pseudo
     * @param $mdp
     */
    public function testLogAdmin($pseudo, $mdp){
        $req = "select count(*) from administrateur where nom = '$pseudo' and mdp = '$mdp'";
        /*var_dump($req);*/
        $res = PdoLafleur::$monPdo->query($req);
        $leResu = $res -> fetch();
        /*var_dump($leResu);*/
        return $leResu;
    }

/*
* Génère un id à partir de la première lettre de la catégorie et de la valeur max de l'id de la catégorie
*/
    public function newid($categorie){
        $premierelettrecat = substr($categorie, 0, 1);
        $req = "select max(id) from produit where id like '$premierelettrecat%'";
        $res = PdoLafleur::$monPdo->query($req);
        $leResu = $res -> fetch();
        $longueur = strlen($leResu[0])-1;
        $resu = substr($leResu[0], 1, $longueur);
        $resu++;
        $resu = $premierelettrecat.$resu;
        return $resu;
    }

/* Fonction ajout de produit
*
*/
    public function ajoutproduit($cat, $desc, $prix, $image){
        $newid = $this->newid($cat);
        $req = "insert into produit values ('$newid','$desc','$prix', '$image','$cat')";
        $res = PdoLafleur::$monPdo->exec($req);
        echo 'Produit ajouté';
    }

    /*
     * Renvoie le nom du produit correspondant à l'id
     */
    public function getNomProduit($id){
        $req="select description, prix, idCategorie from produit where id = '$id'";
        $res = PdoLafleur::$monPdo->query($req);
        $leproduit = $res->fetch();
        return $leproduit;
    }

    /*
     * Supprime le produit
     */
    public function supprProduit($id){
        $req = "delete from produit where id ='$id'";
        $res = PdoLafleur::$monPdo->exec($req);
        echo "Produit supprimé";
    }

    /*
     * Modifie le produit
     */
    public function modifierProduit($id, $desc, $prix, $cat){
        $newid = $this->newid($cat);
        $req = "UPDATE produit SET id='$newid', description='$desc',prix='$prix', idCategorie='$cat' where id='$id'";
        $res = PdoLafleur::$monPdo->exec($req);
        echo 'Produit modifié';
    }

    /*
     * Renvoie les catégorie
     */
    public function getLesCategorie(){
        $req="select DISTINCT idCategorie from produit";
        $res = PdoLafleur::$monPdo->query($req);
        $lescat = $res->fetchAll();
        return $lescat;
    }
}
?>