@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <!-- page title -->
    <div class="page__title">
        <span>ยอดรับผ้าจากโรงงาน</span>
        <a href="{{ url('daily/received/form') }}" class="btn btn-primary pull-right">
          <i class="fa fa-plus" aria-hidden="true"></i>
          New
        </a>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('daily/received/add') }}" method="POST">
                {{ csrf_field() }}
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">วันที่รับผ้า</label>
                        <input type="text" id="received_date" name="received_date" class="form-control">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">น้ำหนักผ้ารวม</label>
                        <input type="text" id="weight" name="weight" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">จำนวนผ้าเสียทั้งหมด</label>
                        <input type="text" id="return" name="return" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">หมายเหตุ</label>
                        <input type="text" id="remark" name="remark" class="form-control">
                    </div>
                </div>

                <table class="table table-striped table-hover">
                    <tr>
                        <th style="text-align: center; width: 4%;">#</th>
                        <th style="text-align: left;">รายการผ้า</th>
                        <th style="text-align: center; width: 10%;">จำนวนรับ</th>
                        <th style="text-align: center; width: 10%;">จำนวนผ้าเสีย<br>(ส่งคืน)</th>
                        <th style="text-align: center; width: 20%;">หมายเหตุ</th>
                    </tr>

                    @foreach($drapes as $drape)
                        <tr>
                            <td style="text-align: center;">{{ $drape->id }}</td>
                            <td>{{ $drape->name }}</td>
                            <td style="text-align: center;">
                                <input type="text" id="{{ $drape->id. '_amount' }}" name="{{ $drape->id. '_amount' }}" class="form-control" style="text-align: center;">
                            </td>
                            <td style="text-align: center;">
                                <input type="text" id="{{ $drape->id. '_return' }}" name="{{ $drape->id. '_return' }}" class="form-control" style="text-align: center;">
                            </td>
                            <td style="text-align: center;">
                                <input type="text" id="{{ $drape->id. '_remark' }}" name="{{ $drape->id. '_remark' }}" class="form-control">
                            </td>
                        </tr>
                    @endforeach

                </table>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary pull-right">บันทึก</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function($) {
        var dateNow = new Date();

        $('#received_date').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM-DD',
            defaultDate: moment(dateNow)
        });
    });
</script>

@endsection
