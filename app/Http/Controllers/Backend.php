<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

use DB;
use Illuminate\View\View;
use Symfony\Component\Console\Helper\Table;

/**
 * Created by PhpStorm.
 * User: Bara
 * Date: 12/3/2015
 * Time: 2:06 AM
 */

Class Backend extends controller {
        public static function uploadPhotos($oImage,$sfile){
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
        public static function validateUser(){
                $aSession = \Session::all();
                if(isset($aSession['loggedin']) && $aSession['loggedin']==true){
                        return true;
                }else{
                        return false;
                }
        }
        public static function LoginData(){
                $aSession = \Session::all();
                $aData = array();

                $aData['items_count']=isset($aSession['cart']['items'])?count($aSession['cart']['items']):0;

                if(isset($aSession['loggedin']) && $aSession['loggedin']==true){
                        $aData['username']=$aSession['username'];
                        $aData['id_user']=$aSession['id_user'];
                        $aData['logged']='yes';
                        $aData['user_type']=$aSession['user_type'];
                }else{
                        //Not logged in logic
                        $aData['logged']='no';
                        $aData=array();
                }
                return $aData;
        }
}