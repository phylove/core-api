<?php

namespace Phy\CoreApi\Service;

use Phy\CoreApi\Helpers\DateUtil;
use Phy\CoreApi\CoreService;
use Phy\CoreApi\DefaultService;
use Phy\CoreApi\CoreException;
use App\Model\User;
use App\Model\Role;
use App\Model\ApiToken;
use DB;

class LoginAuth extends CoreService implements DefaultService {

    public $transaction = false;

    public function prepare($input)
    {
        
    }

    public function process($input, $originalInput)
    {
        $user = User::where("username", $input["username"])->first();
        if(is_null($user)){
            throw New CoreException("User not found");
        }

        if(!password_verify($input["password"], $user->password)){
            throw New CoreException("User and Password don't match");
        }

        $key = sha1($user->id.microtime().rand(1000,999));

        $user->key = sha1($user->id.microtime().rand(1000,999));
        $role = Role::find($user->role_id);

        $dbConnection = env('DB_CONNECTION', 'mysql');

        if($dbConnection == 'pgsql'){
            $tasks = DB::select(
                "SELECT string_agg(A.task_name, ',') AS result 
                    FROM tasks A 
                INNER JOIN role_task B ON A.id=B.task_id
                    WHERE B.role_id=".$role->id);
        } elseif($dbConnection == 'mysql'){
            $tasks = DB::select(
                "SELECT group_concat(A.task_name, '') AS result 
                    FROM tasks A
                INNER JOIN role_task B ON A.id=B.task_id
                    WHERE B.role_id=".$role->id);
        }

        $session = [
            "user_id" => $user->id,
            "username" => $user->username,
            "full_name" => $user->full_name,
            "email" => $user->email,
            "key" => $key,
            "role_id" => $role->id,
            "role_code" => $role->role_code,
            "role_name" => $role->role_name,
            "tasks" => explode(",", $tasks[0]->result)
        ];

        return $session;

    }

}