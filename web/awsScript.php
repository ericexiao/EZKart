<?php
	/* Set the Amazon locale, which is the top-level domain of the server */
	$xml_obj = null;
	
	function itemLookup($itemID) {
		$query = array( 'Operation'     =>'ItemLookup', 
					'ResponseGroup' =>'Offers',
					'IdType'        =>'ASIN',
					'ItemId'        =>'047061529X' );
		$signed_url = sign_query($query);
	 
		/* Use CURL to retrieve the data so that http errors can be examined */
		$ch = curl_init($signed_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 7);

	   
	   $xml_string = curl_exec($ch);
		$curl_info = curl_getinfo($ch);
		if(curl_errno($ch)) { 
			echo 'Curl error: ' . curl_error($ch); 
		}
		curl_close($ch);
		 
		if($curl_info['http_code']==200) {
			// dump_xml($xml_string);
			$xml_obj = simplexml_load_string($xml_string, "SimpleXMLElement");
			$xmlArray = json_decode(json_encode($xml_obj), true);
		}
		else {
			/* examine the $curl_info to discover why AWS returned an error 
			   $xml_string may still contain valid XML, and may include an
			   informative error message */
			echo json_encode($curl_info);
		}
	 
	/* Traverse $xml_obj to display parts of it on your website */
		if (!is_null($xml_obj)) {
			print_r($xmlArray);
			if (!is_null($xmlArray) && $xmlArray['Items']['Request']['IsValid'] == "True") {
				$rawValue = ($xmlArray['Items']['Item']['OfferSummary']['LowestNewPrice']['Amount']);
				$formattedValue = ($xmlArray['Items']['Item']['OfferSummary']['LowestNewPrice']['FormattedPrice']);
				echo $formattedValue;
			}
		}
		exit();
	}

	function sign_query($parameters) {	
		/*keys and authentication material */
		$ASSOCIATE_ID = 'ez05f-20';
		$PUBLIC_KEY = 'AKIAJJ4HKNGNIVJWHD5Q';
		$PRIVATE_KEY = 'VHok4bSZFouShRiqBYByivD2qv3QhACxSZDO/yK5';

		//sanity check
		if(! $parameters) return '';
	 
		/* create an array that contains url encoded values
		   like "parameter=encoded%20value" 
		   USE rawurlencode !!! */
		$encoded_values = array();
		foreach($parameters as $key=>$val) {
			$encoded_values[$key] = rawurlencode($key) . '=' . rawurlencode($val);
		}
	 
		/* add the parameters that are needed for every query
		   if they do not already exist */
		$encoded_values['AssociateTag'] = 'AssociateTag='.rawurlencode($ASSOCIATE_ID);
		$encoded_values['AWSAccessKeyId'] = 'AWSAccessKeyId='.rawurlencode($PUBLIC_KEY);
		$encoded_values['Service'] = 'Service=AWSECommerceService';
		$encoded_values['Timestamp'] = 'Timestamp='.rawurlencode(gmdate('Y-m-d\TH:i:s\Z'));
		$encoded_values['Version'] = 'Version=2011-08-01';
 
		/* sort the array by key before generating the signature */
		ksort($encoded_values);
	 
	 
		/* set the server, uri, and method in variables to ensure that the 
		   same strings are used to create the URL and to generate the signature */
		
	$aws_locale = '.com';
		$server = 'webservices.amazon'.$aws_locale;
		$uri = '/onca/xml'; //used in $sig and $url
		$method = 'GET'; //used in $sig
	 
	 
		/* implode the encoded values and generate signature
		   depending on PHP version, tildes need to be decoded
		   note the method, server, uri, and query string are separated by a newline */
		$query_string = str_replace("%7E", "~", implode('&',$encoded_values));   
		$sig = base64_encode(hash_hmac('sha256', "{$method}\n{$server}\n{$uri}\n{$query_string}", $PRIVATE_KEY, true));
	 
		/* build the URL string with the pieces defined above
		   and add the signature as the last parameter */
		$url = "http://{$server}{$uri}?{$query_string}&Signature=" . str_replace("%7E", "~", rawurlencode($sig));
		return $url;
	}
	 
?>