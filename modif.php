if ($action=='modifUser' && isset($_POST['login'],$_POST['mdp']) && !empty($_POST['login'] && $_POST['mdp']))
 {
$login=$_POST['login'];
$mdp=$_POST['mdp'];
$id_user=intval($_SESSION['id_user']);

$req="SELECT * FROM utilisateur where login=:login AND id_user!=:id_user";
$donnees=$bd->prepare($req);

$donnees->bindParam('login',$login);
$donnees->bindParam('id_user',$id_user);
//var_dump($id_user);
$donnees->execute();

$verifEtudiant=$donnees->fetchObject();
if ($verifEtudiant!=false)//(== la requete a retouner une valeur true donc le pseudo modifié exite deja en base de données ==> donc pas de modification)
  {
    $erreure="-1";
    header('location:user.php?erreure='.$erreure);

  }
  else
  {
    $req="UPDATE  utilisateur SET login=:login,mdp=:mdp WHERE id_user=:id_user";
    $enregistrer=$bd->prepare($req);
    $enregistrer->bindParam('login',$login);
    $enregistrer->bindParam('mdp',$mdp);
    $enregistrer->bindParam('id_user',$id_user);
    $enregistrer->execute();
    $verifLogin=$enregistrer->execute();

    if ($verifLogin=='true') {
      $_SESSION['login']=$login;
    }

    $erreure="1";
  header('location:user.php?erreure='.$erreure);
   }

}
