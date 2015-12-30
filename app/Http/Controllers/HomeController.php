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
            $data = Backend::LoginData();
            /*
             * If user is logged in then add session's values
             */
            return view('pages.mainpage')->with("data",$data);
        }
        public function registration()
        {
            if(Backend::validateUser()){
                $aData = Backend::LoginData();
                return redirect('/')->with(array('data'=>$aData));
            }
            /*
             * Collect the data from the tables to be shown on the registration page
             * 1:50 AM 11/17/2015
             * Bara Hasaniya
             */
            $aCuisines = DB::table('cuisines')->get(array('*'));
            $aCountries = DB::table('countries')->get(array('*'));
            $aGender = array(1 => 'Male', 2 => 'Female');
//            dd($aCuisines[0]->id_cuisine);
//            dd($aCuisines[1]['id_cuisines']);
            $aData = array(
                'aCountries' => $aCountries,
                'aGender' => $aGender,
                'aCuisines'=>$aCuisines
            );
           // dd($aData['aCuisines']);
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
            //Get if the user is logged in or not
            $bLoggedIn = \Session::get("loggedin");
            $data = Backend::LoginData();
            //In default the profile's vistor is not the owner of it.
            $data['profileOwner']='no';
            if(isset($data['logged']) && $data['logged'] == 'yes'){
                $dVisitorId = $data['id_user'];
                $sUser  = $data['username'];

                /*
                 * Check if this page is for the logged in uesr
                 * to show him more options.
                 */
                if($sUsername == \Session::get('username')){
                    $data['profileOwner']='yes';
                }
            }else{
                $data['logged'] ='no';
                $data['user_type'] = "visitor";

            }

            /*
             * Get the username and put it in data
             */
            if(!empty($sUser)){
                $data['username']=$sUser;
            }
            /*
             * Get the Id of the logged in user
             */
            if(!empty($dVisitorId)){
                $data['visitor_id']=$dVisitorId;
            }
            /*
             * Check if the user is a normal user 'Customers'
             */
            $aUserData = DB::table('users')->where(array('username'=>$sUsername))->get(array("id_user","username","first_name","last_name","email","id_country","gender","age","user_bio","user_mobile","user_status","user_type","photo"));
            if(empty($aUserData)){
                /*
                 * Being here means that the username is not for a normal user,
                 * Check restauarant's table to check if the username is for a restaurant.
                 */
                $aParams = array('username','id_restaurant','id_country','restaurant_name','email','logo','telephone','twitter_account','bio','price_range','cuisines','opening_days','smoking_allowed','provide_ordering','website','rating');
                $aUserData = DB::table('restaurants')->where(array('username'=>$sUsername))->get($aParams);
                if(empty($aUserData)) {
                    /*
                     * If it came here means the username is not in the system
                     * redirect the viewer to the home directory,
                     * or maybe 'page not(404)found page'
                     */
                    return redirect()->intended('/')->with(array('data'=>$data));
                }
               // foreach($aParams as $sParam) {
                    $oRestarant = $aUserData[0];
               // }
                //username is for a restaurant, Redirect it to the restaurant's page.
                return view('pages.restaurantpage')->with(array('data'=>$data,'restaurant'=>$oRestarant));
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
            if(Backend::validateUser()){
                return redirect('/');
            }

            return view("pages.login");
        }
        public function search(){
            $aRequest = \Request::all();
            $q = $aRequest['searchTerm'];

            //Get the from - to price
            $aPrice['from']=$aRequest['from_price'];
            $aPrice['to']=$aRequest['to_price'];

            $searchTerms = explode(' ', $q);

            if($searchTerms[0]=="" && !isset($aPrice['from'])){
                $bNoSearchTerms = false;
            }else{
                $bNoSearchTerms = true;
            }
            $aRestaurantsParams = array("restaurant_name","username","logo","email","telephone","id_restaurant","rating","price_range","id_country");
            $query = DB::table('restaurants');
            $aSearchTerms = array();
            foreach($searchTerms as $term){
                $aSearchTerms[]=ucfirst($term);
                $aSearchTerms[]=strtolower($term);
                $aSearchTerms[]=ucfirst(strtolower($term));
            }
            /*
             * The Search Method will search in as many tables as possible to get a nearly close
             * list of restaurants the customer want.
             */
            if(!$bNoSearchTerms) {
                foreach ($aSearchTerms as $term) {

                    $query->where('restaurant_name', 'LIKE', '%' . $term . '%')
                        ->orWhere('username', 'LIKE', '%' . $term . '%')
                        ->orWhere('bio', 'LIKE', '%' . $term . '%')
                        ->orWhere('cuisines', 'LIKE', '%' . $term . '%');
                }
            $Results['restaurants'] = $query->get($aRestaurantsParams);
            }

            $query = DB::table('food');
            if(!$bNoSearchTerms) {
                foreach ($aSearchTerms as $term) {
                    $query->where('name', 'LIKE', '%' . $term . '%')
                        ->orWhere("type", 'LIKE', '%' . $term . '%')
                        ->orWhere("description", 'LIKE', '%' . $term . '%');
                }
            }
            if(isset($aPrice['from'])) {
                $from = $aPrice['from'];
            }else{
                $from = 0;
            }

            if(isset($aPrice['to'])){
                $to = $aPrice['to'];
            }else{
                $to = 1000;
            }
            $query->orWhereBetween("price",array($from,$to));

            $aRestaurants =  $query->get(array("id_restaurant"));
            dd($aRestaurants);
            foreach($aRestaurants as $oRestaurant){
                $aRestaurantsIds[]= $oRestaurant->id_restaurant;
            }
            if(!empty($aRestaurantsIds)){
                $aRestaurants = DB::table("restaurants")->whereIn("id_restaurant",$aRestaurantsIds)
                    ->get($aRestaurantsParams);
               // dd($aRestaurants);
                if(!empty($aRestaurants)){
                    $Results['restaurants']= array_merge($Results['restaurants'],$aRestaurants);
                }
            }
            foreach($Results['restaurants'] as $result){
                $FinalResults[$result->id_restaurant]=$result;
            }
            echo json_encode($FinalResults);
        }

        public function logout(){
            \Session::flush();
            return redirect()->intended('/');
        }

}