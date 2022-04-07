<?= $this->extend('default') ?>

<?= $this->section('content'); ?>


    <section id="profil">
        <div class="wrap">
            <?php
            if(!empty($erreurs)){ ?>
                <div class="erreur_enfant"><p>Il y a eu une erreur lors de l'ajout de votre enfant sur votre compte, vérifiez les erreurs sur le formulaire d'inscription.</p></div>
            <?php  } ?>
           <div class="profil_top">
               <div class="profil_pp">
                   <?php if ($_SESSION['user']['status']=='parent'){
                   if(!empty($parent[0]['parent_photo'])){ ?>
                       <a href="/profil/photo/<?= $_SESSION['user']['id'] ?>"><img class="img" src="<?= base_url('uploads/imgs/').'/'.$parent[0]['parent_photo']; ?>"></a>
                   <?php } else {?>
                       <a href="/profil/photo/<?= $_SESSION['user']['id'] ?>"><img class="img" src="<?= base_url('assets/imgs/pp_basique.svg'); ?>"></a>
                   <?php }} else {
                       if(!empty($pro[0]['pro_photo'])){ ?>
                       <a href="/profil/photo/<?= $_SESSION['user']['id'] ?>"><img class="img" src="<?= base_url('uploads/imgs/').'/'.$pro[0]['pro_photo']; ?>"></a>
                   <?php } else {?>
                       <a href="/profil/photo/<?= $_SESSION['user']['id'] ?>"><img class="img" src="<?= base_url('assets/imgs/pp_basique.svg'); ?>"></a>
                   <?php }
                   } ?>
               </div>
               <div class="profil_intro">
                   <?php if ($_SESSION['user']['status']=='parent'){ ?>

                       <h2 class="titre">Bienvenue sur votre profil <?= $parent[0]['parent_prenom']?> !</h2>

                   <?php }elseif ($_SESSION['user']['status']=='professionnel'){ ?>

                       <h2 class="titre">Bienvenue sur votre profil <?= $pro[0]['pro_prenom']?> !</h2>
                   <?php } ?>
               </div>
           </div>

            <div class="separator"></div>

            <div class="profil_mid">
                <h2 class="titre">Informations :</h2>
                <?php if ($_SESSION['user']['status']=='parent'){ ?>
                    <div class="mid_flex">
                        <p class="mid_txt"><strong>Nom :</strong> <?= $parent[0]['parent_nom']?></p>
                        <p class="mid_txt"><strong>Prénom :</strong> <?= $parent[0]['parent_prenom']?></p>
                        <p class="mid_txt"><strong>Email:</strong> <?= $parent[0]['parent_email']?></p>
                        <p class="mid_txt"><strong>Téléphone :</strong> <?php echo wordwrap('0'.$parent[0]['parent_tel'],2," ",1)?></p>
                        <p class="mid_txt"><strong>Adresse :</strong> <?= $parent[0]['parent_numAdresse'].' '. $parent[0]['parent_adresse'].' '.$parent[0]['parent_ville'].' '.$parent[0]['parent_postal'] ?> </p>
                        <p class="mid_txt"><strong>Informations supplémentaires :</strong> <?php if(!empty($parent[0]['parent_infosAdresse'])){echo $parent[0]['parent_infosAdresse'];}else{ echo 'Non renseigné';} ?></p>
                    </div>
                    <a class="modif_button" href="/profil/modifier">Modifier</a>

                <?php }elseif ($_SESSION['user']['status']=='professionnel'){ ?>

                    <div class="mid_flex">
                        <p class="mid_txt"><strong>Nom :</strong> <?= $pro[0]['pro_nom']?></p>
                        <p class="mid_txt"><strong>Prénom :</strong> <?= $pro[0]['pro_prenom']?></p>
                        <p class="mid_txt"><strong>Email:</strong> <?= $pro[0]['pro_email']?></p>
                        <p class="mid_txt"><strong>Téléphone :</strong> <?php echo wordwrap('0'.$pro[0]['pro_telephone'],2," ",1)?></p>
                        <p class="mid_txt"><strong>Adresse :</strong> <?= $pro[0]['pro_numAdresse'].' '. $pro[0]['pro_adresse'].' '.$pro[0]['pro_ville'].' '.$pro[0]['pro_postal'] ?> </p>
                        <p class="mid_txt"><strong>Informations supplémentaires :</strong> <?php if(!empty($pro[0]['pro_infosAdresse'])){echo $pro[0]['pro_infosAdresse'];}else{ echo 'Non renseigné';} ?></p>
                        <p class="mid_txt"><strong>Catégorie :</strong> <?= $pro[0]['pro_categorie']?></p>
                        <p class="mid_txt"><strong>Tarif Horaire :</strong> <?= $pro[0]['pro_taux_horaire'].'€/h'?></p>
                        <?php if($pro[0]['pro_categorie']!='Nourrice'){ ?>
                            <p class="mid_txt" ><strong>Entreprise:</strong> <?= $pro[0]['pro_entreprise']?></p>
                            <p class="mid_txt"><strong>N° de Siret :</strong> <?= $pro[0]['pro_siret']?></p>
                         <?php  }?>
                    </div>
                    <p class="mid_txt"><strong>Description :</strong> <?= $pro[0]['pro_description'] ?></p>
                    <a class="modif_button" href="/profil/modifier">Modifier</a>

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
                            <p><strong>Informations :</strong> <?= $enfant['enfants_infos'] ?></p>
                        </div>

                        <?php if (!empty($enfant['enfant_carnet'])) {?>
                        <div class="link">
                            <a href="<?= base_url('uploads/carnets/').'/'.$enfant['enfant_carnet']; ?>" class="carnetEnfant" download>Télécharger le carnet de santé de l'enfant</a>
                        </div>
                        <?php } ?>

                        <div class="link">
                            <a href="/profil/supprimer/<?= $enfant['id'] ?>">Supprimer</a>
                        </div>

                    </div>
                   <?php     } ?>

                    <?php }else{ ?>
                        <div class="pasDenfants">
                            <p>Vous n'avez pas ajouté d'enfants à garder</p>
                            <p>Cliquez ici pour en ajouter</p>
                        </div>

                     <?php   }}?>
                    <?php if($_SESSION['user']['status']=='parent'){ ?>
                        <i id="js_btn" style="font-size:3rem; cursor:pointer;"class="fa-solid fa-circle-plus"></i>
                  <?php  } ?>


            </div>
        </div>
    </section>

