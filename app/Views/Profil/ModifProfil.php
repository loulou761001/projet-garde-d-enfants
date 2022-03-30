<?= $this->extend('default') ?>

<?= $this->section('content'); ?>



<section id="profil">
    <div class="wrap">
        <?php
        if (!empty($erreurs)){
        if(!empty($erreurs == 'Mauvais mot de passe')){ ?>
            <div class="erreur_enfant"><p>Il y a eu une erreur lors de l'ajout de votre enfant sur votre compte, vérifiez les erreurs sur le formulaire d'inscription.</p></div>
        <?php  }}?>


        <div class="profil_top">
            <div class="profil_pp">
                <?php if(!empty($parent[0]['parent_photo'])){
                    echo'afficher photo';
                } else {?>
                    <a href=""><img class="img" src="<?= base_url('assets/imgs/pp_basique.svg'); ?>"></a>
                <?php } ?>
            </div>
            <div class="profil_intro">


                <?php if ($_SESSION['user']['status']=='parent'){ ?>

                    <h2 class="titre">Bienvenue sur votre profil <?= $parent[0]['parent_prenom']?> !</h2>

                <?php }elseif ($_SESSION['user']['status']=='professionnel'){ ?>

                    <h2 class="titre">Bienvenue sur votre profil <?= $pro[0]['pro_prenom']?> !</h2>

                <?php   } ?>

            </div>
        </div>

        <div class="separator"></div>

        <div class="profil_mid">

            <h2 class="titre">Informations :</h2>

            <?php if ($_SESSION['user']['status']=='parent'){ ?>

               <div class="box_form">
                   <form action="" method="post" class="wrapform" novalidate>

                       <div class="modif_box">
                           <label for="nom">Nom* :</label>
                           <input type="text" placeholder="Ex : Dupont" id="nom" name="nom" value="<?php if(!empty($parent[0]['parent_nom'])){echo $parent[0]['parent_nom']; } ?>">
                           <?php if(!empty($erreurs['nom'])){ ?>
                               <span class="erreur"> <?= $erreurs['nom'] ?></span>
                           <?php } ?>
                       </div>

                       <div class="modif_box">
                           <label for="prenom">Prenom* :</label>
                           <input type="text" placeholder="Ex : Louise" id="prenom" name="prenom" value="<?php if(!empty($parent[0]['parent_prenom'])){echo $parent[0]['parent_prenom']; } ?>">
                           <?php if(!empty($erreurs['prenom'])){ ?>
                               <span class="erreur"> <?= $erreurs['prenom'] ?></span>
                           <?php } ?>
                       </div>

                       <div class="modif_box">
                           <label for="email">Email* :</label>
                           <input type="email" placeholder="Ex: louis.dupont@gmail.com" id="email" name="email" value="<?php if(!empty($parent[0]['parent_email'])){echo $parent[0]['parent_email'];} ?>">
                           <?php if(!empty($erreurs['email'])){ ?>
                               <span class="erreur"> <?= $erreurs['email'] ?></span>
                           <?php } ?>
                       </div>


                       <div class="modif_box">
                           <label for="tel"> Téléphone* : </label>
                           <input type="tel" placeholder="Ex : 06 01 02 03 04 " pattern="[0-9]{10}" maxlength="10" id="tel" name="tel" value="<?php if(!empty($parent[0]['parent_tel'])){echo '0'.$parent[0]['parent_tel']; } ?>">
                           <?php if(!empty($erreurs['tel'])){ ?>
                               <span class="erreur"> <?= $erreurs['tel'] ?></span>
                           <?php } ?>
                       </div>

                       <div class="modif_box">
                           <label for="numAdresse">Numéro dans la voie* :</label>
                           <input type="text" placeholder="Ex : 05, 05 BIS" id="numAdresse" name="numAdresse" value="<?php if(!empty($parent[0]['parent_numAdresse'])){echo $parent[0]['parent_numAdresse']; } ?>">
                           <?php if(!empty($erreurs['numAdresse'])){ ?>
                               <span class="erreur"> <?= $erreurs['numAdresse'] ?></span>
                           <?php } ?>
                       </div>

                       <div class="modif_box">
                           <label for="adresse">libellé de la voie* :</label>
                           <input type="text" placeholder="Ex : Rue Albert Premier" id="adresse" name="adresse" value="<?php if(!empty($parent[0]['parent_adresse'])){echo $parent[0]['parent_adresse']; } ?>">
                           <?php if(!empty($erreurs['adresse'])){ ?>
                               <span class="erreur"> <?= $erreurs['adresse'] ?></span>
                           <?php } ?>
                       </div>



                       <div class="modif_box">
                           <label for="ville">Ville* :</label>
                           <input type="text" placeholder="" id="ville" name="ville" value="<?php if(!empty($parent[0]['parent_ville'])){echo $parent[0]['parent_ville']; } ?>">
                           <?php if(!empty($erreurs['ville'])){ ?>
                               <span class="erreur"> <?= $erreurs['ville'] ?></span>
                           <?php } ?>
                       </div>

                       <div class="modif_box">
                           <label for="codePostal">Code Postal* :</label>
                           <input type="text" placeholder="" id="codePostal" name="codePostal" value="<?php if(!empty($parent[0]['parent_postal'])){echo $parent[0]['parent_postal']; } ?>">
                           <?php if(!empty($erreurs['codePostal'])){ ?>
                               <span class="erreur"> <?= $erreurs['codePostal'] ?></span>
                           <?php } ?>
                       </div>

                       <div class="modif_box">
                           <label for="modifsAdresse">Informations complémentaires (facultatif) :</label>
                           <input type="text" placeholder="Ex : Appartement 51" id="modifsAdresse" name="modifsAdresse" value="<?php if(!empty($parent[0]['parent_modifsAdresse'])){echo $parent[0]['parent_modifsAdresse']; } ?>">
                           <?php if(!empty($erreurs['modifsAdresse'])){ ?>
                               <span class="erreur"> <?= $erreurs['modifsAdresse'] ?></span>
                           <?php } ?>
                       </div>

                       <div class="modif_box">
                           <label for="password">Confirmez les changements avec votre mot de passe :</label>
                           <input type="password" placeholder="Votre mot de passe..." id="password" name="password" value="">
                           <?php if(!empty($erreurs['modifsAdresse'])){ ?>
                               <span class="erreur"> <?= $erreurs['modifsAdresse'] ?></span>
                           <?php } ?>
                       </div>

                       <a href="/motdepasse/profil/modifier">Changer de mot de passe ?</a>


                       <input class="button" type="submit" name="submitted" value="ENVOYER">

                       <p>Les champs avec * sont requis</p>
                   </form>
               </div>

            <?php }elseif ($_SESSION['user']['status']=='professionnel'){ ?>
                <form action="" method="post" class="wrapform" novalidate>


                    <div class="modif_box">
                        <label for="nom">Nom* :</label>
                        <input type="text" placeholder="Ex : Dupont" id="nom" name="nom" value="<?php if(!empty($pro[0]['pro_nom'])){echo $pro[0]['pro_nom']; } ?>">
                        <?php if(!empty($erreurs['nom'])){ ?>
                            <span class="erreur"> <?= $erreurs['nom'] ?></span>
                        <?php } ?>
                    </div>

                    <div class="modif_box">
                        <label for="prenom">Prenom* :</label>
                        <input type="text" placeholder="Ex : Louise" id="prenom" name="prenom" value="<?php if(!empty($pro[0]['pro_prenom'])){echo $pro[0]['pro_prenom']; } ?>">
                        <?php if(!empty($erreurs['prenom'])){ ?>
                            <span class="erreur"> <?= $erreurs['prenom'] ?></span>
                        <?php } ?>
                    </div>

                    <div class="modif_box">
                        <label for="email">Email* :</label>
                        <input type="email" placeholder="Ex: louis.dupont@gmail.com" id="email" name="email" value="<?php if(!empty($pro[0]['pro_email'])){echo $pro[0]['pro_email'];} ?>">
                        <?php if(!empty($erreurs['email'])){ ?>
                            <span class="erreur"> <?= $erreurs['email'] ?></span>
                        <?php } ?>
                    </div>


                    <div class="modif_box">
                        <label for="tel"> Téléphone* : </label>
                        <input type="tel" placeholder="Ex : 06 01 02 03 04 " pattern="[0-9]{10}" maxlength="10" id="tel" name="tel" value="<?php if(!empty($pro[0]['pro_telephone'])){echo '0'.$pro[0]['pro_telephone']; } ?>">
                        <?php if(!empty($erreurs['tel'])){ ?>
                            <span class="erreur"> <?= $erreurs['tel'] ?></span>
                        <?php } ?>
                    </div>

                    <div class="modif_box">
                        <label for="numAdresse">Numéro dans la voie* :</label>
                        <input type="text" placeholder="Ex : 05, 05 BIS" id="numAdresse" name="numAdresse" value="<?php if(!empty($pro[0]['pro_numAdresse'])){echo $pro[0]['pro_numAdresse']; } ?>">
                        <?php if(!empty($erreurs['numAdresse'])){ ?>
                            <span class="erreur"> <?= $erreurs['numAdresse'] ?></span>
                        <?php } ?>
                    </div>

                    <div class="modif_box">
                        <label for="adresse">libellé de la voie* :</label>
                        <input type="text" placeholder="Ex : Rue Albert Premier" id="adresse" name="adresse" value="<?php if(!empty($pro[0]['pro_adresse'])){echo $pro[0]['pro_adresse']; } ?>">
                        <?php if(!empty($erreurs['adresse'])){ ?>
                            <span class="erreur"> <?= $erreurs['adresse'] ?></span>
                        <?php } ?>
                    </div>



                    <div class="modif_box">
                        <label for="ville">Ville* :</label>
                        <input type="text" placeholder="" id="ville" name="ville" value="<?php if(!empty($pro[0]['pro_ville'])){echo $pro[0]['pro_ville']; } ?>">
                        <?php if(!empty($erreurs['ville'])){ ?>
                            <span class="erreur"> <?= $erreurs['ville'] ?></span>
                        <?php } ?>
                    </div>

                    <div class="modif_box">
                        <label for="codePostal">Code Postal* :</label>
                        <input type="text" placeholder="" id="codePostal" name="codePostal" value="<?php if(!empty($pro[0]['pro_postal'])){echo $pro[0]['pro_postal']; } ?>">
                        <?php if(!empty($erreurs['codePostal'])){ ?>
                            <span class="erreur"> <?= $erreurs['codePostal'] ?></span>
                        <?php } ?>
                    </div>

                    <div class="modif_box">
                        <label for="modifsAdresse">Informations complémentaires (facultatif) :</label>
                        <input type="text" placeholder="Ex : Appartement 51" id="modifsAdresse" name="modifsAdresse" value="<?php if(!empty($pro[0]['pro_modifsAdresse'])){echo $pro[0]['pro_modifsAdresse']; } ?>">
                        <?php if(!empty($erreurs['modifsAdresse'])){ ?>
                            <span class="erreur"> <?= $erreurs['modifsAdresse'] ?></span>
                        <?php } ?>
                    </div>

                        <?php if ($pro[0]['pro_categorie'] !='Nourrice'){ ?>
                            <div class="modif_box">
                                <label for="entreprise">Nom de l'entreprise :</label>
                                <input type="text" placeholder="" id="entreprise" name="entreprise" value="<?php if(!empty($pro[0]['pro_entreprise'])){echo $pro[0]['pro_entreprise']; } ?>">
                                <?php if(!empty($erreurs['entreprise'])){ ?>
                                    <span class="erreur"> <?= $erreurs['entreprise'] ?></span>
                                <?php } ?>
                            </div>

                            <div class="modif_box">
                                <label for="siret">N° Siret :</label>
                                <input type="text" placeholder="" id="siret" name="siret" value="<?php if(!empty($pro[0]['pro_siret'])){echo $pro[0]['pro_siret']; } ?>">
                                <?php if(!empty($erreurs['siret'])){ ?>
                                    <span class="erreur"> <?= $erreurs['siret'] ?></span>
                                <?php } ?>
                            </div>

                        <?php }?>




                        <div class="modif_box">
                            <label for="tauxHorraire">Taux Horaire</label>
                            <div class="tauxHoraire_modif">
                                <input type="number" id="tauxHorraire" name="tauxHorraire" min="0" value="<?= $pro[0]['pro_taux_horaire'] ?>">
                                <?php if(!empty($erreurs['pro_taux_horaire'])){ ?>
                                    <span class="erreur"> <?= $erreurs['pro_taux_horaire'] ?></span>
                                <?php } ?>
                            </div>
                        </div>


                        <div class="modif_box">
                            <label for="description">Description (facultatif, recommandé) : </label>
                            <textarea name="description" id="description"><?php if(!empty($pro[0]['pro_description'])){echo $pro[0]['pro_description']; } ?></textarea>
                        </div>

                    <div class="modif_box">
                        <label for="password">Confirmez les changements avec votre mot de passe :</label>
                        <input type="text" placeholder="Votre mot de passe..." id="password" name="password" value="">
                        <?php if(!empty($erreurs['modifsAdresse'])){ ?>
                            <span class="erreur"> <?= $erreurs['modifsAdresse'] ?></span>
                        <?php } ?>
                    </div>

                        <input id="dernierSubmit" class="button" type="submit" name="submitted" value="ENVOYER">
                    <p>Les champs avec * sont requis</p>
                </form>
            <?php   } ?>
        </div>
        <div class="separator"></div>
</section>



<?php
$this->endSection() ;
$this->section('js');?>
<script src="../assets/js/profil.js"></script>
<?php $this->endSection() ;
?>


