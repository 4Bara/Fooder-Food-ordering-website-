<?php
/**
 * Created by PhpStorm.
 * User: Bara
 * Date: 12/25/2015
 * Time: 1:51 AM
 */
namespace App\Http\Controllers;
use App\Http\Requests\Request;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CartController extends Controller{

    public function addToCart(){
        $aRequest = \Request::all();
        \Session::push("cart.items",$aRequest);
       // print_r(\Session::all());
    }
    public function showCart(){
        $aSession = \Session::all();
        $aCart = isset($aSession['cart'])?$aSession['cart']:array();
        $cartTotalPrice = 0;
        $aCartData = array();
        if(isset($aCart['items'])) {
            foreach ($aCart['items'] as $aItem) {
                if(isset($aItem['idRestaurant'])) {
                    $aRestaurant = DB::table('restaurants')->where(array("id_restaurant" => $aItem['idRestaurant']))->get(array("restaurant_name"));
                    $sRestaurant = $aRestaurant[0]->restaurant_name;
                    $oItem = DB::table('food')->where(array('id_item' => $aItem['idItem']))->get(array('name', 'price'))[0];
                    $aItem['name'] = $oItem->name;
                    $aItem['total_price'] = $oItem->price * $aItem['amount'];
                    $cartTotalPrice += $aItem['total_price'];
                    $aCartData['restaurants'][$sRestaurant][] = $aItem;
                }
            }
        }
        $aCartData['tax']=.16;
        $aCartData['total_price_with_out_tax']=$cartTotalPrice;
        $aCartData['total_price_with_tax']=$cartTotalPrice*$aCartData['tax']+$cartTotalPrice;
        $aData = Backend::LoginData();
        return view("pages.cartPage")->with(array('cartData'=>$aCartData,'data'=>$aData));
    }
    /*
     * This function will be used when a user want to checkout his/her cart,
     * it should be used for offers/menus items checkouts !
     */
    public function checkout(){
        //Check if user is logged in

        if(!Backend::validateUser()){
            return redirect('/');
        }

        $aRequest = \Request::all();

        //This is a temprory array that will be used to create a temp item to be used in saved and any processing on item before saving it.
        $tempItem = array();
        if(!isset($aRequest['items']))
           return;
        /*
         * Total price will be saved here,
         * this also will be used to indicate the last price that will be required on each restaurant
         */

        foreach($aRequest['items'] as $item){
            $dTotalPrice = 0;
            $oItem = DB::table('food')->where(array('id_item'=>$item['id_item']))->get(array("id_restaurant","price"))[0];
            $tempItem['id_item']=$item['id_item'];
            $tempItem['qty']=$item['qty'];
            $tempItem['spicy']=$item['spicy'];
            //$tempItem['note']=$item['note'];
            $tempItem['total_price']=$oItem->price * $item['qty'];
            $dTotalPrice+=$tempItem['total_price'];
            $aRestaurants[$oItem->id_restaurant]['total_price']=$dTotalPrice;
            $aRestaurants[$oItem->id_restaurant]['items'][]=$tempItem;
            $tempItem=array();
        }
        $sNote = $aRequest['note'];
        $sLocation = json_encode($aRequest['location']);

        foreach($aRestaurants as $id_restaurant => $aRestaurant){
            $id_user = \Session::all()['id_user'];
            $sOrderDetails = (json_encode($aRestaurant));

            $aOrder = array(
                'id_user'=>$id_user,
                'id_restaurant'=>$id_restaurant,
                'order_details'=>$sOrderDetails,
                'note'=>$sNote,
                'location'=>$sLocation,
                'date_inserted'=>Date('Y-m-d h:i:s'),
                'status'=>'not_approved_yet'
            );

            DB::table('orders')->insert($aOrder);
        }

        \Session::forget('cart');
        return redirect('/');
    }
}