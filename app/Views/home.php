<?= $this->extend('default') ?>

<?= $this->section('content'); ?>
<section class="wrap">


    <div class="relative">
        <div class="flexslider">
            <ul class="slides">
                <li>
                    <img src="<?= base_url('assets/imgs/slide1.jpg'); ?>" />
                </li>
                <li>
                    <img src="<?= base_url('assets/imgs/slide2.jpg'); ?>" />
                </li>
                <li>
                    <img src="<?= base_url('assets/imgs/slide3.jpg'); ?>" />
                </li>

            </ul>
        </div>

        <div class="absolute" id="flexsliderTexte">
            <h2><i class="fa-solid fa-magnifying-glass"></i> Que recherchez-vous?</h2>
            <p>Je cherche :</p>
            <div class="flex sb">
                <div class="moitieTexte">
                    <h3>Un professionnel</h3>
                    <a href=""><p>S'inscrire en tant que parent</p></a>
                </div>
                <div class="moitieTexte">
                    <h3>Des enfants à garder</h3>
                    <a href=""><p>S'inscrire en tant que professionnel</p></a>
                </div>
            </div>
        </div>
    </div>
    <div class="flex sb" id="sectionCentrale">
        <div class="boite">
            <h2><i class="fa-solid fa-user-check"></i> Des profils confirmés!</h2>
            <p>Nous vérifions tous les profils de nounouos enregistrés et garantissons la sécurité de nos utilisateurs ! 😉</p>
        </div>
        <div class="boite">
            <h2><i class="fa-solid fa-medal"></i> Rapide et efficace!</h2>
            <p>Des milliers d’annonces chaque jours, pour les nounous comme pour la garde d’enfants ! 💼</p>
        </div>
        <div class="boite">
            <h2><i class="fa-solid fa-money-bills"></i> Et gratuit!</h2>
            <p>Parce que nous estimons que la garde d'enfants doit être accessible à tous, l’inscription sur Ticrocos est TOTALEMENT gratuite !💸</p>
        </div>
    </div>
    <h1>Des milliers de parents et de nounous recommendent notre site!</h1>
    <div class="flex boutonsAccueil">
        <div class="boutonAccueil" id="btnNounous">
            <p>Avis de nos nourices</p>
        </div>
        <div class="boutonAccueil" id="btnParents">
            <p>Avis de nos parents</p>
        </div>
    </div>
<!--    AVIS DES NOUNOUS-->
    <div class="avisNounous">
        <div class="avisSlider">
            <ul class="slides">
                <li class="avis">
                    <div class="flex">
                        <img src="<?= base_url('assets/imgs/smilef.png'); ?>" />
                        <div>
                            <p>Thérèse - nourice</p>
                            <p>Service efficace, je rencontre grâce à Ticrocos des gens formidables.</p>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </li>
                <li class="avis">
                    <div class="flex">
                        <img src="<?= base_url('assets/imgs/smilef.png'); ?>" />
                        <div>
                            <p>Nicole - nourice</p>
                            <p>Très bonne expérience, au niveau professionnel comme au personnel!</p>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                </li>
                <li class="avis">
                    <div class="flex">
                        <img src="<?= base_url('assets/imgs/smile.png'); ?>" />
                        <div>
                            <p>Etienne - nourice</p>
                            <p>J'utilise cette application pour donner facilement de mon temps libre tout en aidant les autres!</p>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
<!--    AVIS DES PARENTS-->
    <div class="avisNounous">
        <div class="avisSlider">
            <ul class="slides">
                <li class="avis">
                    <div class="flex">
                        <img src="<?= base_url('assets/imgs/smilef.png'); ?>" />
                        <div>
                            <p>Lucile - mère de 2 enfants</p>
                            <p>Service efficace, je rencontre grâce à Ticrocos des gens formidables.</p>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </li>
                <li class="avis">
                    <div class="flex">
                        <img src="<?= base_url('assets/imgs/smile.png'); ?>" />
                        <div>
                            <p>Clovis - père de la France</p>
                            <p>Très bonne expérience, au niveau professionnel comme au personnel!</p>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                </li>
                <li class="avis">
                    <div class="flex">
                        <img src="<?= base_url('assets/imgs/smilef.png'); ?>" />
                        <div>
                            <p>Louise - mère de 3 enfants</p>
                            <p>J'utilise cette application pour donner facilement de mon temps libre tout en aidant les autres!</p>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
<?php
//var_dump($parents);
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
    <script src="<?= base_url('assets/js/jquery.flexslider-min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/flexslider.js'); ?>"></script>


<?php
$this->endSection() ;
