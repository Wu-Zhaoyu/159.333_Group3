<?php

namespace app\controller\Both;

use app\BaseController;
use app\model\User as UserModel;
use app\validate\User as UserValidate;
use think\exception\ValidateException;
use think\facade\Request;
use think\facade\Session;

class Start extends BaseController{

    public function Register(){
        if(Session::has('User_ID')){
            return json(['code' => 101, 'msg' => 'You are currently logged in.']);
        }else{
            if(request()->isAjax()){
                $data = Request::post();
                try {
                    validate(UserValidate::class) -> check($data);
                    $User = new UserModel;
                    if($User -> register($data)){
                        Session::set('User_ID', $User -> getUserID($data));
                        return json(['code' => 1010, 'message' => 'Register and login successfully.', 'result'=>'success']);
                    }else{
                        return json(['code' => 1006, 'message' => 'The user name already exists.', 'result'=>'error']);
                    }
                } catch (ValidateException $e) {
                    return $e->getError();
                }
            }else{
                return json(['code' => 1000, 'message' => 'An error occurred. Please try again later.', 'result'=>'error']);
            }
        }
    }

    public function Login(){
        if(Session::has('User_ID')){
            return json(['code' => 101, 'message' => 'You are currently logged in.']);
        }else{
            if(request()->isAjax()){
                $data = Request::post();
                try {
                    validate(UserValidate::class) -> scene('login') -> check($data);
                    $User = new UserModel();
                    if($User -> login($data)){
                        Session::set('User_ID', $User -> getUserID($data));
                        return json(['code' => 1010, 'message' => 'Login successfully.', 'result'=>'success']);
                    }else{
                        return json(['code' => 1007, 'message' => 'The account or password is incorrect.', 'result'=>'error']);
                    }
                } catch (ValidateException $e) {
                    return $e->getError();
                }
            }else{
                return json(['code' => 1000, 'message' => 'An error occurred. Please try again later.', 'result'=>'error']);
            }
        }
    }
}