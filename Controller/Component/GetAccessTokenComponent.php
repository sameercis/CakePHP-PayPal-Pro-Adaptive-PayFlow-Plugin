<?php
/**
 * GetAccessTokenComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class GetAccessTokenComponent extends Component {
	
	public function execute() {

		// Create PayPal object.
		$PayPalConfig = array(
							  'Sandbox' => $this->sandbox,
							  'DeveloperAccountEmail' => $this->developer_account_email,
							  'ApplicationID' => $this->application_id,
							  'DeviceID' => $this->device_id,
							  'IPAddress' => $_SERVER['REMOTE_ADDR'],
							  'APIUsername' => $this->api_username,
							  'APIPassword' => $this->api_password,
							  'APISignature' => $this->api_signature,
							  'APISubject' => $this->api_subject
							);

		$PayPal = new PayPal_Adaptive($PayPalConfig);

		// Prepare request arrays
		$GetAccessTokenFields = array(
									'Token' => '', 					// Required.  The request token from the response to RequestPermissions
									'Verifier' => '' 				// Required.  The verification code returned in the redirect from PayPal to the return URL.
									);

		$PayPalRequestData = array('GetAccessTokenFields' => $GetAccessTokenFields);

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->GetAccessToken($PayPalRequestData);

		return $PayPalResult;
	}
}
?>