<?php
require('connexion.php');
$bd=connect();
include('session.php');

if (isset($_GET['suprimEtudiant'],$_GET['cni']) && !empty($_GET['suprimEtudiant'] && $_GET['cni'])) {
  $id_etudiant=$_GET['suprimEtudiant'];
  $cni_etudiant=$_GET['cni'];
  $classe=$_GET['classe'];
  $req="DELETE FROM `etudiant` WHERE id_etudiant=:id_etudiant AND cni_etudiant=:cni_etudiant";
  $enregistrer=$bd->prepare($req);
  $enregistrer->bindParam('id_etudiant',$id_etudiant);
  $enregistrer->bindParam('cni_etudiant',$cni_etudiant);
  $enregistrer->execute();
  header('location:listEtudiant.php?classe='.$classe);
}

if (isset($_GET['suprimProfesseur'],$_GET['cni']) && !empty($_GET['suprimProfesseur'] && $_GET['cni'])) {
  $id_prof=$_GET['suprimProfesseur'];
  $cni_prof=$_GET['cni'];
  $classe=$_GET['classe'];
  $req="DELETE FROM `professeur` WHERE id_prof=:id_prof AND cni_prof=:cni_prof";
  $enregistrer=$bd->prepare($req);
  $enregistrer->bindParam('id_prof',$id_prof);
  $enregistrer->bindParam('cni_prof',$cni_prof);
  $enregistrer->execute();
  header('location:listProfesseur.php?classe='.$classe);
}


if (isset($_GET['suprimUser']) && !empty($_GET['suprimUser'])) {
  $id_user=$_GET['suprimUser'];
  $req="DELETE FROM `utilisateur` WHERE id_user=:id_user";
  $enregistrer=$bd->prepare($req);
  $enregistrer->bindParam('id_user',$id_user);
  $enregistrer->execute();
  header('location:listUser.php');
}

if (isset($_GET['suprimInfo']) && !empty($_GET['suprimInfo'])) {
  $id_info=$_GET['suprimInfo'];
  $req="DELETE FROM `infos` WHERE id_info=:id_info";
  $enregistrer=$bd->prepare($req);
  $enregistrer->bindParam('id_info',$id_info);
  $enregistrer->execute();
  header('location:accueil.php');
}


?>
