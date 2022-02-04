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


public function addAppointments() {
    $query = 'INSERT INTO ' . $this->table . '(`dateHour`, `idPatients`) VALUES (:dateHour, :idPatients) ';
    $queryStatement = $this->db->prepare($query);
    $queryStatement->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
    $queryStatement->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
    $queryStatement->execute();
}


public function setIdPatients($value){
    $this->idPatients = $value;
}
public function setDateHour($value){
    $this->dateHour = $value;
}

}


?>