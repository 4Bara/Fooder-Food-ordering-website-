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
        //dd($aRequest);
        $oImage = $aRequest['food_picture'];
        $FullImagePath = $this->uploadImage($oImage);
        if(!$FullImagePath){
            return view('pages.addItemPage')->withErrors('Image wasn\'t uploaded');
        }else{
            $sFullPath = $FullImagePath;
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
       $aItem['picture']=$FullImagePath;
        $aItem['type']="not spcified";
        //dd($aItem);
        if(DB::table('food')->insert($aItem)){
           return Redirect::back();
        } else{
            return view('/pages.addItemPage')->withErrors("Something is wrong, we are sorry ! :( ");
        }
    }

    private function uploadImage($oImage){
        $sDestination=  public_path().'\images\\';
       if(Request::file('food_picture')->move($sDestination,$oImage->getClientOriginalName())){
           //Asset will give you the directory of public folders, that will be used in saving photos to it!
           return asset($oImage->getClientOriginalName());
       }
       else {
            return false;
       }

    }

}