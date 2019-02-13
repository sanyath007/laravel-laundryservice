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
            
            <form id="frm_search" action="{{ url('daily/setdrape/list') }}" method="GET" class="form-inline">
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

            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="font-size: 8pt;">
                    <tr>
                        <th style="text-align: center; width: 10%" rowspan="2">วันที่</th>                        
                        <th style="text-align: center;" colspan="3">เซต Large</th>
                        <th style="text-align: center;" colspan="3">เซต Lap</th>
                        <th style="text-align: center;" colspan="3">เซตตา</th>
                        <th style="text-align: center;" colspan="3">เซตกาวน์</th>
                    </tr>
                    <tr>
                        <!-- Large -->
                        <th style="text-align: center;">ส</th>
                        <th style="text-align: center;">ช</th>
                        <th style="text-align: center;">จ</th>
                        <!-- Lap -->
                        <th style="text-align: center;">ส</th>
                        <th style="text-align: center;">ช</th>
                        <th style="text-align: center;">จ</th>
                        <!-- เซตตา -->
                        <th style="text-align: center;">ส</th>
                        <th style="text-align: center;">ช</th>
                        <th style="text-align: center;">จ</th>
                        <!-- เซตกาวน์ -->
                        <th style="text-align: center;">ส</th>
                        <th style="text-align: center;">ช</th>
                        <th style="text-align: center;">จ</th>
                    </tr>                    
                    
                    <?php $index = 0; ?>
                    @for($d=1; $d <= 31; $d++)

                        <tr>
                            <td style="text-align: center;">{{ $_month.'-'.$d }}</td>

                            <?php $setdrape = DB::table("setdrape_daily")
                                                ->select('*')
                                                ->join('setdrape_daily_detail', 'setdrape_daily.id', '=', 'setdrape_daily_detail.setdrape_daily_id')  
                                                ->where(['setdrape_daily.date' => $_month. '-' .$d])
                                                ->where(['setdrape_daily_detail.set_id' => '1'])
                                                ->first();
                            ?>

                            <td style="text-align: center;">
                                {{ '' }}
                            </td>
                            <td style="text-align: center;">
                                {{ '' }}
                            </td>
                            <td style="text-align: center;">
                                {{ '' }}
                            </td>
                        </tr>

                    @endfor

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
        }).on('dp.change', function(e) {
            $("#frm_search").submit();
        });
    });
</script>

@endsection
