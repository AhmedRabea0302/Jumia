<?php

namespace App\Http\Controllers;

class ValidateNums {

    public $country_code;
    public $country;
    public $state;
    public $phone;

    public function getCountryCode($num) {
        $this->country_code = substr($num->phone, 1, 3);
        return $this->country_code;
    }

    public function getState($num, $reg) {
        return preg_match('$reg', $num->phone) ? 'valid' : 'invalid';
    }

    public function getPhone($num) {
        $this->phone = trim(substr($num->phone, 5));
    }

}
