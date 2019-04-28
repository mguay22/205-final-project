<?php
require_once(dirname(__DIR__) . '/vendor/formvalidator.php');

class Auth {
    public $errorMessage;
    private $tableName;
    private $databaseReader;
    private $databaseWriter;

    public function __construct($databaseReader, $databaseWriter) {
        $this->tableName = 'user';
        $this->databaseReader = $databaseReader;
        $this->databaseWriter = $databaseWriter;
    }

    public function validateUserStatus() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['userInfo'])) {
            $this->redirect('index.php');
        }

        if (!isset($_SESSION['userInfo'][0]['addressId'])
        || !isset($_SESSION['userInfo'][0]['status'])) {
            // User still needs to associate an address
            $this->redirect('address.php');
        }
    }

    public function validateUserStatusAddBill() {
        $this->validateUserStatus();

        // Additionally, make sure the user is an admin
        if ($_SESSION['userInfo'][0]['status'] !== 'admin') {
            $this->redirect('dashboard.php');
        }
    }

    public function validateUserStatusAddress() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['userInfo'])) {
            $this->redirect('index.php');
        }
    }

    public function getUserAddressId($address) {
        $addressId = $this->queryAddressId($address);

        if (!$addressId) {
            return false;
        }

        return $addressId;
    }

    public function registerUser() {
        $this->tableName = 'user';

        if (!(isset($_POST['submitted'])) || !($this->validateFormSubmission())) {
            return false;
        }

        $formInfo = $this->collectFormSubmission();
        
        if (!$this->saveToDatabase($formInfo)) {
            return false;
        }

        $_POST['username'] = $formInfo['username'];
        $_POST['password'] = $formInfo['password'];
        
        if (!$this->loginUser()) {
            return false;
        }

        return true;
    }

    public function registerNewHousehold() {
        $this->tableName = 'address';

        if (!(isset($_POST['submitted'])) || !($this->validateAddressFormSubmission())) {
            return false;
        }

        $formInfo = $this->collectAddressFormSubmission();

        if (!$this->saveNewAddressToDatabase($formInfo)) {
            return false;
        }

        return true;
    }

    public function registerExistingHousehold($addressId, $userInfo) {
        // Check to see if addressId matches any in the current database
        $doesHouseholdExist = $this->validatExistingAddressId($addressId);

        if (!$doesHouseholdExist) {
            return false;
        }

        $username = $userInfo[0]['username'];

        // Update user
        $updateUser = $this->updateUserAddressId($addressId, $username);
        if (!$updateUser) {
            return false;
        }
        
        return true;
    }

    public function loginUser() {
        if (empty($_POST['username'])) {
            $this->handleError("Username is empty!");
            return false;
        }
        
        if (empty($_POST['password'])) {
            $this->handleError("Password is empty!");
            return false;
        }
        
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        if (!isset($_SESSION)) { 
            session_start(); 
        }

        if (!$this->checkLoginInDB($username, $password)) {
            return false;
        }
                
        return true;
    }

    private function validateAddressFormSubmission() {
        $validator = new FormValidator();
        $validator->addValidation("address", "req", "Please fill in address");
        $validator->addValidation("zip-code", "req", "Please fill in zip code");
        $validator->addValidation("city", "req", "Please fill in city");
        $validator->addValidation("state", "req", "Please fill in state");
        
        if(!$validator->ValidateForm()) {
            $error = '';
            $errorHash = $validator->GetErrors();
            foreach ($errorHash as $inputName => $inputError) {
                $error .= $inputName . ':' . $inputError . "\n";
            }

            $this->handleError($error);
            return false;
        }
        
        return true;
    }

    private function validatExistingAddressId($addressId) {
        $query = "select * from address where id = ?";
        $queryArray = array(
            $addressId
        );

        $result = $this->databaseWriter->select($query, $queryArray);

        if (!$result || sizeof($result) == 0) {
            return false;
        }

        return true;
    }

    private function queryAddressId($address) {
        $query = "select id from address where address = ?";

        $queryArray = array(
            $address
        );

        $result = $this->databaseWriter->select($query, $queryArray);

        if (!$result || sizeof($result) == 0) {
            return false;
        }

        return $result;
    }

    private function updateUserAddressId($addressId, $username) {
        $query = "update user SET addressId = ?, status = ? WHERE username = ?";
        $queryArray = array(
            $addressId,
            'standard',
            $username
        );

        $result = $this->databaseWriter->update($query, $queryArray);

        var_dump($result);

        if (!$result) {
            return false;
        }

        return true;

    }

    private function checkLoginInDB($username, $password) {
        $username = $this->sanitizeForSQL($username);
        $encryptedPassword = md5($password);

        $values = array(
            $username,
            $encryptedPassword
        );

        $query = "select * from " . $this->tableName . " where username = ? AND password = ?";
        $result = $this->databaseReader->select($query, $values);;
        
        if (!$result || sizeof($result) <= 0) {
            $this->HandleError("Error logging in. The username or password does not match");
            return false;
        }
        
        $_SESSION['userInfo'] = $result;
        
        return true;
    }

    private function collectAddressFormSubmission() {
        $formInfo = array();

        $formInfo['address'] = $this->sanitize($_POST['address']);
        $formInfo['unit-number'] = $this->sanitize($_POST['unit-number']);
        $formInfo['zip-code'] = $this->sanitize($_POST['zip-code']);
        $formInfo['city'] = $this->sanitize($_POST['city']);
        $formInfo['state'] = $this->sanitize($_POST['state']);

        return $formInfo;
    }

    private function collectFormSubmission() {
        $formInfo = array();

        $formInfo['name'] = $this->sanitize($_POST['name']);
        $formInfo['email'] = $this->sanitize($_POST['email']);
        $formInfo['username'] = $this->sanitize($_POST['username']);
        $formInfo['password'] = $this->sanitize($_POST['password']);

        return $formInfo;
    }

    private function saveNewAddressToDatabase($formInfo) {
        if (!$this->insertNewAddressIntoDb($formInfo)) {
            $this->handleError("Inserting to Database failed!");
            return false;
        }

        return true;
    }

    private function saveToDatabase($formInfo) {
        if (!$this->isFieldUnique($formInfo, 'email')) {
            $this->handleError("This email is already registered");
            return false;
        }
        
        if (!$this->isFieldUnique($formInfo, 'username')) {
            $this->handleError("This UserName is already used. Please try another username");
            return false;
        }  

        if (!$this->insertIntoDb($formInfo)) {
            $this->handleError("Inserting to Database failed!");
            return false;
        }

        return true;
    }

    private function insertNewAddressIntoDb($formInfo) {
        $query = 'insert into address set ';
        $query .= 'address = ?, ';
        $query .= 'unitNumber = ?, ';
        $query .= 'zip = ?, ';
        $query .= 'city = ?, ';
        $query .= 'state = ?';

        $values = array(
            $this->sanitizeForSQL($formInfo['address']),
            $this->sanitizeForSQL($formInfo['unit-number']),
            $this->sanitizeForSQL($formInfo['zip-code']),
            $this->sanitizeForSQL($formInfo['city']),
            $this->sanitizeForSQL($formInfo['state']),
        );

        return $this->databaseWriter->insert($query, $values);
    }

    private function insertIntoDb($formInfo) {
        $query = 'insert into user set ';
        $query .= 'id = ?, ';
        $query .= 'token = ?, ';
        $query .= 'email = ?, ';
        $query .= 'fullName = ?, ';
        $query .= 'username = ?, ';
        $query .= 'password = ?, ';
        $query .= 'status = ?, ';
        $query .= 'addressId = ? ';

        $values = array(
            null,
            'sampleToken',
            $this->sanitizeForSQL($formInfo['email']),
            $this->sanitizeForSQL($formInfo['name']),
            $this->sanitizeForSQL($formInfo['username']),
            md5($formInfo['password']),
            null,
            null
        ); ;

        return $this->databaseWriter->insert($query, $values);
    }

    private function isFieldUnique($formInfo, $fieldName) {
        $fieldValue = $this->sanitizeForSQL($formInfo[$fieldName]);
        $query = "select " . $fieldName . " from " . $this->tableName . " where " . $fieldName . " = ?";
        $data = array(
            $fieldValue
        );

        $result = $this->databaseReader->select($query, $data);

        if ($result && sizeof($result) > 0) {
            return false;
        }

        return true;
    }

    private function validateFormSubmission() {    
        $validator = new FormValidator();
        $validator->addValidation("name", "req", "Please fill in Name");
        $validator->addValidation("email", "email", "The input for Email should be a valid email value");
        $validator->addValidation("email", "req", "Please fill in Email");
        $validator->addValidation("username", "req", "Please fill in UserName");
        $validator->addValidation("password", "req", "Please fill in Password");
        
        if(!$validator->ValidateForm()) {
            $error = '';
            $errorHash = $validator->GetErrors();
            foreach ($errorHash as $inputName => $inputError) {
                $error .= $inputName . ':' . $inputError . "\n";
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