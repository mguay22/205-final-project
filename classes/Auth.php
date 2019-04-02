<?php
require_once(dirname(__DIR__ ) . '/vendor/autoload.php');

use Auth0\SDK\Auth0;

class Auth {
  private $auth0;
  private $accessToken;

  public function __construct() {
    $this->auth0 = new Auth0([
      'domain' => 'billbuddy.auth0.com',
      'client_id' => 'OJk52cegiigbHQKllHkt4Ff692qJ54M8',
      'client_secret' => 'KrcUQRqz7JPAHr0igi5IDnivbUZgha83ForgmM6S-G12hdrKLxnP7H3nzHWjkIuV',
      'redirect_uri' => 'http://localhost:7888/205-final-project/dashboard.php',
      'audience' => 'https://cs205/billbuddy',
      'scope' => 'openid profile',
      'persist_id_token' => true,
      'persist_access_token' => true,
      'persist_refresh_token' => true,
    ]);
  }

  public function setAccessToken($accessToken) {
    $this->accessToken = $accessToken;
  }

  public function handleLogin() {
    $this->auth0->login();
  }

  public function getUserInfo() {
    return $this->auth0->getUser();
  }

  public function getAccessToken() {
    return $this->accessToken;
  }

  public function getUserId() {
    $userInfo = $this->getUserInfo();
    return $userInfo['sub'];
  }

  public function updateHouseholdCode($householdCode) {
    $curl = curl_init();
    var_dump(array(
      "authorization: Bearer " . $this->getAccessToken(),
      "content-type: application/json"
    ));
    var_dump("https://billbuddy.auth0.com/api/v2/users/" . $this->getUserId());
    var_dump($householdCode);

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://billbuddy.auth0.com/api/v2/users/" . $this->getUserId(),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "PATCH",
      CURLOPT_POSTFIELDS => "{\"user_metadata\": {\"householdCode\": " . $householdCode ."}}",
      CURLOPT_HTTPHEADER => array(
        "authorization: Bearer " . $this->getAccessToken(),
        "Content-type: application/json"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }
  }

}