<?php

namespace Phy\CoreApi;

use Phy\CoreApi\CoreException;
use Exception;
use DB;
use Validator;
use Log;


abstract class CoreService implements DefaultService {

	protected static $instances;

	abstract protected function prepare($input);
	abstract protected function process($input, $originalData);

	public static function getInstance() {
        $class = get_called_class();

        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class;
        }
        return self::$instances[$class];
    }

	public function execute($input){
		$originalData = $input;
		$result = [];

		if(isset($this->task)){
			if(!in_array($this->task, $input['session']->tasks))
				throw New CoreException("Unauthorized");
		}
		
		try {
			
			$validator = Validator::make($input, $this->validation());

			if ($validator->fails()) {
				throw new CoreException("", $validator->errors());
			}

			$this->prepare($input);
			$result =  $this->process($input, $originalData);

		} catch(CoreException $ex){		

			throw $ex;
			
        } catch(Exception $ex){
			
			throw new CoreException($ex->getMessage());

		}
        
		return $result;
	}

	protected function validation() {
		return [];
	}

	protected function errorListValidation($message="", $errorList=[]) {
		throw new CoreException($message, $errorList);
	}

	protected function auditInsert($object, $userId, $datetime) {
		$object->{'created_at'} = $datetime;
		$object->{'created_by'} = $userId;
		$object->{'updated_at'} = $datetime;
		$object->{'updated_by'} = $userId;
		$object->{'version'} = 0;
	}

	protected function auditUpdate($object, $userId, $datetime) {
		$object->{'updated_at'} = $datetime;
		$object->{'updated_by'} = $userId;
		$object->{'version'} = DB::raw("version+1");
	}
}