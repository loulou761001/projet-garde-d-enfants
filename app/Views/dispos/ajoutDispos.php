<?=
$this->extend('default');
$this->section('content');
?>
<section class="wrap">
    <form action="" method="post" class="formAjoutDispo">
        <label for="date">Date de disponibilité :</label>
        <input type="date" id="date" name="date" required>
        <div class="flex listeHeures">
             <div>
                <input type="checkbox" value="00-01" name="00-01" id="00-01">
                <label for="00-01">00h-01h</label>
                <input type="checkbox" name="01-02" value="01-02" id="01-02">
                <label for="01-02">01h-02h</label>
                <input type="checkbox" name="02-03" value="02-03" id="02-03">
                <label for="02-03">03h-04h</label>
                <input type="checkbox" name="03-04" value="03-04" id="03-04">
                <label for="03-04">04h-05h</label>
                <input type="checkbox" name="04-05" value="04-05" id="04-05">
                <label for="04-05">05h-06h</label>
                <input type="checkbox" name="05-06" value="05-06" id="05-06">
                <label for="05-06">05h-06h</label>
            </div>
            <div>
                <input type="checkbox" name="06-07" value="06-07" id="06-07">
                <label for="06-07">06h-07h</label>
                <input type="checkbox" name="07-08" value="07-08" id="07-08">
                <label for="07-08">07h-08h </label>
                <input type="checkbox" name="08-09" value="08-09" id="08-09">
                <label for="08-09">08h-09h</label>
                <input type="checkbox" name="09-10" value="09-10" id="09-10">
                <label for="09-10">09h-10h</label>
                <input type="checkbox" name="10-11" value="10-11" id="10-11">
                <label for="10-11">10h-11h</label>
                <input type="checkbox" name="11-12" value="11-12" id="11-12">
                <label for="11-12">11h-Midi</label>
            </div>
            <div>
                <input type="checkbox" value="12-13" name="12-13" id="12-13">
                <label for="12-13">Midi-13h</label>
                <input type="checkbox" name="13-14" value="13-14" id="13-14">
                <label for="13-14">13h-14h</label>
                <input type="checkbox" name="14-15" value="14-15" id="14-15">
                <label for="14-15">14h-15h</label>
                <input type="checkbox" name="15-16" value="15-16" id="15-16">
                <label for="15-16">15h-16h</label>
                <input type="checkbox" name="16-17" value="16-17" id="16-17">
                <label for="16-17">16h-17h</label>
                <input type="checkbox" name="17-18" value="17-18" id="17-18">
                <label for="17-18">17h-18h</label>
            </div>
            <div>
                <input type="checkbox" name="18-19" value="18-19" id="18-19">
                <label for="18-19">18h-19h</label>
                <input type="checkbox" name="19-20" value="19-20" id="19-20">
                <label for="19-20">19h-20h</label>
                <input type="checkbox" name="20-21" value="20-21" id="20-21">
                <label for="20-21">20h-21h </label>
                <input type="checkbox" name="21-22" value="21-22" id="21-22">
                <label for="21-22">21h-22h</label>
                <input type="checkbox" name="22-23" value="22-23" id="22-23">
                <label for="22-23">22h-23h</label>
                <input type="checkbox" name="10-11" value="23-24" id="23-24">
                <label for="23-24">23h-Minuit</label>
            </div>
        </div>
        <label for="places"> Nombre de places disponibles :</label>
        <input type="number" min="1" name="places" id="places" placeholder="nombre de place" required>
        <input type="submit" class="envoieDispo">
    </form>

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
<?php
$this->endSection() ;
