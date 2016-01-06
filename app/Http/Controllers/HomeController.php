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
use Faker\Provider\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class HomeController extends controller
{
        /*
         * This should prepare the mainpage and show it
         * when the user open the site
         */
        public function index(){

            /*
             * Fill the data if the user is logged in or not
             * and add any other needed information
             */
            $data = Backend::LoginData();
            /*
             * Get the countries list to be shown on the form
             */
            $aCountries = DB::table("countries")->get(array("*"));
            /*
             * Get the Food Types list from the DATABase
             */
            $aFoodType  = DB::table("cuisines")->get(array("*"));

            /*
             * Get the top rated Restaurants
             * to be shown on the homepage of the website.
             */
            $aTopRestaurants = DB::table("restaurants")->orderBy("rating","desc")->limit(4)->get(array("*"));

            /*
             * This array will be filled with the restaurants reviews,
             * to be processed later to get the rating of the restaurants
             */
            $aReviews = array();
            /*
             * This to get the count of reviews that was written on the restaurant.
             */
            $aResult = $this->getRatingAndReviewsCount($aTopRestaurants);
            if(isset($aResult['aTopRestaurants'])) {
                $aTopRestaurants = $aResult['aTopRestaurants'];
                if(isset($aResult['aReviews'])) {
                    $aReviews = $aResult['aReviews'];
                }
            }

            $aFiltersData['countries']=$aCountries;
            $aFiltersData['food_type']=$aFoodType;
            $aRandomOffers = DB::table('offers')->orderByRaw("Rand()")->limit(3)->get(array('*'));
            foreach($aRandomOffers as $oOffer){
                $oRestaurantName= DB::table("restaurants")->where(array('id_restaurant'=>$oOffer->id_restaurant))->get(array("restaurant_name"));
                $oOffer->id_restaurant= $oRestaurantName[0]->restaurant_name;
            }
            //Now redirect to main page and pass the variables with the page to be used by the templating enigne.
            return view('pages.mainpage')->with(array("data"=>$data,"aRandomOffers"=>$aRandomOffers,"aFilterData"=>$aFiltersData,"aTopRestaurants"=>$aTopRestaurants,"aReviews"=>$aReviews));
        }
        /*
         * This will redirect the user to the registeration page
         */
        public function registration()
        {
            /*
             * Check if the user is authorized to be in this page.
             */
            if(Backend::validateUser()){
                //Get the login data if the user is logged in
                $aData = Backend::LoginData();
                //Redirect the user to the homepage.
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

            $aData = array(
                'aCountries' => $aCountries,
                'aGender' => $aGender,
                'aCuisines'=>$aCuisines
            );

            /*
             * At this part the user is not logged in and authorized to register
             */
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
                $aParams = array('username','id_restaurant','id_country','restaurant_name','email','logo','telephone','twitter_account','bio','price_range','cuisines','opening_days','smoking_allowed','provide_ordering','website','rating','location');
                $aUserData = DB::table('restaurants')->where(array('username'=>$sUsername))->get($aParams);

                if(empty($aUserData)) {
                    /*
                     * If it came here means the username is not in the system
                     * redirect the viewer to the home directory,
                     * or maybe 'page not(404)found page'
                     */
                    return redirect()->intended('/')->with(array('data'=>$data));
                }
                    $oRestarant = $aUserData[0];
                    if(isset($oRestarant->cuisines)) {
                        $sCuisineName = DB::table("cuisines")->where(array("id_cuisine" => $oRestarant->cuisines))->get(array("name"));
                        if(!empty($sCuisineName)){
                            $oRestarant->cuisines=$sCuisineName[0]->name;
                        }
                    }
                    $data['reviews_count']=DB::table("reviews")->where(array("id_restaurant"=>$oRestarant->id_restaurant))->count(array("*"));
                    $oRestarant->opening_days = Backend::checkifOpen($oRestarant->opening_days);
                    $oRestarant->location= json_decode($oRestarant->location);
                //username is for a restaurant, Redirect it to the restaurant's page.
                return view('pages.restaurantpage')->with(array('data'=>$data,'restaurant'=>$oRestarant));
            }

            /*
             * Get the user rating
             */
            $aUserRating = DB::table('user_rating')->where(array('id_user'=>$aUserData[0]->id_user))->get(array('likes_count'));
            /*
             * Get the user followers count
             */
            $aUserFollower = DB::table("users_relationships")->where(array("id_other_user"=>$aUserData[0]->id_user,"relationship_status"=>"following"))->count();
            $aUser['followers']=$aUserFollower;
            /*
             * Get the user country
             */
            $sCountry = DB::table("countries")->where(array('id_country'=>$aUserData[0]->id_country))->get(array('country_name'));
            /*
             * Count how many reviews was written by the user
             */
            $dReviewsCount = DB::table("reviews")->where(array("id_user"=>$aUserData[0]->id_user))->count(array("*"));
            $aActivtiesList = DB::table("activities")->where(array("id_user"=>$aUserData[0]->id_user))->orderBy("date_inserted","desc")->get(array("*"));

            //Parse Activities
            $aActivties = array();
            $aTmpActivity = array();
            foreach($aActivtiesList as $oActivity){
                switch($oActivity->type){
                    case "review":
                    $aTmp = DB::table("reviews")->where(array("id_review"=>$oActivity->id_other))->get(array("*"));
                    if(count($aTmp)!=0){
                        $aRestaurantName=DB::table("restaurants")->where(array("id_restaurant"=>$aTmp[0]->id_restaurant))->get(array("restaurant_name","username"));
                        $aTmpActivity['type']=$oActivity->type;
                        $aTmpActivity['other_name']=$aRestaurantName[0]->restaurant_name;
                        $aTmpActivity['content']=$aTmp[0]->body;
                        $aTmpActivity['rating']=$aTmp[0]->rating;
                        $aTmpActivity['date']=$oActivity->date_inserted;
                        $aTmpActivity['username']=$aRestaurantName[0]->username;
                        $aActivties[]=$aTmpActivity;
                    }
                    break;
                }
            }
            /*
             * Put the reviews count to 0 if there's no reviews
             */
            if(!empty($dReviewsCount)) {
                $aUser['reviews_count'] = $dReviewsCount;
            }else{
                $aUser['reviews_count']=0;
            }
            /*
             * Get the user age
             */
            $dInterval = Backend::getAge($aUserData[0]->age);
            $aUserData[0]->age=$dInterval;
            if(!empty($sCountry[0])) {
                //Set the user's country name
                $aUser['country'] = $sCountry[0]->country_name;
            }
            if(!empty($aUserRating)) {
                //Set the user rating
                $aUser['rating'] = $aUserRating[0]->likes_count;
            }
            $aUser['user']= $aUserData[0];
            /*
             * Show the normal user profile page, pass the needed data with the page
             */
            return view('pages.profilepage')->with(array('data'=>$data,'aUser'=>$aUser,'aActivities'=>$aActivties));
        }
        public function login(){
            //Check if the user is authorized to be on the login page
            if(Backend::validateUser()){
                /*
                 * User here is not authorized,
                 * redirect user to homepage.
                 */
                return redirect('/');
            }
            /*
             * User is authorized
             */
            return view("pages.login");
        }
        /*
         * This function will be taking an array of restaurants
         * and iterate through them and update the rating and reviews count
         * for each restaurant.
         */
        public function getRatingAndReviewsCount($aTopRestaurants){
            $aReviews=array();
            foreach($aTopRestaurants as $oRestaurant){
                $dTotalReviews = 0;
                $dScore=0;
                $aRatings = DB::table("reviews")->select("rating",DB::raw(" count('*') as total"))->where("id_restaurant",'=',$oRestaurant->id_restaurant)->groupBy('rating')->get();
                foreach($aRatings as $oRating){
                    switch($oRating->rating){
                        case "poor":$dScore+=(0*$oRating->total);break;
                        case "good":$dScore+=(1*$oRating->total);break;
                        case "vGood":$dScore+=(2*$oRating->total);break;
                        case "excellent":$dScore+=(3*$oRating->total);break;
                        case "extraordinary":$dScore+=(4*$oRating->total);break;
                    }
                    $dTotalReviews+=$oRating->total;
                }
                $aReviews[$oRestaurant->id_restaurant]=$dTotalReviews;
                if($dTotalReviews>0)
                $oRestaurant->rating=$dScore/$dTotalReviews;
            }
            return array("aTopRestaurants"=>$aTopRestaurants,"aReviews"=>$aReviews);
        }
        /*
         * This method will be used everytime i want to
         * excute a search query,
         * it parses the data that contains a search query variables
         * and returns a list of restaurants, based on the matched ones
         */
        public function GetRestaurantsList($aData){
            /*
             * Get the search term from the Data
             */
            $searchTerms = explode(' ', $aData['searchTerm']);
            /*
             * Put the table name in order to be used in updating the query
             */
            $query = DB::table('restaurants');

            $aSearchTerms = array();
            if(!empty($searchTerms[0])) {
                /*
                 * Make sure to get all the combination of the data
                 */
                foreach ($searchTerms as $term) {
                    $aSearchTerms[] = ucfirst($term);
                    $aSearchTerms[] = strtolower($term);
                    $aSearchTerms[] = ucfirst(strtolower($term));
                }
                /*
                * This foreach, will update the query, puting the likes
                 * in searching for the used columns.
                 * if you want to serach in another column
                 * just add a new line like how it is written.
                */
                foreach ($aSearchTerms as $term) {
                    $query->where('restaurant_name', 'LIKE', '%' . $term . '%')
                        ->orWhere('username', 'LIKE', '%' . $term . '%')
                        ->orWhere('bio', 'LIKE', '%' . $term . '%')
                        ->orWhere('cuisines', 'LIKE', '%' . $term . '%');
                }
                /*
                 * Get a list of Restaurants IDS
                 */
                $aRestaurantsIdsSearchTerm = $query->get(array("id_restaurant"));
            }
            /*
             * If the location data was sent with the query
             */
            if(isset($aData['location']) && $aData['location']!=''){
                if(!empty($aData['location'])) {
                    $query->where('id_country', '=', $aData['location']);
                }
            }

            if(isset($aData['no_smoking'])) {
                $sSmoking='yes';
            }else{
                $sSmoking='no';
            }

            $query->where('smoking_allowed', '=', $sSmoking);
            $aRestaurantsIds= $query->get(array("id_restaurant"));

            if(isset($aRestaurantsIdsSearchTerm))
            array_merge($aRestaurantsIds,$aRestaurantsIdsSearchTerm);

            foreach($aRestaurantsIds as $aRestaurantsId){
                $aResults[]=$aRestaurantsId->id_restaurant;
            }

            $query = DB::table('food');
            if(!empty($searchTerms[0])) {
                foreach ($aSearchTerms as $term) {
                    $query->where('name', 'LIKE', '%' . $term . '%')
                        ->orWhere("type", 'LIKE', '%' . $term . '%')
                        ->orWhere("description", 'LIKE', '%' . $term . '%');
                }

            }
            /*
             * Check if the needed food is healthy
             */

            if(isset($aData['food_health'])){
                $query->where('healthy','=',$aData['food_health']);
            }
            if(isset($aData['price_range'])) {
                $aPriceRange= explode(" - ", $aData['price_range']);
                $dFrom = trim(str_replace('$','',$aPriceRange[0]));
                $dTo = trim(str_replace('$','',$aPriceRange[1]));
                if(isset($dTo) && isset($dFrom)) {
                    $query->whereBetween("price", array($dFrom, $dTo));
                }
            }
            $aRestaurantsIds = $query->get(array("id_restaurant"));
            foreach($aRestaurantsIds as $aRestaurantsId){
                $aResults[]=$aRestaurantsId->id_restaurant;
            }
            if(!empty($aResults[0])){
                $aRestaurants = DB::table("restaurants")->whereIn("id_restaurant",$aResults)
                    ->get(Backend::$aRestaurantsParams);

                foreach($aRestaurants as $restaurant){
                    $restaurant->opening_days= Backend::checkifOpen($restaurant->opening_days);
                }
            }
            $aFinalResult=array();
            if($aData['userlat']!=0 && $aData['userlong']!=0) {

                foreach ($aRestaurants as $restaurant) {
                    if(!empty($restaurant->location)) {
                        $point = json_decode($restaurant->location);
                    }

                    if (isset($point->lat)) {
                        $dCalculatedDist = $this->haversineGreatCircleDistance($aData['userlat'], $aData['userlong'], $point->lat, $point->long)/1000;
                        if ($dCalculatedDist <= $aData['distance']) {
                            $restaurant->location=$dCalculatedDist;
                            $aFinalResult [] = $restaurant;
                        }
                    }
                }
                //Search based on location!

                return $aFinalResult;
            }
            return $aRestaurants;
        }
        /*
         * This is the search function,
         * that will be used to search a certain query
         */
        public function search(){
            $aRequest = \Request::all();

            //get Restaurants List based on the search request
            $aRestaurants= self::GetRestaurantsList($aRequest);

            //Update the restuarnats list by adding the rating and reviews count of each restaurant.
            $aResult = $this->getRatingAndReviewsCount($aRestaurants);

            $aReviews=array();
            if(isset($aResult['aTopRestaurants'])) {
                $aRestaurants = $aResult['aTopRestaurants'];
                if(isset($aResult['aReviews'])) {
                    $aReviews = $aResult['aReviews'];
                }
            }
            $FinalResults=array();
            foreach($aRestaurants as $result){
                $FinalResults[$result->id_restaurant]=$result;
            }
            /*
             * Update only the part that contains the list of the restaurant.
             */
            $html = \View::make("pages.restaurant-box")->with(array("aTopRestaurants"=>$FinalResults,"aReviews"=>$aReviews))->render();
            echo $html;
        }
        /*
         * When the user need to logout
         */
        public function logout(){
            \Session::flush();
            return redirect()->intended('/');
        }

        /*
         * This function was used to compute the
         * distance between the user and needed
         * location,
         * taking the :
         * $latitudeFrom : That's the latitude of the user
         * $longitudeFrom: That's the longitude of the user
         * $latitudeTo : That's the latitude of the Restaurant
         * $longitudeTo: That's the longitude of the Restaurant
         */
      private function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
        {
            // convert from degrees to radians
            $latFrom = deg2rad($latitudeFrom);
            $lonFrom = deg2rad($longitudeFrom);
            $latTo = deg2rad($latitudeTo);
            $lonTo = deg2rad($longitudeTo);

            $latDelta = $latTo - $latFrom;
            $lonDelta = $lonTo - $lonFrom;

            $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
            return $angle * $earthRadius;
        }



}