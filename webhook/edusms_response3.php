<?php
include_once 'PaytmChecksum.php';



if (isset($_POST) && !empty($_POST)){
require_once('conn7.php');
date_default_timezone_set('Asia/Kolkata');
$date= date("Y-m-d");

$udf_1 = explode("#$#", $_POST["udf_1"]);
$udf_2 = explode("#$#", $_POST["udf_2"]);
$fee_category = mysqli_real_escape_string($conn7,$udf_1[0]);
$total = mysqli_real_escape_string($conn7,$udf_1[1]);
$fine = mysqli_real_escape_string($conn7,$udf_1[2]);
$STATUS =  mysqli_real_escape_string($conn7,$_POST["STATUS"]);
$ORDERID =  mysqli_real_escape_string($conn7,$_POST["ORDERID"]);
$TXNID =  mysqli_real_escape_string($conn7,$_POST["TXNID"]);
$TXNAMOUNT =  mysqli_real_escape_string($conn7,$_POST["TXNAMOUNT"]);

$myarray = array();
$myarray[1]['amount'] = $total;
$myarray[1]['date'] = $date;
$myarray[1]['amount_discount'] = 0;
$myarray[1]['amount_fine'] = $fine;
$myarray[1]['description'] = "Order ID : $ORDERID   Bank Ref. No.: $TXNID";
$myarray[1]['received_by'] = "online";
$myarray[1]['payment_mode'] = "Paytm";
$myarray[1]['inv_no'] = 1;
$myjson =  json_encode($myarray);


if($STATUS == "TXN_SUCCESS" && !empty($fee_category) && $total > 0) {
	
if($fee_category == "fees"){

$student_fees_master_id = mysqli_real_escape_string($conn7,$udf_2[0]);
$fee_groups_feetype_id = mysqli_real_escape_string($conn7,$udf_2[1]);

$student_transport_fee_id = "NULL";
$sql = mysqli_query($conn7,"SELECT student_fees_master_id,fee_groups_feetype_id FROM student_fees_deposite WHERE student_fees_master_id='$student_fees_master_id' AND fee_groups_feetype_id='$fee_groups_feetype_id'");
$rowcount=mysqli_num_rows($sql);
}
elseif($fee_category == "transport"){
$student_fees_master_id = "NULL";
$fee_groups_feetype_id = "NULL";
$student_transport_fee_id = mysqli_real_escape_string($conn7,$udf_2[2]);
$sql = mysqli_query($conn7,"SELECT student_transport_fee_id FROM student_fees_deposite WHERE student_transport_fee_id='$student_transport_fee_id'");
$rowcount=mysqli_num_rows($sql);
}

if ($rowcount == 0 && $TXNAMOUNT > 0) {
	$set = mysqli_query($conn7,"SET FOREIGN_KEY_CHECKS=0");
	$insert = mysqli_query($conn7,"INSERT INTO student_fees_deposite SET student_fees_master_id=$student_fees_master_id, fee_groups_feetype_id=$fee_groups_feetype_id, student_transport_fee_id=$student_transport_fee_id, amount_detail='$myjson'");
	$unset = mysqli_query($conn7,"SET FOREIGN_KEY_CHECKS=1");
	
	if($insert){
		echo"insert by webhook";
		} else{
			echo"not inserted";
			echo mysqli_error($conn7);	
		}			
} 
else{
echo "Already paid";	
}


}
else{
	echo "un-successful payment, not success";
	}

}
else{
	echo"no data post";
	}

?>