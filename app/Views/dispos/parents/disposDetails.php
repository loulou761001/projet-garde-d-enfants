<?=
$this->extend('default') ?>

<?= $this->section('content');
setlocale(LC_TIME, "fr_FR");
?>
<section class="wrap dispoDetails">
    <h1>Détails : </h1>
    <?php if (!empty($pro[0]['pro_entreprise'])) { ?>
        <p>nom de la <?= strtolower($pro[0]['pro_categorie']) ?> : <?= $pro[0]['pro_entreprise'] ?>, par <?= $pro[0]['pro_nom'] ?> <?= $pro[0]['pro_prenom'] ?></p>
    <?php } else  { ?>
    <p>nom de la <?= strtolower($pro[0]['pro_categorie']) ?> : <?= $pro[0]['pro_nom'] ?> <?= $pro[0]['pro_prenom'] ?></p>
    <?php }?>
    <p>Taux horaire : <?= strtolower($pro[0]['pro_taux_horaire']) ?>.00€/heure.</p>
    <h2>choisissez les créneaux horaires que vous désirez :</h2>
<form action="" method="post">
<?php
$i = 0;
$minPlaces = 999;
foreach ($disposActuelles as $heure) { ?>
    <input data-nbplaces ="<?= $heure['dispo_places'] ?>" data-jsName="inputHeures" type="checkbox" value="<?= $heure['id'] ?>" name="id_dispo<?= $i ?>" id="<?= $heure['id'] ?>">
    <label data-jsname="inputHeures" for="<?= $heure['id'] ?>"><?= date('H', strtotime($heure['dispo_heure_debut'])) ?>h-<?= date('H', strtotime($heure['dispo_heure_fin'])) ?>h - <?= $heure['dispo_places'] ?> places disponibles.</label>
<?php $i++;

} ?>
    <p class="erreurSuivant"></p>

    <button class="detailsSuivantBtn">Suivant</button>

    <div class="detailsPartieDeux hidden">
        <h2>Choisissez les enfants à inscrire :</h2>
        <?php $e = 0; foreach ($enfants as $enfant) { ?>
        <div>
            <input data-jsName="inputEnfants" type="checkbox" value="<?= $enfant['id'] ?>" name="id_enfant<?= $i ?>" id="<?= $enfant['id'] ?>">
            <label data-jsname="inputEnfants" for="<?= $enfant['id'] ?>"><?= $enfant['enfant_prenom'] ?> <?= $enfant['enfant_nom'] ?></label>
            <br>
        </div>
        <?php $e++; } ?>
        <label for="infos" class="labelTextarea">Informations complémentaires :</label>
        <textarea name="infos" id="infos" cols="30" rows="10"></textarea>
        <input class="submit" type="submit">
        <p class="erreurSubmit"></p>
    </div>
</form>


</section>
<?php
$this->endSection() ;


$this->section('js'); ?>
    <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous">
    </script>

    <script src="<?= base_url('assets/js/insertionDispo.js'); ?>"></script>
<?php
$this->endSection() ;
