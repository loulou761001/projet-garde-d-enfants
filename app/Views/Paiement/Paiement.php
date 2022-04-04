<?= $this->extend('default') ?>

<?= $this->section('content'); ?>
<?php
debug($prix);
if (!empty($_POST)){
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
        'amount' => $prix,
        'currency' => 'eur',
        'description' => 'Discover France Guide by Erasmus of Paris',
        'receipt_email' => $email
    ));

}





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
                <p>Date de paiement</p>
            </div>
            <div>
                <p>Numéro de facture</p>
                <p><?php
                    $date1 = date('Y-m-d');
                    setlocale(LC_TIME, "fr_FR", "French");
                    echo strtoupper(strftime("%A %d %B %G", strtotime($date1))); ?></p>
                <p><?= strtoupper(strftime("%A %d %B %G", strtotime($date1))); ?></p>
            </div>
        </div>

        <div class="top3">
            <div>
                <p>Les Ticrocos</p>
                <p>lesticrocos@gmail.com</p>
            </div>
            <div>
                <p>Facturation à </p>
                <p>Adresse mail du client </p>
            </div>
        </div>

        <div class="prix">
           <h2><?= $prix ?>€ payé le <?= strtoupper(strftime("%A %d %B %G", strtotime($date1))); ?></h2>
            <p>Merci d'avoir choisi les Ticrocos pour la garde de vos enfants, nous vous en somme très reconnaissant !</p>
        </div>

        <div class="mid">
            <p>Description</p>

            <div class="table">

                <div class="col">
                    <p>Qté</p>
                    <p>Prix à l'unité</p>
                    <p>Montant </p>
                </div>

                <div class="col">
                    <p>Sous-total</p>
                    <p>prix</p>
                </div>

                <div class="col">
                    <p>Total</p>
                    <p>Prix</p>
                </div>

                <div class="col">
                    <p>Montant payé</p>
                    <p>Prix</p>
                </div>

            </div>

        </div>

        <div class="footer">
            <div class="separator"></div>
            <div class="info">
                <p>Numéro facture </p>
                <p> - <?= $prix ?>€</p>
                <p> payé le <?= strtoupper(strftime("%A %d %B %G", strtotime($date1))); ?></p>
            </div>
        </div>

    </div>
</section>

<section id="profil">
    <div class="wrap">
        <?php if(empty($_POST)){ ?>
        <form action="" method="POST">
            <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_test_51Kgr5DHwpow00Jhwb1OS9KRiMBEPPlaKY5nawfQLx1YiDlxL8SYL8oGQw2Bf5UBaKSt85URYXl8MxQsU70o6qRth004bCUa4Zh"
                data-amount="<?= $prix ?>>"
                data-name="Les Ticrocos"
                data-description="Paiement garde d'enfant"
                data-image="<?= base_url('assets/imgs/ticroco.png'); ?>"
                data-locale="auto"
                data-currency="eur"
                data-label="Appuyer ici pour procéder au paiement !" >
            </script>
        </form>
        <?php }else{ ?>
            <div class="success_paiement"><h1>Paiement accepté !</h1></div>
        <?php } ?>
    </div>
</section>


<?php
$this->endSection() ;
$this->section('js');?>

<?php $this->endSection() ;
?>


