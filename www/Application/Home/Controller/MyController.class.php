<?php
namespace Home\Controller;
use Think\Controller;
class MyController extends Controller {
	public function _before_index(){
		if(session('uid')<=0){
			$this->redirect(C('app_path').'/');
		}
	}
	
    public function index(){
		echo 'my';
    }
	
	public function invite(){
		$this->display();
	}
	
	public function coupon(){
		$this->display();
	}
	
	public function prize(){
		$this->display();
	}
}