<?php

$config = require(ROOT_PATH . "/include/config.php");
$params = array_merge($config['params'], array('administrator' => array('admin'),));
$st="";

    $params['roleItem'] = array(
    array(
     '人员信息管理',
        array(
            'award_index315' => array('用户信息', 'Admin/index'),
            'award_index316' => array('学生信息', 'Userinfo/index'),

            
         ),
    ),
    array(
        '合作单位管理',
        array(
               'award_index329' => array('教育主管部门', 'ClubList/index&list_type=3'),
               'award_index317' => array('学校', 'ClubList/index&list_type=0'),
               'award_index318' => array('研学基地', 'ClubList/index&list_type=1'),
               'award_index319' => array('合作伙伴', 'ClubList/index&list_type=2'),
             ),
    ),
    array(
        '研学管理',
        array(
               'award_index320' => array('课程登记', 'ClubNews/index&news_type=0'),
               'award_index321' => array('课程审核', 'ClubNews/index&news_type=1'),
             ),
    ),
    array(
        '研学列表',
        array(
               'award_index323' => array('全部课程', 'ClubNews/index&news_type=2'),
               'award_index324' => array('报名结束课程', 'ClubNews/index&news_type=3'),
               'award_index325' => array('正在进行课程', 'ClubNews/index&news_type=4'),
               'award_index326' => array('已经结束的课程', 'ClubNews/index&news_type=5'),
             ),
    ),
    array(
        '报名管理',
        array(
                'award_index326' => array('报名失败名单', 'SignList/index&id=0'),
                'award_index327' => array('正在报名名单', 'SignList/index&id=1'),
                'award_index328' => array('报名完成名单', 'SignList/index&id=2'),
             ),
    ),

  );




$main = array(
    'basePath' => ROOT_PATH . '/admin',
    'runtimePath' => ROOT_PATH . '/runtime/admin',
    'name' => '',
    'defaultController' => 'index',
    'components' => array(
        'db' => $config['components']['db'],
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'info,error, warning'
                ),
                array(
                    'class' => 'CWebLogRoute',
                    'levels' => 'trace'
                ),
            ),
        ),
    ),
    'params' => $params,
);

return array_merge($config, $main);
?>

<ul class="sidebar-menu">            
<li class="treeview">               
    <a href="#">                    
        <i class="fa fa-gears"></i> <span>权限控制</span>                    
        <i class="fa fa-angle-left pull-right"></i>               
    </a>               
    <ul class="treeview-menu">                   
        <li class="treeview">                        
            <a href="/admin">管理员</a>                        
            <ul class="treeview-menu">                            
                <li><a href="/user"><i class="fa fa-circle-o"></i> 后台用户</a></li>                            
                <li class="treeview">                                
                    <a href="/admin/role"> <i class="fa fa-circle-o"></i> 权限 <i class="fa fa-angle-left pull-right"></i>
                    </a>                                
                    <ul class="treeview-menu">                                    
                        <li><a href="/admin/route"><i class="fa fa-circle-o"></i> 路由</a></li>
                        <li><a href="/admin/permission"><i class="fa fa-circle-o"></i> 权限</a></li>
                        <li><a href="/admin/role"><i class="fa fa-circle-o"></i> 角色</a></li>
                        <li><a href="/admin/assignment"><i class="fa fa-circle-o"></i> 分配</a></li>
                        <li><a href="/admin/menu"><i class="fa fa-circle-o"></i> 菜单</a></li>
                    </ul>                           
                </li>                        
            </ul>                    
        </li>                
    </ul>            
    </li>        
</ul>
