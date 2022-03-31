<?=
$this->extend('default') ?>

<?= $this->section('content');
setlocale(LC_TIME, "fr_FR");
?>
<section class="wrap" id="ajoutdispo">
    <a href="/gestionDispo/ajout">Ajouter une date</a>
    <h1>Mes disponibilités actuelles : </h1>
<?php
$n = 0;
$t = 0;
for ($i = 0; $i < count($dispos); $i++) {
    if ($i == 0) {
        $dispoTotale[$n][$t] = $dispos[$i];
        $t++;
    } elseif ($dispos[$i]['dispo_heure_debut'] == $dispos[$i - 1]['dispo_heure_fin'] && $dispos[$i]['dispo_jour'] == $dispos[$i - 1]['dispo_jour']) {
        $dispoTotale[$n][$t] = $dispos[$i];
        $t++;
    } else {
        $t = 0;
        $n++;
        $dispoTotale[$n][$t] = $dispos[$i];
        $t++;
    }
}
foreach ($dispoTotale as $dispo) {

    ?>

<div class="dispo">
<?php for ($i = 0; $i < count($dispo); $i++) {
    if ($i == 0) {
    ?>
    <h2><?= date('l d/m/Y',strtotime($dispo[$i]['dispo_jour']))  ?></h2>
    <?php } ?>
    <div class="flex sb">
        <h2><?= date('H',strtotime($dispo[$i]['dispo_heure_debut']))  ?>h - <?= date('H',strtotime($dispo[$i]['dispo_heure_fin'])) ?>h</h2>
        <p>
            Places disponibles : <?= $dispo[$i]['dispo_places'] ?>
        </p>
    </div>
<?php } ?>
</div>
<?php    }
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
