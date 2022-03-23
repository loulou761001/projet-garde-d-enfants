<?= $this->extend('default') ?>

<?= $this->section('content');
require_once('inc/fonctions.php'); ?>
<section id="connexion">
<div class="wrap">
    <form action="" method="post">
        <div class="photo"><img src="<?= base_url('assets/imgs/ticroco.png'); ?>" alt="Logo Ticrocos"></div>
        <div class="infoBox">
            <label for="email">Votre adresse Email :</label>
            <input type="email" name="email" id="email">
        </div>

        <div class="infoBox">
            <label for="mdp">Votre mot de passe :</label>
            <input type="password" name="mdp" id="mdp">
        </div>

        <input type="submit">

    </form>

</div>
</section>


<?php
$this->endSection() ;
?>





<?= $this->section('js'); ?>
    <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous">
    </script>
<?php
$this->endSection() ;
