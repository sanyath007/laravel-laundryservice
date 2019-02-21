<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Drape;
use App\Set;
use App\SetDrape;
use App\DrapeCate;
use App\DrapeType;
use App\Substock;
use App\ReceivedDaily;
use App\ReceivedDailyDetail;
use App\SentinDaily;
use App\SentinDailyDetail;
use App\SentoutDaily;
use App\SentoutDailyDetail;
use App\SentoutType;
use App\SetdrapeDaily;
use App\SetdrapeDailyDetail;
use App\SentoutDailyDetailItem;

class DailyController extends Controller
{
    public function receivedlist ()
    {
    	return view('daily.receivedlist', [
    		'drapeCates' => DrapeCate::where('status','=', '1')
                                ->whereNotIn('drape_cate_id',['14'])
                                ->get(),
            'drapes' => Drape::whereIn('drape_cate', ['1','2','4','5','6','7','9','10','11','12','13','99'])
    							->where('status','<>', '0')
    							// ->orderBy('drape_cate', 'ASC')
    							->orderBy('sort', 'ASC')
    							->get(),
    		'stocks' => Substock::where('id','<>','1')->get(),
    		'_month' => (!Input::get('_month')) ? date('Y-m') : Input::get('_month'),
    	]);
    }

    public function receivedform ()
    {
    	return view('daily.receivedform', [
            'drapeCates' => DrapeCate::where('status','=', '1')
                                ->whereNotIn('drape_cate_id',['14'])
                                ->get(),
    		'drapes' => Drape::whereIn('drape_cate', ['1','2','4','5','6','7','9','10','11','12','13','99'])
                                ->where('status','<>', '0')
    							// ->orderBy('drape_cate', 'ASC')
    							->orderBy('sort', 'ASC')
    							->get(),
    		'stocks' => Substock::all(),
    	]);
    }

