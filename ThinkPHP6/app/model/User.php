<?php
namespace app\model;

use think\Model;

class User extends Model{
    protected $connection = 'user';
    
    protected $table = 'applicant';

    protected $schema = [
        'id' => 'int',
        'username' => 'string',
        'password' => 'string'
    ];

    public function register($data){
        if(User::where('name', $data['username'])->findOrEmpty()->isEmpty()){
            User::create($data);
            return true;
        }else{
            return false;
        }
    }

    public function login($data){
        if(User::where('name', $data['username'])->value('password') == $data['password']){
            return true;
        }else{
            return false;
        }
    }

    public function getUserID($data){
        return User::where($data)->value('id');
    }
}
?>