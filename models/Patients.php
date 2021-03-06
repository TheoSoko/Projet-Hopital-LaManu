<?php
class Patients
{
    private int $id;
    private string $lastname;
    private string $firstname;
    private string $birthdate;
    private string $birthdateView;
    private string $phone;
    private string $mail;
    private PDO $db;
    private string $table = '`patients`';
    private string $nameSearch;
    private array $idList;

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

    //R??cup??re tous les patients existant dans la base de donn??e.
    public function patientsList(): array{
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, \'%d/%m/%Y\') AS `birthdateView`, `birthdate` AS `birthdate`'
        . 'FROM ' . $this->table
        . 'ORDER BY `id` DESC';
        $queryStatement = $this->db->query($query);
        $patientsList = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $patientsList;
    }



    //Modifie les information d'un patient.
    public function patientUpdate(): bool{
        $query = 'UPDATE ' . $this->table . ' SET `lastname` = :lastname, `firstname` = :firstname, `birthdate` = :birthdate, `phone` = :phone'
                                            . ', `mail` = :mail  WHERE `id` = :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryStatement->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $queryStatement->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $queryStatement->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryStatement->execute();
    }


    //R??cup??re les informations d'un patient unique.
    public function getPatientInfo(): bool
    {
        $query = 'SELECT `lastname`, `firstname`, DATE_FORMAT(`birthdate`, \'%d/%m/%Y\') AS `birthdateView`, `birthdate` AS `birthdate`,
                 `phone`, `mail` FROM ' . $this->table . ' WHERE id= :id';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        //Si j'ai un r??sultat j'hydrate mon objet.
        if(is_object($result)){
            $this->lastname = $result->lastname;
            $this->firstname = $result->firstname;
            $this->birthdate = $result->birthdate;
            $this->birthdateView = $result->birthdateView;
            $this->phone = $result->phone;
            $this->mail = $result->mail;
            return true;
        }
        return false;
    }

    //R??cup??re une liste de patients en fonction de la recherche
    public function getSearchedPatients(){
        $query = 'SELECT `lastname`, `firstname`, DATE_FORMAT(`birthdate`, \'%d/%m/%Y\') AS `birthdateView`, `id` FROM ' . $this->table . 
                        ' WHERE `lastname` LIKE :lastname OR `firstname` LIKE :firstname';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':lastname', '%'.$this->nameSearch.'%', PDO::PARAM_STR);
        $queryStatement->bindValue(':firstname', '%'.$this->nameSearch.'%', PDO::PARAM_STR);
        $queryStatement->execute();
        $SearchedPatientList = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $SearchedPatientList; 
    }

    //R??cup??re l'id d'un patient d'apr??s ses informations personnelles
    public function getPatientId()
    {
        $query = 'SELECT `id` FROM ' . $this->table
            . ' WHERE `lastname` = :lastname AND `firstname` = :firstname AND `birthdate` = :birthdate';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryStatement->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $queryStatement->execute();
        $idPatient = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $idPatient;
    }
       

    //Supprime un ou plusieurs patients.
    public function deletePatient(){
        //R??cup??re idList et le transorme en string.
        $queryPart = implode(', ', $this->idList);
        $query = 'DELETE FROM ' . $this->table . ' WHERE `id` IN ('. $queryPart .')';
        $queryStatement = $this->db->prepare($query);
        return $queryStatement->execute();
    }



//SELECT `id` FROM $this->table WHERE `lastname` = :lastname AND `firstname` = :firstname AND `birthdate` = :birthdate


    //SETTERS
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

    public function setId(int $value): void{
        $this->id = $value;
    }
    public function setNameSearch($value): void{
        $this->nameSearch = $value;
    }
    public function setIdList(array $value): void{
        $this->idList = $value;
    }


    //GETTERS
    public function getId():int{
        return $this->id;
    }
    public function getLastName():string{
        return $this->lastname;
    }
    public function getFirstName():string{
        return $this->firstname;
    }
    public function getBirthDate():string{
        return $this->birthdate;
    }
    public function getBirthDateView():string{
        return $this->birthdateView;
    }
    public function getPhone():string{
        return $this->phone;
    }
    public function getMail():string{
        return $this->mail;
    }
    public function getIdList(): array{
        return $this->idList ;
    }
}