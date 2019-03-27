<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drape;
use App\Models\Substock;

class DrapeController extends Controller
{
    public function index ()
    {

    }

    public function genlist ()
    {
    	return view('drapes.genlist', [
    		'drapes' => Drape::where(['drape_cate' => '1'])
    							->where(['status' => '1'])
    							->orderBy('sort','ASC')
    							->paginate(15),
    	]);
    }

    public function viplist ()
    {
        return view('drapes.viplist', [
            'drapes' => Drape::where(['drape_cate' => '3'])
                                ->where(['status' => '1'])
                                ->orderBy('sort','ASC')
                                ->paginate(15),
        ]);
    }


    public function babylist ()
    {
        return view('drapes.babylist', [
            'drapes' => Drape::where(['drape_cate' => '2'])
                                ->where(['status' => '1'])
                                ->orderBy('sort','ASC')
                                ->paginate(15),
        ]);
    }


    public function orlist ()
    {
    	return view('drapes.orlist', [
    		'drapes' => Drape::where(['drape_cate' => '6'])
    							->where(['status' => '1'])
    							->orderBy('sort','ASC')
    							->paginate(15),
    	]);
    }

    public function lrlist ()
    {
    	return view('drapes.lrlist', [
    		'drapes' => Drape::where(['drape_cate' => '4'])
    							->where(['status' => '1'])
    							->orderBy('sort','ASC')
    							->paginate(15),
    	]);
    }

    public function denlist ()
    {
    	return view('drapes.denlist', [
    		'drapes' => Drape::where(['drape_cate' => '7'])
    							->where(['status' => '1'])
    							->orderBy('sort','ASC')
    							->paginate(15),
    	]);
    }

    public function suplist ()
    {
    	return view('drapes.suplist', [
    		'drapes' => Drape::where(['drape_cate' => '9'])
    							->where(['status' => '1'])
    							->orderBy('sort','ASC')
    							->paginate(15),
    	]);
    }

    public function offlist ()
    {
        return view('drapes.offlist', [
            'drapes' => Drape::where(['drape_cate' => '5'])
                                ->where(['status' => '1'])
                                ->orderBy('sort','ASC')
                                ->paginate(15),
        ]);
    }

    public function baglist ()
    {
        return view('drapes.baglist', [
            'drapes' => Drape::where(['drape_cate' => '12'])
                                ->where(['status' => '1'])
                                ->orderBy('sort','ASC')
                                ->paginate(15),
        ]);
    }

    public function othlist ()
    {
        return view('drapes.othlist', [
            'drapes' => Drape::where(['drape_cate' => '99'])
                                ->where(['status' => '1'])
                                ->orderBy('sort','ASC')
                                ->paginate(15),
        ]);
    }

    public function ajaxdrape ()
    {
        $drapes = Drape::where(['status' => '1'])
                        ->whereNotIn('drape_cate', ['8','14','81'])
                        ->whereNotIn('id', ['26','49','44','95'])
                        ->orderBy('drape_cate','ASC')
                        ->orderBy('sort','ASC')
                        ->get();

        return $drapes;
    }

    public function ajaxdrapeforstock ($substock)
    {
        $substock = Substock::where(['id' => $substock])->get();
        $drape_types = explode(",", $substock[0]->drape_cate);

        if (count($drape_types) == 1) {
            $drapes = Drape::where(['drape_cate' => $substock[0]->drape_cate])
                                ->where(['status' => '1'])
                                ->orderBy('sort','ASC')
                                ->get();
        } else {
            $drapes = Drape::where(['status' => '1'])
                                ->whereIn('drape_cate', $drape_types)
                                ->orderBy('sort','ASC')
                                ->get();
        }

        return $drapes;
    }

    // for($d=1; $d <= 31; $d++)
    //     $received = DB::table("sentin_daily")
    //                 ->select('*')
    //                 ->join('sentin_daily_detail', 'sentin_daily.id', '=', 'sentin_daily_detail.sentin_daily_id')  
    //                 ->where(['sentin_daily.date' => $_month. '-' .$d])
    //                 ->where(['sentin_daily_detail.drape_id' => $drape->id])
    //                 ->first();
}
