<?=
$this->extend('default') ?>

<?= $this->section('content');
setlocale(LC_TIME, "fr_FR");

?>
<section id="disponibilites" class="wrap">
    <h1>Désolé, aucune disponibilité pour le moment.</h1>
</section>
<?php
$this->endSection();
?>

<?= $this->section('js'); ?>
    <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous">
    </script>
<?php
$this->endSection() ;
