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
            
            <form id="frm_search" action="{{ url('daily/sentout/list') }}" method="GET" class="form-inline">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="">ประจำเดือน :</label>
                    <input  type="text" 
                            id="_month" 
                            name="_month" 
                            value="<?=$_month?>"
                            class="form-control"
                            style="text-align: center;">
                </div>
            </form><br>

            <!-- day1-15 -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th style="text-align: center; width: 2%;">#</th>
                        <th style="text-align: center; width: 20%;">รายการผ้า</th>

                        @for($i=1; $i <= 15; $i++)
                            <th style="text-align: center; width: 4%;"><?=$i ?></th>
                        @endfor
                        
                        <!-- <th style="text-align: center; width: 5%;">Actions</th> -->
                    </tr>

                    @foreach($sentoutTypes as $sentoutType)

                        <tr>
                            <td style="text-align: center;">{{ $sentoutType->sentout_type_id }}</td>
                            <td>{{ $sentoutType->sentout_type_name }} ( {{$sentoutType->unit }})</td>

                            @for($d=1; $d <= 15; $d++)

                                <?php $sentout = DB::table("sentout_daily")
                                                    ->select('*')
                                                    ->join('sentout_daily_detail', 'sentout_daily.id', '=', 'sentout_daily_detail.sentout_daily_id')  
                                                    ->where(['sentout_daily.date' => $_month. '-' .$d])
                                                    ->where(['sentout_daily_detail.sentout_type_id' => $sentoutType->sentout_type_id])
                                                    ->first();
                                ?>

                                @if($sentoutType->sentout_type_id==14 || $sentoutType->sentout_type_id==15)
                                    @if(($sentout) && $sentout->amount > 0)

                                        <td style="text-align: center; font-size: 8pt;">
                                            {{ ($sentout) ? $sentout->amount : '' }}

                                            <a  ng-click="popUpDetailItems({{ $sentout->sentout_daily_id }}, {{ ($sentoutType->sentout_type_id==14) ? 1 : 2 }})"
                                                class="btn btn-info btn-xs">
                                                <i class="fa fa-list" aria-hidden="true"></i>
                                            </a>
                                        </td>

                                    @else 

                                        <td style="text-align: center;"></td>

                                    @endif
                                @else

                                    <td style="text-align: center; font-size: 8pt;">
                                        {{ ($sentout) ? $sentout->amount : '' }}
                                    </td>

                                @endif
                            @endfor

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

                    <!-- น้ำหนักรวม -->
                    <tr>
                        <td colspan="2" style="text-align: center;">น้ำหนักรวม</td>

                        @for($d=1; $d <= 15; $d++)
                            <?php 
                                $sentoutTotal = DB::table("sentout_daily")  
                                                ->where(['date' => $_month. '-' .$d])
                                                ->first();
                            ?>
                            <td style="text-align: center; font-size: 8pt;">
                                {{ ($sentoutTotal) ? number_format($sentoutTotal->total, 2) : '' }}<br>

                                <?= (!empty($sentoutTotal->remark)) 
                                        ?   '<span data-balloon="'.$sentoutTotal->remark.'" data-balloon-pos="up">
                                                <i class="fa fa-info-circle fa-1x text-info" aria-hidden="true"></i>
                                            </span>' 
                                        : '' 
                                ?>
                            </td>
                        @endfor
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">Actions</td>

                        @for($d=1; $d <= 15; $d++)
                            <?php $sentout2 = DB::table("sentout_daily")  
                                                ->where(['date' => $_month. '-' .$d])
                                                ->first();
                            ?>

                            <td style="text-align: center;">
                                @if (Auth::user()->person_id == '1300200009261')                  
                                    <!-- <a  href="{{ url('/print/print.php') }}?id={{ ($sentout2) ? $sentout2->id : '' }}" 
                                        class="btn btn-success btn-xs"
                                        target="_blank">
                                        <i class="fa fa-print" aria-hidden="true"></i>
                                    </a> -->
                                @endif
                                    
                                <a  href="{{ url('/reserve/edit/') }}" 
                                    class="btn btn-warning btn-xs">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                
                                @if (Auth::user()->person_id == '1300200009261')
                                    <!-- <a  href="{{ url('/reserve/cancel/') }}"
                                        class="btn btn-primary btn-xs">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>

                                    <form id="cancel-form" action="{{ url('/reserve/cancel/') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form> -->
                                @endif

                                @if (Auth::user()->person_id == '1300200009261')
                                    <!-- <a  href="{{ url('/reserve/recover/') }}"
                                        class="btn btn-default btn-xs">
                                        <i class="fa fa-retweet" aria-hidden="true"></i>
                                    </a>

                                    <form id="recover-form" action="{{ url('/reserve/recover/') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form> -->                                

                                    <a  href="{{ url('/reserve/delete/') }}"
                                        class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>

                                    <form id="delete-form" action="{{ url('/reserve/delete/') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                @endif                            
                            </td>

                        @endfor

                    </tr>

                </table>
            </div>
            <!-- day1-15 -->

            <!-- day16-31 -->
            <div class="table-responsive">
                {{ date("Y-m-t", strtotime(date($_month.'-1'))) }}
                <table class="table table-striped table-bordered">
                    <tr>
                        <th style="text-align: center; width: 2%;">#</th>
                        <th style="text-align: center; width: 20%;">รายการผ้า</th>

                        @for($i=16; $i <= 31; $i++)
                            <th style="text-align: center; width: 4%;"><?=$i ?></th>
                        @endfor
                        
                        <!-- <th style="text-align: center; width: 5%;">Actions</th> -->
                    </tr>

                    @foreach($sentoutTypes as $sentoutType)

                        <tr>
                            <td style="text-align: center;">{{ $sentoutType->sentout_type_id }}</td>
                            <td>{{ $sentoutType->sentout_type_name }} ({{ $sentoutType->unit }})</td>

                            @for($d=16; $d <= 31; $d++)
                                <?php $sentout = DB::table("sentout_daily")
                                                    ->select('*')
                                                    ->join('sentout_daily_detail', 'sentout_daily.id', '=', 'sentout_daily_detail.sentout_daily_id')  
                                                    ->where(['sentout_daily.date' => $_month. '-' .$d])
                                                    ->where(['sentout_daily_detail.sentout_type_id' => $sentoutType->sentout_type_id])
                                                    ->first();
                                ?>

                                @if($sentoutType->sentout_type_id==14 || $sentoutType->sentout_type_id==15)
                                    @if(($sentout) && $sentout->amount > 0)

                                        <td style="text-align: center; font-size: 8pt;">                                            
                                            {{ ($sentout) ? $sentout->amount : '' }}

                                            <a  ng-click="popUpDetailItems({{ $sentout->sentout_daily_id }}, {{ ($sentoutType->sentout_type_id==14) ? 1 : 2 }})"
                                                class="btn btn-info btn-xs">
                                                <i class="fa fa-list" aria-hidden="true"></i>
                                            </a>
                                        </td>

                                    @else 

                                        <td style="text-align: center;"></td>

                                    @endif
                                @else

                                    <td style="text-align: center; font-size: 8pt;">
                                        {{ ($sentout) ? $sentout->amount : '' }}
                                    </td>

                                @endif
                            @endfor

                        </tr>

                    @endforeach

                    <!-- น้ำหนักรวม -->
                    <tr>
                        <td colspan="2" style="text-align: center;">น้ำหนักรวม</td>

                        @for($d=16; $d <= 31; $d++)
                            <?php 
                                $sentoutTotal = DB::table("sentout_daily")  
                                                ->where(['date' => $_month. '-' .$d])
                                                ->first();
                            ?>
                            <td style="text-align: center; font-size: 8pt;">
                                {{ ($sentoutTotal) ? number_format($sentoutTotal->total, 2) : '' }}<br>

                                <?= (!empty($sentoutTotal->remark)) 
                                        ?   '<span data-balloon="'.$sentoutTotal->remark.'" data-balloon-pos="up">
                                                <i class="fa fa-info-circle fa-1x text-info" aria-hidden="true"></i>
                                            </span>' 
                                        : '' 
                                ?>
                            </td>
                        @endfor
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">Actions</td>

                        <?php for($d=16; $d <= 31; $d++): ?>
                            <?php 
                                $sentout2 = DB::table("sentout_daily")  
                                                ->where(['date' => $_month. '-' .$d])
                                                ->first();
                            ?>

                            <td style="text-align: center;">
                                @if (Auth::user()->person_id == '1300200009261')                               
                                    <!-- <a  href="{{ url('/print/print.php') }} ?id={{ ($sentout2) ? $sentout2->id : '' }}" 
                                        class="btn btn-success btn-xs"
                                        target="_blank">
                                        <i class="fa fa-print" aria-hidden="true"></i>
                                    </a> -->
                                @endif

                                <a  href="{{ url('/reserve/edit/') }}" 
                                    class="btn btn-warning btn-xs">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                    
                                @if (Auth::user()->person_id == '1300200009261')
                                    <!-- <a  href="{{ url('/reserve/cancel/') }}"
                                        class="btn btn-primary btn-xs">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>

                                    <form id="cancel-form" action="{{ url('/reserve/cancel/') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form> -->
                                @endif

                                @if (Auth::user()->person_id == '1300200009261')
                                    <!-- <a  href="{{ url('/reserve/recover/') }}"
                                        class="btn btn-default btn-xs">
                                        <i class="fa fa-retweet" aria-hidden="true"></i>
                                    </a>

                                    <form id="recover-form" action="{{ url('/reserve/recover/') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form> -->

                                    <a  href="{{ url('/reserve/delete/') }}"
                                        class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>

                                    <form id="delete-form" action="{{ url('/reserve/delete/') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                @endif                              
                            </td>

                        <?php endfor; ?>
                    </tr>

                </table>
            </div>
            <!-- day16-31 -->
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="dlgDetailItems" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="">เพิ่มข้อมูล</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="sd_id" name="sd_id">
                    <input type="hidden" id="r_type" name="r_type">

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <select id="dlgDrape" class="form-control">
                                    <option value="">-- กรุณาเลือกประเภทผ้า --</option>
                                    <option ng-repeat="drape in allDrapes" value="@{{ drape.id }}">
                                        @{{ drape.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" id="dlgAmount" class="form-control" placeholder="ระบุจำนวน (ชิ้น)">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button id="dlgAddItem" class="btn btn-success" ng-click="dlgAddItem()">เพิ่ม</button>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 4%; text-align: center;">#</th>
                                    <th>รายการผ้า</th>
                                    <th style="width: 30%; text-align: center;">จำนวน (ชิ้น)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="(index, item) in dlgItemList">
                                    <td>@{{ index + 1 }}</td>
                                    <td>@{{ item.drape_name }}</td>
                                    <td>@{{ item.amount }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 

                    <ul class="pagination">
                        <li>
                            <a ng-click="paginate($event, dlgItemList.path)" aria-label="First">
                                <span aria-hidden="true">First</span>
                            </a>
                        </li>

                        <li ng-class="{ 'disabled': (dlgItemList.current_page === 1) }">
                            <a  ng-click="paginate($event, dlgItemList.prev_page_url)" 
                                aria-label="Prev">
                                <span aria-hidden="true">Prev</span>
                            </a>
                        </li>                         
                               
                        <li ng-repeat="i in _.range(1, dlgItemList.last_page + 1)"
                            ng-class="{ 'active': (dlgItemList.current_page === i) }">
                            <a ng-click="paginate($event, dlgItemList.path + '?page=' + i)">
                                @{{ i }}
                            </a>
                        </li>
                                
                        <li ng-class="{ 'disabled': (dlgItemList.current_page === dlgItemList.last_page) }">
                            <a ng-click="paginate($event, dlgItemList.next_page_url)" aria-label="Next">
                                <span aria-hidden="true">Next</span>
                            </a>
                        </li>

                        <li>
                            <a ng-click="paginate($event, dlgItemList.path + '?page=' + dlgItemList.last_page)" aria-label="Last">
                                <span aria-hidden="true">Last</span>
                            </a>
                        </li>
                    </ul> 

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" ng-click="dlgSaveItem()">
                        บันทึก
                    </button>

                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

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
