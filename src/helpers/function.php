<?php

if ( ! function_exists('blank_value'))
{

    function blank_value($array, $key)
    {
        return isset($array[$key])? $array[$key] : "";
    }
}

if ( ! function_exists('is_blank'))
{

    function is_blank($array, $key)
    {
        return isset($array[$key])? (empty($array[$key])? true : false) : true;
    }
}


if(!function_exists('service')){

    /**
     * get service object
     * 
     * @param string     $service  service name in call
     * @return object    the result instance of Class Service
     */ 

    function service($service)
    {
        $classService = "App\\Service\\".ucfirst($service);
        if(!class_exists($classService)){
            throw New \Phy\CoreApi\CoreException("Service ".$service." doesn't exists");
        }

        return $classService::getInstance();
    }
}

if(!function_exists('service_exec')){
    
    /**
     * execute service when service dont't call first
     * 
     * @param string     $service
     * @param array      $input input of service
     * @return mixed     the result of behavioure service
     */ 
    function service_exec($service, $input)
    {
        $object = service($service);
        return $object->execute($input);
    }
}