<?php
namespace app\model;

use think\Model;

class Resume extends Model{
    protected $connection = 'user';
    
    protected $table = 'resume';

    protected $schema = [
        'id' => 'int',
        'name' => 'string',
        'E-mail' => 'string',
        'phone' => 'string',
        'school' => 'string',
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

    public function AddResume($user_id, $Resume){
        if(Resume::where('userid', $user_id)->findOrEmpty()->isEmpty()){
            Resume::create($Resume);
        }else{
            Resume::where('userid', $user_id)->update($Resume);
        }
    }

    public function UploadFile($user_id, $Filename){
        if(Resume::where('userid', $user_id)->findOrEmpty()->isEmpty()){
            Resume::create($Filename);
        }else{
            Resume::where('userid', $user_id)->update($Filename);
        }
    }
}
?>