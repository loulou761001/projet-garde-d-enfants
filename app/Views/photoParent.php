<?= $this->extend('default') ?>

<?= $this->section('content');
if ($parent[0]['id'] != $_SESSION['user']['id']) { ?>
    <p></p>
    <a href="/">Retour à l'accueil</a>

<?php $this->endSection(); }
$parent = $parent[0];
if ($parent['id'] != $_SESSION['user']['id']) {
    return redirect()->to('/');
}
if ($parent['id'] == $_SESSION['user']['id']) { ?>
    <section class="wrap">
        <form action="/inscription/photo/<?= $parent['id'] ?>" method="post" enctype="multipart/form-data">
            <h1>Ajouter une photo de profil</h1>
            <label for="pfp">Votre photo (.jpg, .jpeg, .png)</label>
            <input type="file" class="form-control" accept="image/*" name="file">
            <input type="submit" name="submittedPhoto">
        </form>
    </section>
<?php }
$this->endSection() ;
?>





<?= $this->section('js'); ?>


<?php
$this->endSection() ;