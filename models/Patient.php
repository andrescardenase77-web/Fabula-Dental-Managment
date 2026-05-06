<?php

class Patient {
    public $patientID;
    public $fullName;
    public $birthday;
    public $phone;
    public $reasonForConsultation;
    public $legalRepresentative;

    public function __construct($data) {
        $this->patientID = $data['patientID'] ?? '';
        $this->fullName = $data['fullName'] ?? '';
        $this->birthday = $data['birthday'] ?? '';
        $this->phone = $data['phone'] ?? '';
        $this->reasonForConsultation = $data['reasonForConsultation'] ?? '';
        $this->legalRepresentative = $data['legalRepresentative'] ?? '';
    }

    public function validateData() {
        if (empty($this->patientID) || strlen($this->patientID) !== 10) {
            return false;
        }
        if (empty($this->fullName) || empty($this->birthday)) {
            return false;
        }
        return true;
    }

    public function toArray() {
        return [
            'patientID' => $this->patientID,
            'fullName' => $this->fullName,
            'birthday' => $this->birthday,
            'phone' => $this->phone,
            'reasonForConsultation' => $this->reasonForConsultation,
            'legalRepresentative' => $this->legalRepresentative,
            'createdAt' => new MongoDB\BSON\UTCDateTime()
        ];
    }
}