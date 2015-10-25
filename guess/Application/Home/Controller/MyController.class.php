<?php
namespace Home\Controller;
use Think\Controller;
class MyController extends Controller {
    public function index(){
		header('Location: '.C('app_path'));exit;
    }
	
	public function invite(){
		if(session('uid')<=0){
			header('Location: '.C('app_path'));exit;
		}
		
		$invites = M('invite')->field('invite.*, users.name')
					->join('LEFT JOIN users on users.id=invite.newer_id')
					->where(array(
						'invite.sender_id' => session('uid'),
						'invite.newer_id' => array('GT', 0),
						))
					->select();
		foreach($invites as $index => $inv){
			$invites[$index]['time_str'] = date('m/d/Y', strtotime($inv['ctime']));
		}
		$this->user = M('users')->where(array('id'=>session('uid')))->find();
		$questions = M('question')->where(array('user_id'=>session('uid')))->select();
		$this->question_count = count($questions);
		$this->invites = $invites;
		$this->invite_count = count($invites);
		$this->share_code();
		$this->display();
	}
	
	private function share_code(){
		do{
			$code = rand(111111, 999999);
			$exist = M('invite')->where(array('code'=>$code))->count();
		}while($exist>0);
		$invite = array(
			'sender_id' => session('uid'),
			'ctime' => date('Y-m-d H:i:s'),
			'code' => $code,
			'state' => 1
		);
		M('invite')->add($invite);
		$this->code = $invite['code'];
	}
	
	public function coupon(){
		if(session('uid')<=0){
			header('Location: '.C('app_path'));exit;
		}
		$coupons = M('coupon')->where(array('user_id'=>session('uid')))->select();
		$this->coupons = count($coupons);
		$this->empty = '<div class="ept">You have no coupons.</div>';
		$this->display();
	}
	
	public function prize(){
		if(session('uid')<=0){
			header('Location: '.C('app_path'));exit;
		}
		
		$user = M('users')->where(array('id'=>session('uid')))->find();
		if($user['hit'] != 1){
			
		}
		
		$products = C('products');
		$this->product = $products[ $user['product_id'] ];
		$this->user = $user;
		$this->display();
	}
}