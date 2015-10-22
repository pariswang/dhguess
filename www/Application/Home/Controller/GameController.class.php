<?php
namespace Home\Controller;
use Think\Controller;
class GameController extends Controller {
    public function index(){
		$this->uid = session('uid');
		//$list = M('users')->select();
		
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
    }
	
	public function result(){
		$product = session('product');
		
		if(session('guess_type') == 1){
			session('guess_type', null);
			$sel = I('post.select');
			if( $product['right_price'] == $sel ){
				//right
				$this->lucky_draw($product);
				$this->display('result_ok');
			}else{
				$this->display('result_err');
			}
		}else{
			session('guess_type', null);
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
				$this->display('draw_complete');
				exit;
			}
		}
		
		if( session('hit') == 1 ){
			$this->product = session('product');
			$this->display('draw_hit');
		}else{
			$this->display('draw_none');
		}
	}
	
	public function share(){
		$this->display();
	}
	
	public function help(){
		$this->display();
	}
}