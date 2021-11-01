<?php 

namespace app\admin\model;
use think\Model;
 
/**

 * 分类模型

 * 无限级分类

 */

 class Category extends Model

 {


    protected $name = 'category';//数据表


    /*无限极分类列表 by qing*/
    public function getTree($data='',$cate_id='')

    {
        if(empty($data)){
            $data = $this->order('cat_sort')->field('id,cat_pid,cat_name,cat_sort')->select()->toArray();
        }
        return $this->_reSort($data,$cate_id);
    }


    // 无限级分类
    public static function tree($data){
        $tree = [];

        foreach ($data as $value) {
            $tree[$value['id']] = $value;
        }

        foreach ($tree as $key => $value)
            $tree[$value['cat_pid']]['son'][] = &$tree[$key]; //引用
        $tree = isset($tree[0]['son']) ? $tree[0]['son'] : array();

        return $tree;
    }


    //无限极分类树状结构，修改level值

    private function _reSort($data, $cat_pid=0, $cat_level=0, $isClear=TRUE)

    {

        static $ret = array();

        if($isClear)

            $ret = array();

        foreach ($data as $k => $v)

        {

            if($v['cat_pid'] == $cat_pid)

            {

                $v['cat_level'] = $cat_level;

                $ret[] = $v;
                unset($data[$k]);

                $this->_reSort($data, $v['id'], $cat_level+1, FALSE);

            }

        }

        return $ret;

    }



    /*批量添加分类*/

    public function add($data) {

        $cat_name=explode(",",$data['cat_name']);

        foreach ($cat_name as $k => $v) {

            $data['cat_name']=$v;

            $this->insert($data);

        }

       return 1;

    }



    /*获取某栏目的所有子分类ID，返回多维数组*/

    public function getChildrenId($cate_list,$cat_pid=0){

        //由父类id得到全部子类
        $arr = array();

        foreach ($cate_list as $k => $v) {

            if ($v['cat_pid']==$cat_pid) {

                 $arr[] = $v;
                 unset($cate_list[$k]);

                $this->getChildrenId($cate_list,$v['id']);

            }

        }

        return $arr;

    }


    /*获取某栏目的顶级父类，返回顶级栏目id*/
    public function getTopCategory($id){

        $data = db('category')->field('id,cat_pid')->find($id);
        if($data['cat_pid'] != '0'){
            $this->getTopCategory($data['cat_pid']);
        }
        return $data['cat_pid'];

    }

    //由父类id得到全部子类，返回字符串
    public function getChildrenIdStr($cate_list,$cat_pid=0){

        static $str='';
        foreach ($cate_list as $k => $v) {

            if ($v['cat_pid']==$cat_pid) {

                $str =$str.','.$v['id'];

                $this->getChildrenIdStr($cate_list,$v['id']);

            }

        }
        
        $str=ltrim($str,',');
        $str=rtrim($str,',');
        //print_r($str);
        return $str;

    }


    //得到全部子级，多维数组

    public function getChildren($cate_list,$cat_pid=0){
        
        $arr = array();

        foreach ($cate_list as $key => $value) {

            if ($value['cat_pid']==$cat_pid) {

                $value['children'] = $this->getChildren($cate_list,$value['id']);

                $arr[] = $value;

            }

        }

        return $arr;

    }


    //获取多级分类数据
    public function getNavCateData(){
        $data=array();
        $allcate=db('category')->order('cat_sort asc')->select();
        foreach ($allcate as $k => $v) {
            if($v['cat_pid']==0){
                
                foreach ($allcate as $k1 => $v1) {
                    if($v1['cat_pid']==$v['id']){

                        foreach ($allcate as $k2 => $v2) {
                            if($v2['cat_pid']==$v1['id']){
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



}

?>