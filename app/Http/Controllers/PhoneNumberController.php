<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ValidateNums;
use Illuminate\Http\Request;

use DB;

class PhoneNumberController extends Controller
{
    public function index() {
        $rows = DB::table('customer')->select('phone')->paginate(10);
        $numbers = $this->validateNumbers($rows);
        return view('phones.allnumbers', ['numbers' => $numbers]);
    }

    public function validateNumbers($numbers) {

        foreach($numbers as $num) {
            $validateNum = new ValidateNums();

            $country_code = $validateNum->getCountryCode($num);
            $phone = trim(substr($num->phone, 5));

            switch ($country_code){
                case '237':
                    $num->code = '237'; 
                    $num->country = 'Cameroon'; 
                    $num->state   = preg_match('/\(237\)\ ?[2368]\d{7,8}$/', $num->phone) ? 'valid' : 'invalid';
                    $num->phone_num = $phone;
                    break;
                case '251':
                    $num->code = '251'; 
                    $num->country = 'Ethiopia'; 
                    $num->state   = preg_match('/\(251\)\ ?[1-59]\d{8}$/', $num->phone) ? 'valid' : 'invalid';
                    $num->phone_num = $phone;  
                    break;

                case '212':
                    $num->code = '212'; 
                    $num->country = 'Morocco'; 
                    $num->state   = preg_match('/\(212\)\ ?[5-9]\d{8}$/', $num->phone) ? 'valid' : 'invalid';
                    $num->phone_num = $phone;
                    break;
                case '258':
                    $num->code = '258'; 
                    $num->country = 'Mozambique'; 
                    $num->state   = preg_match('/\(258\)\ ?[28]\d{7,8}$/', $num->phone) ? 'valid' : 'invalid';
                    $num->phone_num = $phone;
                    break;
                case '256':
                    $num->code = '256'; 
                    $num->country = 'Uganda'; 
                    $num->state   = preg_match('/\(256\)\ ?\d{9}$/', $num->phone) ? 'valid' : 'invalid';
                    $num->phone_num = $phone;
                    break;
                default:
                    break;
            }
            
        }
        return $numbers;

    }

    public function traversPages(Request $request) {
        
        $rows = DB::table('customer')->select('phone')->take(10)->skip( ($request->page - 1) * 10 )->get();
        $numbers = $this->validateNumbers($rows);
        return view('layouts.table', compact('numbers'))->render();
    }

    public function filterPhones(Request $request) {

        $country = $request->country;
        $state   = $request->state;

        $rows = DB::table('customer')->select('phone')->get();
        
        $filtered_numbers = $this->validateNumbers($rows);
        $numbers = array_filter($filtered_numbers->toArray() , function($row) use ($country, $state) {
            return ($row->country == $country && $row->state == $state );
        });
        return view('layouts.table', compact('numbers'))->render();
    }
}
