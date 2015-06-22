<?php
//error_reporting(1);

$basepaths=$_SERVER['HTTP_HOST'].'/emss/';
$site_path=$_SERVER['DOCUMENT_ROOT'].'/emss/';

//echo $site_path.'third_party/html2fpdf.php';die;
//require_once $basepaths.'third_party/html2fpdf.php';

require_once "../../third_party/html2pdf.class.php";
require_once '../../bootstrap.php';

$basepath = Core_Config::getInstance()->get('basepath');

$dateformat = Core_Config::getInstance()->get('dateformat');

if (isset($_REQUEST['fromdate']) && $_REQUEST['todate']) {
//var_dump($appointmentid);
    $fromdateArray = explode('/', $_REQUEST['fromdate']);

    $temp = $fromdateArray[0];
    $fromdateArray[0] = $fromdateArray[1];
    $fromdateArray[1] = $temp;


    //$fromdate = strtotime(implode('/', $fromdateArray));
    $fromdate = DateTime::createFromFormat($dateformat, urldecode($_REQUEST['fromdate']));
	//print_r($fromdate)."<br/>";
    $fromdate = $fromdate->getTimeStamp();
	//echo $fromdate."<br/>";
    $todate = DateTime::createFromFormat($dateformat, urldecode($_REQUEST['todate']));

    $todate = $todate->getTimeStamp();

    $todateArray = explode('/', $_REQUEST['todate']);

    $temp = $todateArray[0];
    $todateArray[0] = $todateArray[1];
    $todateArray[1] = $temp;


    //$todate = strtotime(implode('/', $todateArray));
//var_dump($fromdate);
    $fromday = date('d', $fromdate);
    $frommonth = date('m', $fromdate);
    $fromyear = date('y', $fromdate);

//var_dump($todate);
    $today = date('d', $todate);
    $tomonth = date('m', $todate);
    $toyear = date('y', $todate);
    $database = Core_Database::getInstance();
	//echo $_REQUEST['fromdate'].'to - > '.$_REQUEST['todate'];
	if(isset($_REQUEST['fromdate']) && isset($_REQUEST['todate'])){
	
	/*	if($_REQUEST['fromdate']==$_REQUEST['todate'])
		{*/
			//echo 'visjhnu';
			$temp 		= explode("/",$_REQUEST['fromdate']); 
			$temp_new 	= $temp[2]."/".$temp[1]."/".$temp[0];
			$fromdate	= strtotime($temp_new);
			
			$temp 		= explode("/",$_REQUEST['todate']); 
			$temp_new 	= $temp[2]."/".$temp[1]."/".$temp[0];
			$todate		= strtotime($temp_new);
			$todate		+= 86400;
			
		/*}*/
	
	}
	//echo date('d-m-Y',strtotime($fromdate));
    //echo $fromdate."==".date("Y/m/d h:i A",$fromdate);
	//echo "<br>".$todate."==".date("Y/m/d h:i A",$todate);
	
	$query = 'SELECT apt.' . App_Model_Appointment::getPrimaryKeyName() . ',
                  apt.AppointmentDate as "appointmentdate",
				  apt.addedAppId as addedAppId,
                  patients.patientDOB as "dob",
                  patients.PatientPracticeCode, 
				  prac.pathologycode, 
                  apt.fees,
                  gp.GPFirstName,
                  gp.GPSurname
            FROM ' . App_Model_Appointment::getTableName() . ' apt
            JOIN ' . App_Model_AddAppointment::getTableName() . ' add_apt 
                ON add_apt.appid = apt.addedAppId
            JOIN gpmaster gp 
                ON apt.appointmentGPID = gp.gpid
            JOIN ' . App_Model_Patient::getTableName() . ' patients ON add_apt.patientid = patients.' . App_Model_Patient::getPrimaryKeyName() . '
			JOIN ' . App_Model_Practice::getTableName() .' prac ON patients.PatientPracticeCode = prac.practicecode
            WHERE apt.fees > 0 
			AND  prac.ccg like "%'.$_REQUEST['ccg'].'%"';
	//$query.='AND (apt.AppointmentDate >= ' . $fromdate . ' AND  apt.AppointmentDate <='.$todate.')';		
			$query.='AND apt.AppointmentDate BETWEEN ' . $fromdate . ' AND ' . $todate;
			$query.=' order by  apt.AppointmentDate ASC ';
	//echo $query;
    $result = $database->query($query)->fetchAll();
	//print_r($result)
	
$width="";	

//print_r(count($_REQUEST));
//die;
$total_column=count($_REQUEST);
if($total_column>4)
{
	if($total_column==5)
	{
	$awidth="15%";
	$piwidth="10%";
	$pwidth="10%";
	$rwidth="15%";
	$prwidth="30%";
	$uwidth="10%";
	$tprwidth="10%";
		
	}
	elseif($total_column==6)
	{
	$awidth="10%";
	$piwidth="9%";
	$pwidth="10%";
	$rwidth="9%";
	$prwidth="20%";
	$uwidth="8%";
	$dbwidth="10%";
	$tprwidth="8%";
	}
	elseif($total_column==7)
	{
	$awidth="9%";
	$piwidth="5%";
	$pwidth="7%";
	$rwidth="7%";
	$prwidth="10%";
	$uwidth="7%";
	$dbwidth="7%";
	$tprwidth="8%";
	}

}
else
{
	$awidth="15%";
	$piwidth="15%";
	$pwidth="15%";
	$rwidth="15%";
	$prwidth="20%";
	$uwidth="15%";
	$dbwidth="10%";
	$tprwidth="10%";	
}

//echo $prwidth;die;


	$strcontent='
	<page style="font-family: arial">
	    <table class="page_header">
		 <tr>
                <td style="width: 100%; text-align: center">
                   Dr. Manu Mehra
                </td>
            </tr>
			 <tr>
                <td style="width: 100%; text-align: center">
                   38 The Warren, Carshalton Beeches, Surrey SM5 4EH
                </td>
            </tr>
            <tr>
                <td style="width: 100%; text-align: center">
                   <h1>Invoice</h1>
                </td>
            </tr>
        </table>
    
	<table style="width: 100%;">';
						
						 if($_REQUEST['ccg']=='sutton'){
								$strcontent.='<tr><td style="width:70%">Sutton CCG </td><td style="width:10%">Invoice Date:</td><td style="width:20%">'.date($dateformat, time()).'</td></tr>
                                        <tr><td>08T Payables K765</td><td>Reference: </td><td>MEHRA '. $fromday . $frommonth . $fromyear.'/'.$today . $tomonth . $toyear.'</td></tr>
                                         <tr><td>Phoenix House</td><td>CCG:</td><td>'.date('d/m/Y').'</td></tr>
                                        <tr><td colspan="2">Topcliffe Lane</td></tr>
                                       <tr><td colspan="2"> Wakefield<BR/></td></tr>
                                        <tr><td colspan="2">WF3 1WE</td></tr>';	 
						 	}
							elseif($_REQUEST['ccg']=='Epsom')
							{
								$strcontent.= '<tr><td style="width:70%">CCG:Epsom and St. Helier NHS Trust</td><td style="width:10%">Invoice Date:</td><td style="width:20%">'.date($dateformat, time()).'</td></tr>
                                         <tr><td>St. Helier Hospital</td><td>Reference: </td><td>MEHRA '. $fromday . $frommonth . $fromyear.'/'.$today . $tomonth . $toyear.'</td></tr>
                                        <tr><td>Wrythe Lane</td><td>CCG:</td><td>'.date('d/m/Y').'</td></tr>
                                        <tr><td> Carshalton</td></tr>
                                        <tr><td>Surrey SM5 1AA</td></tr>
                                        ';
								
							}
							else{
								$strcontent.= '<tr><td style="width:70%">Merton CCG</td><td style="width:10%">Invoice Date:</td><td style="width:20%">'.date($dateformat, time()).'</td></tr>
                                        <tr><td>08R Payables K755</td><td>Reference: </td><td>MEHRA '. $fromday . $frommonth . $fromyear.'/'.$today . $tomonth . $toyear.'</td></tr>
                                        <tr><td>Phoenix House</td><td>CCG:</td><td>'.date('d/m/Y').'</td></tr>
                                        <tr><td>Topcliffe Lane</td></tr>
                                       <tr><td> Wakefield</td></tr>
                                        <tr><td>WF3 1WE</td></tr>';
							}
							$strcontent.='</table> <br>';
							
					
					
					$strcontent.='<table style="width: 100%;" border="0.5" CELLSPACING="0" CELLPADDING="10" class="table">
                   	 <tr style="height:15px;">';
					 
                     $strcontent.='<td style="width:'.$awidth.';height:15px;" align="center"><strong>Appointment Date</strong></td>';
					 
					 if(isset($_REQUEST['patients_initials'])){
					
						$strcontent.='<td style="width:'.$piwidth.';height:15px;" align="center"><strong>Patient Initials</strong></td>';
					 }
					 
					  
					  if(isset($_REQUEST['dob'])){
					 	$strcontent.='<td style="width:'.$dbwidth.';height:15px;" align="center"><strong>Date of Birth</strong></td>';
					  }
					  
					  if(isset($_REQUEST['post_code'])){
					 	$strcontent.='<td style="width:8%;height:15px;" align="center"><strong>Post Code</strong></td>';
					  }
					  
					 $strcontent.='<td style="width:'.$rwidth.';height:15px;" align="center"><strong>Referring GP</strong></td>
					   <td style="width:'.$pwidth.';height:15px;" align="center"><strong>Practice Code</strong></td>
  					   <td style="width:'.$prwidth.';height:15px;" align="center"><strong>Procedure/s Performed</strong></td>
					   <td style="width:'.$tprwidth.';height:15px;" align="center"><strong>Total Procedures</strong></td>
					   <td style="width:'.$uwidth.';height:15px;" align="center"><strong>Units Charged</strong></td>
					   <td style="width:7%;height:15px;" align="center"><strong>Fees</strong></td>
					</tr>';
						
					
					if ($result) {
								 
								   foreach ($result as $appointment) {
									$strcontent.='<tr>';
									
									   $procedureNames = array('No Procedures performed');
                                try {
                                    $appointmentObject = new App_Model_Appointment($appointment[App_Model_Appointment::getPrimaryKeyName()]);
                                    $addedAppointmentObject = $appointmentObject->getAddedAppointment();
                                    //var_dump($addedAppointmentObject);
                                } catch (Core_Exception $e) {
                                    continue;
                                }

                                $appointmentProcedures = $addedAppointmentObject->getProcedureNames();

                                if ($appointmentProcedures && count($appointmentProcedures)) {
                                    $procedureNames = $appointmentProcedures;
                                }
								
								$units=$addedAppointmentObject->getUnitcharged($appointment['addedappid']);
								
								$total_procedure=$addedAppointmentObject->gettotalprocedure($appointment['addedappid']);
								 
								 $strcontent.='<td align="center">'.(date(Core_Config::getInstance()->get('dateformat'), $appointmentObject->getAppointmentDate())).'</td>';
								  
								  if(isset($_REQUEST['patients_initials'])){
									$strcontent.='<td align="center">'.$addedAppointmentObject->getPatientInitials().'</td>';
								  }
								  
								  
								  if(isset($_REQUEST['dob'])){
								 	$strcontent.='<td align="center">'.date($dateformat, $appointment['dob']).'</td>';
								  }
								  if(isset($_REQUEST['post_code'])){
								 	$strcontent.='<td align="center">'.substr(str_replace(' ','',$addedAppointmentObject->getPatientsPostCode()),0,5).'</td>';
								  }
								$strcontent.='<td>'.$appointment['gpfirstname'] . ' ' . $appointment['gpsurname'].'</td>';
								$strcontent.='<td align="center">'.$appointment['pathologycode'].'</td>';
								 $strcontent.='<td>';
								 
								 for($i=0;$i<count($procedureNames);$i++){
								
									if($procedureNames[$i]=="Other"){
									
										$strcontent.=nl2br($appointmentObject->getOtherProcedure())."<br>";
									
									}
									else 
										$strcontent.= $procedureNames[$i]."<br>";
								
								}
								
								$strcontent.='</td>';
								
								$strcontent.='<td align="center">'.$units.'</td>';
								$strcontent.='<td align="center">'.$total_procedure.'</td>';
								$strcontent.='<td align="center">'.$appointment['fees'].'</td>';
								 
								$strcontent.='</tr>';
							
								
								   
								   }
								   
								 
								 }
								 
					$strcontent.='</table>';	
					
					 $totalfees = 0;

                    foreach ($result as $appointment) {
                        $totalfees = $appointment['fees'] + $totalfees;
                    }
						
							 	$strcontent.='
								<br><br>
								<table style="width: 100%;">
								<tr height="20">
								   <td style="width:40%" colspan="1"><strong>Payable to: </strong>Dr Manu Mehra</td>
								   
								   <td style="width:10%" align="right"><strong>Total Amount &pound;</strong>'.$totalfees.'</td>
								</tr>
								<tr height="20">
								   <td style="width:100%" colspan="2"><strong>Bank: </strong>HSBC</td>
								</tr>
								<tr>
								   <td style="width:40%" colspan="1"><strong>Account Number: </strong>71899414</td>
								   <td style="width:10%" align="right">Payable 28 days from receipt of Invoice</td>
								</tr>
								<tr height="20">
								   <td style="width:60%"><strong>Branch Sort Code: </strong>40-43-26</td>
								</tr>
								<tr>
									<td colspan="2"> &nbsp;</td>
								</tr>
								<tr>
									<td colspan="2"> &nbsp;</td>
								</tr>
								<tr height="20">
								   <td style="width:100%" colspan="2">If you have any queries concerning this invoice, please contact us on:</td>
								</tr>
								<tr height="20">
								   <td style="width:100%" colspan="2"><strong>Email: </strong> manu.mehra@nhs.net</td>
								</tr>
								<tr height="20">
								   <td style="width:100%" colspan="2"><strong>Tel: </strong>020 8395 7985 </td>
								</tr>
								
								</table>';
								

                   $strcontent.='</page>';	
    						
                    
}
		$strcontent.='<style type="text/css">
<!--
.table tr td
{
    padding-left:5px;
	padding-top:5px;
	padding-bottom:5px;
}
table.page_header {width: 100%; text-align:center; border: none; padding: 2mm;}

-->
</style>';

		$strContent=$strcontent;
		
		//echo $strContent;die;
		
	try
    {
		$html2pdf = new HTML2PDF('L', 'A4', 'en',true, 'UTF-8');
                $html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->pdf->SetMargins(10,10,10);
		$html2pdf->writeHTML($strContent,isset($_GET['vuehtml']));
		$html2pdf->Output("invoices.pdf");
		}
    	catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
	
?>
