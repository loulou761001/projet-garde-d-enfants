<?=
$this->extend('default');  ?>

<?= $this->section('content');
setlocale(LC_TIME, "fr_FR");
?>
<section class="wrap dispoDetails">
    <div class="detailp">
    <h1>Détails : </h1>
    <?php if (!empty($pro[0]['pro_entreprise'])) { ?>
        <p>nom de la <?= strtolower($pro[0]['pro_categorie']) ?> : <a href="profil/pro/<?= $pro[0]['id'] ?>"><?= $pro[0]['pro_entreprise'] ?>, par <?= $pro[0]['pro_nom'] ?> <?= $pro[0]['pro_prenom'] ?></a></p>
    <?php } else  { ?>
        <p>nom de la <?= strtolower($pro[0]['pro_categorie']) ?> : <a href="profil/pro/<?= $pro[0]['id'] ?>"><?= $pro[0]['pro_nom'] ?> <?= $pro[0]['pro_prenom'] ?></a></p>
    <?php }?>
    <p>Taux horaire : <?= strtolower($pro[0]['pro_taux_horaire']) ?>.00€/heure.</p>
    </div>

    <iframe
        width="600"
        height="450"
        style="border:0"
        loading="lazy"
        allowfullscreen
        referrerpolicy="no-referrer-when-downgrade"
        src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyB7Bd7FBAfcCuG-i0hKlQBpPX3ytXB0qg0&origin=<?= $_SESSION['user']['numAdresse'] ?>+<?= $_SESSION['user']['adresse'] ?>,<?= $_SESSION['user']['ville'] ?>&destination=<?= $pro[0]['pro_numAdresse'] ?>+<?= $pro[0]['pro_adresse'] ?>,<?= $pro[0]['pro_ville'] ?>">
    </iframe>

    <h2>choisissez les créneaux horaires que vous désirez :</h2>

<form action="/paiement" method="post">
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
            <input data-jsName="inputEnfants" type="checkbox" value="<?= $enfant['id'] ?>" name="id_enfant<?= $e ?>" id="<?= $enfant['id'] ?>">
            <label data-jsname="inputEnfants" for="<?= $enfant['id'] ?>"><?= $enfant['enfant_prenom'] ?> <?= $enfant['enfant_nom'] ?></label>
            <br>
        </div>
        <?php $e++; } ?>
        <label for="infos" class="labelTextarea">Informations complémentaires :</label>
        <textarea name="infos" id="infos" cols="30" rows="5" placeholder="Veuillez rentrer vos informations"></textarea>
        <input type="text" class="hidden" value="<?= $pro[0]['pro_taux_horaire'] ?>" name="taux" id="taux">
        <input type="text" class="hidden" value="<?= $pro[0]['id'] ?>" name="pro_id" id="pro_id">
        <input type="text" class="hidden" value="<?= $_GET['dispoNbr'] ?>" name="dispoNbr" id="dispoNbr">
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
    <script src="<?= base_url('assets/js/details.js'); ?>"></script>
<?php
$this->endSection() ;
