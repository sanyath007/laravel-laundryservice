app.controller('mainCtrl', function($scope, $http, toaster, ModalService) {
    $scope.locationQuery = [];
    $scope.locations = [];
    $scope.locationIds = '';

    $scope.removeLocation = function(location) {
        // console.log(location);
        let index = $scope.locations.indexOf(location);
        $scope.locations.splice(index, 1);
        console.log($scope.locations);

        $scope.createLocationIdList();
    }

    //################## ฟังก์ชั่นแสดง autocomplete ของ customers ##################
    $scope.queryLocation = function(e) {
        var output = [];
        var keyword = ($(e.target).val() == '') ? '' : $(e.target).val();
        // console.log('keyword = ' + keyword);

        $scope.hidePopupLocation = false;

        if(e.keyCode == 8 && keyword == '') {
            $scope.hidePopupLocation = true;
            return;
        } else {
            $http.get('http://localhost/public/carservice/public/ajaxlocation/' + keyword)
            .then(function (data) {
                // console.log(data);
                $scope.locationQuery = data.data;
                // console.log(this.locationQuery);

                //ใส่ข้อมูลจากากร filter ในตัวแปรสำหรับแสดงผลใน autocomplete
                $scope.filterLocation = $scope.locationQuery;
                // $scope.cursorControl(e);
            });
        }        
    }

    $scope.addLocation = function(location) {
        let index = $scope.locations.findIndex(l => {
            console.log(l.id + '==' + location.id);
            return l.id==location.id;
        });
        console.log('index :' + index);

        if (index < 0) {
            $scope.locations.push({
                id: location.id,
                name: location.name
            });
        } else {
            toaster.pop('warning', "", "คุณเลือกสถานที่ซ้ำ !!!");
        }

        $scope.createLocationIdList();

        //clear input value
        $('#location').val('');
        //ซ่อน autocomplete
        $scope.hidePopupLocation = true;
    }

    $scope.createLocationIdList = function() {
        var index = 1;
        $scope.locationIds = '';
        angular.forEach($scope.locations, function(location) {
            console.log(index + '==' + $scope.locations.length);
            if (index < $scope.locations.length) {
                $scope.locationIds += location.id + ',';
            } else {
                $scope.locationIds += location.id;
            }

            index++;
        });

        console.log($scope.locationIds);

        $('#locationId').val($scope.locationIds);
    }

    $scope.cursorControl = function (e) {
        var list = $('.list-group-item');
        console.log(list);

        $.each(list, function(index, el) {
            if (index == 0) {
                console.log(this);
            }
        });
    }

    $scope.isProduct = false;
    $scope.persons = [];
    $scope.passengerList = [];

    //################## ฟังก์ชั่นแสดง autocomplete ของ products ##################
    $scope.completePersons = function(e) {
        var output = [];
        var keyword = ($(e.target).val() == '') ? '' : $(e.target).val();
        $scope.hidethis = false;

        if(e.keyCode == 8 && keyword == '') {
            console.log('keyword = ' + keyword);
            $scope.hidethis = true;
            return;
        } else {
            console.log('keyword = ' + keyword);
            $http.get('http://localhost/public/carservice/public/ajaxperson/' + keyword)
            .then(function (data) {
                // console.log(data);
                this.persons = data.data;
                // console.log(this.persons);

                //ดึงรายการ product ทั้งหมดมาแสดงใน autocomplete
                // angular.forEach($scope.persons, function(person) {
                    //filter เฉพาะรายการที่มีชื่อตามคำค้นหา
                    // if(person.name.toLowerCase().indexOf(keyword.toLowerCase()) >= 0) {
                        // output.push(person)
                    // }
                // });

                // console.log(output);
                //ใส่ข้อมูลจากากร filter ในตัวแปรสำหรับแสดงผลใน autocomplete
                $scope.filterPerson = this.persons;
            });
        }
    }

    $scope.filterPersonList = function(persons) {
        let list = {
            persons: persons,
        };

        $scope.passengerList.push(list);

        //ซ่อน autocomplete
        $scope.hidethis = true;

        //เคลียร์ค่าใน text searchProduct
        $('#searchPassenger').val('');

        //count passenger number
        var passengers = "";
        var count = 0;
        angular.forEach($scope.passengerList, function(passenger) {
            if(count != $scope.passengerList.length - 1){
                passengers += passenger.persons.id + ",";
            } else {
                passengers += passenger.persons.id
            }

            count++;
        });

        $('#passengers').val(passengers);
    }

    $scope.selectText = function(form) {
        var input = form.$editables[0].inputEl;
        input.select();
    }

    $scope.updateQty = function(data) {
        $scope.orderList.qty = data;
    }

    $scope.updateDisc = function(data) {
        $scope.orderList.disc = data;
    }

    // ลบรายการ
    $scope.removeProductList = function(list) {
        let index = $scope.passengerList.indexOf(list);
        $scope.passengerList.splice(index, 1);
    }

    // $scope.popover=null;
    // $scope.showEditable = function($event) {
    //   $scope.popover = $event.currentTarget;
    //   let target = $event.target;
    //   $($scope.popover).popover({
    //     html : true,
    //     title: function() {
    //       return $("#popover-head").html();
    //     },
    //     content: function() {
    //       return $("#popover-content").html();
    //     }
    //   });
    //
    //   $($scope.popover).popover("toggle");
    // }
    //
    // $scope.hideEditable = function($event) {
    //   let target = $event.target;
    //   $($scope.popover).popover("hide");
    //   $($scope.popover).on('hidden.bs.popover', function () {
    //     target.text('1');
    //   })
    //   $scope.popover=null;
    // }

    $scope.title = '';
    $scope.contentTopic = '';
  
    // Calendar variables
    $scope.today = moment().format('YYYY-MM-DD');
    $scope.fdMonth = moment().format('YYYY-01-01');
    $scope.ldMonth = moment().format('YYYY-12-31');
    // $scope.ldMonth = moment($scope.fdMonth).endOf('month').format('YYYY-MM-DD');
    $scope.events = [];

    $scope.initCalendar = function ($scope) {
        console.log(this.today);
        var callback = this.showEvent;

        $http.get('http://localhost/public/carservice/public/reserve/ajaxcalendar/' + this.fdMonth + '/' + this.ldMonth)
        .then(function (data) {
            this.events = data.data;
            console.log(this.events);

            $('#calendar').fullCalendar({
                locale: 'th',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                defaultDate: this.today,
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: this.events,
                eventClick: callback,
                dayClick: function (date) {
                    console.log(date)
                }
            });
        });
    }

    $scope.showEvent = function (event) {
        alert(event.title);
    }

    $scope.passengers = [];
    $scope.showPassengers = function (event, reserveid) {
        $http.get('http://localhost/public/carservice/public/ajaxpassenger/' + reserveid)
        .then(function (data) {
            $scope.passengers = data.data[1];
            console.log($scope.passengers);

            $('#dlgLocations').modal('show')
            
        //     ModalService.showModal({
        //         templateUrl: "modal.html",
        //         controller: "ModalController"
        //     }).then(function(modal) {
        //         //it's a bootstrap element, use 'modal' to show it
        //         modal.element.modal();
        //         modal.close.then(function(result) {
        //             console.log(result);
        //         });                
        //     });
        });
    }
});
