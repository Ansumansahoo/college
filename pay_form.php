<?php
// Merchant key here as provided by Payu
$MERCHANT_KEY = "H4ZqUV";

// Merchant Salt as provided by Payu
$SALT = "eLtte10t";

// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://secure.payu.in/";

$action = '';

$posted = array();

//Generate random transaction id
$txnid = random_string('numeric', 5);

if(!empty($_POST)) {
		
		$posted['amount'] = $_POST['amount'];
		$posted['phone'] = $_POST['phone'];
		$posted['firstname'] = $_POST['firstname'];
		$posted['email'] = $_POST['email'];
		$posted['key'] = $MERCHANT_KEY;
		$posted['txnid'] = $txnid;
		$posted['productinfo'] = 'This is a Test Product';
		$posted['email'] = $_POST['email'];
		$posted['firstname'] = $_POST['firstname'];
		$posted['phone'] = $_POST['phone'];
		$posted['surl'] = base_url("index.php/payumoney/success");
		$posted['furl'] = base_url("index.php/payumoney/failed");
		$posted['curl'] = base_url("index.php/payumoney/failed");
		$posted['service_provider'] = 'payu_paisa';

}

$hash = '';

// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

if(empty($posted['hash']) && sizeof($posted) > 0) {
	if(
			  empty($posted['key'])
			  || empty($posted['txnid'])
			  || empty($posted['amount'])
			  || empty($posted['firstname'])
			  || empty($posted['email'])
			  || empty($posted['phone'])
			  || empty($posted['productinfo'])
			  || empty($posted['surl'])
			  || empty($posted['furl'])
			  || empty($posted['service_provider'])
	  ) {
		//echo "Fail";
		redirect('payumoney/');
	  }
	else{
		
		$hashVarsSeq = explode('|', $hashSequence);
		$hash_string = '';
		foreach($hashVarsSeq as $hash_var){
			  $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
			  $hash_string .= '|';
		}

		$hash_string .= $SALT;
		$hash = strtolower(hash('sha512', $hash_string));
		$posted['hash'] = $hash;
		$action = $PAYU_BASE_URL . '/_payment';
	}
}
elseif(!empty($posted['hash'])){
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Payumoney Integration</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
     if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
 </script>
 <style>
			 body {
  background: #FEF8F8;
}

.expiry-date-group {
  float: left;
  width: 50%
}

.expiry-date-group input {
  width: calc(100% + 1px);
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}

.expiry-date-group input:focus {
  position: relative;
  z-index: 10;
}

.security-code-group {
  float: right;
  width: 50%
}

.security-code-group input {
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}

.zip-code-group {
  clear: both;
}

#PayButton {
  outline: 0!important;
  height: 42px;
  font-size: 16px;
  background-color: #54C7C3!important;
  border: none;
}

#PayButton:hover {
  background-color: #6DCECB!important;
}

#PayButton:active {
  background-color: #4FBCB9!important;
}

#PayButton:disabled {
  background: rgba(84, 199, 195, .5)!important;
  color: #FFF!important;
}

.container {
  margin-top: 50px;
}

#Checkout {
  z-index: 100001;
  background: ;
  width: 86%;
  min-width: 300px;
  height: 100%;
  min-height: 100%;
  background: 0 0 #ffffff;
  border-radius: 8px;
  border: 1px solid #dedede;
  margin-left: auto;
  margin-right: auto;
  display: block;
}

#Checkout>h1 {
  margin: 0;
  padding: 20px;
  text-align: center;
  background: #EEF2F4;
  color: #5D6F78;
  font-size: 24px;
  font-weight: 300;
  border-bottom: 1px solid #DEDEDE;
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
}

#Checkout>form {
  margin: 0 25px 25px;
}

label {
  color: #46545C;
  margin-bottom: 2px;
}

.input-container {
  position: relative;
}

.input-container input {
  padding-right: 25px;
}

.input-container>i, a[role="button"] {
  color: #d3d3d3;
  width: 25px;
  height: 30px;
  line-height: 30px;
  font-size: 16px;
  position: absolute;
  top: 2px;
  right: 2px;
  cursor: pointer;
  text-align: center;
}

