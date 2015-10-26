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
		}
		$this->users = $users;
		$this->display();
	}
}