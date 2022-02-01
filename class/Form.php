<?php

/**
 * Classe permettant de faire les vérifications des formulaires
 */

class Form
{

    private string $inputName;
    private $inputValue;
    private string $inputNameError;
    private string $regexName = '/^[A-ZÀ-ÖØ][A-Za-zÀ-ÖØ-öø-ÿ\-\' ]*$/';
    private string $regexPhone =  '/^0[1-79]([\.\-\s]?([0-9]{2})){4}$/';
    private string $regexDate = '/^(19[0-9]{2})|(20([0-1][0-9])|(2[0-2]))-((0[1-9])|(1[0-2]))-((0[1-9])|([1-2][0-9])|(3[0-1]))$/';
    private string $errorMessage;

    public function __construct()
    {
    }

    private function isNotEmpty(): bool
    {
        $check = true;
        if (empty($this->inputValue)) {
            $this->errorMessage = 'Ce champ ne peut pas être vide.';
            $check = false;
        }
        return $check;
    }

    /**
     * Méthode permettant de vérifier le format des données saisies
     *
     * @param string $formatType (email | name | date | phone)
     * @return boolean
     */
    private function checkFormat(string $formatType): bool
    {
        switch ($formatType) {
            case 'name':
                $check = preg_match($this->regexName, $this->inputValue);
                $this->errorMessage = 'Merci de renseigner ' . $this->inputNameError . ' ne contenant que des lettres, commençant par une majuscule et des séparateurs (espace, tiret).';
                break;
            case 'phone':
                $check = preg_match($this->regexPhone, $this->inputValue);
                $this->errorMessage = 'Merci de renseigner ' . $this->inputNameError . ' ne contenant que des chiffres et des séparateurs (espace, tiret).';
                break;
            case 'email':
                $check = filter_var($this->inputValue, FILTER_VALIDATE_EMAIL);
                $this->errorMessage = 'Merci de renseigner ' . $this->inputNameError . ' valide.';
                break;
            case 'date':
                $check =  preg_match($this->regexDate, $this->inputValue);
                $this->errorMessage = 'Merci de renseigner ' . $this->inputNameError . ' respectant ce format : jj/mm/aaaa.';
                if ($check) {
                    $check = $this->checkDate();
                }
                break;
            default:
                $check = false;
                break;
        }
        return $check;
    }

    /**
     * Méthode permettant de vérifier qu'une date existe
     *
     * @return boolean
     */
    private function checkDate(): bool
    {
        //2022-01-27
        $dateArray = explode('-', $this->inputValue);
        if ($dateArray[0] < 1900){
            $this->errorMessage = 'Merci de renseigner une année supérieure à 1900';
            return false;
        } else {
        return checkdate($dateArray[1], $dateArray[2], $dateArray[0]);
        }
    }
    /**
     * Méthode globale de vérification d'un champ. 
     *
     * @param string $type
     * @param string $inputName
     * @param string $inputNameError
     * @param array $form
     * @return boolean
     */
    public function check(array $input): bool
    {
        $this->inputName = $input['filter'];
        $this->inputNameError = $input['realName'];
        $this->inputValue = $_POST[$input['name']];
        $check = false;
        $check = $this->isNotEmpty() && $this->checkFormat($this->inputName);
        // if($this->isNotEmpty()){
        //     if($this->checkFormat('name')){
        //     $check = true;
        //     }else{
        //         $check = false;
        //     }
        // }else{
        //     $check = false;
        // }
        return $check;
    }


    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
