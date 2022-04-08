<?= $this->extend('default') ?>

<?= $this->section('content'); ?>
<?php

if (!empty($_POST['stripeToken'])){
    require_once('../vendor/stripe/stripe-php/init.php');

    \Stripe\Stripe::setApiKey("sk_test_51Kgr5DHwpow00Jhwlm0Qx5BL8dkVLsg7zPAxjKMwBaw8b2C2NEvmSvT0vDUksCD9zKdzIMUjVAd6vrKlhWErq8Lb00MIgyvt9R");

    $token = $_POST['stripeToken'];
    $email = $_POST['stripeEmail'];

    $customer = \Stripe\Customer::create(array(
        'email' => $email,
        'source' => $token
    ));

    $charge = \Stripe\Charge::create(array(
        'customer' => $customer->id,
        'amount' => $prix*100,
        'currency' => 'eur',
        'description' => 'Discover France Guide by Erasmus of Paris',
        'receipt_email' => $email
    ));

}
$fmt = datefmt_create(
    'fr_FR',
    IntlDateFormatter::LONG,
    IntlDateFormatter::NONE,
    'Europe/Paris',
    IntlDateFormatter::GREGORIAN
);
$date1 = datefmt_format($fmt, time());
debug($date1);
?>

<section id="facture">
    <div class="wrap">

        <div class="top">
            <h2>Garde d'enfant(s)</h2>
           <img class="img" src="<?= base_url('assets/imgs/ticroco.png'); ?>">
        </div>

        <div class="top2">
            <div>
                <p>Numéro de facture :</p>
                <p>Date d'envoi :</p>
                <p>Date de paiement :</p>
            </div>
            <div>
                <p>Numéro de facture</p>
                <p><?php
                    $date1 = date('Y-m-d');
                    setlocale(LC_TIME, "fr_FR", "French");
                    echo strtoupper(datefmt_format($fmt, time())); ?></p>
                <p><?= strtoupper(datefmt_format($fmt, time())); ?></p>
            </div>
        </div>

        <div class="top3">
            <div>
                <p>Les Ticrocos</p>
                <p>lesticrocos@gmail.com</p>
            </div>
            <div>
                <p>Facturation à </p>
                <p><?= $_SESSION['user']['email'] ?></p>
            </div>
        </div>

        <div class="prix">
           <h2><?= $prix ?>€ payé le <?= (datefmt_format($fmt, time())); ?></h2>
            <p>Merci d'avoir choisi les Ticrocos pour la garde de vos enfants, nous vous en somme très reconnaissant !</p>
        </div>

        <div class="mid">
            <p>Description</p>

            <div class="table">

                <div class="col">
                    <p>Qté</p>
                    <p>Prix unitaire : <?= $prix_unite ?>€</p>
                    <p>Quantité : <?= $quantite ?></p>
                </div>

                <div class="col">
                    <p>Hors taxes</p>
                    <p><?= round($prix/1.07,2)  ?>€</p>
                </div>

                <div class="col">
                    <p>Total TTC</p>
                    <p><?= $prix ?>€</p>
                </div>


            </div>

        </div>

        <div class="footer">
            <div class="separator"></div>
            <div class="info">
                <p>Numéro facture : <?= $facture ?> </p>
                <p> - <?= $prix ?>€ | </p>
                <p>| payé le <?= datefmt_format($fmt, time()); ?></p>
            </div>
        </div>

    </div>
</section>

<section id="profil">
    <div class="wrap">
        <?php if(empty($_POST['stripeToken'])){ ?>
        <form action="" method="post">
            <?php
            foreach ($_POST as $key => $value) {
            echo '<input type="text" class="hidden" value="'. $value .'" name="'. $key .'" id="'. $key .'">';
            } ?>
            <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_test_51Kgr5DHwpow00Jhwb1OS9KRiMBEPPlaKY5nawfQLx1YiDlxL8SYL8oGQw2Bf5UBaKSt85URYXl8MxQsU70o6qRth004bCUa4Zh"
                data-amount="<?= $prix*100 ?>"
                data-name="Les Ticrocos"
                data-description="Paiement garde d'enfant"
                data-image="<?= base_url('assets/imgs/ticroco.png'); ?>"
                data-locale="auto"
                data-currency="eur"
                data-label="Appuyer ici pour procéder au paiement !" >
            </script>
        </form>
        <?php }else{ ?>
            <form action="/dispoDetails" method="post">
                <?php
                foreach ($_POST as $key => $value) {
                    echo '<input type="text" class="hidden" value="'. $value .'" name="'. $key .'" id="'. $key .'">';
                } ?>
            <button class="factureBtn">Cliquez ici pour télécharger votre facture.</button>

            <div class="success_paiement"><h1>Paiement accepté !</h1><h2><input type="submit" value="Cliquez ici pour accéder à vos réservations"></h2></div>
            </form>
        <?php
        } ?>
    </div>
</section>


<?php
$this->endSection() ;
$this->section('js');?>
<script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
</script>
<script src="../assets/js/pdf/jspdf.debug.js"></script>
<script src="../assets/js/pdf/html2canvas.min.js"></script>
<script src="../assets/js/pdf/html2pdf.min.js"></script>
<script src="../assets/js/pdf/domtopdf.js"></script>

<?php $this->endSection();
?>


