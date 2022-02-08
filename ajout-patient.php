<?php
require 'controllers/ajout-patientCtrl.php';
include 'parts/header.php';
?> 


<?php if (!isset($_POST['addPatient']) || !empty($errorList['addPatient'])) { ?>
    <div class="container">
        <div class="row text-center mainTitle">
            <div class="col">
                <H1 class="display-5">Ajout d'un nouveau patient</H1>
            </div>
        </div>

        <!-- Message patient déjà existant--> 
        <div class="text-center mb-4"> <p class="text-danger fw-bold fs-4"><?= !empty($errorList['addPatient']) ? $errorList['addPatient'] : '' ?></p> </div>             

        <div class="row text-center blocForm">
            <div class="col">
                <form method="POST">
                    <?php foreach ($inputArray as $input){?>
                        <div class="row formElement">
                            <div class="col">
                                <label for="<?= $input['name']?>"> <?= $input['label']?> </label>
                                <input type="<?= $input['type']?>" name="<?= $input['name']?>" id="<? $input['name']?>" value="<?= isset($placeHolderArray[$input['name']]) ? $placeHolderArray[$input['name']] : '' ?>" required>
                            </div>

                            <!--messages d'erreurs ; !-->
                            <?php if (!empty($errorList[$input['name']])){?>
                                <p class="pt-2 errorMessage"><?= $errorList[$input['name']] ?></p>
                            <?php } ?> 
                        </div>
                    <?php } ?>
                    <input type="submit" value="Ajout du patient" name="addPatient" class="btn btn-myColor">
                </form>
            </div>
        </div>
    </div>
<?php } ?>


<?php if (isset($_POST['addPatient']) && empty($errorList['addPatient'])) { ?>
        <div class="text-center">
            <p class="text-myColor fw-bold fs-3 mt-5">Le patient a bien été ajouté.</p>
        </div>
<?php }  ?>  
    







<?php include 'parts/footer.php';
