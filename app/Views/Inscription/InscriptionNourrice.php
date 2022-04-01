<?php
include_once ('inc/fonctions.php');
$errors=[];

if (isLogged()==true){
    header('Location: /');
    exit();
}
?>

<?= $this->extend('default') ?>

<?= $this->section('content'); ?>

    <section id="formulaire">
        <div class="wrap">

            <div class="filAriane flex">
                <button class="btnEtape1">1</button>
                <div class="arianeSep"></div>
                <button class="btnEtape2">2</button>
                <div class="arianeSep"></div>
                <button class="btnEtape3">3</button>
            </div>

            <h2>Inscription :</h2>

            <form action="" method="post" class="wrapform" enctype="multipart/form-data" novalidate>

                <div class="form1">
                    <div class="info_box">
                        <label for="email">Adresse mail* :</label>
                        <input type="email" placeholder="Ex : louis.dupont@gmail" id="email" name="email" value="<?= recupInputValue('email'); ?>">
                    </div>
                    <span data-champ="email"></span>

                    <div class="info_box">
                        <label for="password">Mot de passe* :</label>
                        <input type="password" placeholder="*********" id="password" name="password" value="">
                    </div>

                    <div class="info_box">
                        <label for="password2">Valider votre mot de passe* :</label>
                        <input type="password" placeholder="*********" id="password2" name="password2" value="">
                    </div>

                    <span data-champ="motDePasse"></span>

                    <button id="jsButton1">Suivant <i class="fa-solid fa-arrow-right"></i></button>

                </div>

                <!------------------------------------------------------------------------------------------------------------------------------>

                <div class="form2 hidden">
                    <div class="info_box">
                        <label for="nom">Nom* :</label>
                        <input type="text" placeholder="Ex: Dupont" id="nom" name="nom" value="<?= recupInputValue('nom');?>">
                    </div>
                    <span data-champ="nom"></span>

                    <div class="info_box">
                        <label for="prenom">Prénom* :</label>
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
                        <label for="numAdresse">Numéro dans la voie :</label>
                        <input type="text" placeholder="Ex : 05, 05 BIS" id="numAdresse" name="numAdresse" value="<?= recupInputValue('numAdresse');?>">
                    </div>
                    <span data-champ="numAdresse"></span>

                    <div class="info_box">
                        <label for="adresse">libellé de la voie :</label>
                        <input type="text" placeholder="Ex : Rue Albert Premier" id="adresse" name="adresse" value="<?= recupInputValue('adresse');?>">
                    </div>
                    <span data-champ="adresse"></span>

                    <div class="info_box">
                        <label for="infosAdresse">Informations complémentaires (facultatif) :</label>
                        <input type="text" placeholder="Ex : Appartement 51" id="infosAdresse" name="infosAdresse" value="<?= recupInputValue('infosAdresse');?>">
                    </div>
                    <span data-champ="infosAdresse"></span>

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

                    <div class="info_box">
                        <label for="categorie">Catégorie :</label>
                        <select name="categorie" id="categorie">
                            <option value="Nourrice">Nourrice à domicile</option>
                            <option value="Garderie">Garderie</option>
                            <option value="Creche">Crèche</option>
                        </select>
                    </div>
                    <span data-champ="categorie"></span>

                    <div class="info_box identite">
                        <label for="identite">Piece d'identité (image ou pdf) :</label>
                        <input type="file" placeholder="" id="identite" name="identite">
                    </div>
                    <span data-champ="entreprise"></span>

                    <div class="info_box entreprise hidden">
                        <label for="entreprise">Nom de l'entreprise :</label>
                        <input type="text" placeholder="" id="entreprise" name="entreprise" value="<?= recupInputValue('entreprise');?>">
                    </div>
                    <span data-champ="entreprise"></span>

                    <div class="info_box siret hidden">
                        <label for="siret">Numéro de siret :</label>
                        <input type="text" placeholder="" id="siret" name="siret" value="<?= recupInputValue('siret');?>">
                    </div>
                    <span data-champ="siret"></span>

                    <div class="info_box">
                        <label for="tauxHorraire">Taux Horaire</label>
                        <div class="tauxHoraire">
                            <input type="number" id="tauxHorraire" name="tauxHorraire" min="0">
                            <p>€/h</p>
                        </div>
                    </div>
                    <span data-champ="tauxHorraire"></span>

                    <div class="info_box">
                        <label for="description">Description (facultatif, recommandé) : </label>
                        <textarea name="description" id="description"></textarea>
                    </div>
                    <span data-champ="description"></span>

                    <input id="dernierSubmit" class="button" type="submit" name="submitted" value="ENVOYER">

                </div>

                <p>Les champs avec * sont requis</p>
                <a href="/inscription"><p>Vous êtes un parent et vous voulez faire garder vos enfants ? Inscrivez-vous <strong>ici</strong> !</p></a>
            </form>
        </div>
    </section>

<?php
$this->endSection() ;


$this->section('js');
?>
    <script>var base_url = '<?php echo base_url() ?>';</script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="../assets/js/inscriptionPro.js"></script>

    <script src="../assets/js/geosearchMap.js"></script>
<?php
$this->endSection() ;
