@extends('layouts.main')

@section('content')
<div class="container-fluid">
  
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">ข้อมูลการให้บริการ OR</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>
            <i class="fa fa-calendar" aria-hidden="true"></i> ข้อมูลการให้บริการ OR
        </span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form id="frm_search" action="{{ url('service/or') }}" method="GET" class="form-inline">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="">ประจำเดือน :</label>
                    <input  type="text" 
                            id="_month" 
                            name="_month" 
                            value="{{ $_month }}"
                            class="form-control">
                </div>
            </form><br>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <!-- <th style="width: 4%; text-align: center;">#</th> -->
                        <th style="text-align: center;">วัน/เดือน/ปี</th>
                        <th style="width: 10%; text-align: center;">ทั้งหมด</th>
                        <th style="width: 10%; text-align: center;">ทั่วไป</th>
                        <th style="width: 10%; text-align: center;">จักษุ</th>
                        <th style="width: 10%; text-align: center;">ออร์โธ</th>
                        <th style="width: 10%; text-align: center;">ก่อนเที่ยง</th>
                        <th style="width: 10%; text-align: center;">หลังหลังเที่ยง</th>
                        <th style="width: 10%; text-align: center;">บ่าย</th>
                        <th style="width: 10%; text-align: center;">ดึก</th>
                    </tr>

                    @foreach($orservices as $orservice)

                        <tr>
                            <td style="text-align: center;">
                                {{ $orservice->operation_date }}
                            </td>  
                            <td style="text-align: center;">
                                {{ $orservice->num }}
                            </td>                      
                            <td style="text-align: center;">
                                {{ $orservice->gen }}
                            </td>
                            <td style="text-align: center;">
                                {{ $orservice->eye }}
                            </td>
                            <td style="text-align: center;">
                                {{ $orservice->orth }}
                            </td>
                            <td style="text-align: center;">
                                {{ $orservice->morning }}
                            </td>                       
                            <td style="text-align: center;">
                                {{ $orservice->afternoo }}
                            </td>
                            <td style="text-align: center;">
                                {{ $orservice->evening }}
                            </td>
                            <td style="text-align: center;">
                                {{ $orservice->night }}
                            </td>                            
                        </tr>

                    @endforeach

                </table>
            </div>            
            

        </div>
        <!-- right column -->
    </div><!-- /.row -->

</div><!-- /.container -->

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
