<?php
 namespace App\Http\Proxy;
  /**
   *
   */
  class TokenProxy
  {
    protected $http;

    function __construct(\GuzzleHttp\client $http)
    {
      # code...
      $this->http = $http;
    }
    public function login($email,$password)
    {
      if (auth()->attempt(['email'=>$email,'password'=>$password,'is_active' => 1])) {
        # code...
        return $this->proxy('password',[
          'username' => $email,
          'password' => $password,
          'scope' => ''
        ]);
      }
      return response()->json([
        'status' => false,
        'message' => 'your account is not actived'
      ],421);

    }
    public function loginout(){
      $user = auth()->guard('api')->user();
      $accessToken = $user->token();
      app('db')->table('oauth_refresh_tokens')
      ->where('access_token_id',$accessToken->id)
      ->update([
        'revoked' => true,
      ]);
      app('cookie')->forget('refreshToken');
      $accessToken->revoke();
      return response()->json([
        'message'=>'loginout!'
      ],204);
    }
    public function proxy($grantType,array $data = [])
    {
      $data = array_merge($data,[
        'client_id' =>env('PASSPORT_CLIENT_ID'),
        'client_secret' =>env('PASSPORT_CLIENT_SECRET'),
        'grant_type' => $grantType
      ]);
      $response = $this->http->post('http://vue-spa.dev/oauth/token',[
        'form_params' => $data
      ]);
      $token = json_decode((string)$response->getBody(),true);
      return response()->json([
        'token' => $token['access_token'],
        'expires_in' => $token['expires_in']
      ])->cookie('refreshToken',$token['refresh_token'],14400,null,null,false,true);
    }

  }


 ?>
