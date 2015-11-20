<?php
namespace Home\Controller;
use Think\Controller;
class GameController extends Controller {
    public function index(){
		if(session('uid')<=0){
			header('Location: '.C('app_path'));exit;
		}
		
		$user = M('users')->where(array('id'=>session('uid')))->find();
		if($user['guess_count']<=0){
			header('Location: '.C('app_path'));exit;
		}
		
		$products = C('products');
		$pid = rand(1,count($products));
		$product = $products[$pid];
		session('product', $product);
		$this->product = $product;
		
		if( $product['name'] != '' ){
			if( rand(1,2) == 1){
				//猜价格
				session('guess_type', 1);
				$this->display('guess_price');
			}else{
				//猜名字
				session('guess_type', 2);
				$this->display('guess_name');
			}
		}else{
			//猜价格
			session('guess_type', 1);
			$this->display('guess_price');
		}
		$qid = M('question')->add(array(
			'product_id' => $product['id'],
			'type' => session('guess_type'),
			'user_id' => session('uid'),
			'ctime' => date('Y-m-d H:i:s'),
			'answer' => 0,
		));
		session('qid', $qid);
		M('users')->where(array('id'=>session('uid')))->setDec('guess_count');
    }
	
	public function helpguess(){
		$user = M('users')->where(array('id'=>session('uid')))->find();
		$product = session('product');
		$this->product = $product;
		if(session('guess_type')==1){
			$this->display('guess_price');
		}else{
			$this->display('guess_name');
		}
	}
	
	public function result(){
		if(session('uid')<=0){
			header('Location: '.C('app_path'));exit;
		}
		
		$product = session('product');
		$this->product = $product;
		$question = M('question')->where(array('id'=>session('qid')))->find();
		
		if(session('guess_type') == 1){
			$sel = I('post.select');
			if( $product['right_price'] == $sel ){
				//right
				$question['answer'] = 1;
				$this->lucky_draw($product);
				$this->display('result_ok');
			}else{
				$question['answer'] = 2;
				$this->help_code();
				$this->display('result_err');
			}
		}else{
			$name = I('post.name');
			if( strtolower($product['name']) == strtolower($name) ){
				//right
				$question['answer'] = 1;
				$this->lucky_draw($product);
				$this->display('result_ok');
			}else{
				$question['answer'] = 2;
				$this->help_code();
				$this->display('result_err');
			}
		}
		M('question')->save($question);
	}
	
	private function lucky_draw($product){
		if(session('uid')<=0){
			header('Location: '.C('app_path'));exit;
		}
		
		$user = M('users')->where(array('id'=>session('uid')))->find();
		if( $user['hit']==1 ){
			//曾经中过奖，就没中
			session('hit', 0);
			return;
		}
		$c = M('users')->where(array('product_id'=>$product['id']))->count();
		if( $product['count'] <= 0 || $product['count'] <= $c ){
			//没奖品了，就没中
			session('hit', 0);
			return;
		}
		if( rand(1,100) > $product['chance'] ){
			//没中
			session('hit', 0);
		}else{
			//中了
			session('hit', 1);
		}
	}
	
	private function help_code(){
		do{
			$code = rand(111111, 999999);
			$exist = M('invite')->where(array('code'=>$code))->count();
		}while($exist>0);
		$invite = array(
			'sender_id' => session('uid'),
			'ctime' => date('Y-m-d H:i:s'),
			'code' => $code,
			'state' => 1,
			'help_info' => serialize(array(
				'product' => session('product'),
				'guess_type' => session('guess_type'),
				'question_id' => session('qid'),
			)),
		);
		M('invite')->add($invite);
		$this->code = $invite['code'];
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
	
	public function draw(){
		if(session('uid')<=0){
			header('Location: '.C('app_path'));exit;
		}
		
		//先检查奖品数量
		$user = M('users')->where(array('id'=>session('uid')))->find();
		$this->product = session('product');
		if( session('hit') == 1 ){
			if( $user['hit']==1 ){
				//曾经中过奖，就没中
				session('hit', 0);
			}
			$c = M('users')->where(array('product_id'))->count();
			if( $this->product['count'] <= 0 || $this->product['count'] <= $c ){
				//没奖品了，就没中
				session('hit', 0);
			}
		}
		
		
		
		if(IS_POST){
			if( session('hit') == 0){
				$this->error('You missed!',C('app_path'));
				exit;
			}
			$username = I('post.username');
			$email = I('post.email');
			$pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
			if( $username && $email && preg_match( $pattern, $email ) ){
				$this->username = $username;
				$this->email = $email;
				$user['hit']=1;
				$user['username'] = $username;
				$user['email'] = $email;
				$user['product_id'] = $this->product['id'];
				M('users')->save($user);
				session('hit', 0);
				$this->display('draw_complete');
				exit;
			}
		}
		
		
		
		if( session('hit') == 1){
			$this->display('draw_hit');
		}else{
			$coupon = array(
				'user_id' => session('uid'),
				'coupon_id' => 1,
				'ctime' => date('Y-m-d H:i:s'),
				'code' => 'abc',
			);
			M('coupon')->add($coupon);
			$this->coupons = M('coupon')->where(array('user_id'=>session('uid')))->select();
			$this->coupons_count = count($this->coupons);
			$this->share_code();
			$this->display('draw_none');
		}
	}
	
	public function share(){
		if(session('uid')<=0){
			header('Location: '.C('app_path'));exit;
		}
		
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
		$invites = M('invite')->where(array(
			'sender_id' => session('uid'),
			'newer_id' => array('GT', 0),
		))->select();
		$this->invite_count = count($invites);
		$this->product = session('product');
		$this->display();
	}
	
	public function help(){
		if(session('uid')<=0){
			header('Location: '.C('app_path'));exit;
		}
		
		do{
			$code = rand(111111, 999999);
			$exist = M('invite')->where(array('code'=>$code))->count();
		}while($exist>0);
		$invite = array(
			'sender_id' => session('uid'),
			'ctime' => date('Y-m-d H:i:s'),
			'code' => $code,
			'state' => 1,
			'help_info' => serialize(array(
				'product' => session('product'),
				'guess_type' => session('guess_type'),
				'question_id' => session('qid'),
			)),
		);
		M('invite')->add($invite);
		$this->code = $invite['code'];
		
		$invites = M('invite')->where(array(
			'sender_id' => session('uid'),
			'newer_id' => array('GT', 0),
		))->select();
		$this->invite_count = count($invites);
		$this->product = session('product');
		$this->display();
	}
}