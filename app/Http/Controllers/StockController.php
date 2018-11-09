<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\StockDetail;
use App\Drape;

class StockController extends Controller
{
    public function genlist ($drape)
    {
        return view('stocks.gen-list', [
            "brings" => Bring::join('bring_detail', 'bring_detail.bring_id' ,'=', 'bring.id')
                                ->where('bring_detail.drape_id', '=', $drape)
                                ->paginate(10)
        ]);
    }

    public function orlist ($drape)
    {
        return view('stocks.or-list', [
            "drape" => Drape::where('id', '=', $drape)->get(),
            "stocks" => StockDetail::where('stock_detail.drape_id', '=', $drape)
                                ->orderBy('stock_detail.stock_date')
                                ->paginate(10)
        ]);

        // "stocks" => StockDetail::join('drapes', 'drapes.id' ,'=', 'stock_detail.drape_id')
        //                         ->where('stock_detail.drape_id', '=', $drape)
        //                         ->paginate(10)
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
