<?php
namespace Home\Controller;
use Think\Controller;
class StatsController extends Controller {
    public function index(){
		if( session('is_admin') ){
			header('Location: /guess/stats/alllist');
			exit;
		}
		if(IS_POST){
			if(I('post.pwd')=='dhgate_guess'){
				session('is_admin', 1);
				header('Location: /guess/stats/alllist');
				exit;
			}
			$this->error = '密码错误！';
		}
		$this->display();
	}
	
	public function alllist(){
		if( session('is_admin') != 1 ){
			header('Location: /guess/stats');
			exit;
		}
		
		$products = C('products');
		$invites = M('invite')->select();
		$users = M('users')->select();
		$user_hit_count = 0;
		foreach($users as $index => $u){
			if($u['product_id']>0){
				$users[$index]['product'] = $products[$u['product_id']];
			}
			$users[$index]['invite_accept_count'] = array();
			$users[$index]['invite_count'] = 0;
			foreach($invites as $i){
				if($i['sender_id'] == $u['id']){
					$users[$index]['invite_count']++;
					if($i['newer_id']>0){
						$users[$index]['invite_accept_count'][ $i['newer_id'] ] = $i['newer_id'];
					}
				}
			}
			$users[$index]['invite_accept_count'] = count($users[$index]['invite_accept_count']);
			if($u['hit']==1){
				$user_hit_count++;
			}
		}
		$this->users = $users;
		$this->user_count = count($users);
		$this->user_hit_count = $user_hit_count;
		$this->display();
	}
	
	public function updateuser(){
		if(IS_POST){
			$uid = I('post.uid');
			$c = I('post.guess_count');
			$r = M('users')->where(array('id'=>$uid))->save(array('guess_count'=>$c));
			if($r)
				$this->ajaxReturn(array('ok'=>1));
			else
				$this->ajaxReturn(array('ok'=>0,'msg'=>'系统错误，请稍后再试！'));
		}
	}
	
	public function hitlist(){
		if( session('is_admin') != 1 ){
			header('Location: /guess/stats');
			exit;
		}
		
		$products = C('products');
		$invites = M('invite')->select();
		$users = M('users')->where(array('hit'=>1))->select();
		$user_hit_count = 0;
		foreach($users as $index => $u){
			if($u['product_id']>0){
				$users[$index]['product'] = $products[$u['product_id']];
			}
			$users[$index]['invite_accept_count'] = array();
			$users[$index]['invite_count'] = 0;
			foreach($invites as $i){
				if($i['sender_id'] == $u['id']){
					$users[$index]['invite_count']++;
					if($i['newer_id']>0){
						$users[$index]['invite_accept_count'][ $i['newer_id'] ] = $i['newer_id'];
					}
				}
			}
			$users[$index]['invite_accept_count'] = count($users[$index]['invite_accept_count']);
			if($u['hit']==1){
				$user_hit_count++;
			}
		}
		$this->users = $users;
		$this->user_count = count($users);
		$this->user_hit_count = $user_hit_count;
		$this->display();
	}
}