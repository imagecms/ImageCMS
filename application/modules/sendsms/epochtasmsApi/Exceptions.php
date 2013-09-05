<?php
class Exceptions{
	private $gateway=NULL;

	function __construct($gateway){
		$this->gateway=$gateway;
	}
	/**
	 * Add phone to exceptions by phone number
	 */
	function addPhoneToExceptionsByPhone($phone,$reason){
		return $this->gateway->execCommad('addPhoneToExceptions',array('phone'=>$phone,'reason'=>$reason));
	}
	/**
	 * Add phone to exceptions by phone ID
	 */
	function addPhoneToExceptionsByIdPhone($idPhone,$reason){
		return $this->gateway->execCommad('addPhoneToExceptions',array('idPhone'=>$idPhone,'reason'=>$reason));
	}
	/**
	 * Delete phone from exceptions by phone number
	 */
	function delPhoneFromExceptionByPhone($phone){
		return $this->gateway->execCommad('delPhoneFromExceptions',array('phone'=>$phone));
	}

	/**
	 * Delete phone from exceptions by phone ID
	 */
	function delPhoneFromExceptionByIdPhone($idPhone){
		return $this->gateway->execCommad('delPhoneFromExceptions',array('idPhone'=>$idPhone));
	}

	/**
	 * Delete phone from exceptions by exception ID
	 */
	function delPhoneFromExceptionByIdException($idException){
		return $this->gateway->execCommad('delPhoneFromExceptions',array('idException'=>$idException));
	}

	/**
	 * Edit exception by exception ID
	 */
	function editException($idException,$reason){
		return $this->gateway->execCommad('editExceptions',array('idException'=>$idException, 'reason'=>$reason));
	}

	/**
	 * Get exception from exceptions by exception ID
	 */
	function getException($idException){
		return $this->gateway->execCommad('getException',array('idException'=>$idException));
	}
	/**
	 * Get exception from exceptions by phone ID
	 */
	function getExceptionByIdPhone($idPhone){
		return $this->gateway->execCommad('getException',array('idPhone'=>$idPhone));
	}
	
	/**
	 * Get all exceptions  
	 */
	function getAllExceptions($from=null,$offset=null){
		return $this->gateway->execCommad('getException',array('from'=>$from, 'offset'=>$offset),true);
	}

	/**
	 * Get exception by phone  
	 */
	function getExceptionByPhone($phone){
		return $this->gateway->execCommad('getException',array('phone'=>$phone));
	}

	/**
	 * Get exceptions by address book ID  
	 */
	function getExceptionByIdAddresbook($idAddresbook){
		return $this->gateway->execCommad('getException',array('idAddresbook'=>$idAddresbook));
	}

	/**
	 * Search excpetion
	 * Availible fields:  id, phone, date, descr.
	 * Availible operations: like,=,>,>=,<,<=.
	 * Example for searchFields:
	 * $searchFields['phone']=array('operation'=>'like', 'value'=>"999%");
	 */
	function searchPhonesInExceptions($searchFields,$from=null,$offset=null){
		$searchFields_json=json_encode($searchFields);
		return $this->gateway->execCommad('searchPhonesInExceptions',array('searchFields'=>$searchFields_json, 'from'=>$from, 'offset'=>$offset),true);
	}
}