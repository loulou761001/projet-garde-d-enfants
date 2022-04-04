<?=
$this->extend('default') ?>

<?= $this->section('content');
setlocale(LC_TIME, "fr_FR");

?>
<div class="chargement absolute flex">
    <h1>Veuillez patienter, nous chargeons les informations...</h1>
</div>
<section id="disponibilites" class="wrap">
    <h1>Disponibilités de nos professionnels :</h1>
    <div>
        <form class="flex filters" action="" autocomplete="off">
            <label for="ville">Ville : </label>
            <div class="relative">
                <input type="text" name="ville" id="ville">
            </div>
            <label for="distance">Distance maximale (km) : </label>
            <input type="number" name="distance" id="distance">
            <label for="prix">Prix horaire maximal : </label>
            <input type="number" name="prix" id="prix">
            <label for="date">Date : </label>
            <input type="date" name="date" id="date">
            <input type="submit" id="filterBtn" value="appliquer les filtres">
        </form>
    </div>
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


foreach ($pro as $unPro) {
    if($unPro['id'] == $dispo['0']['dispo_id_pro']) {
        $proActuel['taux'] = $unPro['pro_taux_horaire'];
        $proActuel['nom'] = $unPro['pro_nom'];
        $proActuel['prenom'] = $unPro['pro_prenom'];
        $proActuel['entreprise'] = $unPro['pro_entreprise'];
        $proActuel['categorie'] = $unPro['pro_categorie'];
        $proActuel['adresse'] = $unPro['pro_numAdresse'].' '.$unPro['pro_adresse'];
        $proActuel['ville'] = $unPro['pro_ville'];
    }
}?>
    <div class="dispo" data-ville="<?= $proActuel['ville'] ?>" data-prix="<?= $proActuel['taux'] ?>" data-distance="<?= str_replace(" km","",$distance[$dispo[0]['id']]) ?>" data-date="<?= $dispo[0]['dispo_jour'] ?>">
        <?php
for ($i = 0; $i < count($dispo); $i++) {
    if ($i == 0) {
        if (!empty($proActuel['entreprise'])) { ?>
            <h2><?= $proActuel['entreprise'] ?></h2>
        <?php } else { ?>
            <h2><?= $proActuel['nom'].' '.$proActuel['prenom'] ?></h2>
        <?php }
    ?>

    <h2><?= date('l d/m/Y',strtotime($dispo[$i]['dispo_jour']))  ?></h2>
    <div class="flex sb">
        <h2>
            <?php echo date('H',strtotime($dispo[0]['dispo_heure_debut'])).'h - ';
            echo date('H',strtotime($dispo[count($dispo)-1]['dispo_heure_fin'])).'h'; ?> |
            <?= $proActuel['taux'] ?>.00€/heure <br>
            <?= $proActuel['adresse'] ?> | à <?= str_replace('.',',',$distance[$dispo[0]['id']]) ?> de votre domicile
        </h2>
        <p>
            Places disponibles : <?php $placesMinNb = 999;
            $placesMaxNb = 0;
            foreach ($dispo as $uneDispo) {
                $dispo_place = $uneDispo['dispo_places'];
                if ($dispo_place > $placesMaxNb) {
                    $placesMaxNb = $dispo_place;
                }
                if ($dispo_place < $placesMinNb) {
                    $placesMinNb = $dispo_place;
                }
            }
            echo $placesMinNb.' - '.$placesMaxNb;
            ?>
        </p>
    </div>
<?php }} ?>
<p class="categorie"></p>
<a href="/dispoDetails?dispoNbr=<?php for ($i = 0; $i < count($dispo); $i++) {echo $dispo[$i]['id'].'-';} ?>">DETAILS</a>
</div>
<?php } ?>

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
    <script src="../assets/js/disposParents.js"></script>
<?php
$this->endSection() ;
