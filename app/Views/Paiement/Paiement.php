<?= $this->extend('default') ?>

<?= $this->section('content'); ?>
<?php
debug($prix);
if (!empty($_POST)){
    require_once('../../../vendor/stripe/stripe-php/init.php');

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

    echo '<h1>Payment accepted!</h1>';
}


?>
<section id="profil">
    <div class="wrap">
        <form action="" method="POST">
            <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_test_51Kgr5DHwpow00Jhwb1OS9KRiMBEPPlaKY5nawfQLx1YiDlxL8SYL8oGQw2Bf5UBaKSt85URYXl8MxQsU70o6qRth004bCUa4Zh"
                data-amount="<?= $prix ?>>"
                data-name="Les Ticrocos"
                data-description="Paiement garde d'enfant"
                data-image="https://www.erasmusofparis.com/up/erasmus-of-paris.jpg"
                data-locale="auto"
                data-currency="eur"
                data-label="Appuyer ici pour procéder au paiement !" >
            </script>
        </form>

    </div>
</section>



<?php
$this->endSection() ;
$this->section('js');?>

<?php $this->endSection() ;
?>


