<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Bring;
use App\BringDetail;

class StockController extends Controller
{
    public function genlist ($drape)
    {
        return view('stocks.gen-list', [
            "brings" => Bring::join('bring_detail', 'bring_detail.bring_id' ,'=', 'bring.id')
                                ->where('bring_detail.item_id', '=', $drape)
                                ->andWhere('bring_detail.item_type', '=', 'Drape')
                                ->paginate(10)
        ]);
    }

    public function orlist ($drape)
    {
        return view('stocks.or-list', [
            "brings" => Bring::join('bring_detail', 'bring_detail.bring_id' ,'=', 'bring.id')
                                ->where('bring_detail.item_id', '=', $drape)
                                ->paginate(10)
        ]);
    }

    public function ajaxquery ($location)
    {
        if(empty($location)){
            $locations = Location::where('id', '<>', '1')->get();
        }else{
            $locations = Location::where('name', 'like', '%' .$location. '%')
                                    ->where('id', '<>', '1')
                                    ->get();
        }

        return $locations;
    }
}
