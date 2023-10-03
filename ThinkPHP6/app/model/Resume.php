<?php
namespace app\model;

use think\Model;

class Resume extends Model{
    protected $connection = 'user';
    
    protected $table = 'resume';

    protected $schema = [
        'ID' => 'int',
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'school' => 'string',
        'academic' => 'string',
        'major' => 'string',
        'dataEdu' => 'string',
        'company' => 'string',
        'position' => 'string',
        'dataWor' => 'string',
        'evaluation' => 'string',
        'experience' => 'string',
        'resFile' => 'string',
        'userid' => 'int'
    ];

    public function AddUserid($user_id){
        if(Resume::where('userid', $user_id)->findOrEmpty()->isEmpty()){
            Resume::create(['userid' => $user_id]);
        }
    }

    public function AddResume($user_id, $Resume){
        Resume::where('userid', $user_id)->update($Resume);
    }

    public function UploadFile($user_id, $Filename){
        Resume::where('userid', $user_id)->update($Filename);
    }
}
?>