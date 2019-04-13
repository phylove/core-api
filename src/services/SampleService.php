<?php

namespace App\Service;

use Phy\CoreApi\CoreService;
use Phy\CoreApi\CoreException;
use Phy\CoreApi\Models\ApiToken;

class SampleService extends CoreService {

    public $transaction = true;

    public function prepare($input)
    {
        
    }

    public function process($input, $originalInput)
    {
        return ["test" => "version 1.5.0"];
    }

}