@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <!-- page title -->
    <div class="page__title">
        <span>ยอดส่งผ้าไปหน่วยงาน</span>
        <a href="{{ url('daily/sentin/form') }}" class="btn btn-primary pull-right">
          <i class="fa fa-plus" aria-hidden="true"></i>
          New
        </a>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            
            <form action="{{ url('daily/sentin/list') }}" method="GET" class="form-inline">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="">คลัง : </label>
                    <select id="_stock" name="_stock" class="form-control">
                        <option value="">-- กรุณาเลือก --</option>
                        @foreach ($stocks as $stock)
                            <option value="{{ $stock->id }}" <?=(($stock->id == $_stock) ? 'selected' : '')?>>
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

            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="font-size: 8pt;">
                    <tr>
                        <th style="text-align: center; width: 2%">#</th>
                        <th style="text-align: center; width: 10%">รายการผ้า</th>

                        <?php for($i=1; $i <= 31; $i++): ?>
                            <th style="text-align: center;"><?=$i ?></th>
                        <?php endfor; ?>
                        
                        <!-- <th style="text-align: center; width: 5%;">Actions</th> -->
                    </tr>

                    @foreach($drapes as $drape)
                        <tr>
                            <td style="text-align: center;">{{$drape->id}}</td>
                            <td>{{$drape->name}}</td>

                            <?php for($d=1; $d <= 31; $d++): ?>
                                <?php $received = DB::table("sentin_daily")
                                                        ->select('*')
                                                        ->join('sentin_daily_detail', 'sentin_daily.id', '=', 'sentin_daily_detail.sentin_daily_id')  
                                                        ->where(['sentin_daily.date' => $_month. '-' .$d])
                                                        ->where(['sentin_daily_detail.drape_id' => $drape->id])
                                                        ->first();
                                ?>

                                <th style="text-align: center;"></th>
                            <?php endfor; ?>
                            
                            <!-- <td style="text-align: center;">
                                <a href="{{$drape->id}}" class="btn btn-warning btn-xs">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                <a href="{{$drape->id}}" class="btn btn-danger btn-xs">
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
