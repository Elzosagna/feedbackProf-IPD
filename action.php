<?php
require('connexion.php');
$bd=connect();
include('session.php');

if (isset($_POST['action']) && !empty($_POST['action'])) {
  $action=$_POST['action'];
  //var_dump($action);
}
else {
  header('location:accueil.php');
}


//modification d'utilisateur///////

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
      $_SESSION['mdp']=$mdp;
    }

    $erreure="1";
    //var_dump($mdp);
  header('location:user.php?erreure='.$erreure);
   }

}

//ajout Etudiant
if ($action=='newEtudiant' && isset($_POST['nom_etudiant'],$_POST['prenom_etudiant'],$_POST['date_naiss'],$_POST['lieu_naissance'],$_POST['cni_etudiant'],$_POST['classe_etudiant']) && !empty($_POST['nom_etudiant'] && $_POST['prenom_etudiant'] && $_POST['date_naiss'] && $_POST['lieu_naissance'] && $_POST['cni_etudiant'] && $_POST['classe_etudiant']))
 {

$nom_etudiant=$_POST['nom_etudiant'];
$prenom_etudiant=$_POST['prenom_etudiant'];
$date_naiss=$_POST['date_naiss'];
$lieu_naissance=$_POST['lieu_naissance'];
$cni_etudiant=$_POST['cni_etudiant'];
$classe_etudiant=intval($_POST['classe_etudiant']);
//ceil()

$req="SELECT * FROM etudiant where cni_etudiant=:cni_etudiant";

$donnees=$bd->prepare($req);
$donnees->bindParam('cni_etudiant',$cni_etudiant);
$donnees->execute();
$verifEtudiant=$donnees->fetchObject();
if ($verifEtudiant!=false)
  {
    $erreure="-1";
    header('location:newEtudiant.php?erreure='.$erreure);

  }
  else
  {
    $date_ins=date('y-m-d');

    $req="INSERT INTO etudiant (nom_etudiant,prenom_etudiant,date_naissance_et,lieu_naissance,cni_etudiant,id_classe,date_inscription) VALUES(:nom_etudiant,:prenom_etudiant,:date_naiss,:lieu_naissance,:cni_etudiant,:id_classe,:date_ins)";
    $enregistrer=$bd->prepare($req);
    $enregistrer->bindParam('nom_etudiant',$nom_etudiant);
    $enregistrer->bindParam('prenom_etudiant',$prenom_etudiant);
    $enregistrer->bindParam('date_naiss',$date_naiss);
    $enregistrer->bindParam('lieu_naissance',$lieu_naissance);
    $enregistrer->bindParam('cni_etudiant',$cni_etudiant);
    $enregistrer->bindParam('id_classe',$classe_etudiant);
    $enregistrer->bindParam('date_ins',$date_ins);
    $enregistrer->execute();
    $erreure="1";
    header('location:newEtudiant.php?erreure='.$erreure);

   }

}


//modif etudiant


if ($action=='modifEtudiant' && isset($_POST['nom_etudiant'],$_POST['prenom_etudiant'],$_POST['date_naiss'],$_POST['lieu_naissance'],$_POST['cni_etudiant'],$_POST['classe_etudiant']) && !empty($_POST['nom_etudiant'] && $_POST['prenom_etudiant'] && $_POST['date_naiss'] && $_POST['lieu_naissance'] && $_POST['cni_etudiant'] && $_POST['classe_etudiant']))
 {
$id_etudiant=$_POST['id_etudiant'];
$nom_etudiant=$_POST['nom_etudiant'];
$prenom_etudiant=$_POST['prenom_etudiant'];
$date_naiss=$_POST['date_naiss'];
$lieu_naissance=$_POST['lieu_naissance'];
$cni_etudiant=$_POST['cni_etudiant'];
$classe_etudiant=intval($_POST['classe_etudiant']);
//ceil()

$req="SELECT * FROM etudiant where cni_etudiant=:cni_etudiant AND id_etudiant!=:id_etudiant";

$donnees=$bd->prepare($req);
$donnees->bindParam('cni_etudiant',$cni_etudiant);
$donnees->bindParam('id_etudiant',$id_etudiant);
$donnees->execute();
$verifEtudiant=$donnees->fetchObject();
if ($verifEtudiant!=false)
  {
    $erreure="-1";
    header('location:modifEtudiant.php?Etudiant='.$id_etudiant.'&erreure='.$erreure);

  }
  else
  {

    $date_ins=date('y-m-d');


    $req="UPDATE  etudiant SET nom_etudiant=:nom_etudiant,prenom_etudiant=:prenom_etudiant,date_naissance_et=:date_naissance_et,lieu_naissance=:lieu_naissance,cni_etudiant=:cni_etudiant,id_classe=:id_classe,date_inscription=:date_inscription WHERE id_etudiant=:id_etudiant";
    $enregistrer=$bd->prepare($req);
    $enregistrer->bindParam('id_etudiant',$id_etudiant);
    $enregistrer->bindParam('nom_etudiant',$nom_etudiant);
    $enregistrer->bindParam('prenom_etudiant',$prenom_etudiant);
    $enregistrer->bindParam('date_naissance_et',$date_naiss);
    $enregistrer->bindParam('lieu_naissance',$lieu_naissance);
    $enregistrer->bindParam('cni_etudiant',$cni_etudiant);
    $enregistrer->bindParam('id_classe',$classe_etudiant);
    $enregistrer->bindParam('date_inscription',$date_ins);
    $enregistrer->execute();
    $erreure="1";
    header('location:listEtudiant.php?classe='.$classe_etudiant.'&erreure='.$erreure);

   }

}



