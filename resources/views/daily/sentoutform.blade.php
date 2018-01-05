@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <!-- page title -->
    <div class="page__title">
        <span>ยอดส่งผ้าไปโรงงาน</span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('daily/sentout/add') }}" method="POST">
                {{ csrf_field() }}                

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">วันที่ส่ง</label>
                        <input type="text" id="sentout_date" name="sentout_date" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">บิล เล่มที่/เลขที่</label>
                        <input type="text" id="invoice" name="invoice" class="form-control">
                    </div>
                </div>
                
                <table class="table table-striped">
                    <tr>
                        <th style="text-align: center; width: 4%;">#</th>
                        <th style="text-align: left;">รายการผ้า</th>
                        <th style="text-align: center; width: 10%;">จำนวน นน. (กก.)</th>
                        <th style="text-align: center; width: 25%;">หมายเหตุ</th>
                    </tr>

                    @foreach($drapecates as $drapecate)
                    <tr>
                        <td style="text-align: center;">{{ $drapecate->drape_cate_id }}</td>
                        <td>{{ $drapecate->drape_cate_name }}</td>
                            <td style="text-align: center;">
                                <input type="text" id="{{ $drapecate->drape_cate_id. '_amount' }}" name="{{ $drapecate->drape_cate_id. '_amount' }}" class="form-control" style="text-align: center;">
                            </td>
                            <td style="text-align: center;">
                                <input type="text" id="{{ $drapecate->drape_cate_id. '_remark' }}" name="{{ $drapecate->drape_cate_id. '_remark' }}" class="form-control">
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="2" style="text-align: right;"><b>น้ำหนักรวม</b></td>
                        <td style="text-align: center;">
                            <input type="text" id="total" name="total" class="form-control" style="text-align: center;">
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right;"><b>ซักซ้ำ</b></td>
                        <td style="text-align: center;">
                            <input type="text" id="return" name="return" class="form-control" style="text-align: center;">
                        </td>
                        <td>&nbsp;</td>
                    </tr>

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

        $('#sentout_date').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM-DD',
            defaultDate: moment(dateNow)
        });
    });
</script>

@endsection
