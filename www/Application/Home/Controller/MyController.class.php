<?php
namespace Home\Controller;
use Think\Controller;
class MyController extends Controller {
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