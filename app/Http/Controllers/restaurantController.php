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

class restaurantController extends controller
{

    public function addNewItemPage(){
      $aSession= \Session::all();;

        if(!isset($aSession['loggedin']) || $aSession['loggedin'] !=true){
            return redirect('/');
        }

       return view('pages.addItemPage');
    }

    public function addNewItem(){
        $aSession = \Session::all();
        $aRequest = Request::all();

        if(isset($aRequest['food_picture'])) {
            $oImage = $aRequest['food_picture'];
            $FullImagePath = $this->uploadImage($oImage, 'food_picture');
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
    public function showOffers(){
        $aSession = \Session::all();
       // dd($aSession);
        $this->validateUser($aSession);

        $aData = array(
            'user_type'=>$aSession['user_type'],
            'id_user'=>$aSession['id_user'],
            'page_type'=>'menu',
        );
        $aPageData = array(
            'page_type'=>'offer',
            'page_id'=>'id_offer'
        );
        return view('/pages.menu')->with(array('data'=>$aData));
    }
    public function showMenus($username){
       $aRestaurantData =  DB::table('restaurants')->where(array('username'=>$username))->get(array('id_restaurant'));
        if(empty($aRestaurantData)){
            //Go the previous page
        }
        $dIdRestaurant = $aRestaurantData[0]->id_restaurant;
      //  dd($dIdRestaurant);
        $aMenus = DB::table('menus')->
                    where(array('id_restaurant'=>$dIdRestaurant,'status'=>'active'))->paginate(6);
        $aMenus->setPath('username='.$username);
//                    get(array('id_menu','id_category','id_creator','picture','name','description'));
        //dd($aMenus);
        //dd(\Request::all());
       // dd($aMenus);
        return view('/pages.menusList')->with(array('menus'=>$aMenus));
    }
    public function showMenu(){
        $aRequest = \Request::all();
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

        $aData = array('page_type'=>'menu');
        $aItems = DB::table('food')->whereIn('id_item',$aItemsIds)->get(array('*'));

        return view('/pages.menu')->with(array('data'=>$aData,'restaurant'=>$oRestaurant,'menu'=>$oMenu,'items'=>$aItems));
    }
    /*
     * This function should perfom the addition of a new menu for the logged in restaurant.
     */
    public function addNewMenu(){
        $aSession = \Session::all();
        $this->validateUser($aSession);
        $aItemsList = DB::table('food')->where(array('id_restaurant'=>$aSession['id_user']))->get(array("*"));
        $aData = array(
            'user_type'=>$aSession['user_type'],
            'id_user'=>$aSession['id_user'],
            'page_type'=>'menu',
        );
        return view('/pages.addNewMenu')->with(array('data'=>$aData,'items'=>$aItemsList));
    }

    public function newMenu(){
        $aRequest = \Request::all();
        $aSession= $this->validateUser(\Session::all());
        $aMenu['name']=$aRequest['name'];
        //dd($aRequest);
        if(isset($aRequest['cover_picture'])){
        $aMenu['picture']=$this->uploadImage($aRequest['cover_picture'],'cover_picture');
        }

        $aMenu['description']=$aRequest['description'];
        $aMenu['id_restaurant']=$aSession['id_user'];
        $aMenu['id_creator']=1;
        $aMenu['date_created']= date('Y-m-d H:i:s');
        $aMenu['status']='active';
        $dIdMenu = DB::table('menus')->insertGetId($aMenu);
        $sFoodList = json_encode($aRequest['food']);
        DB::table('menu_items')->insert(array('id_menu'=>$dIdMenu,'items'=>$sFoodList));
            return redirect('/p/'.$aSession['username']);
    }

    public function newOffer(){
        $aRequest = \Request::all();
        $aSession= $this->validateUser(\Session::all());
        $aOffer['name']=$aRequest['name'];
        //dd($aRequest);
        if(isset($aRequest['cover_picture'])){
            $aOffer['picture']=$this->uploadImage($aRequest['cover_picture'],'cover_picture');
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
        DB::table('offer_items')->insert(array('id_offer'=>$dIdOffer,'items'=>$sFoodList));
        return redirect('/p/'.$aSession['username']);
    }

    public function addNewOffer(){
        $aSession = \Session::all();
        $this->validateUser($aSession);
        $aItemsList = DB::table('food')->where(array('id_restaurant'=>$aSession['id_user']))->get(array("*"));
        $aData = array(
            'user_type'=>$aSession['user_type'],
            'id_user'=>$aSession['id_user'],
            'page_type'=>'offer',
        );
        return view('/pages.addNewMenu')->with(array('data'=>$aData,'items'=>$aItemsList));
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

    //This function will get an image as a parameter and upload it to the directory then return the directory or if failed it will return false
    private function uploadImage($oImage,$sfile){
        $sDestination=  'images/photos/';
        //$sName =$oImage->getClientOriginalName();
       // dd($sDestination);
        $sDate=date('YmdHis');
        if(Request::file($sfile)->move($sDestination, $sDate.$oImage->getClientOriginalName())){
            //Asset will give you the directory of public folders, that will be used in saving photos to it!
          //  dd(asset($oImage->getClientOriginalName()));
            return asset($sDestination.$sDate.$oImage->getClientOriginalName());
        }
        else {
            return false;
        }
    }


}