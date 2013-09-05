<?php
class APISMS{

	private $privateKey;
	private $publicKey;
	private $formatResponse;
	private $url;
	private $version;
	private $testMode;

	function __construct($privateKey,$publicKey,$url,$testMode=false,$version='3.0',$formatResponse='json'){
		$this->privateKey=$privateKey;
		$this->publicKey=$publicKey;
		$this->formatResponse=$formatResponse;
		$this->url=$url;
		$this->version=$version;
		$this->testMode=$testMode;
	}

	public  function execCommad($command,$params,$simple=false){
		$params['key']=$this->publicKey;
		if($this->testMode) $params['test']=true;
		$controlSUM=$this->calcControlSum($params,$command);
		$params['sum']=$controlSUM;
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_URL, $this->url.$this->version .'/'.$command);
		$result = curl_exec($ch);
		if(curl_errno($ch)>0) return array('success'=> false,  'code'=>curl_errno($ch),'error'=>curl_error($ch));
		elseif ($this->formatResponse=='json') return $this->processResponseJSON($result,$simple);
		elseif ($this->formatResponse=='xml') return $this->processResponseXML($result);
		else return $this->processResponseJSON($result);
	}

	private function processResponseJSON($result,$simple){
		if($simple) return json_decode($result,true);
		elseif ($result) {
			$jsonObj = json_decode($result,true);
			if(null===$jsonObj) {
				return array('success'=> false,  'result'=>NULL);
			}
			elseif(!empty($jsonObj->error)) {
				return array('success'=> false,  'error'=> $jsonObj->error,'code'=>$jsonObj->code);

			} else {
				return $jsonObj;
			}
		} else {
			return array('success'=> false,  'result'=>NULL);
		}
	}

	private function processResponseXML($result,$simple){
		//:TODO processResponseXML
		return NULL;
	}

	private function calcControlSum($params,$action){
		$params['version']=$this->version;
		$params['action']=$action;
		ksort($params);
		$sum='';
		foreach ($params as $k=>$v) $sum.=$v;
		$sum.=$this->privateKey;
		return md5($sum);
	}
}