<?php

namespace TAS\CoreApi;

class CallService {

	public static function execute($input, $serviceName)
    {
        try {
            $classService = "App\\Service\\".ucfirst($serviceName);
            
            // validation service exists
            if(!class_exists($classService)){
                throw New CoreException("Service doesn't exists");
            }

            $object = $classService::getInstance();

            // begin transaction
            if($object->transaction !== null && $this->transaction !== false)
                DB::beginTransaction();

            // validation service not allow
            if(isset($object->system)){
                if($object->system === true){
                    throw New CoreException("Service doesn't allow access");
                }
            }

            $sessions = app()->make('sessions')->getSessionAll();
            $input['session'] = $sessions;
            $input['datetime'] = DATE_TIME_ACCESS;
            
            $result = $object->execute($input);

            if($object->transaction !== null && $this->transaction !== false)
                DB::commit();

            return CoreResponse::ok($result);

        } catch (CoreException $ex){
            // transaction rollback
            if($object->transaction !== null && $this->transaction !== false)
                DB::rollback();
            
            return CoreResponse::fail($ex);
        }
        
        
    }
}