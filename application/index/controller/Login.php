<?php
namespace app\index\controller;
use think\Controller;

//访问链接：http://www.jdshop.com/index.php/index/login/index
class Login extends Controller
{
	public function index()
	{
		if(request()->isPost()){
			$this->check(input('authcode'));
			$username = trim(input('post.username/s'));
			$password = md5(trim(input('post.password/s')));
			//dump($username);die;
			$user = db('user')->where('username',$username)->find();
			if(!$user){
				//dump($user);die;
				$this->error('用户不存在');
			}else{
				if($password !=$user['password']){
					$this.error('密码错误');
				}else{
					$userInfo['username'] = $username;
					session('user',$userInfo);
					$this->success('登陆成功',url('index/index'));
				}
			}
		}else{
			if(session('user.username')==null|| session('user.username')!='user'){
				session(null);
				return view();
			}else{
				$this->redirect('index/index');
			}
			
		}
		
	}

	public function check($authcode=''){
		if(!captcha_check($authcode)){
			$this->error('验证码错误');
		}else{
			return true;
		}
	}
}