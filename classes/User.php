<?php
class User {
    private $householdCode;

    public function __construct($householdCode) {
        $this->householdCode = $householdCode;
    }

    public function updateHouseholdCode($householdCode) {
        $this->houseHoldCode = $householdCode;
        
    }
}