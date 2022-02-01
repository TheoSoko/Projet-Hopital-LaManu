<?php
require 'controllers/ajout-patientCtrl.php';
include 'parts/header.php';
?> 




<div class="container">

    <div class="row text-center mainTitle">
        <div class="col">
            <H1 class="display-5">Ajout d'un nouveau patient</H1>
        </div>
    </div>

    <div class="row text-center blocForm">
        <div class="col">
            <form method="POST">

                <?php foreach ($inputArray as $input){?>
                    <div class="row formElement">
                        <div class="col">
                            <label for="<?= $input['name']?>"> <?= $input['label']?> </label>
                            <input type="<?= $input['type']?>" name="<?= $input['name']?>" id="<? $input['name']?>" required>
                        </div>
                        
                        <!--messages d'erreurs ; !-->
                        <?php if (!empty($errorList[$input['name']])){?>
                               <p class="pt-2 errorMessage"><?= $errorList[$input['name']] ?></p>
                        <?php } ?> 
                    </div>
                <?php } ?>
                <input type="submit" value="Ajout du patient" name="addPatient" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>


                



<?php include 'parts/footer.php';
