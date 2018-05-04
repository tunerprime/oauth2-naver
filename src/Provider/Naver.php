<?php namespace TunerPrime\OAuth2\Client\Provider;


use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

class Naver extends AbstractProvider{
	const BASE_NAVER_URL = 'https://nid.naver.com/oauth2.0/';
	
	const BASE_NAVER_PROFILE_URL = 'https://openapi.naver.com/v1/nid/me';
	
	public function __construct(array $options = [], array $collaborators = [])
	{
		parent::__construct($options, $collaborators);
	}
	
	public function getBaseAuthorizationUrl(){
		return static::BASE_NAVER_URL.'authorize';
	}
	
	public function getBaseAccessTokenUrl(array $params){
		return static::BASE_NAVER_URL.'token';
	}
	
	public function getResourceOwnerDetailsUrl(AccessToken $token)
	{
		return static::BASE_NAVER_PROFILE_URL;
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