//ajout Proffesseur

if ($action=='newProfesseur' && isset($_POST['nom_prof'],$_POST['prenom_prof'],$_POST['cni_prof'],$_POST['matiere_prof']) && !empty($_POST['nom_prof'] && $_POST['prenom_prof'] && $_POST['cni_prof'] && $_POST['matiere_prof']))
 {

$nom_prof=$_POST['nom_prof'];
$prenom_prof=$_POST['prenom_prof'];
$cni_prof=$_POST['cni_prof'];
$matiere_prof=$_POST['matiere_prof'];
//ceil()

$req="SELECT * FROM professeur where cni_prof=:cni_prof";

$donnees=$bd->prepare($req);
$donnees->bindParam('cni_prof',$cni_prof);
$donnees->execute();
$verifEtudiant=$donnees->fetchObject();
if ($verifEtudiant!=false)
  {
    $erreure="-1";
    header('location:newProfesseur.php?erreure='.$erreure);

  }
  else
  {
    $date_ins=date('y-m-d');

    $req="INSERT INTO professeur (nom_prof,prenom_prof,cni_prof,matiere_prof,date_inscription) VALUES(:nom_prof,:prenom_prof,:cni_prof,:matiere_prof,:date_ins)";
    $enregistrer=$bd->prepare($req);
    $enregistrer->bindParam('nom_prof',$nom_prof);
    $enregistrer->bindParam('prenom_prof',$prenom_prof);
    $enregistrer->bindParam('cni_prof',$cni_prof);
    $enregistrer->bindParam('matiere_prof',$matiere_prof);
    $enregistrer->bindParam('date_ins',$date_ins);
    $enregistrer->execute();
    $erreure="1";
    header('location:newProfesseur.php?erreure='.$erreure);

   }

}




if ($action=='modifProfesseur' && isset($_POST['nom_prof'],$_POST['prenom_prof'],$_POST['cni_prof'],$_POST['matiere_prof'],$_POST['classe']) && !empty($_POST['nom_prof'] && $_POST['prenom_prof'] && $_POST['cni_prof'] && $_POST['matiere_prof'] && $_POST['classe']))
 {
$id_prof=$_POST['id_prof'];
$nom_prof=$_POST['nom_prof'];
$prenom_prof=$_POST['prenom_prof'];
$cni_prof=$_POST['cni_prof'];
$matiere_prof=$_POST['matiere_prof'];
$classe=$_POST['classe'];

//ceil()

$req="SELECT * FROM professeur where cni_prof=:cni_prof AND id_prof!=:id_prof";

$donnees=$bd->prepare($req);
$donnees->bindParam('cni_prof',$cni_prof);
$donnees->bindParam('id_prof',$id_prof);
$donnees->execute();
$verifEtudiant=$donnees->fetchObject();
if ($verifEtudiant!=false)
  {
    $erreure="-1";
    header('location:modifProfesseur.php?id_prof='.$id_prof.'&erreure='.$erreure);

  }
  else
  {
    $date_ins=date('y-m-d');
    $req="UPDATE  professeur SET nom_prof=:nom_prof,prenom_prof=:prenom_prof,cni_prof=:cni_prof,matiere_prof=:matiere_prof,date_inscription=:date_ins WHERE id_prof=:id_prof";
    $enregistrer=$bd->prepare($req);
    $enregistrer->bindParam('id_prof',$id_prof);
    $enregistrer->bindParam('nom_prof',$nom_prof);
    $enregistrer->bindParam('prenom_prof',$prenom_prof);
    $enregistrer->bindParam('cni_prof',$cni_prof);
    $enregistrer->bindParam('matiere_prof',$matiere_prof);
    $enregistrer->bindParam('date_ins',$date_ins);
    $enregistrer->execute();
    //var_dump($enregistrer);

    $erreure="1";
    header('location:listProfesseur.php?classe='.$classe.'&erreure='.$erreure);

   }

}



