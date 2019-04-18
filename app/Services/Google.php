<?php

namespace App\Services;

class Google
{
    protected $client;

    public function __construct()
    {
        $client = new \Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect_uri'));
        $client->setAccessType(config('services.google.access_type'));
        $client->setIncludeGrantedScopes(config('services.google.include_granted_scopes'));

        $client->setPrompt('select_account consent');
        $client->setApplicationName('Google Calendar API PHP Quickstart');
        $client->setScopes(config('services.google.scopes'));

        if ($credentials_file = 'service-account.json') {
            // set the location manually
            $client->setAuthConfig($credentials_file);
        } elseif (getenv('GOOGLE_APPLICATION_CREDENTIALS')) {
            // use the application default credentials
            $client->useApplicationDefaultCredentials();
        } else {
            echo missingServiceAccountDetailsWarning();

            return;
        }

        $this->client = $client;
    }

    public function __call($method, $args)
    {
        if (!method_exists($this->client, $method)) {
            throw new \Exception("Call to undefined method '{$method}'");
        }

        return call_user_func_array([$this->client, $method], $args);
    }

    public function service($service)
    {
        $classname = "Google_Service_$service";

        return new $classname($this->client);
    }

    public function connectUsing($token)
    {
        $this->client->setAccessToken($token);

        return $this;
    }
}
