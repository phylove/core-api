<?php

namespace Phy\CoreApi;

class CoreResponse {

    private $successMessage;
    private $errorMessage;
	private $errorList;
	
	public static function ok($output, $message=""){
        $result["success"] = true;
        $result["result"] = $output;
        if(!is_null($message) && !empty($message)){
            $result["message"] = $message;
        }

        return response()->json($result, 200);
	}

	public static function fail($ex){
        $result["success"] = false;
        if(!empty($ex->getErrorMessage()) && !is_null($ex->getErrorMessage()) ){
            $result["error_message"] = $ex->getErrorMessage();
        }

        $result["error_list"] = $ex->getErrorList();

        return response()->json($result, 200);
        
    }
    
    public static function error($ex){
        $result["success"] = false;
        if(!empty($ex->getErrorMessage()) && !is_null($ex->getErrorMessage()) ){
            $result["error_message"] = $ex->getErrorMessage();
        }

        $result["error_code"] = $ex->getErrorCode();
        return response()->json($result, $ex->getErrorCode());
        
	}
}