<?= $this->extend('default') ?>

<?= $this->section('content');
var_dump($parent);?>
<br><br>
<?=
var_dump($_SESSION);

if ($parent['id'] != $_SESSION['user']['id']) {

}
?>