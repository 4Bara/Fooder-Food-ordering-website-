<?php
/**
 * Created by PhpStorm.
 * User: Bara
 * Date: 11/11/2015
 * Time: 3:31 AM
 */
namespace App\Http\Controllers;
use App\Http\Requests\Request;
use DB;
use App\Http\Controllers\Controller;

class HomeController extends controller
{
        public function index(){
            return view('pages.mainpage');
        }
        public function registration()
        {
            /*
             * Collect the data from the tables to be shown on the registration page
             * 1:50 AM 11/17/2015
             * Bara Hasaniya
             */
            $aCountries = DB::table('countries')->get(array('*'));
            $aGender = array(1 => 'Male', 2 => 'Female');
            $aData = array(
                'aCountries' => $aCountries,
                'aGender' => $aGender
            );
            return view('pages.registeration')->with('aData', $aData);
        }
        public function profile(){
            return view('pages.profilepage');
        }

}