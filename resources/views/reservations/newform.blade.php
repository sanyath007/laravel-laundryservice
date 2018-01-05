    @extends('layouts.main')

    @section('content')
    <div class="container-fluid">
      
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">บันทึกขอใช้รถ</li>
        </ol>

        <!-- page title -->
        <div class="page__title">
            <span>
                <i class="fa fa-calendar" aria-hidden="true"></i> บันทึกขอใช้รถ
            </span>
        </div>

        <hr />
        <!-- page title -->
        
        <form action="{{ url('/reserve/add') }}" method="post">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ID">เลขที่การขอ</label>
                        <input type="text" value="REV60-NEW" class="form-control" readonly>
                    </div>
                </div>
                <!-- left column -->
        
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ID">วันที่ขอ</label>
                        <input type="text" name="reserve_date" value="<?= date('Y-m-d'); ?>" class="form-control" readonly>
                    </div>
                </div>
                <!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="ID">เพื่อไปราชการ</label>
                        <input type="text" id="activity" name="activity" value="" class="form-control">
                    </div>
                </div>
                <!-- left column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">

                    <div class="form-group">
                        <label for="ID">สถานที่</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dlgLocations">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </button>
                            </span>
                            <input type="text" id="location" name="location" class="form-control" placeholder="สถานที่&hellip;" ng-keyup="queryLocation($event)" autocomplete="off">
                        </div>                        

                        <!-- <tags-input ng-model="locations"> -->
                            <!-- <auto-complete source="loadLocation($query)"></auto-complete> -->
                        <!-- </tags-input> -->
                        
                        <input type="hidden" id="locationId" name="locationId">

                        <!-- Autocomplete List -->
                        <div class="list-group" ng-model="hidePopupLocation" ng-hide="hidePopupLocation" style="width: auto; z-index: 10; position: absolute;">
                            <a class="list-group-item" ng-repeat="l in filterLocation" ng-click="addLocation(l)">
                                @{{l.name}}
                            </a>
                        </div>
                        <!-- Autocomplete List -->                    
                    </div>

                    

                    <span class="tag label label-info" ng-repeat="location in locations">
                        <span>@{{ location.name }}</span>
                        <a ng-click="removeLocation(location)">
                            <i class="remove glyphicon glyphicon-remove-sign glyphicon-white"></i>
                        </a> 
                    </span>

                    <!-- Modal -->
                    <div class="modal fade" id="dlgLocations" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="">เพิ่มสถานที่</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="">ชื่อสถานที่</label>
                                        <input type="text" name="" ng-model="product" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">ที่อยู่</label>
                                        <input type="text" name="" ng-model="product" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">ถนน</label>
                                        <input type="text" name="" ng-model="product" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="ID">จังหวัด</label>
                                        <select name="" class="form-control">
                                            <option value="">-- กรุณาเลือกจังหวัด --</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="ID">อำเภอ</label>
                                        <select name="" class="form-control">
                                            <option value="">-- กรุณาเลือกอำเภอ --</option>
                                        </select>
                                    </div>                    

                                    <div class="form-group">
                                        <label for="ID">ตำบล</label>                    
                                        <select name="" class="form-control">
                                            <option value="">-- กรุณาเลือกตำบล --</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">รหัสไปรษณี</label>
                                        <input type="text" name="" ng-model="product" class="form-control">
                                    </div>            
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                    <button type="button" class="btn btn-primary">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i> Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->   

                </div><!-- left column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ID">ใช้ระหว่างวันที่</label>
                        <input type="text" id="from_date" name="from_date" class="form-control">
                    </div>
                </div>
                <!-- left column -->
            
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ID">เวลา</label>
                        <input type="text" id="from_time" name="from_time" class="form-control">
                    </div>
                </div><!-- right column -->
            </div><!-- end row -->

            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ID">ถึงวันที่</label>
                        <input type="text" id="to_date" name="to_date" class="form-control">
                    </div>
                </div>
                <!-- left column -->
            
                <!-- right column -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ID">เวลา</label>
                        <input type="text" id="to_time" name="to_time" class="form-control">
                    </div>
                </div><!-- right column -->
            </div><!-- end row -->
            
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="ID">หน่วยงานผู้จอง</label>
                        <select name="department" class="form-control">
                            <option value="">-- กรุณาเลือกหน่วยงาน --</option>
                            <?php $departments = App\Department::all(); ?>                      
                            @foreach($departments as $department)
                                <option value="{{ $department->ward_id }}">
                                    {{ $department->ward_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>         
                        
                </div>
                <!-- left column -->
            </div><!-- end row -->

            <!-- passenger -->
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="ID">ผู้ร่วมเดินทาง</label> ( <input type="checkbox" name="chkUserIn" checked="checked"> รวมผู้ขอ )
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dlgPersons">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                </button>
                            </span>
                            <input type="text" id="searchPassenger" class="form-control" placeholder="เจ้าหน้าที่&hellip;" ng-keyup="completePersons($event)" ng-model="persons" autocomplete="off">
                            <!-- ng-keyup="$event.keyCode == 13 && showCustomer()" -->
                        </div>
                        
                        <!-- Autocomplete List -->
                        <div class="list-group" ng-model="hidethis" ng-hide="hidethis" style="width: auto; z-index: 10; position: absolute;">
                            <a class="list-group-item" ng-repeat="p in filterPerson" ng-click="filterPersonList(p)">
                                @{{p.name}}
                            </a>
                        </div>
                        <!-- Autocomplete List -->
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="dlgPersons" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="">เพิ่มบุคลากร</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="">ชื่อบุคลากร</label>
                                        <input type="text" name="" ng-model="product" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                    <button type="button" class="btn btn-primary">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i> Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->  

                    <div class="table-responsive" style="height: 165px;border: 1px solid #D8D8D8;">
                        <table id="products-list" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10%; text-align: center;">CID</th>
                                    <th>ชื่อ-สกุล</th>
                                    <th style="width: 20%; text-align: center;">ตำแหน่ง</th>
                                    <th style="width: 30%; text-align: center;">สังกัด</th>
                                    <th style="width: 10%; text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="p in passengerList">
                                    <td style="text-align: center;">
                                        @{{p.persons.id}}
                                    </td>
                                    <td>@{{p.persons.name}}</td>   
                                    <td style="text-align: center;">
                                        @{{p.persons.position}}
                                    </td>
                                    <td style="text-align: center;">
                                        @{{p.persons.department}}
                                    </td>
                                    <td style="text-align: center;">
                                        <a ng-click="removeProductList(p)" style="color: red;cursor: pointer;">
                                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- end col -->

                <!-- right column -->
                <div class="col-md-4">
                    <label for="remark">หมายเหตุ</label>
                    <textarea name="remark" cols="30" rows="10" class="form-control"></textarea>
                </div><!-- right column -->
            </div><!-- end row -->

            <!-- <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-danger">
                        <div class="panel-body">
                            <p>
                                <span>Sale Person :</span><span class="pull-right">Kobe</span>
                            </p>
                            <p>
                                <span>Sub Total :</span><span class="pull-right">@{{subTotal}}</span>
                            </p>
                            <p>
                                <span>Discount :</span>
                                <a href="#" class=" pull-right" editable-text="discount">@{{discount}}</a>
                            </p>
                            <p>
                                <span>Tax :</span>
                                <a href="#" class=" pull-right" editable-text="tax">@{{tax}}</a>
                            </p>

                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-md-12">
                                  <label for="" col-md-12>ชำระโดย :</label>
                                  <div data-toggle="buttons">
                                    <label type="button" class="btn btn-default active">
                                      <input type="radio" name="q1" value="0">
                                      Cash
                                    </label>
                                    <label type="button" class="btn btn-default">
                                      <input type="radio" name="q1" value="0">
                                      Credit Card
                                    </label>
                                    <label type="button" class="btn btn-default">
                                      <input type="radio" name="q1" value="0">
                                      Check
                                    </label>
                                    <label type="button" class="btn btn-default">
                                      <input type="radio" name="q1" value="0">
                                      Credit
                                    </label>
                                  </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <div class="input-group">
                                      <input type="text" class="form-control" placeholder="0.00" ng-model="total">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-success">
                                          <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                          จบการขาย
                                        </button>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                            </div>

                            <div class="row" ng-show="!comment">
                                <div class="col-md-12">
                                  <i class="fa fa-comment-o" aria-hidden="true"></i>
                                  Comment :
                                  <a ng-click="comment = !comment">
                                    <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                                  </a>
                                </div>
                            </div>

                            <div class="row" ng-show="comment">
                                <div class="col-md-12">
                                  <i class="fa fa-comment-o" aria-hidden="true"></i>
                                  Comment :
                                  <a ng-click="comment = !comment">
                                    <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
                                  </a>

                                  <textarea name="name" rows="4" cols="80" class="form-control"></textarea>
                                  <input type="checkbox" name="" value=""> แสดงข้อความ Comment
                                </div>
                            </div>

                        </div>
                    </div> --><!-- /.panel -->

                <!-- </div> --><!-- end col -->
            <!-- </div> --><!-- end row -->

            <div class="row">
                <div class="col-md-12">
                    <br><button class="btn btn-primary pull-right">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก
                    </button>
                </div>
            </div>

            <input type="hidden" id="user" name="user" value="{{ Auth::user()->person_id }}">
            <input type="hidden" id="passengers" name="passengers">
            {{ csrf_field() }}
        </form>
        
        <script>
            $(document).ready(function($) {
                var dateNow = new Date();

                $('#from_date').datetimepicker({
                    useCurrent: true,
                    format: 'YYYY-MM-DD',
                    defaultDate: moment(dateNow)
                }); 

                $('#from_time').datetimepicker({
                    useCurrent: true,
                    format: 'HH:mm',
                    defaultDate: moment(dateNow).hours(8).minutes(0).seconds(0).milliseconds(0) 
                }); 

                $('#to_date').datetimepicker({
                    useCurrent: true,
                    format: 'YYYY-MM-DD',
                    defaultDate: moment(dateNow)
                }); 

                $('#to_time').datetimepicker({
                    useCurrent: true,
                    format: 'HH:mm',
                    defaultDate: moment(dateNow).hours(16).minutes(0).seconds(0).milliseconds(0)
                }); 
                // $("#activity").tagsinput('items')
            });
        </script>

    </div><!-- /.container -->
    @endsection
