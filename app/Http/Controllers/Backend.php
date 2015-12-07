<?php
/**
 * Created by PhpStorm.
 * User: Bara
 * Date: 12/3/2015
 * Time: 2:06 AM
 */

Class Backend{
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
}