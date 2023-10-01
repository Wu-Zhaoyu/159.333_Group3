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
        if(request()->isAjax()){
            try{
                $token = Request::header('Authorization');
                $Resume = Request::post();
                $file = Request::file();
                validate(ResumeValidate::class) -> check($Resume);
                $User = new UserModel;
                $user_id = $User -> findID($token);
                $Filename = Filesystem::disk('public')->putFile('resume', $file);
                $resFile = ['resFile' => $Filename];
                $Res = new ResumeModel;
                $Res -> AddResume($user_id, $Resume);
                $Resume -> UploadFile($user_id, $resFile);
                return json(['code' => 100, 'message' => 'Resume saves successfully.']);
            }catch (ValidateException $e) {
                return $e->getError();
            }
        }else{
            return json(['code' => 1000, 'message' => 'An error occurred. Please try again later.', 'result'=>'error']);
        }
    }
}
?>