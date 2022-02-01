<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
  <title><?= isset($pageTitle) ? $pageTitle : 'Hopital Psy La Manu' ?></title>
</head>

<body>

<div class="row navigation">
    <div class="col navTitle">
        <a href="index.php" class="ps-4 h4">Hôpital psychiatrique La Manu</a>
    </div>
    <div class="col navList">
        <ul>
          <li><a href="ajout-patient.php">Ajout Patient</a></li>
        </ul>
    </div>
    <div class="col navList">
        <ul>
          <li><a href="liste-patients.php">Liste Patients</a></li>
        </ul>
    </div>
</div>