<div id="popup" class="popup hidden">
    <form enctype="multipart/form-data" action="" method="post" class="wrapform" novalidate>

        <i id="close" class="fa-solid fa-circle-xmark"></i>

            <div class="popup_box">
                <label for="nom">Nom* :</label>
                <input type="text" placeholder="Ex : Dupont" id="nom" name="nom" value="<?php if (!empty($form['enfant_nom'])){echo $form['enfant_nom'];} ?>">
                <?php if(!empty($erreurs['nom'])){ ?>
                    <span class="erreur"> <?= $erreurs['nom'] ?></span>
                <?php } ?>
            </div>



            <div class="popup_box">
                <label for="prenom">Prenom* :</label>
                <input type="text" placeholder="Ex : Louise" id="prenom" name="prenom" value="<?php if (!empty($form['enfant_prenom'])){echo $form['enfant_prenom'];} ?>">
                <?php if(!empty($erreurs['prenom'])){ ?>
                    <span class="erreur"> <?= $erreurs['prenom'] ?></span>
                <?php } ?>
            </div>



            <label for="sexe">Sexe* :</label>
            <select name="sexe" id="sexe">
                <option value="M">Masculin</option>
                <option value="F">Feminin</option>
            </select>

             <div class="popup_box">
                <label for="naissance">Date de naissance* :</label>
                <input type="date" placeholder="Ex: Louise" id="naissance" name="naissance" value="<?php if (!empty($form['enfant_naissance'])){echo $form['enfant_naissance'];} ?>">
                 <?php if(!empty($erreurs['naissance'])){ ?>
                     <span class="erreur"> <?= $erreurs['naissance'] ?></span>
                 <?php } ?>
             </div>



        <div class="popup_box">
            <label for="carnet">Carnet de santé (pdf ou image) (facultatif) : </label>
            <input type="file"  class="custom-file-input" id="carnet" name="carnet">
            <span class="erreur carnetErreur"></span>
        </div>



            <div class="popup_box">
                <label for="infos">Infos complémentaires* :</label>
                <textarea name="infos" id="infos" placeholder="Allergies, passions, caractère, ect..." ><?php if (!empty($form['enfant_infos'])){echo $form['enfant_infos'];} ?></textarea>
                <?php if(!empty($erreurs['infos'])){ ?>
                    <span class="erreur"> <?= $erreurs['infos'] ?></span>
                <?php } ?>
            </div>



            <input class="button" type="submit" name="submitted" value="ENVOYER">


        <p>Les champs avec * sont requis</p>
    </form>
</div>


<?php
$this->endSection() ;
$this->section('js');?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="../assets/js/profil.js"></script>

<?php $this->endSection() ;
?>


