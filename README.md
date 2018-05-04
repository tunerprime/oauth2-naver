# oauth2-naver
extension league/OAuth2-client version by Naver

Composer Install

        composer require tunerprime/oauth2-naver

Example Code

        $provider = new TunerPrime\OAuth2\Client\Provider\Naver([
            'clientId'     => '{naver-client-id}',
            'clientSecret' => '{naver-client-secret}',
            'redirectUri'  => '{your-redirect-uri}',
        ]);
    
        if (!empty($_GET['error'])) {
        
            exit('Got error: ' . htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'));
        
        } elseif (empty($_GET['code'])) {

            $authUrl = $provider->getAuthorizationUrl();
            $_SESSION['oauth2state'] = $provider->getState();
            header('Location: ' . $authUrl);
            exit;
        
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
            unset($_SESSION['oauth2state']);
            exit('Invalid state');
        
        } else {
        
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);
        
            try {
            
                $ownerDetails = $provider->getResourceOwner($token);
            
                printf('Hello %s!', $ownerDetails->getEmail());
            
            } catch (Exception $e) {
            
                exit('Something went wrong: ' . $e->getMessage());
            
            }
        
            // Use this to interact with an API on the users behalf
            echo $token->getToken();
            
            // Number of seconds until the access token will expire, and need refreshing
            echo $token->getExpires();
        }

