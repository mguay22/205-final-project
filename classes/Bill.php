<?php
/**
 * Created by PhpStorm.
 * User: joshuachilds
 * Date: 2019-04-09
 * Time: 12:43
 */


require_once(dirname(__DIR__) . '/vendor/formvalidator.php');

class Bill
{
    public $errorMessage;
    public $fileName = '';
    private $tableName;
    private $databaseReader;
    private $databaseWriter;

    public function __construct($databaseReader, $databaseWriter) {
        $this->tableName = 'user';
        $this->databaseReader = $databaseReader;
        $this->databaseWriter = $databaseWriter;
    }


    public function addBill($userInfo, $auth) {

        if ( !( isset($_POST['btnSubmit'] ) ) || !( $this->validateFormSubmission() )) {
            return false;
        }

        if (isset($_POST["btnSubmit"])) {
            $dir = "file/";
            $path = $dir . basename($_FILES["fileName"]["name"]);
           if( move_uploaded_file($_FILES["fileName"]["tmp_name"], $path)) {
               echo"Uploaded";
               $this->fileName = $_FILES['fileName']['name'];
           }
           else{
               $this->fileName = "noImage.php";
           }
        }

        $formInfo = $this->collectFormSubmission();


        if (!$this->saveToDatabase($formInfo, $userInfo)) {
            return false;
        }

        $this->emailStandardUsers($auth);

        return true;
    }

    private function emailStandardUsers($auth) {
        require_once(dirname(__DIR__) . '/htmlEmail.php');

        $users = $auth->getUsersByAddressId();

        $msg = $message;

        $headers = "From: Bill Buddy <jhchilds@uvm.edu>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        for ($i = 0; $i < sizeof($users); $i++) {
            $currentEmail = $users[$i]["email"];
            mail($currentEmail, "New Bill", $msg, $headers);
        }
    }

    private function collectFormSubmission() {
        $formInfo = array();

        $formInfo['type'] = $this->sanitize($_POST['type']);
        $formInfo['dueDate'] = $this->sanitize($_POST['dueDate']);
        //$formInfo['addressId'] = $this->sanitize($_POST['addressId']);
        //$formInfo['fileName'] = ($_FILES["fileName"]["name"]);
        $formInfo['amount'] = $this->sanitize($_POST['amount']);

        return $formInfo;
    }

    private function saveToDatabase($formInfo, $userInfo) {

        if (!$this->insertIntoDb($formInfo, $userInfo)) {
            $this->handleError("Inserting to Database failed!");
            return false;
        }

        return true;
    }


    private function insertIntoDb($formInfo, $userInfo) {

        $addressId = $userInfo[0]['addressId'];

        $query = 'INSERT INTO bill SET ';
        $query .= 'id = ?, ';
        $query .= 'type = ?, ';
        $query .= 'dueDate = ?, ';
        $query .= 'addressId = ?, ';
        $query .= 'fileName = ?, ';
        $query .= 'amount = ? ';


        $values = array(
            NULL, // id sample should be pulled from session
            $this->sanitizeForSQL($formInfo['type']),
            $this->sanitizeForSQL($formInfo['dueDate']),
            $addressId, //addressID sample should be pulled from session
            $this->sanitizeForSQL($this->fileName),
            $this->sanitizeForSQL($formInfo['amount'])
        );

        return $this->databaseWriter->insert($query, $values);
    }


    private function validateFormSubmission() {
        $validator = new FormValidator();
        $validator->addValidation("type", "req", "Please fill in bill type");
        $validator->addValidation("dueDate", "req", "Please select a due date");
        $validator->addValidation("amount", "req", "Please fill in Amount");

        if(!$validator->ValidateForm()) {
            $error = '';
            $errorHash = $validator->GetErrors();
            foreach ($errorHash as $inputName => $inputError) {
                $error .= "<p>". $inputError . "</p>";
            }

            $this->handleError($error);
            return false;
        }

        return true;
    }


    private function handleError($error) {
        $this->errorMessage .= $error . "\r\n";
    }

    public function redirect($url) {
        header("Location: $url");
        exit;
    }


    private function sanitizeForSQL($string) {
        if (function_exists("mysql_real_escape_string")) {
            $sanitizedString = mysql_real_escape_string($string);
        } else {
            $sanitizedString = addslashes($string);
        }

        return $sanitizedString;
    }



    /*
    Sanitize() function removes any potential threat from the
    data submitted. Prevents email injections or any other hacker attempts.
    if $removeNl is true, newline chracters are removed from the input.
    */
    private function sanitize($str, $removeNl = true) {
        $str = $this->stripSlashes($str);

        if ($removeNl) {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
            );
            $str = preg_replace($injections, '', $str);
        }
        return $str;
    }


    private function stripSlashes($str) {
        if (get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        return $str;
    }




}