<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ticrocos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url('/assets/css/style.css'); ?>" />
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
                <a href="">Inscription</a>
                <a href="">Connexion</a>
            </div>
        </li>
    </ul>

</header>
<?= $this->renderSection('content') ?>
</body>
<?= $this->renderSection('js') ?>
</html>