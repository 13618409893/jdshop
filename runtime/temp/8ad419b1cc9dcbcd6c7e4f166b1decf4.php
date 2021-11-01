<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"D:\phpStudy\PHPTutorial\WWW\jdshop\public/../application/admin\view\category\index.html";i:1635579030;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>分类管理</title>
    <meta name="keywords" content="分类管理">
    <meta name="description" content="分类管理">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/static/admin/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/admin/css/animate.min.css" rel="stylesheet">
    <link href="/static/admin/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <script src="/static/admin/js/jquery.min.js?v=2.1.4"></script>
    <link href="/static/admin/css/admin.css" rel="stylesheet">
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="<?php if(input('tab',1) == 1): ?>active<?php endif; ?>"><a data-toggle="tab" href="#tab-1" aria-expanded="true">分类列表</a></li>
                        <li class="<?php if(input('tab',1) == 2): ?>active<?php endif; ?>"><a data-toggle="tab" href="#tab-2" aria-expanded="false">添加新分类</a></li>
                        <li id="showtab" class="<?php if(input('tab',1) == 3): ?>active<?php endif; ?>"><a data-toggle="tab" href="#tab-3" style="<?php if(input('tab',1) != 3): ?>display:none<?php endif; ?>" aria-expanded="false">编辑分类</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane <?php if(input('tab',1) == 1): ?>active<?php endif; ?>">
                            <div class="panel-body">
                                <form method="post" class="form-horizontal" action="<?php echo url('index'); ?>">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="10%">排序</th>
                                                    <th width="15%">分类ID</th>
                                                    <th width="25%">分类名称</th>
                                                    <th width="10%">首页显示</th>
                                                    <th width="25%">操作</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="cat_sort[<?php echo $vo['id']; ?>]" class="form-control" value="<?php echo $vo['cat_sort']; ?>">
                                                        </td>
                                                        <td><?php echo $vo['id']; ?></td>
                                                        <td style="text-align:left"><?php echo $vo['cat_name']; ?></td>
                                                        <td><?php echo $vo['cat_pid']==0?($vo['is_show'] ? '是' : '否') : ''; ?></td>
                                                        <td>
                                                            <?php if($vo['cat_pid'] == '0'): ?>
                                                                <a href="<?php echo url('index',['cat_pid'=>$vo['id'], 'tab'=>2]); ?>" title="添加子分类"><i class="fa fa-plus text-navy"></i></a>&nbsp;&nbsp;
                                                            <?php endif; if($vo['cat_pid'] != '0'): ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php endif; ?>
                                                            <a href="<?php echo url('index',['id'=>$vo['id'], 'tab'=>3]); ?>" title="编辑"><i class="fa fa-edit text-navy"></i></a>&nbsp;&nbsp;
                                                            <a name="delete" href="<?php echo url('delete',['id'=>$vo['id']]); ?>" title="删除"><i class="fa fa-trash-o text-navy"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <button class="btn btn-primary" type="submit">提交</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div id="tab-2" class="tab-pane <?php if(input('tab',1) == 2): ?>active<?php endif; ?>">
                            <div class="panel-body">
                                <form method="post" class="form-horizontal" action="<?php echo url('add'); ?>">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">分类名称</label>
                                        <div class="col-sm-10">
                                            <input type="text" name='cat_name' class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">上级分类</label>
                                        <div class="col-sm-10">
                                            <select class="form-control m-b" name="cat_pid">
                                                <option value="0" selected>≡ 作为顶级分类 ≡</option>
                                                <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                    <option value="<?php echo $vo['id']; ?>" <?php echo !empty($vo['cat_pid'])?'disabled' : ''; if(input('cat_pid',0) == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['cat_name']; ?></option>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">首页显示</label>
                                        <div class="col-sm-10">
                                            <div class="radio i-checks">
                                                <label><input type="radio" value="1" name="is_show" checked><i></i> 是</label>
                                                <label><input type="radio" value="0" name="is_show"><i></i> 否</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">排序</label>
                                        <div class="col-sm-10">
                                            <input type="text" name='cat_sort' class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>


                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <button class="btn btn-primary" type="submit">提交</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                      	
						<div id="tab-3" class="tab-pane <?php if(input('tab',1) == 3): ?>active<?php endif; ?>">
                            <div class="panel-body">
                                <form method="post" class="form-horizontal" action="<?php echo url('edit'); ?>">
                                    <input type="hidden" name="tab" value="3">
                                    <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">分类名称</label>
                                        <div class="col-sm-10">
                                            <input type="text" name='cat_name' class="form-control" value="<?php echo $info['cat_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">上级分类</label>
                                        <div class="col-sm-10">
                                            <select class="form-control m-b" name="cat_pid">
                                                <option value="0" selected>≡ 作为顶级分类 ≡</option>
                                                <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                    <option value="<?php echo $vo['id']; ?>" <?php echo !empty($vo['cat_pid'])?'disabled' : ''; ?> <?php echo $info['cat_pid']==$vo['id']?'selected' : ''; ?>><?php echo $vo['cat_name']; ?></option>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">首页显示</label>
                                        <div class="col-sm-10">
                                            <div class="radio i-checks">
                                                <label><input type="radio" value="1" name="is_show" <?php echo !empty($info['is_show'])?'checked' : ''; ?>><i></i> 是</label>
                                                <label><input type="radio" value="0" name="is_show" <?php echo !empty($info['is_show'])?'' : 'checked'; ?>><i></i> 否</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">排序</label>
                                        <div class="col-sm-10">
                                            <input type="text" name='cat_sort' class="form-control" value="<?php echo $info['cat_sort']; ?>">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <button class="btn btn-primary" type="submit">提交</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/static/admin/js/content.min.js?v=1.0.0"></script>
    <script src="/static/admin/js/plugins/iCheck/icheck.min.js"></script>
    <script src="/static/admin/js/plugins/layer/layer.min.js"></script>
    <script src="/static/admin/js/layer_hplus.js"></script>
    <script src="/static/admin/js/plugins/prettyfile/bootstrap-prettyfile.js"></script>
    <script src="/static/admin/js/plugins/cropper/cropper.min.js"></script>

    <script src="/static/admin/js/plugins/layer/laydate/laydate.js"></script>
        <script src="/static/admin/js/demo/form-advanced-demo.min.js"></script>
</body>

</html>
