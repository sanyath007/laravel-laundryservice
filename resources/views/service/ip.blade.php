@extends('layouts.main')

@section('content')
<div class="container-fluid">
  
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">ข้อมูลการให้บริการ IP</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>
            <i class="fa fa-calendar" aria-hidden="true"></i> ข้อมูลการให้บริการ IP
        </span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form id="frm_search" action="{{ url('service/ip') }}" method="GET" class="form-inline">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="">ประจำวันที่ :</label>
                    <input  type="text" 
                            id="_day" 
                            name="_day" 
                            value="{{ $_day }}"
                            class="form-control">
                </div>
            </form><br>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td style="width: 5%; text-align: center;" rowspan="2">ลำดับ</td>
                            <td style="text-align: center;" rowspan="2">หอผู้ป่วย</td>
                            <td style="width: 10%; text-align: center;" colspan="2">เวรเช้า<br></td>
                            <td style="width: 10%; text-align: center;" colspan="2">เวรบ่าย<br></td>
                            <td style="width: 10%; text-align: center;" colspan="2">เวรดึก<br></td>
                        </tr>
                        <tr>
                            <td style="width: 10%; text-align: center;">8.00 - 12.00 น.</td>
                            <td style="width: 10%; text-align: center;">13.00 - 16.00 น.</td>
                            <td style="width: 10%; text-align: center;">16.00 - 20.00 น.</td>
                            <td style="width: 10%; text-align: center;">20.00 - 24.00 น.</td>
                            <td style="width: 10%; text-align: center;">0.00 - 4.00 น.</td>
                            <td style="width: 10%; text-align: center;">4.00 - 8.00 น.</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $cx = 0;
                            $morning11 = 0;
                            $morning12 = 0;
                            $evening21 = 0;
                            $evening22 = 0;
                            $night11 = 0;
                            $night12 = 0;
                        ?>

                        @foreach($ipservices as $ipservice)

                            <?php
                                $morning11+=$ipservice->num11;
                                $morning12+=$ipservice->num12;
                                $evening21+=$ipservice->num21;
                                $evening22+=$ipservice->num22;
                                $night11+=$ipservice->num31;
                                $night12+=$ipservice->num32;
                            ?>
                        
                            <tr>
                                <td style="text-align: center;">{{ ++$cx }}</td>
                                <td>{{ $ipservice->ward.'-'.$ipservice->wardname }}</td>
                                <td style="text-align: center;">{{ $ipservice->num11 }}</td>
                                <td style="text-align: center;">{{ $ipservice->num12 }}</td>
                                <td style="text-align: center;">{{ $ipservice->num21 }}</td>
                                <td style="text-align: center;">{{ $ipservice->num22 }}</td>
                                <td style="text-align: center;">{{ $ipservice->num31 }}</td>
                                <td style="text-align: center;">{{ $ipservice->num32 }}</td>
                            </tr>
                        

                        @endforeach

                        <tr>
                            <td colspan=2 style="text-align: center;">รวม</td>
                            <td style="text-align: center;"><?=$morning11 ?></td>
                            <td style="text-align: center;"><?=$morning12 ?></td>
                            <td style="text-align: center;"><?=$evening21 ?></td>
                            <td style="text-align: center;"><?=$evening22 ?></td>
                            <td style="text-align: center;"><?=$night11 ?></td>
                            <td style="text-align: center;"><?=$night12 ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>            
            

        </div>
        <!-- right column -->
    </div><!-- /.row -->

</div><!-- /.container -->

<script>
    $(document).ready(function($) {
        var dateNow = new Date();

        $('#_day').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM-DD',
            defaultDate: moment(dateNow),
            viewMode: "days"
        }).on('dp.change', function(e) {
            $("#frm_search").submit();
        });
    });
</script>

@endsection
