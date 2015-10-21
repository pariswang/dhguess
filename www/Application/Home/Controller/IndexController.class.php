<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
		$this->uid = session('uid');
        $list = M('users')->select();
		$this->display();
    }
}