@extends('layouts.main')

@section('content')
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">ตารางใช้รถวันนี้</li>
    </ol>
    
    <!-- page title -->
    <div class="page__title">
        <span>
            <i class="fa fa-calendar" aria-hidden="true"></i> ตารางใช้รถวันนี้
        </span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">

            <!-- AngularJS Fullcalendar -->
            <div id="calendar" style="margin: 20px 0px 20px 0px;" ng-init="initCalendar()"></div>

            <!-- JQuery Fullcalendar -->
            <!-- <div id="calendar" style="margin: 20px 0px 20px 0px;"></div>
            
            <script> 
                $(document).ready(function() { 
                    $('#calendar').fullCalendar({
                        "header": {
                            "left": "prev,next today",
                            "center": "title",
                            "right": "month,agendaWeek,agendaDay"
                        },
                        "eventLimit": true,
                        "firstDay": 1,
                        "events": [{
                            "id": 0,
                            "title": "Event one",
                            "allDay": true,
                            "start": "2017-01-02T09:00:00+00:00",
                            "end": "2017-01-06T08:00:00+00:00"
                        }]
                    });
                }); 
            </script> -->

        </div>
    </div><!-- /.row -->

</div>
<!-- /.container -->
@endsection
