<?php
class Addressbook{
	private $gateway=NULL;

	function __construct($gateway){
		$this->gateway=$gateway;
	}
	
	/**
	 * Create address book
	 */
	function addAddressBook($name, $description=NULL){
		return $this->gateway->execCommad('addAddressbook',array('name'=>$name,'description'=>$description));
	}
	/**
	 * Delete address book by address book ID
	 */
	function delAddressBook($idAddressBook){
		return $this->gateway->execCommad('delAddressbook',array('idAddressBook'=>$idAddressBook));
	}
	/**
	 * Edit address book by address book ID
	 */
	function editAddressBook($idAddressBook,$newName,$newDescr=NULL){
		return $this->gateway->execCommad('editAddressbook',array('idAddressBook'=>$idAddressBook, 'newName'=>$newName,'newDescr'=>$newDescr));
	}

	/**
	 * Get address book by address book ID
	 */
	function getAddressBook($idAddressBook){
		return $this->gateway->execCommad('getAddressbook',array('idAddressBook'=>$idAddressBook));
	}
	
	/**
	 * Get all address books 
	 */
	function getAllAddressBook($from=null,$offset=null){
		return $this->gateway->execCommad('getAddressbook',array('from'=>$from,'offset'=>$offset),true);
	}
	
	/**
	 * Add phone to addressbook 
	 */
	function addPhoneToAddressBook($idAddressBook, $phone, $variables){
		return $this->gateway->execCommad('addPhoneToAddressBook', array('idAddressBook'=>$idAddressBook, 'phone'=>$phone, 'variables'=>$variables));
	}
	
	/**
	 * Get phone from addressbook 
	 */
	function getPhoneFromAddressBookByIdPhone($idPhone,$idAddressBook=null){
		return $this->gateway->execCommad('getPhoneFromAddressBook', array('idAddressBook'=>$idAddressBook, 'idPhone'=>$idPhone));
	}
	
	/**
	 * Get phone from addressbook by phon ID
	 */
	function getPhoneById($idPhone){
		return $this->gateway->execCommad('getPhoneFromAddressBook', array('idPhone'=>$idPhone));
	}
	
	/**
	 * Get phone from addressbook by phone 
	 */
	function getPhoneByPhone($phone){
		return $this->gateway->execCommad('getPhoneFromAddressBook', array('phone'=>$phone));
	}
	
	/**
	 * Get phone from addressbook by phone 
	 */
	function getAllPhones($from,$offset){
		return $this->gateway->execCommad('getPhoneFromAddressBook', array('from'=>$from,'offset'=>$offset),$true);
	}
	
	/**
	 * Get phone from addressbook by address book ID 
	 */
	function getPhonesByAddressBook($idAddressBook,$from=null,$offset=null){
		return $this->gateway->execCommad('getPhoneFromAddressBook', array('idAddressBook'=>$idAddressBook, 'from'=>$from,'offset'=>$offset));
	}
	
	/**
	 * Get phone from addressbook by address book ID and phone 
	 */
	function getPhonesByAddressBookByPhone($idAddressBook,$phone,$from=null,$offset=null){
		return $this->gateway->execCommad('getPhoneFromAddressBook', array('idAddressBook'=>$idAddressBook,'phone'=>$phone,'from'=>$from,'offset'=>$offset));
	}
	
	/**
	 * Delete phone from addressbook by phone ID 
	 */
	function delPhoneFromAddressBookById($idPhone){
		return $this->gateway->execCommad('delPhoneFromAddressBook', array('idPhone'=>$idPhone));
	}
	
	/**
	 * Delete all phones from addressbook by address book ID 
	 */
	function delPhonesFromAddressBookByAdressBookId($idAddressBook){
		return $this->gateway->execCommad('delPhoneFromAddressBook', array('idAddressBook'=>$idAddressBook));
	}
	
	/**
	 * Edit phone addressbook by phone ID 
	 */
	function edidPhone($idPhone,$phone,$variables){
		return $this->gateway->execCommad('editPhone',array('idPhone'=>$idPhone, 'phone'=>$phone, 'variables'=>$variables));
	} 
	
	/**
	 * Search addressbook
	 * Availible fields: name,phones,date.
	 * Availible operations: like,=,>,>=,<,<=.
	 * Example for searchFields:
	 * $searchFields['name']=array('operation'=>'like', 'value'=>"test%");
	 */
	function searchAddressBook($searchFields,$from,$offset){
		$searchFields_json=json_encode($searchFields);
		return $this->gateway->execCommad('searchAddressBook',array('searchFields'=>$searchFields_json, 'from'=>$from, 'offset'=>$offset),true);
	}
	
	/**
	 * Search phone
	 * Availible fields: idAddressBook,phones,normalPhone, variables, status.
	 * Availible operations: like,=,>,>=,<,<=.
	 * Example for searchFields:
	 * $searchFields['normalPhone']=array('operation'=>'like', 'value'=>"test%");
	 */
	function searchPhones($searchFields,$from=null,$offset=null){
		$searchFields_json=json_encode($searchFields);
		return $this->gateway->execCommad('searchPhones',array('searchFields'=>$searchFields_json, 'from'=>$from, 'offset'=>$offset),true);
	}
}