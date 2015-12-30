<?php
/**
 * Created by PhpStorm.
 * User: Bara
 * Date: 11/17/2015
 * Time: 12:57 AM
 */
namespace App\Http\Controllers;

use App\Http\Requests\Request;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Mockery\CountValidator\Exception;


class RegisterationController extends controller
{
    /*
     *$aUserParams       @array contains values of the variables of each user
     *$aRestaurantParams @array contains values of the variables of each Restaurant
     */
    private $aUserParams=['username','password','first_name','last_name','email','logo','id_country','date_of_birth','gender','telephone','user_bio','user_type','user_status'];
    private $aRestaurantParams=['username','password','restaurant_name','location','logo','email','telephone','id_country','bio',
                                'cuisines',"date_registered",'opening_days','opening_hours','somking_allowed','provide_ordering','website','price_range',
                                'twitter_account'];

    public function newAccount(){
        $aRequest = \Input::all();
        //check if there is an account with the same username there
        $aTables = array('users','restaurants');
        //dd($aRequest);
        //Loop through out the tables and check the values of usernames or emails to make sure no redundunt usersnames or emails used.
        foreach($aTables as $sTable) {
            try {
                $oUser = DB::table($sTable)->where('username', '=', strtolower($aRequest['username']))->get();

                if (!empty($oUser)) {
                    echo "username is used, choose another one.";
                    return;
                }
            } catch(Exception $e){
            }
            $oUser = DB::table($sTable)->where('email', '=', strtolower($aRequest['email']))->get();
            if (!empty($oUser)) {
                echo "Email is used, choose another one.";
                return;
            }
        }
        //Check user type if person send it to person registeration function, if not send it to resturant's
        if($aRequest['person']==1) {
           $aRequest['user_type']='person';
           $aRequest['user_status']='active';
           $this->addNormalUser($aRequest);
        }else if($aRequest['restaurant']==1) {
            //dd($aRequest);
            $this->addRestaurantUser($aRequest);
        }
    }
    /*
     * This function will be used every time we want to add a new user
     */
    private function addNormalUser($aRequest){
        $aUser = array();
        foreach ($this->aUserParams as $sParam){
            switch($sParam) {
                case "username":
                    $aUser[$sParam] = strtolower($aRequest[$sParam]);
                    break;
                case "logo":
                    $aUser['photo'] = Backend::uploadPhotos($aRequest['logo'], 'logo');
                    break;
                default:
                    $aUser[$sParam] = $aRequest[$sParam];
                    break;
                 }
        }

        $aUser['date_registered']=date('Y-m-d h:i:s');
        $aUser['age']=$aRequest['date_of_birth'];
        $aUser['user_mobile']=$aRequest['telephone'];
        $aUser['user_status']='active';
        unset($aUser['date_of_birth']);
        unset($aUser['telephone']);
        //Hashing the password to be saved encrypted
        $aUser['password']= Hash::make($aUser['password']);

        DB::table('users')->insert($aUser);

        $dIdUser= DB::table('users')->where(array('username'=>$aUser['username']))->get(array('id_user'));

        DB::table('user_rating')->insert(array('id_user'=>$dIdUser[0]->id_user,'likes_count'=>0));
        echo "You've registered successfully!";
        return redirect()->intended('/');
    }
    /*
     *  This function will be used everytime i need to add a new restaurant
     *  to the data base
     */
    /**
     * @param $aRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    private function addRestaurantUser($aRequest){
        $aRestaurant = array();
        //Loop throghout Restaurant's Params array, and put the values to be processed and saved into the database.

        /*
      * $aDays @array contains all the days names to loop throw them when checking the $aRequest variable for values
      */
        $aOpeningDays= array();
        $aDays = array('sunday','monday','tuesday','wednesday','thursday','friday','saturday');
        foreach($aDays as $sDay){
            if(isset($aRequest[$sDay])){
                //Each day we need to check the from and to timeings, if date is not there put no instead.
                $aOpeningDays[$sDay]["from"] = isset($aRequest[$sDay.'_from'])?$aRequest[$sDay.'_from']:'no';
                $aOpeningDays[$sDay]["to"]  =isset($aRequest[$sDay.'_to'])?$aRequest[$sDay.'_to']:'no';
            }
        }
        //Encoding them into jason to make them easier to be parsed
        $sOpeningDays = json_encode($aOpeningDays);

        foreach ($this->aRestaurantParams as $sParam){
            switch($sParam) {
                case "username":
                    $aRestaurant[$sParam] = strtolower($aRequest[$sParam]);
                    break;
                case "logo":
                    $aRestaurant[$sParam] = $this->uploadPhotos($aRequest['logo'], 'logo');
                    break;
                case 'location':break;
                case 'opening_days':break;
                case 'opening_hours':break;
                case 'price_range':break;
                case 'twitter_account':break;
                case 'aOpeningDays':
                    $aRestaurant['opening_days'] = $sOpeningDays;
                break;
                case 'somking_allowed':
                    if(isset($aRequest[$sParam]))
                        $aRestaurant['smoking_allowed']="yes";
                    else
                        $aRestaurant['smoking_allowed']="no";
                break;
                case 'provide_ordering':
                    if(isset($aRequest[$sParam])){
                        $aRestaurant['provide_ordering']='yes';
                    }else{
                        $aRestaurant['provide_ordering']='no';
                    }
                break;
                case 'date_registered':
                    $aRestaurant[$sParam]=date('Y-m-d h:i:s');
                break;
                case 'password':
                    $aRestaurant['password']=Hash::make($aRequest['password']);
                break;
                default:
                    $aRestaurant[$sParam] = $aRequest[$sParam];
                break;
            }
        }

        DB::table('restaurants')->insert($aRestaurant);
        //redirect to page..
        echo "Restaurant Has been registered succesfully";
        return redirect()->intended('/');
    }

    public function uploadPhotos($oImage,$sfile){
        $sDestination=  'images/photos/';
        //$sName =$oImage->getClientOriginalName();
        // dd($sDestination);
        $sDate=date('YmdHis');
        if(\Request::file($sfile)->move($sDestination, $sDate.$oImage->getClientOriginalName())){
            //Asset will give you the directory of public folders, that will be used in saving photos to it!
            //  dd(asset($oImage->getClientOriginalName()));
            return asset($sDestination.$sDate.$oImage->getClientOriginalName());
        }
        else {
            return false;
        }
    }

}
