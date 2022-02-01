<?php
class Patients
{
    public int $id;
    private string $lastname;
    private string $firstname;
    private string $birthdate;
    private string $phone;
    private string $mail;
    private PDO $db;
    private string $table = '`patients`';

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root');
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }


    public function addPatient(): bool
    {
        $query = 'INSERT INTO ' . $this->table
            . ' (`lastname`,`firstname`,`birthdate`,`phone`,`mail`) '
            . 'VALUES (:lastname, :firstname, :birthdate, :phone, :mail)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryStatement->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $queryStatement->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $queryStatement->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        return $queryStatement->execute();
    }
    /**
     * Permet de savoir si un patient est unique
     *
     * @return boolean
     */
    public function checkPatientIfExists(): bool
    {
        $check = false;
        $query = 'SELECT COUNT(`id`) AS `number` FROM ' . $this->table
            . ' WHERE `lastname` = :lastname AND `firstname` = :firstname AND `birthdate` = :birthdate';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryStatement->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $queryStatement->execute();
        // $number = $queryStatement->fetch(PDO::FETCH_OBJ)->number;
        $toto = $queryStatement->fetch(PDO::FETCH_OBJ);
        // number = 0 si il n'y a pas de patient identique
        // number = 1 si il y a un patient identique
        $number = $toto->number;
        if ($number) {
            $check = true;
        }
        return $check;
    }

    //Récupère tous les patients existant dans la base de donnée.
    public function patientsList(): array{
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, \'%d/%m/%Y\') AS `birthdate` FROM ' . $this->table;
        $queryStatement = $this->db->query($query);
        $patientsList = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $patientsList;
    }




    //Récupère les informations d'un patient unique.
    public function patientInfo(): object{
        $query = 'SELECT `lastname`, `firstname`, DATE_FORMAT(`birthdate`, \'%d/%m/%Y\') AS `birthdate`, `phone`, `mail` FROM ' . $this->table 
            . ' WHERE `id` = :id ';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $patient = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $patient ;
    }

    //Modifie les information d'un patient.
    public function patientUpdate($leTrucQuiChange, $laNouvelleValeur ): bool{
        $query = 'UPDATE ' . $this->table . ' SET ' . $leTrucQuiChange . ' = ' . $laNouvelleValeur . ' WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryStatement->execute();
    }






    public function setLastname(string $value): void
    {
        $this->lastname = strtoupper($value);
    }

    public function setFirstname(string $value): void
    {
        $this->firstname = $value;
    }

    public function setBirthdate(string $value): void
    {
        $this->birthdate = $value;
    }

    public function setPhone(string $value): void
    {
        $value = str_replace([' ', '.', '-'], '', $value);
        $this->phone = $value;
    }

    public function setMail(string $value): void
    {
        $this->mail = $value;
    }
}
