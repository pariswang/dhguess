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
			$this->logined = false;
		}
		
        $list = M('users')->select();
		$this->display();
    }
	
	public function fb(){
		if(IS_POST){
			$name = I('post.name');
			$id = I('post.id');
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
			$this->ajaxReturn(array('ok'=>1));
		}
		$this->ajaxReturn(array('ok'=>0));
	}
}