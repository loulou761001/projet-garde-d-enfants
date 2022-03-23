<?php session_start() ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ticrocos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url('/assets/css/style.css'); ?>" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('/assets/css/flexslider-rtl.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url('/assets/css/flexslider.css'); ?>" type="text/css">

</head>
<body>

<header>
    <ul class="flex wrap sb">
        <li>
            <a href="home"><img src="<?= base_url('assets/imgs/ticrocos_logo.svg'); ?>" alt="Logo Ticrocos"></a>
        </li>
        <li>
            <div class="flex">
                <a href="/inscription">Inscription</a>
                <a href="">Connexion</a>
            </div>
        </li>
    </ul>

</header>
<?= $this->renderSection('content') ?>

<footer>

    <div class="diagVerte"></div>
    <div class="footerContent">
        <div class="wrap flex">

            <div class="logoFooter">
                <a href="/"><img src="<?= base_url('assets/imgs/ticrocos_logo.svg'); ?>" alt="Logo Ticrocos"></a>
            </div>

            <div class="separator"></div>

            <div class="navFooter">
                <ul>
                    <li><a href="conditions">Mentions Légales</a></li>
                    <li><a href="vieprive">Vie privée</a></li>
                    <li><a href="">S'inscire / Se connecter</a></li>
                </ul>
            </div>

            <div class="separator"></div>

            <div class="reseauxFooter">
                <a href=""><i class="fa-brands fa-twitter"></i></a>
            </div>
        </div>
    </div>

</footer>
</body>
<?= $this->renderSection('js') ?>
</html>