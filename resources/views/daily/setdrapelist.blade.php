@extends('layouts.main')

@section('content')

<div class="container-fluid" ng-controller="setdrapeCtrl">
    <!-- page title -->
    <div class="page__title">
        <span>ยอดเบิก-จ่ายเซตผ้ารายวัน</span>
        <a href="{{ url('daily/setdrape/form') }}" class="btn btn-primary pull-right">
          <i class="fa fa-plus" aria-hidden="true"></i>
          เบิกเซตผ้า
        </a>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            
            <form id="frm_search" action="{{ url('daily/setdrape/add') }}" method="GET" class="form-inline">
                {{ csrf_field() }}

                <!-- <div class="form-group">
                    <label for="">คลัง : </label>
                    <select id="_stock" name="_stock" class="form-control">
                        <option value="">-- กรุณาเลือก --</option>
                        @foreach ($stocks as $stock)
                            <option value="{{ $stock->id }}" <?=(($stock->id == $_stock) ? 'selected' : '')?>>
                                {{ $stock->stock_name }}
                            </option>
                        @endforeach
                    </select>
                </div> -->
                <div class="form-group">
                    <label for="">ประจำเดือน :</label>
                    <input type="text" id="_month" name="_month" value="<?=$_month?>" class="form-control">
                </div>
            </form><br>

            <!--เซตผ้า OR 1-15-->
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="font-size: 8pt;">
                    <tr>
                        <th style="text-align: center; width: 2%" rowspan="2">#</th>
                        <th style="text-align: center; width: 10%" rowspan="2">รายการผ้า</th>

                        <?php for($i=1; $i <= 15; $i++): ?>
                            <th style="text-align: center;" colspan="3"><?=$i ?></th>
                        <?php endfor; ?>
                    </tr>
                    <tr>
                        <?php for($i=1; $i <= 15; $i++): ?>
                            <th style="text-align: center;">ส</th>
                            <th style="text-align: center;">บ</th>
                            <th style="text-align: center;">จ</th>
                        <?php endfor; ?>
                    </tr>

                    @foreach($sets as $set)
                        @if($set->set_type=='1')

                            <tr>
                                <td style="text-align: center;">{{$set->id}}</td>
                                <td>{{$set->set_name}}</td>

                                <?php for($d=1; $d <= 15; $d++): ?>
                                    <?php $setdrape = DB::table("setdrape_daily")
                                                        ->select('*')
                                                        ->join('setdrape_daily_detail', 'setdrape_daily.id', '=', 'setdrape_daily_detail.setdrape_daily_id')  
                                                        ->where(['setdrape_daily.date' => $_month. '-' .$d])
                                                        ->where(['setdrape_daily_detail.set_id' => $set->id])
                                                        ->first();
                                    ?>

                                    <td style="text-align: center;">
                                        {{ ($setdrape) ? $setdrape->stock_amt : '' }}
                                    </td>
                                    <td style="text-align: center;">
                                        {{ ($setdrape) ? $setdrape->request_amt : '' }}
                                    </td>
                                    <td style="text-align: center;">
                                        {{ ($setdrape) ? $setdrape->sentin_amt : '' }}
                                    </td>

                                <?php endfor; ?>
                                
                            </tr>

                        @endif
                    @endforeach

                    <tr>
                        <td colspan="2" style="text-align: center;">Actions</td>

                        <?php for($d=1; $d <= 15; $d++): ?>
                            <?php $setOr1 = DB::table("setdrape_daily")  
                                                ->where(['date' => $_month. '-' .$d])
                                                ->where(['stock_id' => '14'])
                                                ->first();
                            ?>

                            <td style="text-align: center;" colspan="3"> 
                                    
                                <a  href="{{ url('/reserve/edit/') }}" 
                                    class="btn btn-warning btn-xs">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                
                                @if (Auth::user()->person_id != '1300200009261')
                                    <a  href="{{ url('/reserve/cancel/') }}"
                                        class="btn btn-primary btn-xs">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>

                                    <form id="cancel-form" action="{{ url('/reserve/cancel/') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                @endif

                                @if (Auth::user()->person_id != '1300200009261')
                                    <a  href="{{ url('/reserve/recover/') }}"
                                        class="btn btn-default btn-xs">
                                        <i class="fa fa-retweet" aria-hidden="true"></i>
                                    </a>

                                    <form id="recover-form" action="{{ url('/reserve/recover/') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                @endif

                                <a  href="{{ url('/reserve/delete/') }}"
                                    class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>

                                <form id="delete-form" action="{{ url('/reserve/delete/') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>

                                <a  href="{{ url('/daily/setdrape/form2') }}/14/{{ ($setOr1) ? $setOr1->id : '' }}" 
                                    class="btn btn-primary btn-xs">
                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                </a>                                   
                            </td>

                        <?php endfor; ?>
                    </tr>

                </table>
            </div>
            <!--เซตผ้า OR 1-15-->

            <!--เซตผ้า OR 16-31-->
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="font-size: 8pt;">
                    <tr>
                        <th style="text-align: center; width: 2%" rowspan="2">#</th>
                        <th style="text-align: center; width: 10%" rowspan="2">รายการผ้า</th>

                        <?php for($i=16; $i <= 31; $i++): ?>
                            <th style="text-align: center;" colspan="3"><?=$i ?></th>
                        <?php endfor; ?>
                    </tr>
                    <tr>
                        <?php for($i=16; $i <= 31; $i++): ?>
                            <th style="text-align: center;">ส</th>
                            <th style="text-align: center;">บ</th>
                            <th style="text-align: center;">จ</th>
                        <?php endfor; ?>
                    </tr>

                    @foreach($sets as $set)
                        @if($set->set_type=='1')

                            <tr>
                                <td style="text-align: center;">{{$set->id}}</td>
                                <td>{{$set->set_name}}</td>

                                <?php for($d=16; $d <= 31; $d++): ?>
                                    <?php $setdrape = DB::table("setdrape_daily")
                                                        ->select('*')
                                                        ->join('setdrape_daily_detail', 'setdrape_daily.id', '=', 'setdrape_daily_detail.setdrape_daily_id')  
                                                        ->where(['setdrape_daily.date' => $_month. '-' .$d])
                                                        ->where(['setdrape_daily_detail.set_id' => $set->id])
                                                        ->first();
                                    ?>

                                    <td style="text-align: center;">
                                        {{ ($setdrape) ? $setdrape->stock_amt : '' }}
                                    </td>
                                    <td style="text-align: center;">
                                        {{ ($setdrape) ? $setdrape->request_amt : '' }}
                                    </td>
                                    <td style="text-align: center;">
                                        {{ ($setdrape) ? $setdrape->sentin_amt : '' }}
                                    </td>

                                <?php endfor; ?>
                                
                            </tr>

                        @endif
                    @endforeach

                    <tr>
                        <td colspan="2" style="text-align: center;">Actions</td>

                        <?php for($d=16; $d <= 31; $d++): ?>
                            <?php $setOr2 = DB::table("setdrape_daily")  
                                                ->where(['date' => $_month. '-' .$d])
                                                ->where(['stock_id' => '14'])
                                                ->first();
                            ?>

                            <td style="text-align: center;" colspan="3">                                    
                                <a  href="{{ url('/reserve/edit/') }}" 
                                    class="btn btn-warning btn-xs">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                
                                @if (Auth::user()->person_id != '1300200009261')
                                    <a  href="{{ url('/reserve/cancel/') }}"
                                        class="btn btn-primary btn-xs">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>

                                    <form id="cancel-form" action="{{ url('/reserve/cancel/') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                @endif

                                @if (Auth::user()->person_id != '1300200009261')
                                    <a  href="{{ url('/reserve/recover/') }}"
                                        class="btn btn-default btn-xs">
                                        <i class="fa fa-retweet" aria-hidden="true"></i>
                                    </a>

                                    <form id="recover-form" action="{{ url('/reserve/recover/') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                @endif

                                <a  href="{{ url('/reserve/delete/') }}"
                                    class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>

                                <form id="delete-form" action="{{ url('/reserve/delete/') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>

                                <a  href="{{ url('/daily/setdrape/form2') }}/14/{{ ($setOr2) ? $setOr2->id : '' }}" 
                                    class="btn btn-primary btn-xs">
                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                </a>                                   
                            </td>

                        <?php endfor; ?>
                    </tr>

                </table>
            </div>
            <!--เซตผ้า OR 16-31-->

            <!--เซตผ้า LR 1-15-->
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="font-size: 8pt;">
                    <tr>
                        <th style="text-align: center; width: 2%" rowspan="2">#</th>
                        <th style="text-align: center; width: 10%" rowspan="2">รายการผ้า</th>

                        <?php for($i=1; $i <= 15; $i++): ?>
                            <th style="text-align: center;" colspan="3"><?=$i ?></th>
                        <?php endfor; ?>
                    </tr>
                    <tr>
                        <?php for($i=1; $i <= 15; $i++): ?>
                            <th style="text-align: center;">ส</th>
                            <th style="text-align: center;">บ</th>
                            <th style="text-align: center;">จ</th>
                        <?php endfor; ?>
                    </tr>

                    @foreach($sets as $set)
                        @if($set->set_type=='2')

                            <tr>
                                <td style="text-align: center;">{{$set->id}}</td>
                                <td>{{$set->set_name}}</td>

                                <?php for($d=1; $d <= 15; $d++): ?>
                                    <?php $setdrape = DB::table("setdrape_daily")
                                                        ->select('*')
                                                        ->join('setdrape_daily_detail', 'setdrape_daily.id', '=', 'setdrape_daily_detail.setdrape_daily_id')  
                                                        ->where(['setdrape_daily.date' => $_month. '-' .$d])
                                                        ->where(['setdrape_daily_detail.set_id' => $set->id])
                                                        ->first();
                                    ?>

                                    <td style="text-align: center;">
                                        {{ ($setdrape) ? $setdrape->stock_amt : '' }}
                                    </td>
                                    <td style="text-align: center;">
                                        {{ ($setdrape) ? $setdrape->request_amt : '' }}
                                    </td>
                                    <td style="text-align: center;">
                                        {{ ($setdrape) ? $setdrape->sentin_amt : '' }}
                                    </td>

                                <?php endfor; ?>
                                
                            </tr>

                        @endif
                    @endforeach

                    <tr>
                        <td colspan="2" style="text-align: center;">Actions</td>

                        <?php for($d=1; $d <= 15; $d++): ?>
                            <?php $setLr1 = DB::table("setdrape_daily")  
                                                ->where(['date' => $_month. '-' .$d])
                                                ->where(['stock_id' => '13'])
                                                ->first();
                            ?>

                            <td style="text-align: center;" colspan="3">                                    
                                <a  href="{{ url('/reserve/edit/') }}" 
                                    class="btn btn-warning btn-xs">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                
                                @if (Auth::user()->person_id != '1300200009261')
                                    <a  href="{{ url('/reserve/cancel/') }}"
                                        class="btn btn-primary btn-xs">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>

                                    <form id="cancel-form" action="{{ url('/reserve/cancel/') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                @endif

                                @if (Auth::user()->person_id != '1300200009261')
                                    <a  href="{{ url('/reserve/recover/') }}"
                                        class="btn btn-default btn-xs">
                                        <i class="fa fa-retweet" aria-hidden="true"></i>
                                    </a>

                                    <form id="recover-form" action="{{ url('/reserve/recover/') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                @endif

                                <a  href="{{ url('/reserve/delete/') }}"
                                    class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>

                                <form id="delete-form" action="{{ url('/reserve/delete/') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>

                                <a  href="{{ url('/daily/setdrape/form2') }}/13/{{ ($setLr1) ? $setLr1->id : '' }}" 
                                    class="btn btn-primary btn-xs">
                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                </a>                                   
                            </td>

                        <?php endfor; ?>
                    </tr>
                </table>
            </div>
            <!--เซตผ้า LR 1-15-->

            <!--เซตผ้า LR 16-31-->
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="font-size: 8pt;">
                    <tr>
                        <th style="text-align: center; width: 2%" rowspan="2">#</th>
                        <th style="text-align: center; width: 10%" rowspan="2">รายการผ้า</th>

                        <?php for($i=16; $i <= 31; $i++): ?>
                            <th style="text-align: center;" colspan="3"><?=$i ?></th>
                        <?php endfor; ?>
                    </tr>
                    <tr>
                        <?php for($i=16; $i <= 31; $i++): ?>
                            <th style="text-align: center;">ส</th>
                            <th style="text-align: center;">บ</th>
                            <th style="text-align: center;">จ</th>
                        <?php endfor; ?>
                    </tr>

                    @foreach($sets as $set)
                        @if($set->set_type=='2')

                            <tr>
                                <td style="text-align: center;">{{$set->id}}</td>
                                <td>{{$set->set_name}}</td>

                                <?php for($d=16; $d <= 31; $d++): ?>
                                    <?php $setdrape = DB::table("setdrape_daily")
                                                        ->select('*')
                                                        ->join('setdrape_daily_detail', 'setdrape_daily.id', '=', 'setdrape_daily_detail.setdrape_daily_id')  
                                                        ->where(['setdrape_daily.date' => $_month. '-' .$d])
                                                        ->where(['setdrape_daily_detail.set_id' => $set->id])
                                                        ->first();
                                    ?>

                                    <td style="text-align: center;">
                                        {{ ($setdrape) ? $setdrape->stock_amt : '' }}
                                    </td>
                                    <td style="text-align: center;">
                                        {{ ($setdrape) ? $setdrape->request_amt : '' }}
                                    </td>
                                    <td style="text-align: center;">
                                        {{ ($setdrape) ? $setdrape->sentin_amt : '' }}
                                    </td>

                                <?php endfor; ?>
                                
                            </tr>

                        @endif
                    @endforeach

                    <tr>
                        <td colspan="2" style="text-align: center;">Actions</td>

                        <?php for($d=16; $d <= 31; $d++): ?>
                            <?php $setLr2 = DB::table("setdrape_daily")  
                                                ->where(['date' => $_month. '-' .$d])
                                                ->where(['stock_id' => '13'])
                                                ->first();
                            ?>

                            <td style="text-align: center;" colspan="3">
                                <a  href="{{ url('/reserve/edit/') }}" 
                                    class="btn btn-warning btn-xs">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                
                                @if (Auth::user()->person_id != '1300200009261')
                                    <a  href="{{ url('/reserve/cancel/') }}"
                                        class="btn btn-primary btn-xs">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>

                                    <form id="cancel-form" action="{{ url('/reserve/cancel/') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                @endif

                                @if (Auth::user()->person_id != '1300200009261')
                                    <a  href="{{ url('/reserve/recover/') }}"
                                        class="btn btn-default btn-xs">
                                        <i class="fa fa-retweet" aria-hidden="true"></i>
                                    </a>

                                    <form id="recover-form" action="{{ url('/reserve/recover/') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                @endif

                                <a  href="{{ url('/reserve/delete/') }}"
                                    class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>

                                <form id="delete-form" action="{{ url('/reserve/delete/') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>

                                <a  href="{{ url('/daily/setdrape/form2') }}/13/{{ ($setLr2) ? $setLr2->id : '' }}" 
                                    class="btn btn-primary btn-xs">
                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                </a>                                   
                            </td>

                        <?php endfor; ?>
                    </tr>

                </table>
            </div>
            <!--เซตผ้า LR 16-31-->

        </div>
    </div>
</div>
<script>
    $(document).ready(function($) {
        var dateNow = new Date();

        $('#_month').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM',
            defaultDate: moment(dateNow),
            viewMode: "months"
        }).on('dp.change', function(e) {
            $("#frm_search").submit();
        });
    });
</script>

@endsection