.input-container>i:hover, a[role="button"]:hover {
  color: #777;
}
.amount-placeholder {
  font-size: 20px;
  height: 34px;
}

.amount-placeholder>button {
  float: right;
  width: 60px;
}

.amount-placeholder>span {
  line-height: 34px;
}


.submit-button-lock {
  height: 20px;
  margin-top: -2px;
  margin-right: 7px;
  vertical-align: middle;
}

.align-middle {
  vertical-align: left;
}

input {
  box-shadow: none!important;
}

input:focus {
  border-color: #b0e5e3!important;
  background-color: #EEF9F9!important;
}
.form-group{
	margin-left:15px !important;
	margin-right:15px !important;
}
  </style>
   <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body onload="submitPayuForm()">
<div class="container" style="width: 54%;">
  <div id="Checkout" class="inline">
   <h1>Proceed To Payment</h1>
	

			<?php
				if($this->session->flashdata('msg_error')){
					echo "<div class='alert alert-danger' role='alert'>".$this->session->flashdata('msg_error')."<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
				}
				elseif($this->session->flashdata('msg_success')){
					echo "<div class='alert alert-success' role='alert'>".$this->session->flashdata('msg_success')."<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
				}
			?>

			<form method="post" class="form-horizontal" action="<?php echo $action; ?>" name="payuForm">

				<input type="hidden" name="key" value="<?php echo (!isset($posted['key'])) ? '' : $posted['key'] ?>" />
				<input type="hidden" id="hash" name="hash" value="<?php echo (!isset($posted['hash'])) ? '' : $posted['hash'] ?>"/>
				<input type="hidden" name="txnid" value="<?php echo (!isset($posted['txnid'])) ? '' : $posted['txnid'] ?>" />
				
				<input type="hidden" name="productinfo" id="productinfo" value="<?php echo (!isset($posted['productinfo'])) ? '' : $posted['productinfo'] ?>">
				<input type="hidden" name="surl" value="<?php echo (!isset($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" />
				<input type="hidden" name="curl" value="<?php echo (!isset($posted['curl'])) ? '' : $posted['curl'] ?>" size="64" />
				<input type="hidden" id="furl" name="furl" value="<?php echo (!isset($posted['furl'])) ? '' : $posted['furl'] ?>" size="64" />
				<input type="hidden" name="service_provider" value="<?php echo (!isset($posted['service_provider'])) ? '' : $posted['service_provider'] ?>" size="64" />
				
				<?php 
					
				foreach($p_details as $detail){ ?>
				
				<div class="form-group" style="margin-top:5%;">
				    <label for="inputPassword3" class="col-sm-2 control-label">Membership Id</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" name="firstname" readonly id="firstname" placeholder="Your Name" required value="<?php  echo $detail->membership_id; ?>">
				    </div>
			  	</div>
			  	<div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
				    <div class="col-sm-10">
				      <input type="email" name="email" id="email" class="form-control" readonly placeholder="Your Email" value="<?php  echo $detail->email; ?>" required>
				    </div>
			  	</div>
				<div class="form-group">
				    <label for="inputPassword3" class="col-sm-2 control-label">Mobile</label>
				    <div class="col-sm-10">
				      <input type="text" name="phone" class="form-control" readonly id="inputPassword3" placeholder="Your Mobile Number" value="<?php  echo $detail->contact; ?>" required>
				    </div>
				</div>
				<div class="form-group">
				    <label for="inputPassword3" class="col-sm-2 control-label">Amount</label>
				    <div class="col-sm-10">
				      <input name="amount" class="form-control" readonly id="inputPassword3" placeholder="Amount to Pay" value="1" required>
				    </div>
				</div>
			  	<div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-primary" style="float:left;">Click To Pay</button>
					  <a href="<?php echo base_url('index.php/view_member/edit/'.$detail->membership_id); ?>"><input type="text" value="NOT NOW" style="float:right;" class="btn btn-primary"></a>
				    </div>
			  	</div>
				<?php } ?>
		
			
			</form>



</body>
</html>