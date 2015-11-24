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
use Illuminate\Support\Facades\Session;

class HomeController extends controller
{
        public function index(){
            $bLoggedin = \Session::get('loggedin');
            /*
             * If user is logged in then add session's values
             */
            if($bLoggedin  ==   'true'){
                $bLoggedin =    'yes';
                $sUsername =    \Session::get('username');
                $dIdUser   =    \Session::get('id_user');
                $sUserType = \Session::get('user_type');
            }else{
                $bLoggedin='no';
            }
            $data=array(
            'logged'=>$bLoggedin,
            'date'=>date('Y-m-d')
            );
            if($bLoggedin == 'yes'){
                $data['username']=$sUsername;
                $data['id_user']=$dIdUser;
                $data['user_type']=$sUserType;
            }
            return view('pages.mainpage')->with("data",$data);
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
        /*
         * This method will accept a username and show it when someone is trying to browse their profiles
         *
         * In this function there are two major variables 'Arrays'
         *
         * @Data That contain all the needed data for the logged in user
         * @aUser that contain all the data for the user's page
         */

        public function profile($sUsername){
            $bLoggedIn = \Session::get("loggedin");
            $bProfileOwner = 'no';
            $dVisitorId='';
            if($bLoggedIn == 'true'){
                $bLoggedIn = 'yes';
                $dVisitorId= \Session::get('id_user');
                $sUser = \Session::get('username');
                if($sUsername == \Session::get('username')){
                    $bProfileOwner ='yes';
                }
            }else{
                $bLoggedIn ='no';
            }
            $data= array(
                'logged'=>$bLoggedIn,
                'profileOwner'=>$bProfileOwner,
            );
            if(!empty($sUser)){
                $data['username']=$sUser;
            }
            if(!empty($dVisitorId)){
                $data['visitor_id']=$dVisitorId;
            }
            $aUserData = DB::table('users')->where(array('username'=>$sUsername))->get(array("id_user","username","first_name","last_name","email","id_country","gender","age","user_bio","user_mobile","user_status","user_type"));
            if(empty($aUserData)){
                $aUserData = DB::table('restaurants')->where(array('username'=>$sUsername))->get(array('username'));
                if(empty($aUserData)) {
                    return redirect()->intended('/');
                }
                return view('pages.restaurantpage');
            }
            $aUserRating = DB::table('user_rating')->where(array('id_user'=>$aUserData[0]->id_user))->get(array('likes_count'));
            //Get the country of the profile's owner
            $sCountry = DB::table("countries")->where(array('id_country'=>$aUserData[0]->id_country))->get(array('country_name'));
            if(!empty($aUserRating)) {
                $aUser['rating'] = $aUserRating[0]->likes_count;
            }
            $aUser['user']= $aUserData[0];
            return view('pages.profilepage')->with(array('data'=>$data,'aUser'=>$aUser));
        }
        public function login(){
            return view("pages.login");
        }
        public function logout(){
            \Session::put('loggedin','false');
            return redirect()->intended('/');
        }

}