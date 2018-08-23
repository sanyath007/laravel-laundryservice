@extends('layouts.main')

@section('content')

<div class="container-fluid" ng-controller="sentoutCtrl">
    <!-- page title -->
    <div class="page__title">
        <span>ยอดส่งผ้าไปโรงงาน</span>
        <a href="{{ url('daily/sentout/form') }}" class="btn btn-primary pull-right">
          <i class="fa fa-plus" aria-hidden="true"></i>
          ส่งผ้า
        </a>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            
            <form action="{{ url('daily/sentout/list') }}" method="GET" class="form-inline">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="">ประจำเดือน :</label>
                    <input type="text" id="_month" name="_month" value="<?=$_month?>" class="form-control">
                </div>

                <button class="btn btn-primary">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form><br>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th style="text-align: center; width: 2%">#</th>
                        <th style="text-align: center; width: 10%">รายการผ้า</th>

                        <?php for($i=1; $i <= 31; $i++): ?>
                            <th style="text-align: center;"><?=$i ?></th>
                        <?php endfor; ?>
                        
                        <!-- <th style="text-align: center; width: 5%;">Actions</th> -->
                    </tr>

                    @foreach($sentoutTypes as $sentoutType)
                        <tr>
                            <td style="text-align: center;">{{ $sentoutType->sentout_type_id }}</td>
                            <td>{{ $sentoutType->sentout_type_name }}</td>

                            <?php for($d=1; $d <= 31; $d++): ?>
                                <?php $sentout = DB::table("sentout_daily")
                                                    ->select('*')
                                                    ->join('sentout_daily_detail', 'sentout_daily.id', '=', 'sentout_daily_detail.sentout_daily_id')  
                                                    ->where(['sentout_daily.date' => $_month. '-' .$d])
                                                    ->where(['sentout_daily_detail.sentout_type_id' => $sentoutType->sentout_type_id])
                                                    ->first();
                            ?>

                                <td style="text-align: center;">
                                    <font size="1.5"><?=(($sentout) ? $sentout->amount.$sentoutType->unit : '')?></font>
                                </td>
                            <?php endfor; ?>

                            <!-- <td style="text-align: center;">
                                <a href="{{ $sentoutType->drape_cate_id }}" class="btn btn-warning btn-xs">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                <a href="{{ $sentoutType->drape_cate_id }}" class="btn btn-danger btn-xs">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                            </td> -->
                        </tr>

                    @endforeach

                    <tr>
                        <td colspan="2" style="text-align: center;">Actions</td>

                        <?php for($d=1; $d <= 31; $d++): ?>
                            <?php 
                                $sentout2 = DB::table("sentout_daily")  
                                                ->where(['date' => $_month. '-' .$d])
                                                ->first();
                            ?>

                            <td style="text-align: center;">                                
                                <a  href="{{ url('/print/print.php') }} ?id={{ ($sentout2) ? $sentout2->id : '' }}" 
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
    });
</script>

@endsection