//ajout Module

if ($action=='newModule' && isset($_POST['lib_matiere'],$_POST['v_horaire'],$_POST['id_classe'],$_POST['id_prof'],$_POST['semestre_matiere']) && !empty($_POST['lib_matiere'] && $_POST['v_horaire'] && $_POST['id_classe'] && $_POST['id_prof'] && $_POST['semestre_matiere']))
 {

$lib_matiere=$_POST['lib_matiere'];
$v_horaire=$_POST['v_horaire'];
$id_classe=$_POST['id_classe'];
$id_prof=$_POST['id_prof'];
$semestre_matiere=$_POST['semestre_matiere'];

//ceil()

$req="SELECT * FROM matiere where lib_matiere=:lib_matiere AND id_classe=:id_classe AND id_prof=:id_prof AND semestre_matiere=:semestre_matiere";

$donnees=$bd->prepare($req);
$donnees->bindParam('lib_matiere',$lib_matiere);
$donnees->bindParam('id_classe',$id_classe);
$donnees->bindParam('id_prof',$id_prof);
$donnees->bindParam('semestre_matiere',$semestre_matiere);

$donnees->execute();
$verifEtudiant=$donnees->fetchObject();
if ($verifEtudiant!=false)
  {
    $erreure="-1";
    header('location:newModule.php?erreure='.$erreure);

  }
  else
  {
    $date_matiere=date('y-m-d');

    $req="INSERT INTO matiere (lib_matiere,v_horaire,id_classe,date_matiere,id_prof,semestre_matiere) VALUES(:lib_matiere,:v_horaire,:id_classe,:date_matiere,:id_prof,:semestre_matiere)";
    $enregistrer=$bd->prepare($req);
    $enregistrer->bindParam('lib_matiere',$lib_matiere);
    $enregistrer->bindParam('v_horaire',$v_horaire);
    $enregistrer->bindParam('id_classe',$id_classe);
    $enregistrer->bindParam('date_matiere',$date_matiere);
    $enregistrer->bindParam('id_prof',$id_prof);
    $enregistrer->bindParam('semestre_matiere',$semestre_matiere);

    $enregistrer->execute();
    $erreure="1";
    header('location:newModule.php?erreure='.$erreure);

   }

}

/*else {
  $erreure="2";
  header('location:newProfesseur.php?erreure='.$erreure);
}*/


