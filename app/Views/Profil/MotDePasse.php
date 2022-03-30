<?= $this->extend('default') ?>

<?= $this->section('content'); ?>


<?php
if(!empty($erreurs)){
    debug($erreurs);
}
if (!empty($mail)){
    echo'Reception du lien qui emmène sur : <a href="motdepasse/modifier?token='.urldecode($token).'&email='.urldecode($mail).'">Cette page</a>';
}

?>
<section id="mdpOublie">
    <div class="wrap">
        <h2>Mot de passe oublié ?</h2>
        <h2>Veuillez renseigner votre mail</h2>
        <form action="" method="post" class="wrapform" novalidate>
        <div class="info_box">
            <label for="email">Email :</label>
            <input type="email" placeholder="Ex: louis.dupont@gmail.com" id="email" name="email" value="">
        </div>
        <input id="dernierSubmit" class="button" type="submit" name="submitted" value="ENVOYER">

        </form>

        <span>   <p>    <?php if(!empty($erreurs)){echo'Mot de passe trop court';} ?>   </p>   </span>
    </div>
</section>



<?php
$this->endSection() ;
$this->section('js');?>
<script src="../assets/js/profil.js"></script>
<?php $this->endSection() ;
?>


