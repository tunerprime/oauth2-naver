<?php namespace TunerPrime\OAuth2\Client\Provider;


use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

class Naver extends AbstractProvider{
	public $version = '';
	
	public $base_naver_url = 'https://nid.naver.com/oauth2.0/';
	
	public $base_naver_api_url = 'https://openapi.naver.com/';
	
	public $base_naver_profile_url = "/nid/me";
	
	public function __construct(array $options = [], array $collaborators = [])
	{
		parent::__construct($options, $collaborators);
	}
	
	public function getBaseAuthorizationUrl(){
		return $this->base_naver_url.'authorize';
	}
	
	public function getBaseAccessTokenUrl(array $params){
		return $this->base_naver_url.'token';
	}
	
	public function getResourceOwnerDetailsUrl(AccessToken $token)
	{
		return $this->base_naver_api_url.$this->version.$this->base_naver_profile_url;
	}
	
	protected function getDefaultScopes()
	{
		return [];
	}
	
	public function getAuthorizationHeaders($token = NULL){
		return ['Authorization'=>'Bearer '.$token];
	}
	
	protected function checkResponse(ResponseInterface $response, $data)
	{
		if( $response->getStatusCode() != '200' ) {
			throw new IdentityProviderException($response->getBody(), $response->getStatusCode(), $data);
		}
	}
	protected function createResourceOwner(array $response, AccessToken $token)
	{
		$user = new NaverUser($response);
		return $user;
	}
	
}