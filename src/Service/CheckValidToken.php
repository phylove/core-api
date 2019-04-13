<?php

namespace Phy\CoreApi\Service;

use Phy\CoreApi\DefaultService;
use Phy\CoreApi\CoreService;
use Phy\CoreApi\CoreException;
use Phy\CoreApi\Models\ApiToken;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Exception;

class CheckValidToken extends CoreService implements DefaultService {

    public $transaction = false;

    public function getDescription()
    {
        return "Check Valid Token";
    }

    public function prepare($input)
    {
    }

    public function process($input, $originalInput)
    {
        
        try {
            $payload = JWT::decode($input["token"], env('JWT_SECRET', 'xxx'), ['HS256']);
            
            $sessions = app()->make('sessions');
            $sessions->setSession($payload);
        } catch(ExpiredException $e) {
            throw New CoreException("Token is expired");
        } catch(Exception $e) {
            throw New CoreException("Invalid Token");
        }

        $checkApiValid = ApiToken::where([
            "key" => $payload->key,
            "user_id" => $payload->user_id
        ])->first();

        if(is_null($checkApiValid)) {
            throw New CoreException("Token is expired");
        }

        return [];

    }

}