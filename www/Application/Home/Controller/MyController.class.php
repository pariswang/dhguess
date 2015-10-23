<?php
namespace Home\Controller;
use Think\Controller;
class MyController extends Controller {
	public function _before_index(){
		var_dump(session('uid'));
		if(session('uid')<=0){
			$this->redirect(C('app_path').'/');
		}
	}
	
    public function index(){
		echo 'my';
    }
	
	public function invite(){
		$invites = M('invite')->where(array('sender_id' => session('uid') ))->select();
		foreach($invites as $index => $inv){
			$invites[$index]['time_str'] = date('Y-m-d', strtotime($inv['ctime']));
		}
		$this->invites = $invites;
		var_dump($invites);
		$this->invite_count = count($invites);
		$this->display();
	}
	
	public function coupon(){
		$this->display();
	}
	
	public function prize(){
		$this->display();
	}
}