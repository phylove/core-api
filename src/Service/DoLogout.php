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

        $api = new ApiToken;
        $api->user_id = $session->user_id;
        $api->key = $session->key;
        $api->created_at = DATE_TIME_ACCESS;
        $api->updated_at = DATE_TIME_ACCESS;
        $api->save();

        return [];

    }

}