if ($action=='noterProf' && isset($_POST['id_matiere'],$_POST['appreciation'],$_POST['emploi_temps'],$_POST['logistique'],$_POST['pedagogie'],$_POST['maitrise_prof'],$_POST['methode_pedagogique'],$_POST['document_support'],$_POST['gest_temps'],$_POST['comportement_prof'],$_POST['deroulement_cour'],$_POST['assiduite_ponctualite'],$_POST['prestation']) && !empty($_POST['id_matiere'] && $_POST['appreciation'] && $_POST['emploi_temps'] && $_POST['logistique'] && $_POST['pedagogie'] && $_POST['maitrise_prof'] && $_POST['methode_pedagogique'] && $_POST['document_support']&& $_POST['gest_temps'] && $_POST['comportement_prof'] && $_POST['deroulement_cour']&& $_POST['assiduite_ponctualite'] && $_POST['prestation']))
 {
   $id_user=$_SESSION['id_user'];
   $id_matiere=$_POST['id_matiere'];
   $appreciation=$_POST['appreciation'];
   $emploi_temps=$_POST['emploi_temps'];
   $logistique=$_POST['logistique'];
   $pedagogie=$_POST['pedagogie'];
   $maitrise_prof=$_POST['maitrise_prof'];
   $methode_pedagogique=$_POST['methode_pedagogique'];
   $document_support=$_POST['document_support'];
   $gest_temps=$_POST['gest_temps'];
   $comportement_prof=$_POST['comportement_prof'];
   $deroulement_cour=$_POST['deroulement_cour'];
   $assiduite_ponctualite=$_POST['assiduite_ponctualite'];
   $prestation=$_POST['prestation'];
   $le_plus_apprecier=$_POST['le_plus_apprecier'];
   $le_moin_apprecier=$_POST['le_moin_apprecier'];
   $suggestion=$_POST['suggestion'];
   //ceil()
    $date_matiere=date('y-m-d');

    $req="INSERT INTO question (id_user,id_matiere,appreciation,emploi_temps,logistique,pedagogie,maitrise_prof,methode_pedagogique,document_support,gest_temps,comportement_prof,deroulement_cour,assiduite_ponctualite,prestation,le_plus_apprecier,le_moin_apprecier,suggestion) VALUES(:id_user,:id_matiere,:appreciation,:emploi_temps,:logistique,:pedagogie,:maitrise_prof,:methode_pedagogique,:document_support,:gest_temps,:comportement_prof,:deroulement_cour,:assiduite_ponctualite,:prestation,:le_plus_apprecier,:le_moin_apprecier,:suggestion)";
    $enregistrer=$bd->prepare($req);
    $enregistrer->bindParam('id_user',$id_user);
    $enregistrer->bindParam('id_matiere',$id_matiere);
    $enregistrer->bindParam('appreciation',$appreciation);
    $enregistrer->bindParam('emploi_temps',$emploi_temps);
    $enregistrer->bindParam('logistique',$logistique);
    $enregistrer->bindParam('pedagogie',$pedagogie);
    $enregistrer->bindParam('maitrise_prof',$maitrise_prof);
    $enregistrer->bindParam('methode_pedagogique',$methode_pedagogique);
    $enregistrer->bindParam('document_support',$document_support);
    $enregistrer->bindParam('gest_temps',$gest_temps);
    $enregistrer->bindParam('comportement_prof',$comportement_prof);
    $enregistrer->bindParam('deroulement_cour',$deroulement_cour);
    $enregistrer->bindParam('assiduite_ponctualite',$assiduite_ponctualite);
    $enregistrer->bindParam('prestation',$prestation);
    $enregistrer->bindParam('le_plus_apprecier',$le_plus_apprecier);
    $enregistrer->bindParam('le_moin_apprecier',$le_moin_apprecier);
    $enregistrer->bindParam('suggestion',$suggestion);
    $enregistrer->execute();
    header('location:noter.php?success=1');
    //var_dump($_POST['prestation']);
}

if ($action=='newInfo' && isset($_POST['titre_info'],$_POST['detail_info']) && !empty($_POST['titre_info'] && $_POST['detail_info']))
 {

$titre_info=$_POST['titre_info'];
$detail_info=$_POST['detail_info'];
$date_info=date('y-m-d');

    $req="INSERT INTO infos (titre_info,detail_info,date_info) VALUES(:titre_info,:detail_info,:date_info)";
    $enregistrer=$bd->prepare($req);
    $enregistrer->bindParam('titre_info',$titre_info);
    $enregistrer->bindParam('detail_info',$detail_info);
    $enregistrer->bindParam('date_info',$date_info);
    $enregistrer->execute();
    //$erreure="1";
    header('location:accueil.php');
}



if ($action=='newAdmin' && isset($_POST['login'],$_POST['mdp']) && !empty($_POST['login'] && $_POST['mdp']))
 {
      $login=$_POST['login'];
      $mdp=$_POST['mdp'];

                $req="SELECT * FROM utilisateur  where login=:login";
                $donnees=$bd->prepare($req);
                $donnees->bindParam('login',$login);
                $donnees->execute();
                $verifLogin2=$donnees->fetchObject();
                  if ($verifLogin2!=false) {
                    $erreure=1;
                  }
                  else {
                    $date_ins=date('y-m-d');
                    $titre="admin";
                    $req="INSERT INTO utilisateur (login,mdp,titre,date) VALUES(:login,:mdp,:titre,:date_ins)";
                    $enregistrer=$bd->prepare($req);
                    $enregistrer->bindParam('login',$login);
                    $enregistrer->bindParam('mdp',$mdp);
                    $enregistrer->bindParam('titre',$titre);
                    $enregistrer->bindParam('date_ins',$date_ins);
                    $enregistrer->execute();
                    $erreure=-1;
                    }

                    header('location:newAdmin.php?erreure='.$erreure);

}

?>
