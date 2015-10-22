<?php
namespace Home\Controller;
use Think\Controller;
class InviteController extends Controller {
	public function _before_index(){
		if(session('uid')<=0){
			$this->redirect(C('app_path').'/');
		}
	}
	
    public function index(){
		$this->display();
    }
}