@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="sentoutCtrl">
    <!-- page title -->
    <div class="page__title">
        <span>แบบส่งผ้าไปโรงงาน</span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('daily/sentout/add') }}" method="POST" ng-submit="submitSentoutForm()">
                {{ csrf_field() }}                

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">วันที่ส่ง</label>
                        <input type="text" id="sentout_date" name="sentout_date" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">เลขที่ใบส่งผ้า</label>
                        <input type="text" id="invoice" name="invoice" class="form-control">
                    </div>
                </div>
                
                <table class="table table-striped">
                    <tr>
                        <th style="text-align: center; width: 4%;">#</th>
                        <th style="text-align: left;">รายการผ้า</th>
                        <th style="text-align: center; width: 10%;">จำนวน นน. (กก.)</th>
                        <th style="text-align: center; width: 10%;">จำนวนชิ้น (ผืน)</th>
                        <th style="text-align: center; width: 25%;">หมายเหตุ</th>
                    </tr>

                    @foreach($sentoutTypes as $sentoutType)

                        <tr>
                            <td style="text-align: center;">
                                {{ $sentoutType->sentout_type_id }}
                            </td>
                            <td>
                                {{ $sentoutType->sentout_type_name . ' (' . $sentoutType->count_method_desc . ')' }}
                            </td>
                            
                            @if($sentoutType->count_method == '1')
                                <td style="text-align: center;">
                                    <input  type="text" 
                                            id="{{ $sentoutType->sentout_type_id. '_amount' }}" 
                                            name="{{ $sentoutType->sentout_type_id. '_amount' }}" 
                                            class="form-control" 
                                            style="text-align: center;"
                                            ng-blur="calculateAllWeight()">
                                </td>

                                <td style="text-align: center;">&nbsp;</td>
                            @endif

                            @if($sentoutType->count_method == '2')
                                <td style="text-align: center;">&nbsp;</td>
                                <td style="text-align: center;">
                                    <input  type="text" 
                                            id="{{ $sentoutType->sentout_type_id. '_amount' }}" 
                                            name="{{ $sentoutType->sentout_type_id. '_amount' }}" 
                                            class="form-control" 
                                            style="text-align: center;">
                                </td>
                            @endif
                            
                            @if($sentoutType->count_method == '3')
                                <td style="text-align: center;">
                                    <input  type="text" 
                                            id="{{ $sentoutType->sentout_type_id. '_amount' }}" 
                                            name="{{ $sentoutType->sentout_type_id. '_amount' }}" 
                                            class="form-control" 
                                            style="text-align: center;">
                                </td>
                                <td style="text-align: center;">
                                    <a  ng-click="popUpDetailItems()"
                                        class="btn btn-info btn-xs">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                    </a>
                                </td>
                            @endif
                            <td style="text-align: center;">
                                <input  type="text" 
                                        id="{{ $sentoutType->sentout_type_id. '_remark' }}" 
                                        name="{{ $sentoutType->sentout_type_id. '_remark' }}" 
                                        class="form-control">
                            </td>
                        </tr>

                    @endforeach

                    <tr>
                        <td colspan="2" style="text-align: right;"><b>น้ำหนักรวม</b></td>
                        <td style="text-align: center;">
                            <input  type="text" 
                                    id="total" 
                                    name="total" 
                                    class="form-control" 
                                    style="text-align: center;">
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <!-- <tr>
                        <td colspan="2" style="text-align: right;"><b>ซักซ้ำ</b></td>
                        <td style="text-align: center;">
                            <input type="text" id="return" name="return" class="form-control" style="text-align: center;">
                        </td>
                        <td>&nbsp;</td>
                    </tr> -->

                </table>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary pull-right">บันทึก</button>
                    </div>
                </div>

            </form>
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
                                    <td>@{{ item.id }}</td>
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
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Modal -->
</div>

<script>
    $(document).ready(function($) {
        var dateNow = new Date();

        $('#sentout_date').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM-DD',
            defaultDate: moment(dateNow)
        });
    });
</script>

@endsection
