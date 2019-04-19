@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <!-- page title -->
    <div class="page__title">
        <span>ยอดรับผ้าจากโรงงาน</span>
        <a href="{{ url('daily/received/form') }}" class="btn btn-primary pull-right">
          <i class="fa fa-plus" aria-hidden="true"></i>
          รับผ้า
        </a>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form id="frm_search" action="{{ url('daily/received/list') }}" method="GET" class="form-inline">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="">ประจำเดือน :</label>
                    <input type="text" id="_month" name="_month" value="<?=$_month?>" class="form-control">
                </div>
            </form><br>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th style="text-align: center; width: 4%;">#</th>
                        <th style="text-align: center; width: 7%;">เลขที่บิล</th>
                        <th style="text-align: center; width: 10%;">วันที่</th>
                        <th style="text-align: center; width: 8%;">ผ้าสามัญ</th>
                        <th style="text-align: center; width: 8%;">ผ้าห้องพิเศษ</th>
                        <th style="text-align: center; width: 8%;">ผ้าห้องผ่าตัด</th>
                        <th style="text-align: center; width: 8%;">ผ้าห้องคลอด</th>
                        <th style="text-align: center; width: 8%;">ผ้าทันตกรรม</th>
                        <th style="text-align: center; width: 8%;">ผ้าทั้งหมด</th>
                        <th style="text-align: center; width: 5%;">รายละเเอียด</th>
                        <th style="text-align: center; width: 8%;">Actions</th>
                    </tr>

                    @foreach($receiveds as $received)

                        <tr>
                            <td style="text-align: center;">{{ $received->id }}</td>
                            <td style="text-align: center;">{{ $received->invoice }}</td>
                            <td style="text-align: center;">{{ convThDateFromDb($received->date) }}</td>
                            <td style="text-align: center;">{{ number_format($received->com_weight, 2) }}</td>
                            <td style="text-align: center;">{{ number_format($received->vip_weight, 2) }}</td>
                            <td style="text-align: center;">{{ number_format($received->or_weight, 2) }}</td>
                            <td style="text-align: center;">{{ number_format($received->lr_weight, 2) }}</td>
                            <td style="text-align: center;">{{ number_format($received->dent_weight, 2) }}</td>
                            <td style="text-align: center;">{{ number_format($received->total_weight, 2) }}</td>
                            <td style="text-align: center;">
                                <a  href="{{ url('/reserve/cancel/') }}"
                                    class="btn btn-primary btn-xs">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td style="text-align: center;">
                                @if (Auth::user()->person_id != '1300200009261')
                                    <a  href="{{ url('/print/print.php') }} ?id=" 
                                        class="btn btn-success btn-xs"
                                        target="_blank">
                                        <i class="fa fa-print" aria-hidden="true"></i>
                                    </a>
                                @endif
                                    
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
                            </td>
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
        }).on('dp.change', function(e) {
            $("#frm_search").submit();
        });
    });
</script>

@endsection