@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <!-- page title -->
    <div class="page__title">
        <span>ยอดรับผ้าจากโรงงาน</span>
        <a href="{{ url('daily/received/form') }}" class="btn btn-primary pull-right">
          <i class="fa fa-plus" aria-hidden="true"></i>
          รับผ้า
        </a>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('daily/received/list') }}" method="GET" class="form-inline">
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
                <table class="table table-striped table-bordered" style="font-size: 8pt;">
                    <tr>
                        <th style="text-align: center; width: 2%;">#</th>
                        <th style="text-align: center; width: 10%;">รายการผ้า</th>
                        <th style="text-align: center; width: 3%;">จำนวนที่มี</th>

                        <?php for($i=1; $i <= 31; $i++): ?>
                            <th style="text-align: center;"><?=$i ?></th>
                        <?php endfor; ?>
                        
                        <!-- <th style="text-align: center; width: 5%;">Actions</th> -->
                    </tr>

                    @foreach($drapeCates as $drapeCate)
                        <tr>
                            <td colspan="34" style="background-color: #D8D8D8;">{{ $drapeCate->drape_cate_name }}</td>
                        </tr>

                        @foreach($drapes as $drape)
                            @if($drape->drape_cate == $drapeCate->drape_cate_id)
    
                                <tr>
                                    <td style="text-align: center;">{{ $drape->id }}</td>
                                    <td>{{ $drape->name }}</td>
                                    <td style="text-align: center;">
                                        <span class="label label-primary btn-sm">
                                            {{ number_format($drape->amount) }}
                                        </span>
                                    </td>
                                    
                                    <?php for($d=1; $d <= 31; $d++): ?>
                                        <?php $received = DB::table("received_daily")
                                                            ->select('*')
                                                            ->join('received_daily_detail', 'received_daily.id', '=', 'received_daily_detail.received_daily_id')  
                                                            ->where(['received_daily.date' => $_month. '-' .$d])
                                                            ->where(['received_daily_detail.drape_id' => $drape->id])
                                                            ->first();
                                        ?>

                                        <td style="text-align: center;">
                                            <?=(($received) ? $received->amount : '') ?>
                                        </td>
                                    <?php endfor; ?>

                                </tr>

                            @endif
                        @endforeach
                    @endforeach

                    <tr>
                        <th colspan="3" style="text-align: center;">Actions</th>
                            
                        <?php for($d=1; $d <= 31; $d++): ?>
                            <?php $received = DB::table("received_daily")
                                                    ->select('*')
                                                    ->join('received_daily_detail', 'received_daily.id', '=', 'received_daily_detail.received_daily_id')  
                                                    ->where(['received_daily.date' => $_month. '-' .$d])
                                                    ->where(['received_daily_detail.drape_id' => $drape->id])
                                                    ->first();
                            ?>
                            <td style="text-align: center;">
                                @if (Auth::user()->person_id != '1300200009261')
                                    <a  href="{{ url('/print/print.php') }} ?id=" 
                                        class="btn btn-success btn-xs"
                                        target="_blank">
                                        <i class="fa fa-print" aria-hidden="true"></i>
                                    </a>
                                @endif
                                    
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
