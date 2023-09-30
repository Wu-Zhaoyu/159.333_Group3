<?php

namespace app\controller\Employee;

use app\BaseController;
use app\model\Resume as ResumeModel;
use think\facade\Filesystem;
use think\facade\Request;

class AddResume extends BaseController{

    public function Resume(){
        if(request()->isAjax()){
            $Resume = Request::post();
            $Resume = new ResumeModel;
            $Resume -> JobResume($Resume);
        }
    }

    public function uploadFile(){
        $file = Request::file();
        $Filename = Filesystem::disk('public')->putFile('resume', $file);
        $Resume = new ResumeModel;
        $Resume -> UploadFile($Filename);
    }
}
?>