<?php
namespace Home\Controller;
use Think\Controller;
class GameController extends Controller {
	public function _before_index(){
		if(session('uid')<=0){
			$this->redirect(C('app_path').'/');
		}
	}
	
    public function index(){
		$user = M('users')->where(array('id'=>session('uid')))->find();
		if($user['guess_count']<=0){
			$this->redirect(C('app_path').'/');
		}
		
		$products = C('products');
		$pid = rand(1,count($products));
		$product = $products[$pid];
		session('product', $product);
		$this->product = $product;
		
		if( rand(1,2) == 1){
			//猜价格
			session('guess_type', 1);
			$this->display('guess_price');
		}else{
			//猜名字
			session('guess_type', 2);
			$this->display('guess_name');
		}
		M('users')->where(array('id'=>session('uid')))->setDec('guess_count');
    }
	
	public function result(){
		$product = session('product');
		
		if(session('guess_type') == 1){
			$sel = I('post.select');
			if( $product['right_price'] == $sel ){
				//right
				$this->lucky_draw($product);
				$this->display('result_ok');
			}else{
				$this->display('result_err');
			}
		}else{
			$name = I('post.name');
			if( strtolower($product['name']) == strtolower($name) ){
				//right
				$this->lucky_draw($product);
				$this->display('result_ok');
			}else{
				$this->display('result_err');
			}
		}
	}
	
	private function lucky_draw($product){
		if( rand(1,100) > $product['chance'] ){
			//没中
			session('hit', 0);
		}else{
			//中了
			session('hit', 1);
		}
	}
	
	public function draw(){
		if(I('server.REQUEST_METHOD')=="POST"){
			$username = I('post.username');
			$email = I('post.email');
			$pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
			if( $username && $email && preg_match( $pattern, $email ) ){
				$this->username = $username;
				$this->email = $email;
				$this->display('draw_complete');
				exit;
			}
		}
		
		
		if( session('hit') == 1 ){
			$this->product = session('product');
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
			$this->display('draw_none');
		}
	}
	
	public function share(){
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
		$invites = M('invite')->where(array('sender_id' => session('uid') ))->select();
		$this->invite_count = count($invites);
		$this->display();
	}
	
	public function help(){
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
			)),
		);
		M('invite')->add($invite);
		$this->code = $invite['code'];
		
		$invites = M('invite')->where(array('sender_id' => session('uid') ))->select();
		$this->invite_count = count($invites);
		$this->display();
	}
}