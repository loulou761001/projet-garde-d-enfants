<?= $this->extend('default') ?>

<?= $this->section('content'); ?>
<section class="wrap">


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

<?php
var_dump($parents);
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
