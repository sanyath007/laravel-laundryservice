<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Drape;
use App\DrapeCate;
use App\DrapeType;
use App\Stock;
use App\ReceivedDaily;
use App\ReceivedDailyDetail;
use App\SentinDaily;
use App\SentinDailyDetail;
use App\SentoutDaily;
use App\SentoutDailyDetail;

class DailyController extends Controller
{
    public function receivedlist ()
    {
    	return view('daily.receivedlist', [
    		'drapes' => Drape::whereIn('drape_cate', ['1','2','4','5','6','7','99'])
    							->where('status','<>', '0')
    							// ->orderBy('drape_cate', 'ASC')
    							->orderBy('sort', 'ASC')
    							->get(),
    		'stocks' => Stock::where('id','<>','1')->get(),
    		'_month' => (!Input::get('_month')) ? date('Y-m') : Input::get('_month'),
    	]);
    }

    public function receivedform ()
    {
    	return view('daily.receivedform', [
    		'drapes' => Drape::whereIn('drape_cate', ['1','2','4','5','6','7','99'])
                                ->where('status','<>', '0')
    							// ->orderBy('drape_cate', 'ASC')
    							->orderBy('sort', 'ASC')
    							->get(),
    		'stocks' => Stock::all(),
    	]);
    }

    public function receivedadd(Request $req)
    {	
    	$drapes = Drape::whereIn('drape_cate', ['1','2','4','5','6','7','99'])
    							->where('status','<>', '0')
    							// ->orderBy('drape_cate', 'ASC')
    							->orderBy('sort', 'ASC')
    							->get();

    	$received = new ReceivedDaily();
    	$received->date = $req['received_date'];
    	$received->weight = $req['weight'];
    	$received->return = $req['return'];
    	$received->remark = $req['remark'];

    	if ($received->save()) {
    		$receivedDailyLastId = $received->id;

    		foreach ($drapes as $drape) {
	    		if ($req[$drape->id. '_amount']) {
	    			$detail = new ReceivedDailyDetail();
	    			$detail->received_daily_id = $receivedDailyLastId;
	    			$detail->drape_id = $drape->id;
	    			$detail->amount = $req[$drape->id. '_amount'];
	    			$detail->return = $req[$drape->id. '_return'];
	    			$detail->remark = $req[$drape->id. '_remark'];
	    			$detail->save();
	    		}
	    	}
    	}    	

    	return redirect('daily/received/list');
    }

    public function sentinlist ()
    {
    	return view('daily.sentinlist', [
    		'drapes' => Drape::whereIn('drape_cate', ['1','2','4','5','6','7','99'])
                                ->where('status','<>', '0')
    							// ->orderBy('drape_cate', 'ASC')
                                ->orderBy('sort', 'ASC')
    							->get(),
    		'stocks' => Stock::where('id','<>','1')->get(),
    		'_month' => (!Input::get('_month')) ? date('Y-m') : Input::get('_month'),
    		'_stock' => (!Input::get('_stock')) ? '' : Input::get('_stock'),
    	]);
    }

    public function sentinform ()
    {
    	return view('daily.sentinform', [
    		'drapes' => Drape::whereIn('drape_cate', ['1','2','4','5','6','7','99'])
                                ->where('status','<>', '0')
    							// ->orderBy('drape_cate', 'ASC')
                                ->orderBy('sort', 'ASC')
    							->get(),
    		'stocks' => Stock::where('id','<>','1')->get(),
    	]);
    }

    public function sentinadd(Request $req)
    {	
    	$drapes = Drape::whereIn('drape_cate', ['1','2','4','5','6','7','99'])
                                ->where('status','<>', '0')
    							// ->orderBy('drape_cate', 'ASC')
                                ->orderBy('sort', 'ASC')
    							->get();

    	$sentin = new SentinDaily();
    	$sentin->date = $req['sent_date'];
    	$sentin->stock_id = $req['stock'];
    	$sentin->patient_num = $req['patient_num'];
    	$sentin->remark = $req['remark'];

    	foreach ($drapes as $drape) {
    		$sentinDailyLastId = $sentin->id;

    		if ($req[$drape->id. '_amount']) {
    			$detail = new SentinDailyDetail();
    			$detail->sentin_daily_id = $sentinDailyLastId;
    			$detail->drape_id = $drape->id;
    			$detail->amount = $req[$drape->id. '_amount'];
    			$detail->remark = $req[$drape->id. '_remark'];
    			$detail->save();
    		}
    	}

    	return redirect('daily/sentin/list');
    }

    public function sentoutlist ()
    {
    	return view('daily.sentoutlist', [
    		'drapecates' => DrapeCate::orderBy('drape_cate_id', 'ASC')
    									->get(),
    		'_month' => (!Input::get('_month')) ? date('Y-m') : Input::get('_month'),
    	]);
    }

    public function sentoutform ()
    {
    	return view('daily.sentoutform', [
    		'drapecates' => DrapeCate::orderBy('drape_cate_id', 'ASC')
    									->get()
    	]);
    }

    public function sentoutadd(Request $req)
    {	
    	$drapecates = DrapeCate::orderBy('drape_cate_id', 'ASC')
    								->get();

    	$sentout = new SentoutDaily();
    	$sentout->date = $req['sentout_date'];
    	$sentout->invoice_no = $req['invoice'];
    	$sentout->total = $req['total'];
    	$sentout->return = $req['return'];
    	// $sentout->remark = $req['remark'];
    	
    	if ($sentout->save()) {
    		$sentoutDailyLastId = $sentout->id;

    		foreach ($drapecates as $drapecate) {
	    		if ($req[$drapecate->drape_cate_id. '_amount']) {
	    			$detail = new SentoutDailyDetail();
	    			$detail->sentout_daily_id = $sentoutDailyLastId;
	    			$detail->drape_cate_id = $drapecate->drape_cate_id;
	    			$detail->amount = $req[$drapecate->drape_cate_id. '_amount'];
	    			// $detail->return = $req[$drapecate->drape_cate_id. '_return'];
	    			$detail->remark = $req[$drapecate->drape_cate_id. '_remark'];
	    			$detail->save();
	    		}
	    	}
    	}

    	return redirect('daily/sentout/list');
    }
}
