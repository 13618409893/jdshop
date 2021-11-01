<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use util\Tree;
class Category extends Controller
{
	public function index($id = 0, $tab = 1){
        if(request()->isPost()){
            // 获取数组需加/a
            foreach (input('post.cat_sort/a') as $key => $value) {
                Db::name('category')->where('id',$key)->update(['cat_sort'=>$value]);
            }
            return $this->success('排序更新成功',url('index'));
        }else{
            $category =  Db::name('category')->order('cat_sort')->select();
            $tree = new Tree();
            $tree->tree($category, 'id', 'cat_pid', 'cat_name');
            $lists = $tree->getArray();
            //dump($tab);die;
            $this->assign('lists', $lists);


            $info = db('category')->where('id', $id)->find();
            $this->assign('info', $info);
            //编辑广告
            // if(3 == $tab){
            //     $info = db('category')->where('id', $id)->find();
            //     dump($tab);die;
            //     if($info){
            //         $this->assign('info', $info);
            //     }
            // }
        }
        return view();
    }

    public function add(){
        if(request()->isPost()){
            $count = Db::name('category')->where('cat_name',input('post.cat_name'))->count();
            //dump($count);die;
            if($count){
                return $this->error('分类名称重名');
            }else{
                $result = Db::name('category')->strict(false)->insert(input('post.'));
                if($result){
                    return $this->success('分类添加成功',url('index'));
                }else{
                    return $this->error('分类添加失败');
                }
            }
        }
    }

    public function edit($id = 0){
        if(request()->isPost()){
            $count = Db::name('category')->where('id','<>',$id)->where('cat_name',input('post.cat_name'))->count();
            if($count){
                return $this->error('分类名称重名');
            }else{
                $result = Db::name('category')->strict(false)->update(input('post.'));
                if($result !== false){
                    return $this->success('分类编辑成功',url('index'));
                }else{
                    return $this->error('分类编辑失败');
                }
            }
        }
    }

    //删除功能
    public function delete($id=0){
    	$result = db('category')->where('id', $id)->delete();

        if($result==true){
            return $this->success('删除成功',url('index'));
        }else{
            return $this->error('删除失败');
        }
    }

}