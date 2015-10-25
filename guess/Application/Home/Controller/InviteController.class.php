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
		
		if( $invite['newer_id'] <= 0){
			$invite['newer_id'] = session('uid');
			M('invite')->save($invite);
			M('users')->where(array('id'=>$invite['sender_id']))->setInc('guess_count');
		}
		
		$invite['help_info'] = @unserialize($invite['help_info']);
		$this->invite = $invite;
		if(is_array($invite['help_info'])){
			session('product', $invite['help_info']['product']);
			session('guess_type', $invite['help_info']['guess_type']);
			session('qid', $invite['help_info']['question_id']);
			$inviter = M('users')->where(array('id'=>$invite['sender_id']))->find();
			$this->inviter = $inviter;
			$this->display('index');
			return;
		}
		$this->display('index2');
	}
}