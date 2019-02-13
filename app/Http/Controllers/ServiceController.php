<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function orperday ($_month) 
    {	
    	$sql = "SELECT 
				operation_date, 
				COUNT(DISTINCT operation_id) as num, 
				COUNT(DISTINCT CASE WHEN (operation_type_id=1) THEN operation_id END) as small,
				COUNT(DISTINCT CASE WHEN (operation_type_id=3) THEN operation_id END) as large,
				COUNT(DISTINCT CASE WHEN (operation_type_id NOT IN (1,3) OR operation_type_id is null) THEN operation_id END) as other,
				COUNT(DISTINCT CASE WHEN (request_doctor NOT IN ('0489','0371','0869','0570','0102','0065','0867','1073')) THEN operation_id END) as gen, #แพทย์แผนกอื่นๆ
				COUNT(DISTINCT CASE WHEN (request_doctor IN ('0102','0065','0867','1073')) THEN operation_id END) as eye, #แพทย์ ไพบูลย์, ดนัยพร, วนิดา, วิสาร์กร
				COUNT(DISTINCT CASE WHEN (request_doctor IN ('0489','0371','0869','0570')) THEN operation_id END) as orth, #แพทย์ พงศ์ศักดิ์, ธีรพงษ์, สิทธิพร, บดินทร์
				#COUNT(DISTINCT CASE WHEN (vn NOT IN (SELECT vn from ipt)) THEN operation_id END) as orth #OPD
				COUNT(DISTINCT CASE WHEN (leave_time BETWEEN '08:00:00' AND '12:00:00') THEN operation_id END) as morning,
				COUNT(DISTINCT CASE WHEN (leave_time BETWEEN '12:00:01' AND '16:00:00') THEN operation_id END) as afternoo,
				COUNT(DISTINCT CASE WHEN (leave_time BETWEEN '16:01:00' AND '23:59:59') THEN operation_id END) as evening,
				COUNT(DISTINCT CASE WHEN (leave_time BETWEEN '00:00:01' AND '07:59:59') THEN operation_id END) as night
				FROM operation_list 
				WHERE (operation_date BETWEEN '2019-02-01' AND '2019-02-31')
				AND (status_id=3)
				GROUP BY operation_date";

    	return view('service.or', [
    		'orservices' => \DB::connection('hosxp')->select(\DB::raw($sql)),
    		'_month' => $_month,
    	]);
    }

    public function ipperday ($_day) 
    {
    	$sql="SELECT ic.ward, w.name as wardname, 
    			# ===================================== เวรเช้า ===========================================
				COUNT(CASE WHEN ( 
					(
						(ic.regdate = '2018-10-19' AND ic.regtime <= '12:00:00') 
						AND (
							(ic.dchdate is null)
							OR (ic.dchdate = '2018-10-19' AND ic.dchtime > '08:00:00')
							OR (ic.dchdate > '2018-10-19')
						)
					)
					OR (
						(ic.regdate < '2018-10-19')
						AND (
							(dchdate is null)
							OR (ic.dchdate = '2018-10-19' AND ic.dchtime > '08:00:00')
							OR (ic.dchdate > '2018-10-19')
						)
					)
				) THEN ic.an END) AS num11,
				
				COUNT(CASE WHEN ( 
					(
						(ic.regdate = '2018-10-19' AND ic.regtime <= '16:00:00') 
						AND (
							(ic.dchdate is null)
							OR (ic.dchdate = '2018-10-19' AND ic.dchtime > '08:00:00')
							OR (ic.dchdate > '2018-10-19')
						)
					)
					OR (
						(ic.regdate < '2018-10-19')
						AND (
							(dchdate is null)
							OR (ic.dchdate = '2018-10-19' AND ic.dchtime > '08:00:00')
							OR (ic.dchdate > '2018-10-19')
						)
					)
				) THEN ic.an END) AS num12,
				# ===================================== เวรบ่าย ===========================================
				COUNT(CASE WHEN ( 
					(
						(ic.regdate = '2018-10-19' AND ic.regtime <= '20:00:00') 
						AND (
							(ic.dchdate is null)
							OR (ic.dchdate = '2018-10-19' AND ic.dchtime > '16:00:00')
							OR (ic.dchdate > '2018-10-19')
						)
					)
					OR (
						(ic.regdate < '2018-10-19')
						AND (
							(ic.dchdate is null)
							OR (ic.dchdate = '2018-10-19' AND ic.dchtime > '16:00:00')
							OR (ic.dchdate > '2018-10-19')
						)						
					)
				) THEN ic.an END) AS num21, 
				
				COUNT(CASE WHEN ( 
					(
						(ic.regdate = '2018-10-19' AND ic.regtime <= '23:59:59') 
						AND (
							(ic.dchdate is null)
							OR (ic.dchdate = '2018-10-19' AND ic.dchtime > '16:00:00')
							OR (ic.dchdate > '2018-10-19')
						)
					)
					OR (
						(ic.regdate < '2018-10-19')
						AND (
							(ic.dchdate is null)
							OR (ic.dchdate = '2018-10-19' AND ic.dchtime > '16:00:00')
							OR (ic.dchdate > '2018-10-19')
						)						
					)
				) THEN ic.an END) AS num22, 
				# ===================================== เวรดึก ===========================================  
				COUNT(CASE WHEN ( 
					(ic.regdate = '2018-10-20' AND ic.regtime BETWEEN '00:00:01' AND '05:00:00')
					OR (
						((ic.regdate < '2018-10-20') AND (ic.dchdate > '2018-10-19'))
						OR ((ic.regdate < '2018-10-20') AND (ic.dchdate is null))
					) 
				) THEN ic.an END) AS num31,
				
				COUNT(CASE WHEN ( 
					(ic.regdate = '2018-10-20' AND ic.regtime BETWEEN '05:00:01' AND '07:59:59')
					OR (
						((ic.regdate < '2018-10-20') AND (ic.dchdate > '2018-10-19'))
						OR ((ic.regdate < '2018-10-20') AND (ic.dchdate is null))
					) 
				) THEN ic.an END) AS num32
				
				FROM (select an,hn,regdate,regtime,dchdate,dchtime,ward from ipt where ((dchdate >= '2018-10-19') or (dchdate is null)) ORDER BY regdate) as ic 
				LEFT JOIN ward w ON (ic.ward=w.ward) ";
				
			$sql .= "GROUP BY ic.ward, w.name ORDER BY ic.ward, w.name ";

    	return view('service.ip', [
    		'ipservices' => \DB::connection('hosxp')->select(\DB::raw($sql)),
    		'_day' => $_day,
    	]);
    }

    private function addDate($time, $num)
	{
		$estr = explode('-', $time);
		if(count($estr) != 3) return '';
		return ($estr[0]) .'-'. $estr[1] .'-'. ($estr[2] + $num);
	}

}
