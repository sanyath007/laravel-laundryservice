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
                            class="form-control"
                            style="text-align: center;">
                </div>
            </form><br>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <!-- <th style="width: 4%; text-align: center;">#</th> -->
                        <th style="text-align: center;">วัน/เดือน/ปี</th>
                        <th style="width: 6%; text-align: center;">ทั้งหมด</th>
                        <th style="width: 6%; text-align: center;">ทั่วไป</th>
                        <th style="width: 6%; text-align: center;">จักษุ</th>
                        <th style="width: 6%; text-align: center;">ออร์โธ</th>
                        <th style="width: 6%; text-align: center;"><เที่ยง</th>
                        <th style="width: 6%; text-align: center;">>เที่ยง</th>
                        <th style="width: 6%; text-align: center;">บ่าย</th>
                        <th style="width: 6%; text-align: center;">ดึก</th>
                        @foreach($sets as $set)
                            <th style="width: 7%; text-align: center;">{{ $set->set_name }}</th>
                        @endforeach
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

                            @foreach($sets as $set)                       
                                <?php $setData = DB::table("setdrape_daily")
                                                ->select('*')
                                                ->join('setdrape_daily_detail', 'setdrape_daily.id', '=', 'setdrape_daily_detail.setdrape_daily_id')  
                                                ->where(['setdrape_daily.date' => $orservice->operation_date])
                                                ->where(['setdrape_daily_detail.set_id' => $set->id])
                                                ->first();
                                ?>
                                <td style="text-align: center;">
                                <?php 
                                    if($setData) {
                                        $setTotal = ($setData) 
                                            ? (int)$setData->stock_amt + (int)$setData->sentin1_amt + (int)$setData->sentin2_amt + (int)$setData->sentin3_amt : 
                                            '';
                                        

                                        if($setData->set_id == 2 || $setData->set_id == 3) {
                                            $service = (int)$orservice->gen + (int)$orservice->orth;
                                        }
                                        elseif($setData->set_id == 1) {
                                            $service = (int)$orservice->eye + (int)$orservice->orth;
                                        }
                                        elseif($setData->set_id == 4) {
                                            $service = (int)$orservice->num;
                                        }

                                        echo $setTotal - $service;
                                    }
                                ?>
                                </td> 
                            @endforeach                     
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
            console.log($("#frm_search").attr('action'));
            // $("#frm_search").attr('action');
            $("#frm_search").submit();
        });
    });
</script>

@endsection
