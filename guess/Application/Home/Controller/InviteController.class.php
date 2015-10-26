<?php
namespace Home\Controller;
use Think\Controller;
class InviteController extends Controller {
    public function index($id){
		if(session('uid')<=0){
			header('Location: '.C('app_path'));exit;
		}
		
		$this->display();
    }
	
	public function _empty($code){
		$invite = M('invite')->where(array('code'=>$code))->find();
		if(empty($invite)){
			header('Location: '.C('app_path'));
			exit;
		}
		$this->code = $code;
		
		if(session('uid')>0){
			$this->logined = true;
			$this->user = M('users')->where(array('id'=>session('uid')))->find();
		}else{
			$this->logined = false;
		}
		
		$invite['help_info'] = @unserialize($invite['help_info']);
		$this->invite = $invite;
		if(!empty($invite['help_info'])){
			session('product', $invite['help_info']['product']);
			session('guess_type', $invite['help_info']['guess_type']);
			session('qid', $invite['help_info']['question_id']);
			echo 1;
		}
		$inviter = M('users')->where(array('id'=>$invite['sender_id']))->find();
		$this->inviter = $inviter;
		$this->display('index');
	}
}