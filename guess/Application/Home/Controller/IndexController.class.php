<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
		if(session('uid')>0){
			$this->logined = true;
			$this->uid = session('uid');
			$this->user = M('users')->where(array('id'=>$this->uid))->find();
		}else{
			session('uid',1);
			$this->logined = false;
		}
		
        $list = M('users')->select();
		$this->display();
    }
}