<?php
//appel de la page de connection a la base de données
require('connexion.php');
//reuperation des données du formulaire par POST
$login=$_POST['login'];
$mdp=$_POST['mdp'];
$cni=$_POST['cni'];
$Nlogin=$_POST['Nlogin'];
$Nmdp=$_POST['Nmdp'];
$titre=$_POST['titre'];
//var_dump($titre);
$bd=connect();
if (isset($titre) && empty($titre)) {
  $req="SELECT * FROM utilisateur where login=:login";
  $donnees=$bd->prepare($req);
  $donnees->bindParam('login',$login);
  $donnees->execute();
  $verifLogin=$donnees->fetchObject();

  if ($verifLogin!=false)
    {
        if ($verifLogin->mdp==$mdp)
          {
              session_name('test');
              session_start();
              $_SESSION['login']=$login;
              $_SESSION['mdp']=$mdp;
              $_SESSION['titre']=$verifLogin->titre;
              $_SESSION['connecter']=1;
              $_SESSION['id_user']=$verifLogin->id_user;
//              $_SESSION['classe_etudiant']=$verifLogin->id_classe;
              $_SESSION['id_etudiant']=$verifLogin->id_etudiant;

              //on recupere les informations de l'etudiant connecter
                    if ($verifLogin->titre=="etudiant") {
                      $id_etudiant=$verifLogin->id_etudiant;
                      $req="SELECT * FROM etudiant where id_etudiant=:id_etudiant";
                      $donnees=$bd->prepare($req);
                      $donnees->bindParam('id_etudiant',$id_etudiant);
                      $donnees->execute();
                      $verifLogin=$donnees->fetchObject();
                      if ($verifLogin!=false){
                      $_SESSION['classe_etudiant']=$verifLogin->id_classe;
                      $_SESSION['nom_user']=$verifLogin->nom_etudiant;
                      $_SESSION['prenom_user']=$verifLogin->prenom_etudiant;
                      }

                    }
                    elseif ($verifLogin->titre=="professeur")
                    {
                      $id_prof=$verifLogin->id_prof;
                      $req="SELECT * FROM professeur where id_prof=:id_prof";
                      $donnees=$bd->prepare($req);
                      $donnees->bindParam('id_prof',$id_prof);
                      $donnees->execute();
                      $verifLogin=$donnees->fetchObject();
                      if ($verifLogin!=false){
                      $_SESSION['id_prof']=$verifLogin->id_prof;
                      $_SESSION['nom_user']=$verifLogin->nom_prof;
                      $_SESSION['prenom_user']=$verifLogin->prenom_prof;
                      }

                    }

                    else //($verifLogin->titre=="admin")
                    {
                      $_SESSION['nom_user']="";
                      $_SESSION['prenom_user']=$verifLogin->titre;
                      $_SESSION['id_user']=$verifLogin->id_user;

                    }

              header('location:accueil.php');
          }
      else
          {
              $erreure='mot de passe incorrecte!';
              include('index.php');
          }
    }
  else
    {
        $erreure='informations incorrectes!';
        include('index.php');
    }

}



else {
    if (!empty($_POST['Nlogin']&& $_POST['Nmdp'] && $_POST['titre'] && $_POST['cni']))
      {
        //inscription professeur

          if ($_POST['titre']=="professeur") {



            $req="SELECT professeur.id_prof,professeur.cni_prof FROM professeur LEFT JOIN utilisateur on utilisateur.id_prof=professeur.id_prof where cni_prof=:cni";
            $donnees=$bd->prepare($req);
            $donnees->bindParam('cni',$cni);
            $donnees->execute();
            $verifLogin=$donnees->fetchObject();

            if ($verifLogin==false)//=> on ne peut pas creer un compte pour le professeur car il n'exite pas dans la base de données de l'école
              {
                $erreure="Accés reinstreint! vous ne pouvez pas avoir de compte";
                include('index.php');


              }
              else
              {
                $req="SELECT * FROM utilisateur  where login=:login || cni=:cni";
                $donnees=$bd->prepare($req);
                $donnees->bindParam('login',$Nlogin);
                $donnees->bindParam('cni',$cni);

                $donnees->execute();
                $verifLogin2=$donnees->fetchObject();
                  if ($verifLogin2!=false) {
                    $erreure="Echec! Pseudo Ou utilisateur exite déjà";
                    include('index.php');
                  }
                  else {
                  //  var_dump($verifLogin->id_prof);
                  //$id_prof=$verifLogin->id_prof;
                    $date_ins=date('y-m-d');
                    $req="INSERT INTO utilisateur (login,mdp,titre,cni,date,id_prof) VALUES(:login,:mdp,:titre,:cni,:date_ins,:id_prof)";
                    $enregistrer=$bd->prepare($req);
                    $enregistrer->bindParam('login',$Nlogin);
                    $enregistrer->bindParam('mdp',$Nmdp);
                    $enregistrer->bindParam('titre',$titre);
                    $enregistrer->bindParam('cni',$cni);
                    $enregistrer->bindParam('date_ins',$date_ins);
                    $enregistrer->bindParam('id_prof',$verifLogin->id_prof);
                    $enregistrer->execute();
                    header('location:success.php?success=1');


                  }
               }

          }


          if ($_POST['titre']=="etudiant") {



            $req="SELECT etudiant.id_etudiant,etudiant.cni_etudiant FROM etudiant LEFT JOIN utilisateur on utilisateur.id_etudiant=etudiant.id_etudiant where cni_etudiant=:cni";
            $donnees=$bd->prepare($req);
            $donnees->bindParam('cni',$cni);
            $donnees->execute();
            $verifLogin=$donnees->fetchObject();

            if ($verifLogin==false)//=> on ne peut pas creer un compte pour le professeur car il n'exite pas dans la base de données de l'école
              {
                $erreure="Accés reinstreint! vous ne pouvez pas avoir de compte";
                include('index.php');


              }
              else
              {
                $req="SELECT * FROM utilisateur  where login=:login || cni=:cni";
                $donnees=$bd->prepare($req);
                $donnees->bindParam('login',$Nlogin);
                $donnees->bindParam('cni',$cni);

                $donnees->execute();
                $verifLogin2=$donnees->fetchObject();
                  if ($verifLogin2!=false) {
                    $erreure="Echec! Pseudo Ou utilisateur exite déjà";
                    include('index.php');
                  }
                  else {
                  //  var_dump($verifLogin->id_prof);
                  //$id_prof=$verifLogin->id_prof;
                    $date_ins=date('y-m-d');
                    $req="INSERT INTO utilisateur (login,mdp,titre,cni,date,id_etudiant) VALUES(:login,:mdp,:titre,:cni,:date_ins,:id_etudiant)";
                    $enregistrer=$bd->prepare($req);
                    $enregistrer->bindParam('login',$Nlogin);
                    $enregistrer->bindParam('mdp',$Nmdp);
                    $enregistrer->bindParam('titre',$titre);
                    $enregistrer->bindParam('cni',$cni);
                    $enregistrer->bindParam('date_ins',$date_ins);
                    $enregistrer->bindParam('id_etudiant',$verifLogin->id_etudiant);
                    $enregistrer->execute();
                    header('location:success.php?success=1');


                  }
               }

          }

      }
    else {
        $erreure="veillez remplir tous les champs";
        include('index.php');

      }
    //header('location:index.php');
}
 ?>
