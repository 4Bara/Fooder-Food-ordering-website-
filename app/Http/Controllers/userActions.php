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
    public function showOrders(){
        if(!Backend::validateUser()){
            return redirect('/');
        }
        $aSession = \Session::all();
        $aOrdersList = DB::table('orders')->where(array('id_user'=>$aSession['id_user']))->orderBy('date_inserted','desc')->get(array("*"));
        $aTmpOrder = array();
        $aOrders = array();
        foreach($aOrdersList as $oOrder){
            $aTmpOrder['restaurant_name']=DB::table('restaurants')->where(array('id_restaurant'=>$oOrder->id_restaurant))->get(array('restaurant_name'))[0];
            $oOrderDetails = json_decode($oOrder->order_details);
            $oOrder->order_details = $this->parseOrderDetails($oOrderDetails);
            $oOrder->status = str_replace('_',' ',$oOrder->status);
            $aTmpOrder['info']=$oOrder;
            $aOrders[]=$aTmpOrder;
        }
        $data = Backend::LoginData();
        $data['isRestaurant']=false;

     //   dd($aOrders);
        return view('pages.orders')->with(array('orders'=>$aOrders,'data'=>$data));
    }
    public function showRestaurantsOrders(){
        if(!Backend::validateUser()){
            return redirect('/');
        }
        $aSession = \Session::all();
        $aOrdersList = DB::table('orders')->where(array('id_restaurant'=>$aSession['id_user']))->orderBy('date_inserted','desc')->get(array('*'));
        $aTmpOrder = array();

        foreach($aOrdersList as $oOrder){
            $aTmpOrder['customer']=DB::table('users')->where(array('id_user'=>$oOrder->id_user))->get(array('first_name','last_name','user_mobile'))[0];
            $oOrderDetails =  json_decode($oOrder->order_details);
            $oOrder->order_details = $this->parseOrderDetails($oOrderDetails);
            $oOrder->status = str_replace('_',' ',$oOrder->status);
            $aTmpOrder['info']=$oOrder;
            $aOrders[]=$aTmpOrder;
        }
        $data = Backend::LoginData();
        $data['isRestaurant']=true;
        $data['status']=array('preparing','cancled','not approved yet','on the way','done');
        //dd($aOrders);
        return view('pages.orders')->with(array('orders'=>$aOrders,'data'=>$data));
    }
    public function updateOrderStatus(){
        $aRequest = \Request::all();
        DB::table('orders')->where(array('id_order'=>$aRequest['id_order']))->update(array('status'=>$aRequest['new_status'],'date_last_changed'=>date('Y-m-d h:i:s')));
    }
    private function parseOrderDetails($oOrderDetails){
        $aOrder['total_price']=$oOrderDetails->total_price;
        $aItems = array();
        foreach($oOrderDetails->items as $oItem){
            $aTmpItem = array();
            $aTmpItem['id_item']=$oItem->id_item;
            $aTmpItem['name']=DB::table('food')->where(array('id_item'=>$oItem->id_item))->get(array('name'))[0]->name;
            $aTmpItem['qty']=$oItem->qty;
            $aTmpItem['spicy']=$oItem->spicy;
            $aItems[]=$aTmpItem;
        }
        $aOrder['items']=$aItems;
        return $aOrder;
    }
}