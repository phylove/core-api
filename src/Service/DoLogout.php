<?php

namespace Phy\CoreApi\Service;

use Phy\CoreApi\CoreService;
use Phy\CoreApi\DefaultService;
use Phy\CoreApi\CoreException;
use App\Model\ApiToken;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class DoLogout extends CoreService implements DefaultService {

    public $transaction = true;

    public function getDescription()
    {
        return "Do Logout";
    }

    public function prepare($input)
    {
        
    }

    public function process($input, $originalInput)
    {
        $session = JWT::decode($input["token"], env('JWT_SECRET', 'xxx'), ['HS256']);

        ApiToken::where([
            "key" => $session->key,
            "user_id" => $session->user_id
        ])->delete();

        return [];

    }

}