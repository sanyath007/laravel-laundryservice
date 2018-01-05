@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <!-- page title -->
    <div class="page__title">
        <span>ยอดส่งผ้าไปโรงงาน</span>
        <a href="{{ url('daily/sentout/form') }}" class="btn btn-primary pull-right">
          <i class="fa fa-plus" aria-hidden="true"></i>
          New
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

                    @foreach($drapecates as $drapecate)
                        <tr>
                            <td style="text-align: center;">{{ $drapecate->drape_cate_id }}</td>
                            <td>{{ $drapecate->drape_cate_name }}</td>

                            <?php for($d=1; $d <= 31; $d++): ?>
                                <?php $sentout = DB::table("sentout_daily")
                                                    ->select('*')
                                                    ->join('sentout_daily_detail', 'sentout_daily.id', '=', 'sentout_daily_detail.sentout_daily_id')  
                                                    ->where(['sentout_daily.date' => $_month. '-' .$d])
                                                    ->where(['sentout_daily_detail.drape_cate_id' => $drapecate->drape_cate_id])
                                                    ->first();
                                ?>

                                <td style="text-align: center;">
                                    <?=(($sentout) ? $sentout->amount : '')?>
                                </td>
                            <?php endfor; ?>

                            <!-- <td style="text-align: center;">
                                <a href="{{ $drapecate->drape_cate_id }}" class="btn btn-warning btn-xs">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                <a href="{{ $drapecate->drape_cate_id }}" class="btn btn-danger btn-xs">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                            </td> -->
                        </tr>
                    @endforeach

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
