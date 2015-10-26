<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
		if(session('uid')>0){
			$this->logined = true;
			$this->uid = session('uid');
			$this->user = M('users')->where(array('id'=>$this->uid))->find();
			$this->user['guess_count'] = strval($this->user['guess_count']);
		}else{
			$this->logined = false;
		}
		
        $list = M('users')->select();
		$this->display();
    }
	
	public function logout(){
		session('[destroy]');
		header('Location: /guess');
		exit;
	}
	
	public function fb(){
		if(IS_POST){
			$name = I('post.name');
			$id = I('post.id');
			if(empty($name) || empty($id)){
				$this->ajaxReturn(array('ok'=>0));
			}
			$user = M('users')->where(array('fb_id'=>$id))->find();
			if($user){
				session('uid', $user['id']);
			}else{
				$nid = M('users')->add(array(
					'name' => $name,
					'fb_id' => $id,
					'guess_count' => C('default_chance'),
					'ctime' => date('Y-m-d H:i:s'),
				));
				session('uid', $nid);
			}
			
			//code
			$this->done();
			$this->ajaxReturn(array('ok'=>1));
		}
		$this->ajaxReturn(array('ok'=>0));
	}
	
	private function done(){
		$code = I('post.code');
		$invite = M('invite')->where(array('code'=>$code))->find();
		if(empty($invite)){
			return;
		}
		if( $invite['newer_id'] <= 0){
			$exists = M('invite')->where(array('newer_id'=>session('uid'),'sender_id'=>$invite['sender_id']))->find();
			if(!$exists){
				M('users')->where(array('id'=>$invite['sender_id']))->setInc('guess_count');
			}
			$invite['newer_id'] = session('uid');
			M('invite')->save($invite);
		}
	}
}