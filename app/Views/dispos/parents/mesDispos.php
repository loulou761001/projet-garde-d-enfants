<?=
$this->extend('default') ?>

<?= $this->section('content');
?>
<section id="mesContrats" class="wrap">
    <h1>Mes réservations à venir :</h1>
<?php


$n = 0;
$t = 0;
for ($i = 0; $i < count($dispos); $i++) {
    if ($i == 0) {
        $dispoTotale[$n][$t] = $dispos[$i];
        $t++;
    } elseif ($dispos[$i][0]['dispo_heure_debut'] == $dispos[$i - 1][0]['dispo_heure_fin'] && $dispos[$i][0]['dispo_jour'] == $dispos[$i - 1][0]['dispo_jour']) {
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
    if($dispo[0][0]['dispo_suppr']==0) {
        $classes = 'dispo flex';
    } else {
        $classes = 'dispo flex redBG';
    }?>
    <div class="<?= $classes ?>">
        <?php for ($i = 0; $i < count($dispo); $i++) {
            if ($i == 0) {
        ?>
        <div>
            <h2><?= date('l d/m/Y',strtotime($dispo[$i][0]['dispo_jour']))  ?></h2>
            <div class="flex sb">
                <h2><?= date('H',strtotime($dispo[$i][0]['dispo_heure_debut']))  ?>h - <?= date('H',strtotime($dispo[count($dispo)-1][0]['dispo_heure_fin'])) ?>h</h2>
            </div>
            <?php if($dispo[0][0]['dispo_suppr']==1) {?>
            <h2 class="red">Cette réservation a été annulée par le professionnel</h2>
            <?php } ?>
        </div>
        <div>
            <?php

            foreach ($dispo[$i]['enfants'] as $enfantId) {
                foreach ($enfantId as $item) {
                    for ($i = 0; $i < count($enfants); $i++) {
                        if ($enfants[$i][0]['id'] == $item) {

                            if ($i != 0) {
                                if ($enfants[$i][0]['id'] != $enfants[$i-1][0]['id']) { ?>
                                    <h2><?= $enfants[$i][0]['enfant_prenom'] ?> <?= $enfants[$i][0]['enfant_nom'] ?></h2>
                                <?php }
                            } else { ?>
                                <h2><?= $enfants[$i][0]['enfant_prenom'] ?> <?= $enfants[$i][0]['enfant_nom'] ?></h2>
                            <?php }
                        }
                    }
                }
            } ?>
        </div>
        <?php }} ?>
    </div>
    <?php }
    ?>
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
