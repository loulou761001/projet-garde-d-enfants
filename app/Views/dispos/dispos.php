<?=
$this->extend('default') ?>

<?= $this->section('content');

?>
<section class="wrap">
    <h1>Mes disponibilités actuelles : </h1>

<?php
    foreach ($dispos as $dispo) { ?>


    <?php  debug($dispo);  }
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
    <script src="<?= base_url('assets/js/jquery.flexslider-min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/flexslider.js'); ?>"></script>
    <script src="<?= base_url('assets/js/home.js'); ?>"></script>


<?php
$this->endSection() ;
