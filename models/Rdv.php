<?php 
class Rdv 
{

private string $table = '`appointments`';
private PDO $db;
private string $dateHour;
private int $idPatients;


public function __construct()
{
    try {
        $this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root');
    } catch (Exception $error) {
        die($error->getMessage());
    }
}


public function addAppointments(): bool {
    $query = 'INSERT INTO ' . $this->table . '(`dateHour`, `idPatients`) VALUES (:dateHour, :idPatients) ';
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



public function setIdPatients($value){
    $this->idPatients = $value;
}
public function setDateHour($value){
    $this->dateHour = $value;
}

}

?>

