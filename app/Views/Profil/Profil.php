<?= $this->extend('default') ?>

<?= $this->section('content'); ?>

<?php

debug($parent);
debug($enfants);
?>


    <section id="profil">
        <div class="wrap">

           <div class="profil_top">
               <div class="profil_pp">
                   <?php if(!empty($parent[0]['parent_photo'])){
                       echo'afficher photo';
                   } else {?>
                       <a href=""><img class="img" src="<?= base_url('assets/imgs/pp_basique.svg'); ?>"></a>
                   <?php } ?>
               </div>
               <div class="profil_intro">
                  <h2 class="titre">Bienvenue sur votre profil <?= $parent[0]['parent_prenom']?> !</h2>
               </div>
           </div>

            <div class="separator"></div>

            <div class="profil_mid">

                <h2 class="titre">Informations :</h2>

                <div class="mid_flex">
                    <p><strong>Nom :</strong> <?= $parent[0]['parent_nom']?></p>
                    <p><strong>Prénom :</strong> <?= $parent[0]['parent_prenom']?></p>
                    <p><strong>Email:</strong> <?= $parent[0]['parent_email']?></p>
                    <p><strong>Mot de passe :</strong> ****</p>
                 </div>
                 <p><strong>Téléphone :</strong> +33 <?= $parent[0]['parent_tel']?></p>




                <h2 class="titre">Adresse :</h2>

                <?php if ($_SESSION['user']['status']=='parent'){ ?>
                <div class="mid_flex">
                    <p><strong>Numéro de l'adresse :</strong> <?= $parent[0]['parent_numAdresse']?></p>
                    <p><strong>Rue :</strong> <?= $parent[0]['parent_adresse']?></p>
                    <p><strong>Ville :</strong> <?= $parent[0]['parent_ville']?></p>
                    <p><strong>Code Postal :</strong> <?= $parent[0]['parent_postal']?></p>
                </div>

                <p><strong>Informations supplémentaires :</strong> <?php if(!empty($parent[0]['parent_infosAdresse'])){echo $parent[0]['parent_infosAdresse'];}else{ echo 'Non renseigné';} ?></p>

                <?php }elseif ($_SESSION['user']['status']=='professionnel'){ ?>

                    <div class="mid_flex">
                        <p><strong>Numéro de l'adresse :</strong> <?= $parent[0]['parent_numAdresse']?></p>
                        <p><strong>Rue :</strong> <?= $parent[0]['parent_adresse']?></p>
                        <p><strong>Ville :</strong> <?= $parent[0]['parent_ville']?></p>
                        <p><strong>Code Postal :</strong> <?= $parent[0]['parent_postal']?></p>
                    </div>

                    <p><strong>Informations supplémentaires :</strong> <?php if(!empty($parent[0]['parent_infosAdresse'])){echo $parent[0]['parent_infosAdresse'];}else{ echo 'Non renseigné';} ?></p>
             <?php   } ?>
            </div>

            <div class="separator"></div>

            <div class="bottom_part">
                <h2 class="titre">Enfant(s) :</h2>
                <?php if ($_SESSION['user']['status']=='parent'){
                    if(!empty($enfants)){ ?>

                    <?php }else{ ?>
                        <div class="pasDenfants">
                            <p>Vous n'avez pas ajouté d'enfants à garder</p>
                            <p><a href="">Cliquez ici pour en ajouter</a></p>
                        </div>
                     <?php   }?>


                <?php }elseif ($_SESSION['user']['status']=='professionnel'){ ?>

                <?php   } ?>

            </div>
        </div>
    </section>

<?php
$this->endSection() ;
?>

