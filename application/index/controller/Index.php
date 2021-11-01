<?php
namespace app\index\controller;
use think\Controller;

class Index extends Controller
{
    public function index()
    {	
        //商品分类
    	header("Content-Type:text/html;charset=utf-8");//解决乱码
    	$data = db('category')->select();
    	$catname = $this->getChildren($data);

        //首页导航条
    	$nav = db('nav')->where('type','top')->order('sort')->select();

        //楼层显示
        //$floor = db('floor')->select();
        $floors = $this->getFloorData();
        $this->assign('floors',$floors);
        //dump($floors);die;
        $this->assign('nav',$nav);
    	//dump($catname);die;
    	$this->assign('catname',$catname);
        return view();
    }


     //得到全部子级，多维数组
    public function getChildren($cate_list,$pid=0){
        
        $arr = array();

        foreach ($cate_list as $key => $value) {

            if ($value['cat_pid']==$pid) {

                $value['children'] = $this->getChildren($cate_list,$value['id']);

                $arr[] = $value;

            }

        }

        return $arr;

    }

    public function getFloorData(){
        $data=array();
        $allcate=db('floor')->order('sort')->select();
        foreach ($allcate as $k => $v) {
            if($v['pid']==0){
                
                foreach ($allcate as $k1 => $v1) {
                    if($v1['pid']==$v['id']){

                        foreach ($allcate as $k2 => $v2) {
                            if($v2['pid']==$v1['id']){
                                $v1['children'][]=$v2;
                            }
                        }

                        $v['children'][]=$v1;
                    }
                }

                $data[]=$v;
            }
        }
        return $data;
    }

    //测试页面
    public function test(){
    	return view();
    }

}
