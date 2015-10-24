<?php
namespace Home\Controller;
use Think\Controller;
class InviteController extends Controller {
    public function index(){
		if(session('uid')<=0){
			$this->redirect(C('app_path').'/');
		}
		
		$this->display();
    }
}