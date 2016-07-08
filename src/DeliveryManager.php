<?php namespace DeliveryManager;

class DeliveryManager {
	
	protected $onfleetClient;
	
	protected $onfleetAuthKey;
	
	protected $onfleetApiPrefix;
	
	protected $onfleetBaseUrl;
	
	public function __construct() {
		$this->onfleetClient = new \GuzzleHttp\Client();
		$this->onfleetAuthKey = 'Basic ' . base64_encode('53fd7587b107933c7b596937c076967c:');
		$this->onfleetBaseUrl = 'https://onfleet.com/';
		$this->onfleetBaseUrl = substr($this->onfleetBaseUrl, -1) == '/' ? $this->onfleetBaseUrl : $this->onfleetBaseUrl . '/';
		$this->onfleetApiPrefix = 'api/v2';
	}
	
	public function test() {
		
/*$response = $this->onfleetClient->request('GET', 'https://onfleet.com/api/v2/auth/test', 
            ['verify' => false,
            'headers' => ['Authorization' => $this->onfleetApiPrefix]
        ]);
		print $response->getBody();
		die;*/
		//print $this->onfleetApiCall('/auth/test', 'GET');
	//	print $this->onfleetApiCall('/workers', 'POST', '{"name":"test 2","phone":"+380951133722","teams":["KtZB1FkjmJRmkvdZ0R~oxtET"]}');
		print $this->createTask('O0TFYqud*a9qocZUWr2Uri9M', "2829 Vallejo St, SF, CA, USA", "Blas Silkovich", "+380951433121");
		die;
	}
	
	protected function onfleetApiCall($apiEndpoint, $method, $body = null) {
		$options = [
			'verify' => false,
			'headers' => ['Authorization' => $this->onfleetAuthKey]
		];
		if ($body) {
			$options['body'] = $body;
		}
		$endpointUrl = $this->onfleetBaseUrl . $this->onfleetApiPrefix . $apiEndpoint;
		$response = $this->onfleetClient->request($method, $endpointUrl, $options);
		return $response->getBody();
	}
	
	public function createTask($worker, $destinationAaddress, $recipientName, $recipientPhone) {
		
		$requestData = (object)[
			'destination' => [
				'address' => [
					'unparsed' => $destinationAaddress,
				],
			],
			'recipients' => [
				[
					'name' => $recipientName,
					'phone' => $recipientPhone,
				]
			],
			'container' => [
				'type' => 'WORKER',
				'worker' => $worker,
			]
		];
		return $this->onfleetApiCall('/tasks', 'POST', json_encode($requestData));
	}
}
