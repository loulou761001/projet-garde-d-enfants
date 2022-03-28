<?=
$this->extend('default') ?>

<?= $this->section('content');
setlocale(LC_TIME, "fr_FR");
?>
<section class="wrap dispoDetails">
    <h1>Détails : </h1>
    <p>nom de la <?= strtolower($pro[0]['pro_categorie']) ?> : <?= $pro[0]['pro_nom'] ?> <?= $pro[0]['pro_prenom'] ?></p>
    <h2>choisissez les créneaux horaires que vous désirez :</h2>
<form action="" method="post"></form>
<?php
foreach ($disposActuelles as $heure) { ?>
    <input type="checkbox" value="<?= date('H', strtotime($heure['dispo_heure_debut'])) ?>-<?= date('H', strtotime($heure['dispo_heure_fin'])) ?>" name="<?= date('H', strtotime($heure['dispo_heure_debut'])) ?>-<?= date('H', strtotime($heure['dispo_heure_fin'])) ?>" id="<?= date('H', strtotime($heure['dispo_heure_debut'])) ?>-<?= date('H', strtotime($heure['dispo_heure_fin'])) ?>">
    <label for="<?= date('H', strtotime($heure['dispo_heure_debut'])) ?>-<?= date('H', strtotime($heure['dispo_heure_fin'])) ?>"><?= date('H', strtotime($heure['dispo_heure_debut'])) ?>h-<?= date('H', strtotime($heure['dispo_heure_fin'])) ?>h - <?= $heure['dispo_places'] ?> places disponibles.</label>
<?php } ?>
</section>
<?php
$this->endSection() ;


$this->section('js'); ?>
    <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous">
    </script>
<?php
$this->endSection() ;
