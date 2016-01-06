<?php
/**
 * Created by PhpStorm.
 * User: Bara
 * Date: 11/11/2015
 * Time: 3:31 AM
 */
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

use DB;
use Illuminate\View\View;
use Symfony\Component\Console\Helper\Table;

class restaurantController extends controller
{
    public function addNewItemPage(){
      $aSession= \Session::all();;

        if(!isset($aSession['loggedin']) || $aSession['loggedin'] !=true){
            return redirect('/');
        }
        $aData = Backend::LoginData();
       return view('pages.addItemPage')->with(array("data"=>$aData));
    }
    public function addNewItem(){
        $aSession = \Session::all();
        $aRequest = Request::all();

        if(isset($aRequest['food_picture'])) {
            $oImage = $aRequest['food_picture'];
            $FullImagePath = Backend::uploadPhotos($oImage, 'food_picture');
            if(empty($FullImagePath)){
                return view('pages.addItemPage')->withErrors('Image wasn\'t uploaded');
            }
        }
        $aItemParams = array(
            'name'=>'r',
            'type'=>'n',
            'description'=>'n',
            'price'=>'r',
            'calories'=>'n',
            'status'=>'n',
            'spicy'=>'n',
            'healthy'=>'n',
            );
        //Here i am going to handle the required params of table
        foreach($aItemParams as $sParam => $sCond){
            if($sCond=='r'){
                if(!isset($aRequest['food_'.$sParam])) {
                    //Send it back to the factory ;)
                }
            }
            if(isset($aRequest['food_'.$sParam]))
            $aItem[$sParam]=$aRequest['food_'.$sParam];
        }

       $aItem['id_restaurant']=$aSession['id_user'];


       $aItem['picture'] = $FullImagePath;

       $aItem['type']="not spcified";
        //dd($aItem);
        if(DB::table('food')->insert($aItem)){
           return Redirect::back();
        } else{
            return view('/pages.addItemPage')->withErrors("Something is wrong, we are sorry ! :( ");
        }
    }
    //This function will redirect the user to the page of offers, remember to include the variable that will be used
    //in destingush between menus and offers pages ! :D
    public function showOffers($username){
        $aRestaurantData =  DB::table('restaurants')->where(array('username'=>$username))->get(array('id_restaurant'));
        if(empty($aRestaurantData)){
            //Go the previous page
        }
        $dIdRestaurant = $aRestaurantData[0]->id_restaurant;
        $aMenus = DB::table('offers')->
        where(array('id_restaurant'=>$dIdRestaurant,'status'=>'active'))->paginate(2);
        $aMenus->setPath('offers');
        $aMenus->appends(["username"=>$username]);
//                    get(array('id_menu','id_category','id_creator','picture','name','description'));
        $aData=Backend::LoginData();
        $aData['page_type']="offer";

        return view('/pages.menusList')->with(array('menus'=>$aMenus,'data'=>$aData));
    }
    public function showMenus($username){
       $aRestaurantData =  DB::table('restaurants')->where(array('username'=>$username))->get(array('id_restaurant'));
        if(empty($aRestaurantData)){
            //Go the previous page
        }
        //Get the login data
        $data = Backend::LoginData();

        //Put the page_type to menu to indicate that we will be dealing with menus
        $data['page_type']='menu';
        //Get the Restaurant id to be used in search
        $dIdRestaurant = $aRestaurantData[0]->id_restaurant;

        //Get the menus for this restauarnt, paginated
        $aMenus = DB::table('menus')->where(array('id_restaurant'=>$dIdRestaurant,'status'=>'active'))->paginate(2);
        $aMenus->setPath('menus');
        $aMenus->appends(["username"=>$username]);

        return view('/pages.menusList')->with(array('menus'=>$aMenus,'data'=>$data));
    }

