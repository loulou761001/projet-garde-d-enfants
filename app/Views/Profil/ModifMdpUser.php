<?= $this->extend('default') ?>

<?= $this->section('content'); ?>

<section id="mdpOublie">
    <div class="wrap">


        <h2>Veuillez rentrer votre nouveau mot de passe :</h2>
        <form action="" method="post" class="wrapform" novalidate>
            <div class="info_box">
                <label for="newmdp">Nouveau mot de passe :</label>
                <input type="password"  id="newmdp" name="newmdp" value="">
            </div>

            <div class="info_box">
                <label for="mdp">Confirmer avec votre mot de passe actuel :</label>
                <input type="password"  id="mdp" name="mdp" value="">
            </div>

            <span class="erreur"><p><?php if(!empty($erreurs)){echo 'Le nouveau mot de passe doit faire au minimum 8 caractères';} ?></p></span>

            <input class="button" type="submit" name="submitted" value="ENVOYER">



        </form>
    </div>
</section>




<?php
$this->endSection() ;

