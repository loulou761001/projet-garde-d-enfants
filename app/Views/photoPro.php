<?= $this->extend('default') ?>

<?= $this->section('content');
if ($pro[0]['id'] != $_SESSION['user']['id']) { ?>
    <h1>Vous n'avez pas la permission d'accéder à cette page</h1>
    <a href="/">Retour à l'accueil</a>

<?php $this->endSection(); }
$pro = $pro[0];
if ($pro['id'] != $_SESSION['user']['id']) {
    return redirect()->to('/');
}
if ($pro['id'] == $_SESSION['user']['id']) { ?>
    <section id="photo_add">
        <div class="wrap">
            <form action="/profil/photo/<?= $pro['id'] ?>" method="post" enctype="multipart/form-data">
                <h1>Ajouter une photo de profil</h1>
                <div>
                    <label for="pfp">Votre photo (.jpg, .jpeg, .png)</label>
                    <input type="file" class="form-control" accept="image/*" name="file">
                </div>
                <input class="button" type="submit" name="submittedPhoto">
            </form>
        </div>
    </section>
<?php }
$this->endSection() ;
?>





<?= $this->section('js'); ?>


<?php
$this->endSection() ;