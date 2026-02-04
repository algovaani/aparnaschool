<?php

echo "hi";
include_once 'Easebuzz_lib/Easebuzz_lib.php';
$SALT = 'ROAXXE5MAB';
$easebuzzObj = new Easebuzz_lib($MERCHANT_KEY = null, $SALT, $ENV = null); 
$result = $easebuzzObj->easebuzzResponse( $_POST );
$result2 = json_decode($result);
$status2 = $result2->status;

// save all webhooks posts
$file = 'pg_logs.txt';
file_put_contents($file, $result.PHP_EOL, FILE_APPEND);


if ($status2 == 1) {
require_once('conn7.php');
date_default_timezone_set('Asia/Kolkata');
$date= date("Y-m-d");

$fee_category = mysqli_real_escape_string($conn7,$_POST['productinfo']);
$total = mysqli_real_escape_string($conn7,$_POST['udf1']);
$fine = mysqli_real_escape_string($conn7,$_POST['udf2']);
$status = strtolower($_POST['status']);
$order_id = mysqli_real_escape_string($conn7,$_POST['txnid']);
$easebuzz_txnid =  mysqli_real_escape_string($conn7,$_POST['easepayid']);
$amount = mysqli_real_escape_string($conn7,$_POST['amount']);
//$amount = $_POST['net_amount_debit'];

$myarray = array();
$myarray[1]['amount'] = $total;
$myarray[1]['date'] = "$date";
$myarray[1]['amount_discount'] = 0;
$myarray[1]['processing_charge_type'] = null;
$myarray[1]['gateway_processing_charge'] = 0;
$myarray[1]['amount_fine'] = $fine;
$myarray[1]['description'] = "Order ID : $order_id   Bank Ref. No.: $easebuzz_txnid";
$myarray[1]['received_by'] = "online";
$myarray[1]['payment_mode'] = "Easebuzz";
$myarray[1]['inv_no'] = 1;
$myjson =  json_encode($myarray);


if($status == "success" && !empty($fee_category)) {
	
if($fee_category == "fees"){
$udf3 = mysqli_real_escape_string($conn7,$_POST['udf3']);
$udf4 = mysqli_real_escape_string($conn7,$_POST['udf4']);
$udf5 = "NULL";
$sql = mysqli_query($conn7,"SELECT student_fees_master_id,fee_groups_feetype_id FROM student_fees_deposite WHERE student_fees_master_id='$udf3' AND fee_groups_feetype_id='$udf4'");
$rowcount=mysqli_num_rows($sql);
}
elseif($fee_category == "transport"){
$udf3 = "NULL";
$udf4 = "NULL";
$udf5 = mysqli_real_escape_string($conn7,$_POST['udf5']);
$sql = mysqli_query($conn7,"SELECT student_transport_fee_id FROM student_fees_deposite WHERE student_transport_fee_id='$udf5'");
$rowcount=mysqli_num_rows($sql);
}

if ($rowcount == 0 && $amount > 0) {
	$set = mysqli_query($conn7,"SET FOREIGN_KEY_CHECKS=0");
	$insert = mysqli_query($conn7,"INSERT INTO student_fees_deposite SET student_fees_master_id=$udf3, fee_groups_feetype_id=$udf4, student_transport_fee_id=$udf5, amount_detail='$myjson'");
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