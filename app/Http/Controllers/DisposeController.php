<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Dispose;
use App\Models\Drape;

class DisposeController extends Controller
{
    public function index()
    {
    	return view('disposes.list', [
    		'disposes'	=> Dispose::with('drape')->orderBy('dispose_date', 'DESC')->get(),
    		'drapes'	=> Drape::where('drape_cate', '=', '6')->get(),
    		'_month'	=> Input::get('_month') ? Input::get('_month') : date('Y-m')
    	]);
    }

    public function create()
    {
    	return view('disposes.add', [
    		'drapes'	=> Drape::where('drape_cate', '=', '6')->get(),
    	]);
    }

    public function add(Request $req)
    {
    	$newDispose = new Dispose();
    	$newDispose->dispose_date 	= $req->dispose_date;
    	$newDispose->dispose_type 	= $req->dispose_type;
    	$newDispose->drape_id 		= $req->drape_id;
    	$newDispose->drape_year 	= $req->drape_year;
    	$newDispose->amount 		= $req->amount;
    	$newDispose->remark 		= $req->remark;

    	if($newDispose->save()){
    		return redirect('/dispose/list');
    	}
    }
}
