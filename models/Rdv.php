<?php 
class Rdv 
{

private string $table = '`appointments`';
private PDO $db;
public string $dateHour;
private int $idPatients;
private int $id;


public function __construct()
{
    try {
        $this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root');
    } catch (Exception $error) {
        die($error->getMessage());
    }
}


public function addAppointment(): bool {
    $query = 'INSERT INTO ' . $this->table . '(`dateHour`, `idPatients`) VALUES (:dateHour, :idPatients)';
    $queryStatement = $this->db->prepare($query);
    $queryStatement->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
    $queryStatement->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
    return $queryStatement->execute();
}

public function checkIfAppointmentExists():bool{
    $query = 'SELECT COUNT(`dateHour`) as `number` FROM ' . $this->table . 'WHERE `dateHour` = :dateHour';
    $queryStatement = $this->db->prepare($query);
    $queryStatement->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
    $queryStatement->execute();
    //retourne un seul objet 
    $number = $queryStatement->fetch(PDO::FETCH_OBJ);
    //$number->truc correspond à 1 ou 0, true ou false.
    return $number->number ; 
}

public function getAppointmentsList():array{
    $query = 'SELECT DATE_FORMAT(`dateHour`, \'%d/%m/%Y %Hh%i\') AS `dateHourView`, `dateHour`, `id`' 
            . 'FROM `appointments` ORDER BY `dateHour` ASC';
    $queryStatement = $this->db->query($query);
    $queryStatement->execute();
    return $queryStatement->fetchAll(PDO::FETCH_OBJ);
}

public function getAppointment():object{
    $query = 'SELECT DATE_FORMAT(`dateHour`, \'%d/%m/%Y %Hh%i\') AS `dateHourView`, `dateHour`, CONCAT(`firstname`, \' \', `lastname`) AS `name`'
    . ', `lastname`, `firstname`, DATE_FORMAT(`birthdate`, \'%d/%m/%Y\') AS `birthdateView`, `birthdate`, `phone`, `mail`, ' . $this->table . '.`id` AS `id`' 
    . 'FROM' . $this->table 
    . 'JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id`'
    . 'WHERE'  . $this->table . '.`id` = :id';
    $queryStatement = $this->db->prepare($query);
    $queryStatement->bindValue(':id', $this->id, PDO::PARAM_STR);
    $queryStatement->execute();
    return $queryStatement->fetch(PDO::FETCH_OBJ);
}

/* SELECT `dateHour`, `firstname`, `lastname`, `birthdate` FROM 
`appointments`
JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id`
ORDER BY `dateHour` ASC; */

public function appointmentUpdate():bool{
    $query = 'UPDATE' . $this->table . 'SET `dateHour` = :dateHour WHERE `id` = :id';
    $queryStatement = $this->db->prepare($query);
    $queryStatement->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
    $queryStatement->bindValue(':id', $this->id, PDO::PARAM_STR);
    return $queryStatement->execute();
}

public function getAppointmentListByPatient():array{
    $query = 'SELECT DATE_FORMAT(`dateHour`, \'%d/%m/%Y %Hh%i\') AS `dateHourView`'
            . 'FROM ' . $this->table 
            . 'WHERE idPatients = :idPatient';
    $queryStatement = $this->db->prepare($query);
    $queryStatement->bindValue(':idPatient', $this->idPatients, PDO::PARAM_STR);
    $queryStatement->execute();
    return $queryStatement->fetchAll(PDO::FETCH_OBJ);
}

public function deleteAppointment():bool{
    $query = 'DELETE FROM ' . $this->table . ' WHERE `id` = :id';
    $queryStatement = $this->db->prepare($query);
    $queryStatement->bindValue(':id', $this->id, PDO::PARAM_STR);
    return $queryStatement->execute();
}


public function setId(int $value){
    $this->id = $value;
}
public function setIdPatients(int $value){
    $this->idPatients = $value;
}
public function setDateHour(string $value){
    $this->dateHour = $value;
}

public function getId(){
    return $this->id;
}
}

?>

