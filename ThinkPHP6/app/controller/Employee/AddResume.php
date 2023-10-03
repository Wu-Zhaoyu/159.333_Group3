<?php

namespace app\controller\Employee;

use app\BaseController;
use app\model\Resume as ResumeModel;
use app\model\User as UserModel;
use app\validate\Resume as ResumeValidate;
use think\exception\ValidateException;
use think\facade\Filesystem;
use think\facade\Request;

class AddResume extends BaseController{

    public function Resume(){
            try{
                $token = Request::header('Authorization');
                $Resume = Request::except(['resFile']);
                $file = Request::file('resFile');
                //validate(ResumeValidate::class) -> check($Resume);
                $User = new UserModel;
                $user_id = $User -> findID($token);
                $Filename = Filesystem::disk('public')->putFile('resume', $file);
                $resFile = ['resFile' => $Filename];
                $Res = new ResumeModel;
                $Res -> AddUserid($user_id);
                $Res -> AddResume($user_id, $Resume);
                $Resume -> UploadFile($user_id, $resFile);
                return json(['code' => 100, 'message' => 'Resume saves successfully.']);
            }catch (ValidateException $e) {
                return $e->getError();
            }
    }
}
?>