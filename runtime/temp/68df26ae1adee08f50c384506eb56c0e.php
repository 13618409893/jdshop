<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\phpStudy\PHPTutorial\WWW\jdshop\public/../application/admin\view\ad\index.html";i:1627676042;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <!-- <link href="/static/admin/style.css" rel="stylesheet" type="text/css" /> -->
    <link href="/static/admin/css/core.css" rel="stylesheet" type="text/css" />
    <link href="/static/admin/css/extcore.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <!--查询条件-->
<div class="pageHeader">
    <form id="pagerForm" action="" method="post">
        <div class="searchBar">
            <ul class="searchContent">
                <li style="width:300px;">
                    <label>商品分类名称：</label>
                    <select name="cat_id">
                        <option value="0">selected无</option>
                        <volist name="categorylist" id="vocategory">
                            <option value="1">selected</option>
                        </volist>
                    </select>
                </li>
                <li style="width:300px;">
                    <label>楼层分类名称：</label>
                    <select name="floor_id" style="width:130px;">
                        <option value="0">selected>无</option>
                        <volist name="floorlist" id="vofloor">
                            <option value="1" >selected</option>
                        </volist>
                    </select>
                </li>
                <li>
                    <label>广告位置：</label>
                    <select name="ad_position">
                        <option value="1" >首页分类导航</option>
                        <option value="2" >首页幻灯片</option>
                        <option value="3" >滚动幻灯片</option>
                        <option value="4" >首页右侧随机广告</option>
                        <option value="5" >楼层左侧</option>
                        <option value="6" >楼层中上</option>
                        <option value="7" >楼层中下</option>
                        <option value="8" >楼层右侧</option>
                    </select>
                </li>
            </ul>
            <div class="subBar">
                <ul>
                    <li>
                        <div class="buttonActive">
                            <div class="buttonContent">
                                <button type="submit">查询</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </form>
</div>

<div class="pageContent">
    <!--操作按钮-->
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" href="" target="dialog" rel="ad_add" mask="true" maxable="false" width="580" height="450"><span>新增</span></a></li>
            <li><a class="delete" href="" posttype="string" rel="id" target="selectedTodo" title="确定要删除选中的记录吗？" warn="请至少选择一位用户"><span>删除</span></a></li>
            <li><a class="edit" href="" target="dialog" mask="true" warn="请选择一条记录" width="800" height="550" rel="goods_edit"><span>编辑</span></a></li>
        </ul>
    </div>
    <!--操作按钮结束-->

    <!--数据显示-->
    <table class="list" width="100%" layoutH="115">
        <thead>
            <tr>
                <th width="10%"><input type="checkbox" group="id" class="checkboxCtrl" /></th>
                <th width="10%">编号</th>
                <th width="25%">广告名称</th>
                <th width="20%">图片</th>
                <th width="20%">链接</th>
                <th width="15%">排序</th>
            </tr>
        </thead>
        <tbody>
            <volist id="vo" name="adlist">
                <tr target="sid_user" rel="">
                    <td><input type="checkbox" name="id" value="id" /></td>
                    <td>id</td>
                    <td style="text-align:left;">ad_name</td>
                    <td><img src="ad_img" width="50" height="50" /></td>
                    <td style="text-align:left;">ad_link</td>
                    <td>ad_sort</td>
                </tr>
            </volist>
        </tbody>
    </table>
    <!--数据显示结束-->
</div>
</body>
</html>