    public function showOffer(){
        $aRequest = \Request::all();
        if(!isset($aRequest['id'])){
            return redirect('/');
        }
        $aOffer = DB::table('offers')->where(array('id_offer'=>$aRequest['id']))->get(array('*'));
        $oOffer = $aOffer[0];

        $aRestaurant = DB::table('restaurants')->where(array('id_restaurant'=>$oOffer->id_restaurant))->get(array('restaurant_name'));
        $oRestaurant= $aRestaurant[0];

        $aOfferItems = DB::table('offer_items')->where(array('id_offer'=>$aRequest['id']))->get(array("*"));

        foreach($aOfferItems as $oOfferItem){
            $aItemsIds = json_decode($oOfferItem->items);
        }
        $aData= Backend::LoginData();
        $aData['page_type']='offer';
        if($aData['user_type']=='restaurant'){
            $aData['showUnits'] = false;
        }else{
            $aData['showUnits'] = true;
        }
        $aItems = DB::table('food')->whereIn('id_item',$aItemsIds)->get(array('*'));
        //dd($aItems);
        return view('/pages.menu')->with(array('data'=>$aData,'restaurant'=>$oRestaurant,'offer'=>$oOffer,'items'=>$aItems));
    }
    public function showMenu(){
        $aRequest = \Request::all();
        $data = Backend::LoginData();
        if(!isset($aRequest['id'])){
            return redirect('/');
        }
        $aMenu = DB::table('menus')->where(array('id_menu'=>$aRequest['id']))->get(array('*'));
        $oMenu = $aMenu[0];
        $aRestaurant = DB::table('restaurants')->where(array('id_restaurant'=>$oMenu->id_restaurant))->get(array('restaurant_name'));
        $oRestaurant= $aRestaurant[0];

        $aMenuItems = DB::table('menu_items')->where(array('id_menu'=>$aRequest['id']))->get(array("*"));
        foreach($aMenuItems as $oMenuItem){
            $aItemsIds = json_decode($oMenuItem->items);
        }
        if(empty($aItemsIds)){
            $aItemsIds=array();
        }

        $data['page_type']='menu';
        /*
         * This will show units and addition featuer only for persons users.
         */
        if( isset($data['user_type']) && $data['user_type']=='restaurant'){
            $data['showUnits'] = false;
            $data['user_type']='restaurant';
        }else{
            $data['showUnits'] = true;
            $data['user_type']='user';
        }

        $aItems = DB::table('food')->whereIn('id_item',$aItemsIds)->get(array('*'));
        return view('/pages.menu')->with(array('data'=>$data,'restaurant'=>$oRestaurant,'menu'=>$oMenu,'items'=>$aItems));
    }
    /*
     * This function should perform the addition of a new menu for the logged in restaurant.
     */
    public function addNewMenu(){
        $aSession = \Session::all();
        $this->validateUser($aSession);
        $aItemsList = DB::table('food')->where(array('id_restaurant'=>$aSession['id_user']))->get(array("*"));
        $data = Backend::LoginData();
        $data['page_type']='menu';
        return view('/pages.addNewMenu')->with(array('data'=>$data,'items'=>$aItemsList));
    }
        /*
         * This function will take the request and save it into the
         * menus table in the database.
         */
    public function newMenu(){
        $aRequest = \Request::all();
        $aSession= $this->validateUser(\Session::all());
        $aMenu['name']=$aRequest['name'];
        if(isset($aRequest['cover_picture'])){
        $aMenu['picture']=Backend::uploadPhotos($aRequest['cover_picture'],'cover_picture');
        }
        $aMenu['description']=$aRequest['description'];
        $aMenu['id_restaurant']=$aSession['id_user'];
        $aMenu['id_creator']=1;
        $aMenu['date_created']= date('Y-m-d H:i:s');
        $aMenu['status']='active';
        $dIdMenu = DB::table('menus')->insertGetId($aMenu);
        $sFoodList = json_encode($aRequest['food']);
        $data = Backend::LoginData();

        DB::table('menu_items')->insert(array('id_menu'=>$dIdMenu,'items'=>$sFoodList));
            return redirect('/p/'.$aSession['username'])->with(array('data'=>$data));
    }
    /*
     * This function will add the offer the offer's table
     * in the database
     */
    public function newOffer(){
        $aRequest = \Request::all();
        $aSession= $this->validateUser(\Session::all());
        $aOffer['name']=$aRequest['name'];
        //dd($aRequest);
        if(isset($aRequest['cover_picture'])){
            $aOffer['picture']=Backend::uploadPhotos($aRequest['cover_picture'],'cover_picture');
        }
        $aOffer['type']='normal';
        $aOffer['description']=$aRequest['description'];
        $aOffer['id_restaurant']=$aSession['id_user'];
       // $aOffer['id_creator']=1; To be Added soon!!
        $aOffer['date_created']= date('Y-m-d h:i:s');
        $aOffer['price']=50;
        $aOffer['status']='active';
        $dIdOffer = DB::table('offers')->insertGetId($aOffer);
        //Get the Food list and encode them into JSON before saving them into the DB
        $sFoodList = json_encode($aRequest['food']);
        $data = Backend::LoginData();
        DB::table('offer_items')->insert(array('id_offer'=>$dIdOffer,'items'=>$sFoodList));
        return redirect('/p/'.$aSession['username'])->with(array('data'=>$data));
    }
    /*
     * This is the controller function
     * that will be used to show the page of add new Offer
     *
     */
    public function addNewOffer(){
        $aSession = \Session::all();
        $this->validateUser($aSession);
        $aItemsList = DB::table('food')->where(array('id_restaurant'=>$aSession['id_user']))->get(array("*"));
        $data = Backend::LoginData();
        $data['page_type']='offer';
        return view('/pages.addNewMenu')->with(array('data'=>$data,'items'=>$aItemsList));
    }
    /*
     * This function will direct the user to write review page
     */
    public function writeReview($aRequest){
        $data = Backend::LoginData();
        $data['restaurant_username']=$aRequest;
        return view('/pages.writeReview')->with(array('data'=>$data));
    }

