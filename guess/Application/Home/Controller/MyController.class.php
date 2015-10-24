<?php
namespace Home\Controller;
use Think\Controller;
class MyController extends Controller {
    public function index(){
		$this->redirect(C('app_path').'/');
    }
	
	public function invite(){
		if(session('uid')<=0){
			$this->redirect(C('app_path').'/');
		}
		
		$invites = M('invite')->field('invite.*, users.name')
					->join('LEFT JOIN users on users.id=invite.newer_id')
					->where(array('invite.sender_id' => session('uid') ))
					->select();
		foreach($invites as $index => $inv){
			$invites[$index]['time_str'] = date('m/d/Y', strtotime($inv['ctime']));
		}
		$this->user = M('users')->where(array('id'=>session('uid')))->find();
		$questions = M('question')->where(array('user_id'=>session('uid')))->select();
		$this->question_count = count($questions);
		$this->invites = $invites;
		$this->invite_count = count($invites);
		$this->display();
	}
	
	public function coupon(){
		if(session('uid')<=0){
			$this->redirect(C('app_path').'/');
		}
		$coupons = M('coupon')->where(array('user_id'=>session('uid')))->select();
		$this->coupons = $coupons;
		$this->empty = '<div class="ept">You have no coupons.</div>';
		$this->display();
	}
	
	public function prize(){
		if(session('uid')<=0){
			$this->redirect(C('app_path').'/');
		}
		
		$user = M('users')->where(array('id'=>session('uid')))->find();
		if($user['hit'] != 1){
			$this->error('你没有中奖！', C('app_path').'/', 3);
		}
		
		$products = C('products');
		$this->product = $products[ $user['product_id'] ];
		$this->user = $user;
		$this->display();
	}
}