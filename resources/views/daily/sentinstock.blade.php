@extends('layouts.main')

@section('content')

<div class="container-fluid" ng-controller="sentinCtrl">
    <!-- page title -->
    <div class="page__title">
        <span>ยอดผ้าคงเหลือของหน่วยงาน</span>

        <a href="{{ url('daily/sentin/form') }}" class="btn btn-primary pull-right">
          <i class="fa fa-plus" aria-hidden="true"></i>
          เบิกผ้า
        </a>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('daily/sentin/stock') }}" method="GET" class="form-inline" id="frm_sentin_list">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="">คลัง : </label>
                    <select id="_stock" name="_stock" class="form-control" onchange="reloadSentin()">
                        <option value="">-- กรุณาเลือก --</option>

                        @foreach ($stocks as $stock)
                            <option value="{{ $stock->id }}" <?=(($stock->id == $_stock) ? 'selected' : '')?> >
                                {{ $stock->stock_name }}
                            </option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for="">ประจำเดือน :</label>
                    <input type="text" id="_month" name="_month" value="<?=$_month?>" class="form-control">
                </div>

                <button class="btn btn-primary">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form><br>

            <!-- day 1 to 15 -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="font-size: 8pt;">
                    <tr>
                        <th style="text-align: center; width: 2%;" rowspan="2">#</th>
                        <th style="text-align: center; width: 15%;" rowspan="2">รายการผ้า</th>

                        <?php for($i=1; $i <=   15; $i++): ?>
                            <th style="text-align: center;" colspan="2"><?=$i ?></th>
                        <?php endfor; ?>
                    </tr>
                    <tr>
                        <?php for($i=1; $i <= 15; $i++): ?>
                            <th style="text-align: center;">เบิก</th>
                            <th style="text-align: center;">จ่าย</th>
                        <?php endfor; ?>
                    </tr>

                    @foreach($drapes as $drape)
                        <tr>
                            <td style="text-align: center;">{{ $drape->id }}</td>
                            <td>{{ $drape->name }}</td>

                            <?php for($i=1; $i <= 15; $i++): ?>
                                <?php $sentins = DB::table("sentin_daily")
                                                    ->select('*')
                                                    ->join('sentin_daily_detail', 'sentin_daily.id', '=', 'sentin_daily_detail.sentin_daily_id')  
                                                    ->where(['sentin_daily.date' => $_month. '-' .$i])
                                                    ->where(['sentin_daily.stock_id' => $_stock])
                                                    ->where(['sentin_daily_detail.drape_id' => $drape->id])
                                                    ->first();                                    
                                ?>

                                <td style="text-align: center;">{{ ($sentins) ? $sentins->request_amt : '' }}</td>
                                <td style="text-align: center;">{{ ($sentins) ? $sentins->sent_amt : '' }}</td>
                            <?php endfor; ?>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="2" style="text-align: center;">Actions</td>

                        <?php for($d=1; $d <= 15; $d++): ?>
                            <?php 
                                $sentin2 = DB::table("sentin_daily")  
                                                ->where(['date' => $_month. '-' .$d])
                                                ->where(['stock_id' => $_stock])
                                                ->first();
                            ?>

                            <td style="text-align: center;" colspan="2">                                
                                <a  href="{{ url('/print/print.php') }} ?id={{ ($sentin2) ? $sentin2->id : '' }}" 
                                    class="btn btn-success btn-xs"
                                    target="_blank">
                                    <i class="fa fa-print" aria-hidden="true"></i>
                                </a>
                                    
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

                                <a  href="{{ url('/print/print.php') }} ?id={{ ($sentin2) ? $sentin2->id : '' }}" 
                                    class="btn btn-primary btn-xs">
                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                </a>                                   
                            </td>

                        <?php endfor; ?>
                    </tr>

                </table>
            </div>

            <!-- day 16 to 31 -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="font-size: 8pt;">
                    <tr>
                        <th style="text-align: center; width: 2%;" rowspan="2">#</th>
                        <th style="text-align: center; width: 15%;" rowspan="2">รายการผ้า</th>

                        <?php for($i=16; $i <=   31; $i++): ?>
                            <th style="text-align: center;" colspan="2"><?=$i ?></th>
                        <?php endfor; ?>
                    </tr>
                    <tr>
                        <?php for($i=16; $i <= 31; $i++): ?>
                            <th style="text-align: center;">เบิก</th>
                            <th style="text-align: center;">จ่าย</th>
                        <?php endfor; ?>
                    </tr>

                    @foreach($drapes as $drape)
                        <tr>
                            <td style="text-align: center;">{{ $drape->id }}</td>
                            <td>{{ $drape->name }}</td>

                            <?php for($i=16; $i <= 31; $i++): ?>
                                <?php $sentins = DB::table("sentin_daily")
                                                    ->select('*')
                                                    ->join('sentin_daily_detail', 'sentin_daily.id', '=', 'sentin_daily_detail.sentin_daily_id')  
                                                    ->where(['sentin_daily.date' => $_month. '-' .$i])
                                                    ->where(['sentin_daily.stock_id' => $_stock])
                                                    ->where(['sentin_daily_detail.drape_id' => $drape->id])
                                                    ->first();                                    
                                ?>

                                <td style="text-align: center;">{{ ($sentins) ? $sentins->request_amt : '' }}</td>
                                <td style="text-align: center;">{{ ($sentins) ? $sentins->sent_amt : '' }}</td>
                            <?php endfor; ?>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="2" style="text-align: center;">Actions</td>

                        <?php for($d=16; $d <= 31; $d++): ?>
                            <?php 
                                $sentin2 = DB::table("sentin_daily")  
                                                ->where(['date' => $_month. '-' .$d])
                                                ->where(['stock_id' => $_stock])
                                                ->first();
                            ?>

                            <td style="text-align: center;" colspan="2">                                
                                <a  href="{{ url('/print/print.php') }} ?id={{ ($sentin2) ? $sentin2->id : '' }}" 
                                    class="btn btn-success btn-xs"
                                    target="_blank">
                                    <i class="fa fa-print" aria-hidden="true"></i>
                                </a>
                                    
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

                                <a  href="{{ url('/daily/sentin/form2') }}/{{ ($sentin2) ? $sentin2->id : '' }}" 
                                    class="btn btn-primary btn-xs">
                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                </a>                             
                            </td>

                        <?php endfor; ?>
                    </tr>

                </table>
            </div>

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
        });

        reloadSentin = function () {
            console.log($('#frm_sentin_list'))
            $("#frm_sentin_list").submit()
        }
    });
</script>

@endsection
