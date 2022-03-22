<?= $this->extend('default') ?>

<?= $this->section('content'); ?>
<section class="wrap">

    <form action="" method="post">
        <label for="email">Votre adresse eMail :</label>
        <input type="email" name="email" id="email">
        <label for="mdp">Votre mot de passe :</label>
        <input type="password" name="mdp" id="mdp">
        <input type="submit">
    </form>
    <a href="">Mot de passe oublié?</a>

<?php
//var_dump($parents);
?>
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
