<?php
include_once ('inc/fonctions.php');
$errors=[];
debug($_POST);
?>

<?= $this->extend('default') ?>

<?= $this->section('content'); ?>

    <section id="inscriptionChoix">
        <div class="wrap">



            <h2>Quel type de compte voulez-vous créer ?</h2>
            <div class="boutonChoix">
                <div class="wrapper">
                    <a class="button" href="/inscription/parent">Compte Parent</a>
                </div>

                <div class="wrapper">
                    <a class="button" href="/inscription/nourrice">Compte Nourrice</a>
                </div>
            </div>
            <div class="spring" role="img" aria-label="Animated cartoon showing a sunny scene with a field with flowers and a flying bee."></div>


        </div>
    </section>


<?php
$this->endSection() ;



