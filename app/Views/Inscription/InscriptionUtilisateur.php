<?php
include_once ('inc/fonctions.php');
$errors=[];
debug($_POST);
?>

<?= $this->extend('default') ?>

<?= $this->section('content'); ?>

<section>
    <div class="wrap">

        <form action="" method="post" class="wrapform" novalidate>

            <div class="info_box">
                <label for="email"></label>
                <input type="email" placeholder="Email*" id="email" name="email" value="<?= recupInputValue('email'); ?>">
            </div>
            <span class="error"><?= viewError($errors,'email'); ?></span>

            <div class="info_box">
                <label for="password"></label>
                <input type="password" placeholder="Mot de passe*" id="password" name="password" value="">
            </div>
            <span class="error"><?= viewError($errors,'password'); ?></span>
            <div class="info_box">
                <label for="password2"></label>
                <input type="password" placeholder="Confirmer Mot de passe*" id="password2" name="password2" value="">
            </div>

<!------------------------------------------------------------------------------------------------------------------------------>

            <div class="info_box">
                <label for="nom"></label>
                <input type="text" placeholder="Nom" id="nom" name="nom" value="<?= recupInputValue('nom');?>">
            </div>
            <span class="error"><?= viewError($errors,'nom'); ?></span>

            <div class="info_box">
                <label for="prenom"></label>
                <input type="text" placeholder="Prénom" id="prenom" name="prenom" value="<?= recupInputValue('prenom');?>">
            </div>
            <span class="error"><?= viewError($errors,'prenom'); ?></span>

            <div class="info_box">
                <label for="phone"></label>
                <input type="tel" placeholder="Numéro de téléphone" pattern="[0-9]{10}" maxlength="10" id="phone" name="phone" value="<?= recupInputValue('phone'); ?>">
            </div>
            <span class="error"><?= viewError($errors,'phone'); ?></span>

            <div class="info_box">
                <label for="prenom"></label>
                <input type="text" placeholder="Prénom" id="prenom" name="prenom" value="<?= recupInputValue('prenom');?>">
            </div>
            <span class="error"><?= viewError($errors,'prenom'); ?></span>



            <!------------------------------------------------------------------------------------------------------------------------------>



            

            <div class="info_box_button">
                <input type="submit" name="submitted" value="ENVOYER">
            </div>
            <p>Les champs avec * sont requis</p>
        </form>
    </div>
</section>

<?php
$this->endSection() ;
?>
