<?php
class Account{
	private $gateway=NULL;

	function __construct($gateway){
		$this->gateway=$gateway;
	}
	/**
	 * Get user balance
	 */
	function getUserBalance($currency=null){
		return $this->gateway->execCommad('getUserBalance',array('currency'=>$currency));
	}
	/**
	 * Register new sender name
	 * Return status:
	 * 0-moderation
	 * 1-registered
	 * 2-rejected
	 */
	function registerSender($name,$country){
		return $this->gateway->execCommad('registerSender',array('name'=>$name, 'country'=>$country));
	}
	
	
	/**
	 * Get Sender object by id.
	 * Return status:
	 * 0-moderation
	 * 1-registered
	 * 2-rejected
	 */
	function getSenderStatusById($id){
		return $this->gateway->execCommad('getSenderStatus',array('idName'=>$id));
	}
	
	/**
	 * Get Sender object by name and country.
	 * Return status:
	 * 0-moderation
	 * 1-registered
	 * 2-rejected
	 */
	function getSenderStatusByNameCountry($name,$country){
		return $this->gateway->execCommad('getSenderStatus',array('name'=>$name,'country'=>$country));
	}
	
	/**
	 * Get Sender objects.
	 * Return status:
	 * 0-moderation
	 * 1-registered
	 * 2-rejected
	 */
	function getSenderStatusAll($from=NULL,$offset=NULL){
		return $this->gateway->execCommad('getSenderStatus',array('from'=>$from,'offset'=>$offset));
	}
}