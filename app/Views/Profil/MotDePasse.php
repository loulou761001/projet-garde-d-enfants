<?= $this->extend('default') ?>

<?= $this->section('content'); ?>


<?php
if (!empty($mail)){
    echo'Reception du lien qui emmène sur : <a href="motdepasse/modifier?token='.urldecode($token).'&email='.urldecode($mail).'">Cette page</a>';
}
?>
<section id="mdpOublie">
    <div class="wrap">
        <div class="txt">
            <h2>Mot de passe oublié ?</h2>
            <h2>Veuillez renseigner votre mail</h2>
        </div>

        <form action="" method="post" class="wrapform" novalidate>
        <div class="info_box">
            <label for="email">Email :</label>
            <input type="email" placeholder="Ex: louis.dupont@gmail.com" id="email" name="email" value="">
        </div>
            <span class="erreur"><p><?php if(!empty($erreurs)){echo $erreurs;} ?></p></span>
        <input id="dernierSubmit" class="button" type="submit" name="submitted" value="ENVOYER">

        </form>


    </div>
</section>



<?php
$this->endSection() ;
$this->section('js');?>
<script src="../assets/js/profil.js"></script>
<?php $this->endSection() ;
?>


