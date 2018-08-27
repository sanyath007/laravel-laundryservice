app.controller('sentinCtrl', function($scope, $http, toaster, ModalService, CONFIG) {
/** ################################################################################## */
    console.log(CONFIG.BASE_URL)
    let baseUrl = CONFIG.BASE_URL
/** ################################################################################## */
	// let dateNow = new Date()
	// $scope.assignDate = moment(dateNow)
	$scope.drapeforward = []
	$scope.stocks = []

	$scope.testName = function () {
		console.log(event.target)
	}

	$scope.requestTotal = 0;
	$scope.submitSentinForm = function () {				
		console.log(event.target)
		console.log($("#request_time").val())

		if ($("#total").val() == 0) {
			event.preventDefault()
			toaster.pop('error', "", "กรุณากรอกข้อมูลก่อน !!!")
		} else {
			toaster.pop('success', "", "บันทึกข้อมูลเรียบร้อย !!!")
		}
	}

	$scope.sentTotal = 0;
	$scope.submitSentinForm2 = function () {				
		console.log(event.target)
		console.log($("#sent_time").val())

		if ($("#sent_total").val() == 0) {
			event.preventDefault()
			toaster.pop('error', "", "กรุณากรอกข้อมูลก่อน !!!")
		} else {
			toaster.pop('success', "", "บันทึกข้อมูลเรียบร้อย !!!")
		}
	}

	$scope.calculateSentTotal = function () {
		console.log(event.target)
		$scope.sentTotal += ($("#"+event.target.id).val() == '') ? 0 : parseInt($("#"+event.target.id).val());
		$("#sent_total").val($scope.sentTotal)
		console.log($("#sent_total").val())
	}

	$scope.loadDrapeforWard = function () {
		console.log($('#_stock').val())
		$http.get(baseUrl + '/drape/ajaxdrapeforstock/' + $('#_stock').val())
		.then(function (res) {
			console.log(res.data)
			$scope.drapeforward = res.data
		})
	}

	$scope.createLocationView = function (strLocation) {
		let arrLocation = strLocation.split(',')

		return arrLocation
	}

	$scope.createAssignOptions = function (reservation, times) {
		console.log(reservation)
		if ($(event.target).is(':checked')) {
			if (reservation.total_time <= 3) { // ใช้เวลาไม่ถึง 3 ชม.
				$("#allday").val('1')
			} else if (reservation.total_time > 3 && reservation.total_time < 8) { // ใช้เวลา 3 - 8 ชม.
				$("#allday").val('2')
			} else if (reservation.total_time >= 8) { // ใช้เวลามากกว่า 8 ชม.
				$("#allday").val('3')
			}
			console.log($("#allday").val())

			if (reservation.transport == 5 || reservation.transport == 6) { // รับ-ส่ง (โดยส่งไว้ แล้วไปรับเวลากลับ) - สามารถรับงานอื่นได้
				$("#status").val('2')
			} else {
				$("#status").val('1')
			}
			console.log($("#status").val())

			$('#times').val(times)
			console.log($('#times').val())
		}
	}

	$scope.formMileage = function (event, id, url, isEnabled) {
		if (!isEnabled) {
			$('#dlgMileage').modal('show')
			$('#id').val(id)
			$('#url').val(url)

			/** หำหนดค่า url ใน attribute action ของ form */
			$('#mileage-form').attr('action', baseUrl + url)
			console.log($('#mileage-form').attr('action'))
		} else {
			event.preventDefault()
			toaster.pop('warning', "", "ไม่สามารถบันทึกซ้ำได้ !!!")
		}
	}

	$scope.saveMileage = function () {
		if ($('#mileage').val() > 0) {
			let url = $('#url').val()
			// let reqData = { 
			// 	id: $('#id').val(),
			// 	mileage: $('#mileage').val() 
			// }
			console.log(url)

			if (url == '/assign/drivearrived') {
				$http.get(baseUrl + '/assign/ajaxstartmileage/' + $('#id').val())
				.then ((res) => {
					console.log($('#mileage').val() + ' > ' + res.data)
					console.log(parseInt($('#mileage').val()) > parseInt(res.data))
					/** ตรวจสอบเลขไมล์หลังไปกับก่อนไป */
					if (parseInt($('#mileage').val()) > parseInt(res.data)) {
						$('#mileage-form').submit()

						/** บันทึกข้อมูลแบบ AJAX */
						// $http.post(baseUrl + url, reqData)
						// .then ((res) => {
							// 	console.log(res)

							// if (res.data.msg == 1) {
							// 	toaster.pop('success', "", "บันทึกข้อมูลเรียบร้อย !!!")
							// } else {
							// 	toaster.pop('warning', "", "พบข้อผิดพลาด !!!")
							// }
						// })
					} else {
						event.preventDefault()
						toaster.pop('warning', "", "กรุณาระบุเลขไมล์ให้ถูกต้อง !!!")
					}

					$scope.clearFormControlVal()
				})
			} else {
				$('#mileage-form').submit()

				/** บันทึกข้อมูลแบบ AJAX */
				// $http.post(baseUrl + url, reqData)
				// .then ((res) => {
					// 	console.log(res)

					// if (res.data.msg == 1) {
					// 	toaster.pop('success', "", "บันทึกข้อมูลเรียบร้อย !!!")
					// } else {
					// 	toaster.pop('warning', "", "พบข้อผิดพลาด !!!")
					// }
				// })

				$scope.clearFormControlVal()
			}
		} else {
			toaster.pop('warning', "", "กรุณาระบุเลขไมล์ก่อน !!!")
			$scope.clearFormControlVal()
		}
	}

	$scope.clearFormControlVal = function () {
		/** เคลียร์ค่าใน form ทั้งหมด */
		$('#mileage').val('')
		$('#id').val('')
		$('#url').val('')
		/** หำหนดค่าว่างให้ attribute action ของ form */
		$('#mileage-form').attr('action', '')
	}

	$scope.showChangePopup = function(event, id) {
		console.log(event)
		$('#dlgChange').modal('show')
		$('#assignid').val(id)
	}

	$scope.changeVehicle = function(event) {
		console.log(event)

		if ($('#driver').val() == '' || $('#vehicle').val() == '') {
			toaster.pop('warning', "", "กรุณาระบุเลือก พขร. หรือรถก่อน !!!")
		} else {
			$('#change-form').submit()
			// let reqData = {
			// 	id: $('#assignid').val(),
			// 	driver: $('#driver').val(),
			// 	vehicle: $('#vehicle').val(),
			// }

			// $http.post(baseUrl + '/assign/ajaxchange', reqData)
			// .then( res => {
			// 	console.log(res)
			// })
		}
	}

	$scope.addReservationForm = function(event, assignid) {
		console.log(event)
		$('#aid').val(assignid)
		console.log($('#aid').val())

		$('#dlgReservation').modal('show')
		console.log('times :' + $('#times').val())
	}

	$scope.addReserveId = function (reservation) {
		console.log(reservation)
		$('#rid').val(reservation.id)
		console.log('rid :' + $('#rid').val())
	}

	$scope.addReservation = function(event) {
		console.log(event)
		var data = {
            assign_id: $('#aid').val(),
            reserve_id: $('#rid').val(),
            times: $('#times').val()
        }
        console.log(data);  

        $http.post(baseUrl + '/assign/ajaxadd_reservation', data)
        .then(function (res) {
            console.log(res);
            // if (res.status === 200) {
            //     toaster.pop('success', "", res.data.msg);
            // } else {
            //     toaster.pop('warning', "", res.data.msg);
            // }
		})
	}
})
