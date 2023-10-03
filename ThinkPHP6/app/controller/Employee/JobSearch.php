<?php

namespace app\controller\Employee;

use app\BaseController;
use app\model\Job as JobModel;
use think\facade\Request;

class JobSearch extends BaseController{
    
    public function Search(){
        if(request()->isAjax()){
            $Search = Request::param();
            $Job = new JobModel;
            $Joblist = $Job -> jobSearch($Search);
            if($Joblist == NULL){
                return json(['code' => 101, 'message' => 'No results fit the requirements']);
            }else{
                return json(['code' => 102, 'joblist' => $Joblist]);
            }
        }else{
            return json(['code' => 1000, 'message' => 'An error occurred. Please try again later.']);
        }    
    }
}

