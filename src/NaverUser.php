<?php
namespace TunerPrime\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class NaverUser implements ResourceOwnerInterface{
	protected $response;
	
	public function __construct(array $response = array())
	{
		$this->response = $response['response'];
	}
	
	public function getId(){
		if(isset($this->response['id']))
			return $this->response['id'];
		else
			return null;
	}
	
	public function getNickName(){
		if(isset($this->response['nickname']))
			return $this->response['nickname'];
		else
			return null;
	}
	
	public function getName(){
		if(isset($this->response['name']))
			return $this->response['name'];
		else
			return null;
	}
	
	public function getEmail(){
		if(isset($this->response['email']))
			return $this->response['email'];
		else
			return null;
	}
	
	public function getGender(){
		if(isset($this->response['gender']))
			return $this->response['gender'];
		else
			return null;
	}
	
	public function getAge(){
		if(isset($this->response['age']))
			return $this->response['age'];
		else
			return null;
	}
	
	public function getBirthday(){
		if(isset($this->response['birthday']))
			return $this->response['birthday'];
		else
			return null;
	}
	
	public function getProfileImage(){
		if(isset($this->response['profile_image']))
			return $this->response['profile_image'];
		else
			return null;
	}
	
	public function toArray()
	{
		return $this->response;
	}
}
