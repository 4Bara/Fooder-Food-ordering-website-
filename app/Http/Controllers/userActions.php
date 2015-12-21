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

class userActions extends controller
{
    public function addLike(){
        $aRequest = \Input::all();
        $dIdUser = $aRequest['id_user'];
        DB::table('user_rating')->where(array('id_user'=>$dIdUser))->increment('likes_count');
    }
    public function follow(){
        $aRequest = \Input::all();
        $dIdUser = $aRequest['id_user'];
        $dIdOtherUser = $aRequest['id_visitor'];

        DB::table('users_relationships')
            ->insert(array(
                'id_user'=>$dIdUser,
                'id_other_user'=>$dIdOtherUser,
                'date_changed'=>date('Y-m-d h:m:s'),
                'relationship_status'=>'following')
            );
    }
}