    public function submitReview(){
        //Get the request from the submitted page
        $aRequest = \Request::all();
        //Get the Session
        $aSession = \Session::all();
        //GET RESTAURANT ID
        $aRestaurant = DB::table('restaurants')
                       ->where(array('username'=>$aRequest['username']))
                       ->get(array("id_restaurant"));

        $oRestaurant = $aRestaurant[0];

        $aReview['id_restaurant']=$oRestaurant->id_restaurant;
        $aReview['id_user']=$aSession['id_user'];
        $aReview['body']=$aRequest['review'];
        $aReview['rating']=$aRequest['rating'];
        $oImage = $aRequest['review-picture'];

        //Uplaod the pociture of the review
        $FullImagePath = Backend::uploadPhotos($oImage, 'review-picture');
        $aReview['review_image'] = $FullImagePath;
        $aReview['date_created']=Date('Y-m-d h:i:s');
        //Insert the data into Reviews Table and get it's id
        $dReviewId=DB::table('reviews')->insertGetId($aReview);
        //Add Activity to it's table
        //save activity into the DB:
        Backend::addActivity($aSession['id_user'],'review',$dReviewId);

        //Redirect the user to the restaurant's page.
        return redirect('/p/'.$aRequest['username']);
    }
    public function showReviews(){
       // dd(\Request::all());
        $aRequest = \Request::all();
        $oRestaurant = DB::table('restaurants')->where(array('username'=>$aRequest['username']))->get(array('id_restaurant'))[0];
        $aReviewsList =  DB::table('reviews')->where(array('id_restaurant'=>$oRestaurant->id_restaurant))->get(array('*'));
        $aReviews = array();
        $aTempReview = array();
        foreach($aReviewsList as $oReview){
            $oUser = DB::table('users')->where(array('id_user'=>$oReview->id_user))->get(array('username'))[0];
            $aTempReview['id_review']=$oReview->id_review;
            $aTempReview['username'] =$oUser->username;
            $aTempReview['body']  = $oReview->body;
            $aTempReview['rating']=$oReview->rating;
            switch($oReview->rating){
                case 'poor':$aTempReview['rating']=1;break;
                case 'good':$aTempReview['rating']=2;break;
                case 'vGood':$aTempReview['rating']=3;break;
                case 'excellent':$aTempReview['rating']=4;break;
                case 'extraordinary':$aTempReview['rating']=5;break;
            }
            $aTempReview['image']=$oReview->review_image;
            $aTempReview['date_created']=$oReview->date_created;
            $aReviews [] = $aTempReview;
        }
        $data = Backend::LoginData();
       return view('/pages.reviews')->with(array('data'=>$data,'aReviews'=>$aReviews));
    }
    /*
     * This function will validate if the user can perform this action
     * before anything to be excuted, it will return the session if true, if failed will
     * direct the user to the home page /
     */
    private function validateUser($aSession){
        if(!isset($aSession['loggedin']) || $aSession['loggedin'] !=true ||
            !isset($aSession['user_type'])|| $aSession['user_type']!='restaurant'){
            return redirect('/');
        }
        return $aSession;
    }
    /*
     * This function will get an image as a parameter and upload
     * it to the directory then return the directory or if failed
     * it will return false
     */
//    private function uploadImage($oImage,$sfile){
//        try {
//            $sDestination = 'images/photos/';
//            $sDate = date('YmdHis');
//            if (Request::file($sfile)->move($sDestination, $sDate . $oImage->getClientOriginalName())) {
//                //Asset will give you the directory of public folders, that will be used in saving photos to it!
//                return asset($sDestination . $sDate . $oImage->getClientOriginalName());
//            } else {
//                return false;
//            }
//        } catch(Exception $e){
//
//        }
//    }

}