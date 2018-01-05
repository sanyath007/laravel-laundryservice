@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <!-- page title -->
    <div class="page__title">
        <span>ยอดส่งผ้าไปหน่วยงาน</span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('daily/sentin/add') }}" method="POST">
                {{ csrf_field() }}

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">คลัง</label>
                        <select id="stock" name="stock" class="form-control">
                            <option value="">-- กรุณาเลือก --</option>
                            @foreach ($stocks as $stock)
                                <option value="{{ $stock->id }}">{{ $stock->stock_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">วันที่ส่ง</label>
                        <input type="text" id="sent_date" name="sent_date" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">จำนวนผู้ป่วย</label>
                        <input type="text" id="patient_num" name="patient_num" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">หมายเหตุ</label>
                        <input type="text" id="remark" name="remark" class="form-control">
                    </div>
                </div>
                
                <table class="table table-striped">
                    <tr>
                        <th style="text-align: center; width: 4%;">#</th>
                        <th style="text-align: left;">รายการผ้า</th>
                        <th style="text-align: center; width: 10%;">จำนวนส่ง</th>
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

        $('#sent_date').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM-DD',
            defaultDate: moment(dateNow)
        });
    });
</script>

@endsection
