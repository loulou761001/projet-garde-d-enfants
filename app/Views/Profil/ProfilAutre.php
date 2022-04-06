<?= $this->extend('default') ?>

<?= $this->section('content'); ?>


    <section id="profil">
        <div class="wrap">
           <div class="profil_top">
               <div class="profil_pp">
                   <?php
                   if(!empty($pro['pro_photo'])){ ?>
                       <img class="img" src="<?= base_url('uploads/imgs/').'/'.$pro['pro_photo']; ?>">
                   <?php } else {?>
                       <img class="img" src="<?= base_url('assets/imgs/pp_basique.svg'); ?>">
                   <?php } ?>

               </div>
               <div class="profil_intro">
                   <h2>Bienvenue sur le profil de <?= $pro['pro_prenom']?> <?= $pro['pro_nom']?></h2>
                   <?php if(!empty($pro['pro_entreprise'])) {?>
                   <h3>de l'entreprise <?= $pro['pro_entreprise']?></h3>
                    <?php } ?>
                   <p><?= $pro['pro_description']?></p>
               </div>
           </div>

            <div class="separator"></div>

            <div class="profil_mid">
                <h2 class="titre">Informations :</h2>
                    <div class="mid_flex">

                        <p class="mid_txt"><strong>Nom :</strong> <?= $pro['pro_nom']?></p>
                        <p class="mid_txt"><strong>Prénom :</strong> <?= $pro['pro_prenom']?></p>
                        <p class="mid_txt"><strong>Email:</strong> <?= $pro['pro_email']?></p>
                        <p class="mid_txt"><strong>Téléphone :</strong> <?php echo wordwrap('0'.$pro['pro_telephone'],2," ",1)?></p>
                        <p class="mid_txt"><strong>Adresse :</strong> <?= $pro['pro_numAdresse'].' '. $pro['pro_adresse'].' '.$pro['pro_ville'].' '.$pro['pro_postal'] ?> </p>
                        <p class="mid_txt"><strong>Informations supplémentaires :</strong> <?php if(!empty($pro['pro_infosAdresse'])){echo $pro['pro_infosAdresse'];}else{ echo 'Non renseigné';} ?></p>
                    </div>

    </section>

<div id="popup" class="popup hidden">
    <form action="" method="post" class="wrapform" novalidate>

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
            <label for="carnet">Carnet de santé* : </label>
            <input type="file"  class="custom-file-input" id="carnet" name="carnet" value="">
            <?php if(!empty($erreurs['carnet'])){ ?>
                <span class="erreur"> <?= $erreurs['carnet'] ?></span>
            <?php } ?>
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
<script src="../assets/js/profil.js"></script>
<?php $this->endSection() ;
?>


