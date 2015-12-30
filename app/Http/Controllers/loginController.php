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
use Illuminate\Support\Facades\Hash;

class LoginController extends controller
{
   public function login(){
      $aRequest = \Input::all();
      $sUsername = $aRequest['username'];
      $sPassword = $aRequest['password'];

       //Check if there's a user with this name, if yes, get all needed information for them
       $aResult = DB::table('users')->where(array('username'=>$sUsername))->get(array('*'));
       if(!empty($aResult)) {
           //If execution reached here then the user is normal user.
           $sUserType = 'user';
       }
       if(empty($aResult)){
           //Check if the user is a restaurant
           $aResult= DB::table('restaurants')->where(array('username'=>$sUsername))->get(array('*'));
           $sUserType = 'restaurant';
       }
       if(empty($aResult)){
           return redirect('login')->withErrors('User not found!');
       }

        if(Hash::check($sPassword,$aResult[0]->password)){
            \Session::put('loggedin','true');
            \Session::put('username',$sUsername);
            \Session::put('user_type',$sUserType);

            if($sUserType=='user') {
                //add empty array of items
                \Session::put('cart', array('items'=>array()));
                \Session::put('id_user', $aResult[0]->id_user);
            } else if($sUserType == 'restaurant'){
                \Session::put('id_user',$aResult[0]->id_restaurant);
            }
            $data=Backend::LoginData();
            return redirect()->intended('/')->with(array('data'=>$data));
        }else{
            return redirect('login')->withErrors(['Please check your credentials!!','Error']);
        }
   }
}