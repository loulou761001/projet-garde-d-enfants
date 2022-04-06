<?= $this->extend('default') ?>

<?= $this->section('content'); ?>

<section id="admin">
    <div class="wrap">

        <h1>Il y a <?php echo count($pro) ?> compte à vérifier.</h1>
        <div class="liste_pro">
            <?php foreach ($pro as $single){ ?>
                <div class="table">

                    <div class="row header green">
                        <div class="cell">
                            Champ
                        </div>
                        <div class="cell">
                            Information
                        </div>


                    </div>
                    <div class="row">
                        <div class="cell" >
                            Nom / Prénom
                        </div>
                        <div class="cell" >
                            <?= $single['pro_nom'].' / '. $single['pro_prenom'] ?>
                        </div>

                    </div>
                    <div class="row">
                        <div class="cell" >
                            Description
                        </div>
                        <div class="cell" >
                            <?= $single['pro_description']?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="cell" >
                            Téléphone
                        </div>
                        <div class="cell" >
                            <?= '0'.$single['pro_telephone'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="cell" >
                            Email
                        </div>
                        <div class="cell" >
                            <?= $single['pro_email'] ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="cell" >
                            Categorie
                        </div>
                        <div class="cell" >
                            <?= $single['pro_categorie']?>
                        </div>
                    </div>
                    <?php if ($single['pro_categorie']!=='Nourrice'){ ?>
                        <div class="row">
                            <div class="cell" >
                                Entreprise
                            </div>
                            <div class="cell" >
                                <?= $single['pro_entreprise']?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="cell" >
                                N° Siret
                            </div>
                            <div class="cell" >
                                <?= $single['pro_siret']?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="cell" >
                            Adresse
                        </div>
                        <div class="cell" >
                            <?= $single['pro_numAdresse'].' '. $single['pro_adresse'].' '. $single['pro_ville'].' '.$single['pro_postal'] ?>
                        </div>
                    </div>
                    <?php if(!empty($single['pro_infosAdresse'])){ ?>
                        <div class="row">
                            <div class="cell" >
                                Infos Adresse
                            </div>
                            <div class="cell" >
                                <?= $single['pro_infosAdresse'] ?>
                            </div>
                        </div>
                    <?php }  ?>

                    <div class="row">
                        <div class="cell" >
                            Taux Horaire
                        </div>
                        <div class="cell" >
                            <?= $single['pro_taux_horaire'].'€/h' ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="cell" >
                            Pièce d'identité
                        </div>
                        <div class="cell" >
                            <a href="<?= base_url('uploads/identite/').'/'.$pro[0]['pro_identite']; ?>" download="  <?= $single['pro_nom'].' / '. $single['pro_prenom'] ?>">Télécharger</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="cell" >
                            Action
                        </div>
                        <div class="cell" >
                            <a href="/admin/approuve/<?= $single['id'] ?>">Approuver</a>
                            <a href="/admin/supprimer/<?= $single['id'] ?>">Supprimer</a>
                        </div>
                    </div>
                </div>

           <?php } ?>
        </div>



    </div>
</section>


<?php
$this->endSection() ;
$this->section('js');?>
<script src="../assets/js/profil.js"></script>
<?php $this->endSection() ;
?>


