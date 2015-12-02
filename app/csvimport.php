<?php
namespace App\Http\Controllers;
use App\Http\Requests\Request;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

$fOpen = fopen('restaurants.csv','r+');
print_r(fgetcsv($fOpen));
$aRestaurants = array();
while(!feof($fOpen)){
    $aLine = fgetcsv($fOpen);
    $aRestaurant=array(
        'restaurant_name'=>$aLine[0],
        'username'=>$aLine[1],
        'cuisine'=>$aLine[2],
        'price_range'=>$aLine[6],
        'rating'=>$aLine[7],
        'bio'=>$aLine[9]
    );
    $aRestaurants[]=$aRestaurant;
}
fclose($fOpen);

$aTaken=array();
foreach($aRestaurants as $aRestaurant) {
    if(array_search($aRestaurant['cuisine'],$aTaken))
        continue;
    $sql = 'INSERT INTO `cuisines`(`name`) VALUES ("'.$aRestaurant["cuisine"].'")';
    $aTaken[]=$aRestaurant['cuisine'];
    echo $sql.';'.PHP_EOL;
}
//DB::table('restaurants')->insert()