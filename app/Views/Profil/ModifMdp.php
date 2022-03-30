<?= $this->extend('default') ?>

<?= $this->section('content'); ?>


<section id="mdpOublie">
    <div class="wrap">


        <h2>Veuillez rentrer votre nouveau mot de passe :</h2>
        <form action="" method="post" class="wrapform" novalidate>
            <div class="info_box">
                <label for="mdp">Nouveau mot de passe :</label>
                <input type="password"  id="mdp" name="mdp" value="">
            </div>
            <input class="button" type="submit" name="submitted" value="ENVOYER">

            <span><p><?php if(!empty($erreurs)){echo'Mot de passe trop court';} ?></p></span>

        </form>
    </div>
</section>



<?php
$this->endSection() ;
$this->section('js');?>
<script src="../assets/js/profil.js"></script>
<?php $this->endSection() ;
?>