    public function receivedadd(Request $req)
    {	
    	$drapes = Drape::whereIn('drape_cate', ['1','2','4','5','6','7','9','10','11','12','13','99'])
    							->where('status','<>', '0')
    							// ->orderBy('drape_cate', 'ASC')
    							->orderBy('sort', 'ASC')
    							->get();

    	$received = new ReceivedDaily();
    	$received->date = $req['received_date'];
        $received->invoice = $req['invoice'];
    	$received->total_weight = $req['total_weight'];
        $received->repeat_weight = $req['repeat_weight'];
    	$received->defect_weight = $req['defect_weight'];
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
            'drapes' => Drape::whereIn('drape_cate', ['1','2','4','5','6','7','9','10','11','12','13','99'])
                                ->where('status','<>', '0')
                                // ->orderBy('drape_cate', 'ASC')
                                ->orderBy('sort', 'ASC')
                                ->get(),
            'stocks' => Substock::where('id','<>','1')->get(),
            '_month' => (!Input::get('_month')) ? date('Y-m') : Input::get('_month'),
            '_stock' => (!Input::get('_stock')) ? '' : Input::get('_stock'),
        ]);
    }

    public function sentinform ()
    {
    	return view('daily.sentinform', [
    		'drapes' => Drape::whereIn('drape_cate', ['1','2','4','5','6','7','9','10','11','12','13','99'])
                                ->where('status','<>', '0')
    							// ->orderBy('drape_cate', 'ASC')
                                ->orderBy('sort', 'ASC')
    							->get(),
    		'stocks' => Substock::where('id','<>','1')->get(),
    	]);
    }

    public function sentinform2 ($id)
    {
        $sentins = \DB::table("sentin_daily")
                        ->where(['sentin_daily.id' => $id])
                        ->get();

        $stock = Substock::where('id','=',$sentins[0]->stock_id)->first();        
        $drape_cates = explode(',', $stock->drape_cate);

        return view('daily.sentinform2', [
            'stocks'    => Substock::where('id','<>','1')->get(),
            'drapes'    => Drape::whereIn('drape_cate', $drape_cates)
                                ->where('status','<>', '0')
                                ->orderBy('sort', 'ASC')
                                ->get(),
            'sentins'   => $sentins,
            '_stock'    => $sentins[0]->stock_id,
        ]);
    }

    public function sentinadd(Request $req)
    {	
        date_default_timezone_set('Asia/Bangkok');
    	$drapes = Drape::whereIn('drape_cate', ['1','2','4','5','6','7','9','10','11','12','13','99'])
                                ->where('status','<>', '0')
    							// ->orderBy('drape_cate', 'ASC')
                                ->orderBy('sort', 'ASC')
    							->get();

    	$sentin = new SentinDaily();
        $sentin->date = $req['request_time'];
        // $sentin->request_user = $req['request_user'];
    	$sentin->request_time = $req['request_time']. ' ' .date("h:i:s");
    	$sentin->stock_id = $req['_stock'];
    	$sentin->patient_num = $req['patient_num'];
        $sentin->remark = $req['remark'];
    	
        if($sentin->save()) {
            $sentinDailyLastId = $sentin->id;

            foreach ($drapes as $drape) {
                if ($req[$drape->id. '_request']) {
                    $detail = new SentinDailyDetail();
                    $detail->sentin_daily_id = $sentinDailyLastId;
                    $detail->drape_id = $drape->id;
                    $detail->request_amt = $req[$drape->id. '_request'];
                    $detail->remark = $req[$drape->id. '_remark'];
                    $detail->save();
                }
            }
        }

    	return redirect('daily/sentin/list');
    }

    public function sentinadd2(Request $req)
    {   
        date_default_timezone_set('Asia/Bangkok');
        $drapes = Drape::whereIn('drape_cate', ['1','2','4','5','6','7','9','10','11','12','13','99'])
                                ->where('status','<>', '0')
                                ->orderBy('sort', 'ASC')
                                ->get();
        
        $sentin = SentinDaily::find($req['_id']);
        // $sentin->sent_user = $req['sent_user'];
        $sentin->sent_time = $req['sent_time']. ' ' .date("h:i:s");

        if($sentin->save()) {            
            foreach ($drapes as $drape) {
                if ($req[$drape->id. '_sent']) {
                    $detail = SentinDailyDetail::where(['sentin_daily_id' => $req['_id']])
                                                ->where(['drape_id' => $drape->id])
                                                ->first();

                    $detail->sent_amt = $req[$drape->id. '_sent'];
                    $detail->remark = $req[$drape->id. '_remark'];
                    $detail->save();
                }
            }
        }

        return redirect('daily/sentin/stock');
    }

    public function sentinstock ()
    {   
        $_stock = Input::get('_stock');
        $_month = Input::get('_month');

        if ($_stock) {
            $stock = Substock::where('id','=',$_stock)->first();        
            $drape_cates = explode(',', $stock->drape_cate);
            $drapes = Drape::whereIn('drape_cate', $drape_cates)
                                ->where('status','<>', '0')
                                ->orderBy('sort', 'ASC')
                                ->get();
        } else {
            $drapes = Drape::whereIn('drape_cate', ['1','2','4','5','6','7','99'])
                                ->where('status','<>', '0')
                                ->orderBy('sort', 'ASC')
                                ->get();
        }

        return view('daily.sentinstock', [
            'stocks' => Substock::where('id','<>','1')->get(),
            '_month' => (!$_month) ? date('Y-m') : $_month,
            '_stock' => (!$_stock) ? '' : $_stock,
            'drapes' => $drapes,
        ]);
    }

    public function setdrapelist ()
    {
        return view('daily.setdrapelist', [
            'sets'      => Set::orderBy('id', 'ASC')->get(),
            'stocks'    => Substock::whereIn('id', ['13', '14'])->get(),
            '_month'    => (!Input::get('_month')) ? date('Y-m') : Input::get('_month'),
            '_stock'    => (!Input::get('_stock')) ? '' : Input::get('_stock'),
        ]);
    }

    public function setdrapeform ()
    {
        return view('daily.setdrapeform', [
            'stocks'    => Substock::whereIn('id', ['13', '14'])->get(),
            'sets'      => Set::orderBy('id', 'ASC')->get(),
            // '_stock'    => $sentins[0]->stock_id,
        ]);
    }

    public function setdrapeadd (Request $req)
    {   
        date_default_timezone_set('Asia/Bangkok');

        if ($req['_stock'] == '14'){
            $sets = Set::where(['set_type' => '1'])->orderBy('id', 'ASC')->get();
        } else if ($req['_stock'] == '13'){
            $sets = Set::where(['set_type' => '2'])->orderBy('id', 'ASC')->get();
        }

        $setdrape = new SetdrapeDaily();
        $setdrape->date = $req['request_time'];
        // $setdrape->request_user = $req['request_user'];
        $setdrape->request_time = $req['request_time']. ' ' .date("h:i:s");
        $setdrape->stock_id = $req['_stock'];
        $setdrape->patient_num = $req['patient_num'];
        $setdrape->remark = $req['remark'];
        
        if($setdrape->save()) {
            $setdrapeDailyLastId = $setdrape->id;

            foreach ($sets as $set) {
                $set_id = $set->id;

                if (!empty($req[$set_id. '_stock']) || !empty($req[$set_id. '_request'])) {
                    $detail = new SetdrapeDailyDetail();
                    $detail->setdrape_daily_id = $setdrapeDailyLastId;
                    $detail->set_id = $set_id;
                    $detail->stock_amt = $req[$set_id. '_stock'];
                    $detail->request_amt = $req[$set_id. '_request'];
                    $detail->remark = $req[$set_id. '_remark'];
                    $detail->save();
                }
            }
        }

        return redirect('daily/setdrape/list');
    }

    public function setdrapeform2 ($stock, $id, $isnew)
    {
        if ($stock == '14'){
            $sets = Set::where(['set_type' => '1'])->orderBy('id', 'ASC')->get();
        } else if ($stock == '13'){
            $sets = Set::where(['set_type' => '2'])->orderBy('id', 'ASC')->get();
        }

        return view('daily.setdrapeform2', [
            'stocks'    => Substock::whereIn('id', ['13', '14'])->get(),
            '_stock'    => $stock,
            'setdrape'  => SetdrapeDaily::find($id),
            'sets'      => $sets,
            'isnew'     => ($isnew > 0) ? 2 : 1
        ]);
    }

    public function setdrapedispense1 (Request $req)
    {   
        date_default_timezone_set('Asia/Bangkok');

        if ($req['_stock'] == '14'){
            $sets = Set::where(['set_type' => '1'])->orderBy('id', 'ASC')->get();
        } else if ($req['_stock'] == '13'){
            $sets = Set::where(['set_type' => '2'])->orderBy('id', 'ASC')->get();
        }

        $setdrape = SetdrapeDaily::find($req['_id']);
        $setdrape->sent1_time = $req['sent_time']. ' ' .date("h:i:s");
        
        if($setdrape->save()) {
            foreach ($sets as $set) {
                $set_id = $set->id;

                if ($req[$set_id. '_sent']) {
                    $detail = SetdrapeDailyDetail::where(['setdrape_daily_id' => $req['_id']])
                                                    ->where(['set_id' => $set->id])
                                                    ->first();
                                                    
                    $detail->sentin1_amt = $req[$set_id. '_sentin1'];
                    $detail->sentout_amt = $req[$set_id. '_sentout'];
                    $detail->remark = $req[$set_id. '_remark'];
                    $detail->save();
                }
            }
        }

        return redirect('daily/setdrape/list');
    }

    public function setdrapedispense2 (Request $req)
    {   
        date_default_timezone_set('Asia/Bangkok');

        if ($req['_stock'] == '14'){
            $sets = Set::where(['set_type' => '1'])->orderBy('id', 'ASC')->get();
        } else if ($req['_stock'] == '13'){
            $sets = Set::where(['set_type' => '2'])->orderBy('id', 'ASC')->get();
        }

        $setdrape = SetdrapeDaily::find($req['_id']);
        $setdrape->sent2_time = $req['sent_time']. ' ' .date("h:i:s");
        $setdrape->sent3_time = $req['sent_time']. ' ' .date("h:i:s");

        if($setdrape->save()) {
            foreach ($sets as $set) {
                $set_id = $set->id;

                if ($req[$set_id. '_sentin2'] || $req[$set_id. '_sentin3']) {
                    $detail = SetdrapeDailyDetail::where(['setdrape_daily_id' => $req['_id']])
                                                    ->where(['set_id' => $set->id])
                                                    ->first();

                    $detail->sentin2_amt = $req[$set_id. '_sentin2'];
                    $detail->sentin3_amt = $req[$set_id. '_sentin3'];
                    $detail->remark = $req[$set_id. '_remark'];
                    $detail->save();
                }
            }
        }

        return redirect('daily/setdrape/list');
    }

    public function sentoutlist ()
    {
    	return view('daily.sentoutlist', [
    		'sentoutTypes'  => SentoutType::orderBy('sentout_type_id', 'ASC')->get(),
    		'_month'        => (!Input::get('_month')) ? date('Y-m') : Input::get('_month'),
    	]);
    }

    public function sentoutform ()
    {
    	return view('daily.sentoutform', [
    		'sentoutTypes' => SentoutType::orderBy('sentout_type_id', 'ASC')
    									->get()
    	]);
    }

    public function sentoutadd(Request $req)
    {	
    	$sentoutTypes = SentoutType::orderBy('sentout_type_id', 'ASC')
    								->get();

    	$sentout = new SentoutDaily();
    	$sentout->date = $req['sentout_date'];
    	$sentout->invoice_no = $req['invoice'];
    	$sentout->total = $req['total'];
    	$sentout->return = $req['return'];
    	
    	if ($sentout->save()) {
    		$sentoutDailyLastId = $sentout->id;

    		foreach ($sentoutTypes as $sentoutType) {
                $sentoutTypeId = $sentoutType->sentout_type_id;

	    		if ($req[$sentoutTypeId. '_amount']) {
                    // dd($sentoutType);
	    			$detail = new SentoutDailyDetail();
	    			$detail->sentout_daily_id = $sentoutDailyLastId;
	    			$detail->sentout_type_id = $sentoutTypeId;
	    			$detail->amount = $req[$sentoutTypeId. '_amount'];
	    			// $detail->return = $req[$sentoutTypeId. '_return'];
	    			$detail->remark = $req[$sentoutTypeId. '_remark'];
	    			$detail->save();
	    		}
	    	}
    	}

    	return redirect('daily/sentout/list');
    }

    public function ajaxpostdetailitems(Request $req)
    {
        $resultChk = 0;
        foreach (Input::all() as $item) {
            $detailItem = new SentoutDailyDetailItem();
            $detailItem->sentout_daily_id = $item['sentout_daily_id'];
            $detailItem->return_type      = $item['return_type'];
            $detailItem->drape_id         = $item['drape_id'];
            $detailItem->amount           = $item['amount'];
            // $detailItem->remark           = $item['remark'];
            if($detailItem->save()){
                $resultChk += 1; 
            }
        }

        if($resultChk > 0){
            return 'success'; 
        } else {
            return 'failure'; 
        }
    }

    public function ajax ($drape_id)
    {
        $sentin = DB::table("sentin_daily")
                        ->select('*')
                        ->join('sentin_daily_detail', 'sentin_daily.id', '=', 'sentin_daily_detail.sentin_daily_id')  
                        ->where(['sentin_daily.date' => $_month. '-' .$d])
                        ->where(['sentin_daily_detail.drape_id' => $drape_id])
                        ->first();

        return $sentin;
    }
}
