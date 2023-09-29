<?php
namespace app\model;

use think\Model;

class Job extends Model{
    protected $connection = 'job';
    
    protected $table = 'job';

    protected $schema = [
        'id' => 'int',
        'address' => 'string',
        'category' => 'string',
        'jobName' => 'string'
    ];

    public function jobSearch($Search){
        $map = [];
        if($Search["address"] <> ''){
            $map[] = ['address', '=', $Search["address"]];
        }
        if($Search["category"] <> ''){
            $map[] = ['category', '=', $Search["category"]];
        }
        if($Search["jobName"] <> ''){
            $map[] = ['jobName', 'like', '%' . $Search["jobName"] . '%'];
        }
        $Joblist = Job::where($map)->Select()->toArray();
        return $Joblist;
    }

    public function JobAdd($Job){
        Job::create($Job);
    }
}
?>