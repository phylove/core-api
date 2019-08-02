<?php

namespace Phy\CoreApi;
use Phy\CoreApi\CoreException;
use Phy\CoreApi\ErrorException;
use Exception;
use DB;

class CallService {

	public static function execute($input, $serviceName)
    {
        try {
            $classService = "App\\Service\\".ucfirst($serviceName);
            $object = $classService::getInstance();
            
            // begin transaction
            if($object->transaction !== null && $object->transaction !== false)
                DB::beginTransaction();
            
            // validation service exists
            if(!class_exists($classService)){
                throw New ErrorException("Service doesn't exists", 403);
            }

            // validation service not allow
            if(isset($object->system)){
                if($object->system === true){
                    throw New ErrorException("Service doesn't allow access", 403);
                }
            }

            $sessions = app()->make('sessions')->getSessionAll();

            // by session
            if(is_null($sessions)) {
                $sessions = new \stdClass;
                $sessions->user_id = 0;
                $sessions->tasks = [];
            }

            $input['session'] = $sessions;
            $input['datetime'] = DATE_TIME_ACCESS;

            if(isset($object->task)){
                if(!in_array($object->task, $sessions->tasks))
                    throw New ErrorException("Unauthorized", 401);
            }
            
            $result = $object->execute($input);

            if($object->transaction !== null && $object->transaction !== false)
                DB::commit();

            return CoreResponse::ok($result);

        } catch (CoreException $ex) {
            // transaction rollback
            if($object->transaction !== null && $object->transaction !== false)
                DB::rollback();
            
            return CoreResponse::fail($ex);
        } catch(ErrorException $ex) {
            return CoreResponse::error($ex);
        }
        
        
    }
}
