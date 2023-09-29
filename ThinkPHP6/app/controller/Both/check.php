<?php
namespace app\Controller\Both;

use app\BaseController;

class check extends BaseController {
    public function ChkLogin(){
        if(!isset($_SESSION['User_ID']) || $_SESSION['User_ID'] == '') {
            return json(['code' => 100, 'msg' => '请登录']);
        }
    }
}
    parent::ChkLogin();
?>
