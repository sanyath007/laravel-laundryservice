@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <!-- page title -->
    <div class="page__title">
        <span>รายการจำหน่ายผ้า</span>
        <a href="{{ url('dispose/new') }}" class="btn btn-primary pull-right">
          <i class="fa fa-plus" aria-hidden="true"></i>
          จำหน่ายผ้า
        </a>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form id="frm_search" action="{{ url('dispose/list') }}" method="GET" class="form-inline">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="">ประจำเดือน :</label>
                    <input type="text" id="_month" name="_month" value="<?=$_month?>" class="form-control">
                </div>
            </form><br>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th style="text-align: center; width: 2%;">#</th>
                        <th style="text-align: center; width: 10%;">วันที่จำหน่าย</th>
                        <th style="text-align: center;">รายการผ้า</th>
                        <th style="text-align: center; width: 5%;">ปีผ้า</th>
                        <th style="text-align: center; width: 5%;">จำนวน</th>                     
                        <th style="text-align: center; width: 8%;">Actions</th>
                    </tr>

                    @foreach($disposes as $dispose)
 
                        <tr>
                            <td style="text-align: center;">{{ $dispose->id }}</td>
                            <td style="text-align: center;">{{ $dispose->dispose_date }}</td>
                            <td>{{ $dispose->drape->name }}</td>
                            <td style="text-align: center;">{{ $dispose->drape_year }}</td>
                            <td style="text-align: center;">{{ $dispose->amount }}</td>
                            <td style="text-align: center;">
                                @if (Auth::user()->person_id != '1300200009261')
                                    <a  href="{{ url('/print/print.php') }} ?id=" 
                                        class="btn btn-success btn-xs"
                                        target="_blank">
                                        <i class="fa fa-print" aria-hidden="true"></i>
                                    </a>
                                @endif
                                    
                                <a  href="{{ url('/dispose/edit') }}" 
                                    class="btn btn-warning btn-xs">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                
                                @if (Auth::user()->person_id != '1300200009261')
                                    <a  href="{{ url('/dispose/cancel') }}"
                                        class="btn btn-primary btn-xs">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>

                                    <form id="cancel-form" action="{{ url('/dispose/cancel') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                @endif

                                @if (Auth::user()->person_id != '1300200009261')
                                    <a  href="{{ url('/dispose/recover/') }}"
                                        class="btn btn-default btn-xs">
                                        <i class="fa fa-retweet" aria-hidden="true"></i>
                                    </a>

                                    <form id="recover-form" action="{{ url('/dispose/recover') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                @endif

                                <a  href="{{ url('/dispose/delete') }}"
                                    class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>

                                <form id="delete-form" action="{{ url('/dispose/delete') }}" method="POST" style="display: none;">
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
