<?php
class Stat{
	private $gateway=NULL;

	function __construct($gateway){
		$this->gateway=$gateway;
	}
	
	/*
	**	creating campaign
	**	$sender - sender. Up to 14 numbers for numeric senders, up to 11 for alphanumeric
	** 	$text - sms text
	**	$list_id - id of address book
	**	$datetime must be in GMT, PHP format Y-m-d H:i:s
	*/
	function createCampaign($sender, $text, $list_id, $datetime, $batch, $batchinterval, $sms_lifetime, $controlnumber){
		return $this->gateway->execCommad('createCampaign',array('sender' => $sender, 'text' => $text, 'list_id' => $list_id, 'datetime' => $datetime, 'batch' => $batch, 'batchinterval' => $batchinterval, 'sms_lifetime' => $sms_lifetime, 'controlnumber' => $controlnumber));
	}
	
	/*
	**	quick send sms. No list using, just 1 phone
	*/
	function sendSMS($sender, $text, $phone, $datetime, $sms_lifetime){
		return $this->gateway->execCommad('sendSMS',array('sender' => $sender, 'text' => $text, 'phone' => $phone, 'datetime' => $datetime, 'sms_lifetime' => $sms_lifetime));
	}
	
	/*
	**	this function will return general information about campaign
	*/
	function getCampaignInfo ($id) {
		return $this->gateway->execCommad('getCampaignInfo',array('id' => $id));
	}
	
	/*
	**	this function returns complete list of phones of the task, including DLR	
	*/
	function getCampaignDeliveryStats ($id,$datefrom="") {
		return $this->gateway->execCommad('getCampaignDeliveryStats',array('id' => $id, 'datefrom' => $datefrom));
	}
	
	/*
	**	Cancels campaign. Campaign must be in "Ready for sent" or "Scheduled" state
	*/
	function cancelCampaign ($id) {
		return $this->gateway->execCommad('cancelCampaign',array('id' => $id));
	}
	
	/*
	**	Deletes campaign, any status
	*/
	function deleteCampaign ($id) {
		return $this->gateway->execCommad('deleteCampaign',array('id' => $id));
	}

	/*
	**	gets list of campaigns
	*/
	function getCampaignList() {
		return $this->gateway->execCommad('getCampaignList',"");
	}
	
	/*
	**	calculates price of campaign sending
	*/
	function checkCampaignPrice ($sender, $text, $list_id) {
		return $this->gateway->execCommad("checkCampaignPrice", array('sender' => $sender, 'text' => $text, 'list_id' => $list_id));
	}
}
?>