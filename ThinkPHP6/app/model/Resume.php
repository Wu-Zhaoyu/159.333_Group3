<?php
namespace app\model;

use think\Model;

class Resume extends Model{
    protected $connection = 'user';
    
    protected $table = 'applicant';

    protected $schema = [
        'id' => 'int',
        'name' => 'string',
        'E-mail' => 'string',
        'phone' => 'string',
        'school' => 'string',
        'academic career' => 'string',

    ];

    public function JobResume($Resume){
        Resume::create($Resume);
    }

    public function UploadFile($Filename){
        Resume::create($Filename);
    }
}
?>