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
                    <input type="text" id="_month" name="_month" value="<?=$_month?>" class="form-control" style="text-align: center;">
                </div>
            </form><br>

            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="font-size: 8pt;">
                    <tr>
                        <th style="text-align: center; width: 10%;" rowspan="2">วันที่</th>                        
                        <th style="text-align: center;" colspan="4">เซตตา</th>
                        <th style="text-align: center;" colspan="4">เซต Lap</th>
                        <th style="text-align: center;" colspan="4">เซต Large</th>
                        <th style="text-align: center;" colspan="4">เซตกาวน์</th>
                        <th style="text-align: center; width: 8%;" rowspan="2">Actions</th>                        
                    </tr>
                    <tr>
                        <!-- Large -->
                        <th style="text-align: center; width: 5%;">สต๊อก</th>
                        <th style="text-align: center; width: 5%;">ส่งซัก</th>
                        <th style="text-align: center; width: 5%;">จ่าย</th>
                        <th style="text-align: center; width: 5%;">คงเหลือ</th>
                        <!-- Lap -->
                        <th style="text-align: center; width: 5%;">สต๊อก</th>
                        <th style="text-align: center; width: 5%;">ส่งซัก</th>
                        <th style="text-align: center; width: 5%;">จ่าย</th>
                        <th style="text-align: center; width: 5%;">คงเหลือ</th>
                        <!-- เซตตา -->
                        <th style="text-align: center; width: 5%;">สต๊อก</th>
                        <th style="text-align: center; width: 5%;">ส่งซัก</th>
                        <th style="text-align: center; width: 5%;">จ่าย</th>
                        <th style="text-align: center; width: 5%;">คงเหลือ</th>
                        <!-- เซตกาวน์ -->
                        <th style="text-align: center; width: 5%;">สต๊อก</th>
                        <th style="text-align: center; width: 5%;">ส่งซัก</th>
                        <th style="text-align: center; width: 5%;">จ่าย</th>
                        <th style="text-align: center; width: 5%;">คงเหลือ</th>
                    </tr>                    
                    
                    <?php $index = 0; ?>
                    @for($d=1; $d <= 31; $d++)

                        <tr>
                            <td style="text-align: center;">{{ $_month.'-'.$d }}</td>

                            @for($s = 1; $s <= 4; $s++)

                                <?php $set = DB::table("setdrape_daily")
                                                    ->select('*')
                                                    ->join('setdrape_daily_detail', 'setdrape_daily.id', '=', 'setdrape_daily_detail.setdrape_daily_id')  
                                                    ->where(['setdrape_daily.date' => $_month. '-' .$d])
                                                    ->where(['setdrape_daily_detail.set_id' => $s])
                                                    ->first();
                                ?>

                                <td style="text-align: center;">
                                    {{ ($set) ? $set->stock_amt : '' }}
                                </td>
                                <td style="text-align: center;">
                                    {{ ($set) ? $set->request_amt : '' }}
                                </td>
                                <td style="text-align: center;">
                                    {{ ($set) ? $set->sentin_amt : '' }}
                                </td>
                                <td style="text-align: center;">
                                    <b style="color: red;">
                                        {{ ($set) ? (int)$set->stock_amt + (int)$set->sentin_amt : '' }}
                                    </b>
                                </td>

                             @endfor

                            <?php $setOr = DB::table("setdrape_daily")  
                                                ->where(['date' => $_month. '-' .$d])
                                                ->where(['stock_id' => '14'])
                                                ->first();
                                // var_dump($setOr);
                            ?>

                            <td style="text-align: center;"> 
                                    
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

                                @if ($setOr)
                                    <a  href="{{ url('/daily/setdrape/form2') }}/14/{{ ($setOr) ? $setOr->id : '' }}" 
                                        class="btn btn-primary btn-xs">
                                        <i class="fa fa-reply" aria-hidden="true"></i>
                                    </a>
                                @endif                                 
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
