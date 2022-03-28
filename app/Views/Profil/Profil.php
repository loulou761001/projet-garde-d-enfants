<?= $this->extend('default') ?>

<?= $this->section('content'); ?>




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


                   <?php if ($_SESSION['user']['status']=='parent'){ ?>

                       <h2 class="titre">Bienvenue sur votre profil <?= $parent[0]['parent_prenom']?> !</h2>

                   <?php }elseif ($_SESSION['user']['status']=='professionnel'){ ?>

                       <h2 class="titre">Bienvenue sur votre profil <?= $pro[0]['pro_prenom']?> !</h2>

                   <?php   } ?>

               </div>
           </div>

            <div class="separator"></div>

            <div class="profil_mid">

                <h2 class="titre">Informations :</h2>

                <?php if ($_SESSION['user']['status']=='parent'){ ?>

                    <div class="mid_flex">
                        <p><strong>Nom :</strong> <?= $parent[0]['parent_nom']?></p>
                        <p><strong>Prénom :</strong> <?= $parent[0]['parent_prenom']?></p>
                        <p><strong>Email:</strong> <?= $parent[0]['parent_email']?></p>
                        <p><strong>Mot de passe :</strong> ****</p>
                        <p><strong>Adresse :</strong> <?= $parent[0]['parent_numAdresse'].' '. $parent[0]['parent_adresse'].' '.$parent[0]['parent_ville'].' '.$parent[0]['parent_postal'] ?> </p>
                        <p><strong>Informations supplémentaires :</strong> <?php if(!empty($parent[0]['parent_infosAdresse'])){echo $parent[0]['parent_infosAdresse'];}else{ echo 'Non renseigné';} ?></p>
                    </div>
                    <p><strong>Téléphone :</strong> <?php echo wordwrap('0'.$parent[0]['parent_tel'],2," ",1)?></p>

                <?php }elseif ($_SESSION['user']['status']=='professionnel'){ ?>

                    <div class="mid_flex">
                        <p><strong>Nom :</strong> <?= $pro[0]['pro_nom']?></p>
                        <p><strong>Prénom :</strong> <?= $pro[0]['pro_prenom']?></p>
                        <p><strong>Email:</strong> <?= $pro[0]['pro_email']?></p>
                        <p><strong>Mot de passe :</strong> ****</p>
                        <p><strong>Adresse :</strong> <?= $pro[0]['pro_numAdresse'].' '. $pro[0]['pro_adresse'].' '.$pro[0]['pro_ville'].' '.$pro[0]['pro_postal'] ?> </p>
                        <p><strong>Informations supplémentaires :</strong> <?php if(!empty($pro[0]['pro_infosAdresse'])){echo $pro[0]['pro_infosAdresse'];}else{ echo 'Non renseigné';} ?></p>
                    </div>
                    <p><strong>Téléphone :</strong> <?php echo wordwrap('0'.$pro[0]['pro_telephone'],2," ",1)?></p>

                <?php   } ?>



            </div>

            <div class="separator"></div>


            <?php if ($_SESSION['user']['status']=='parent'){ ?>
            <div class="bottom_part">
                <h2 class="titre">Enfant(s) :</h2>
                <div class="liste_enfant">
             <?php if(!empty($enfants)){
                        foreach($enfants as $enfant){ ?>
                    <div class="box_enfant">

                            <?php if ($enfant['enfant_sexe']=='F'){ ?>
                              <img class="img" src="<?= base_url('assets/imgs/girl.png'); ?>">
                           <?php }elseif ($enfant['enfant_sexe']=='M'){ ?>
                                <img class="img" src="<?= base_url('assets/imgs/boy.png'); ?>">
                       <?php   }?>


                        <div class="right_part">
                            <p><strong><?= $enfant['enfant_prenom'].' '.$enfant['enfant_nom'] ?></strong></p>
                            <p><strong>Date de naissance :</strong> <?php $myDateTime = DateTime::createFromFormat('Y-m-d', $enfant['enfant_naissance']); $date = $myDateTime->format('d-m-Y'); echo $date; ?></p>
                            <p><strong>Informations :</strong> <?= $enfant['enfants_infos'] ?> blablabalbalablabalabalbalablabalablabalablabalablabala</p>
                        </div>

                        <div class="link">
                            <a href="/profil/supprimer/<?= $enfant['id'] ?>">Enlever l'enfant</a>
                            <a href="">Détail</a>
                        </div>

                    </div>
                   <?php     } ?>

                    <?php }else{ ?>
                        <div class="pasDenfants">
                            <p>Vous n'avez pas ajouté d'enfants à garder</p>
                            <p>Cliquez ici pour en ajouter</p>
                        </div>
                     <?php   }}?>

                    <i id="js_btn" style="font-size:3rem;" class="fa-solid fa-circle-plus"></i>
            </div>
        </div>
    </section>

<div id="popup" class="popup hidden">
    <form action="" method="post" class="wrapform" novalidate>

        <i id="close" class="fa-solid fa-circle-xmark"></i>

            <div class="popup_box">
                <label for="nom">Nom* :</label>
                <input type="nom" placeholder="Ex : Dupont" id="nom" name="nom" value="">
            </div>


            <div class="popup_box">
                <label for="prenom">Mot de passe* :</label>
                <input type="prenom" placeholder="Ex: Louise" id="prenom" name="prenom" value="">
            </div>

            <div class="popup_box">
                <label for="password2">Valider votre mot de passe* :</label>
                <input type="password" placeholder="*********" id="password2" name="password2" value="">
            </div>



            <input id="dernierSubmit" class="button" type="submit" name="submitted" value="ENVOYER">


        <p>Les champs avec * sont requis</p>
    </form>
</div>


<?php
$this->endSection() ;
$this->section('js');?>
<script src="../assets/js/profil.js"></script>
<?php $this->endSection() ;
?>


