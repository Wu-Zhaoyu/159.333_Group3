<?php
namespace app\model;

use think\Model;

class User extends Model{
    protected $connection = 'user';
    
    protected $table = 'user';

    protected $schema = [
        'id' => 'int',
        'username' => 'string',
        'password' => 'string',
        'token' => 'string'
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

    public function Verification($token){
        if(User::where('token', $token)->first()->findorEmpty()->isEmpty()){
            return false;
        }else{
            return true;
        }
    }

    public function updataVer($user_id, $token){
        User::where('id', $user_id)->update(['token' => $token]);
    }

    public function findID($token){
        return User::where('token', $token)->value('id');
    }
}
?>