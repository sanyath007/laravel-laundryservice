<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Set;
use App\Substock;

class SetController extends Controller
{
    public function index ()
    {

    }

    // public function orlist ()
    // {
    // 	return view('drapes.orlist', [
    // 		'drapes' => Drape::where(['drape_cate' => '6'])
    // 							->where(['status' => '1'])
    // 							->orderBy('sort','ASC')
    // 							->paginate(15),
    // 	]);
    // }

    // public function lrlist ()
    // {
    // 	return view('drapes.lrlist', [
    // 		'drapes' => Drape::where(['drape_cate' => '4'])
    // 							->where(['status' => '1'])
    // 							->orderBy('sort','ASC')
    // 							->paginate(15),
    // 	]);
    // }

    public function ajaxsetforstock ($substock)
    {
        if ($substock == 14) {
            $sets = Set::where(['set_type' => '1'])
                            ->where(['status' => '1'])
                            ->orderBy('sort', 'ASC')
                            ->get();
        } else if ($substock == 13) {
            $sets = Set::where(['set_type' => '2'])
                            ->where(['status' => '1'])
                            ->orderBy('sort', 'ASC')
                            ->get();
        }

        return $sets;
    }

    // for($d=1; $d <= 31; $d++)
    //     $received = DB::table("sentin_daily")
    //                 ->select('*')
    //                 ->join('sentin_daily_detail', 'sentin_daily.id', '=', 'sentin_daily_detail.sentin_daily_id')  
    //                 ->where(['sentin_daily.date' => $_month. '-' .$d])
    //                 ->where(['sentin_daily_detail.drape_id' => $drape->id])
    //                 ->first();
}
