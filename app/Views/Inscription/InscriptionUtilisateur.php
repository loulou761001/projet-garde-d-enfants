<?php
include_once ('inc/fonctions.php');
$errors=[];
debug($_POST);
?>

<?= $this->extend('default') ?>

<?= $this->section('content'); ?>

<section id="formulaire">
    <div class="wrap">
        <h2>Inscription :</h2>
        <form action="" method="post" class="wrapform" novalidate>

        <div class="form1">
            <div class="info_box">
                <label for="email">Adresse mail :</label>
                <input type="email" placeholder="Ex : louis.dupont@gmail" id="email" name="email" value="<?= recupInputValue('email'); ?>">
            </div>
            <span data-champ="email"></span>

            <div class="info_box">
                <label for="password">Mot de passe :</label>
                <input type="password" placeholder="" id="password" name="password" value="">
            </div>

            <div class="info_box">
                <label for="password2">Valider votre mot de passe :</label>
                <input type="password" placeholder="" id="password2" name="password2" value="">
            </div>

            <span data-champ="motDePasse"></span>
            <button id="jsButton1">Suivant <i class="fa-solid fa-arrow-right"></i></button>
        </div>


<!------------------------------------------------------------------------------------------------------------------------------>

        <div class="form2 hidden">
            <div class="info_box">
                <label for="nom">Nom :</label>
                <input type="text" placeholder="Ex: Dupont" id="nom" name="nom" value="<?= recupInputValue('nom');?>">
            </div>
            <span data-champ="nom"></span>

            <div class="info_box">
                <label for="prenom">Prénom :</label>
                <input type="text" placeholder="Ex : Louis" id="prenom" name="prenom" value="<?= recupInputValue('prenom');?>">
            </div>
            <span data-champ="prenom"></span>

            <div class="info_box">
                <label for="phone"> Téléphone : </label>
                <input type="tel" placeholder="Ex : 06 01 02 03 04 " pattern="[0-9]{10}" maxlength="10" id="phone" name="phone" value="<?= recupInputValue('phone'); ?>">
            </div>
            <span data-champ="tel"></span>

            <div class="info_box">
                <label for="naissance">Date de naissance : </label>
                <input type="date" placeholder="Ex : 21 juin 1987" id="naissance" name="naissance" value="<?= recupInputValue('naissance');?>">
            </div>
            <span data-champ="dateDeNaissance"></span>

            <button id="jsButton2">Suivant <i class="fa-solid fa-arrow-right"></i></button>

        </div>

            <!------------------------------------------------------------------------------------------------------------------------------>
        <div class="form3 hidden">

            <div class="info_box">
                <label for="adresse">Adresse :</label>
                <input type="text" placeholder="" id="adresse" name="adresse" value="<?= recupInputValue('adresse');?>">
            </div>
            <span data-champ="adresse"></span>

            <div class="info_box">
                <label for="ville">Ville :</label>
                <input type="text" placeholder="" id="ville" name="ville" value="<?= recupInputValue('ville');?>">
            </div>
            <span data-champ="ville"></span>

            <div class="info_box">
                <label for="codePostal">Code Postal :</label>
                <input type="text" placeholder="" id="codePostal" name="codePostal" value="<?= recupInputValue('codePostal');?>">
            </div>
            <span data-champ="codePostal"></span>


            <div class="info_box_button">
                <input class="button" type="submit" name="submitted" value="ENVOYER">
            </div>



        </div>





            <p>Les champs avec * sont requis</p>
            <a href="inscription/nourrice"><p>Vous souhaitez garder des enfants ? Inscrivez-vous <strong>ici</strong> !</p></a>
        </form>
    </div>
</section>

<?php
$this->endSection() ;


$this->section('js');
?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="../assets/js/inscription.js"></script>
<?php
$this->endSection() ;
