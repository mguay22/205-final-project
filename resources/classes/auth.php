<?php
namespace BillBuddy;
use Auth0\SDK\Auth0;

class Auth {
  private $auth0;

  public function __construct() {
    $this->auth0 = new Auth0([
      'domain' => 'billbuddy.auth0.com',
      'client_id' => 'OJk52cegiigbHQKllHkt4Ff692qJ54M8',
      'client_secret' => 'KrcUQRqz7JPAHr0igi5IDnivbUZgha83ForgmM6S-G12hdrKLxnP7H3nzHWjkIuV',
      'redirect_uri' => 'http://mguay.w3.uvm.edu/205-final-project/',
      'audience' => 'https://billbuddy.auth0.com/userinfo',
      'scope' => 'openid profile',
      'persist_id_token' => true,
      'persist_access_token' => true,
      'persist_refresh_token' => true,
    ]);
  }

  public function getUserInfo() {
    $userInfo = $this->auth0->getUser();

    if (!$userInfo) {
      var_dump('Authentication invalid');
    } else {
        var_dump('Authenticated');
    }
  }

}