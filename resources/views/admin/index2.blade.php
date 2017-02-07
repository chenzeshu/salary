@extends('layouts.admin')
@section('content')
	<!--头部 开始-->
	<div class="top_box">
		<div class="top_left">
			<div class="logo">工资管理页面</div>
			<ul>
				<li><a href="{{url('admin/index')}}">首页--数据表</a></li>
				<li><a href="#" class="active">二页--输出表</a></li>
			</ul>
		</div>
		<div class="top_right">
			<ul>
				<li>你好：{{\Illuminate\Support\Facades\Session::get('username')}}</li>
				<li><a href="{{url('admin/pass')}}" target="main">修改密码</a></li>
				<li><a href="{{url('admin/logout')}}">退出</a></li>
			</ul>
		</div>
	</div>
	<!--头部 结束-->

	<!--左侧导航 开始-->
	<div class="menu_box">
		<ul>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>工资</h3>
				<ul class="sub_menu">
					<li><a href="{{url('gongzi/mingxi')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>工资明细表</a></li>
					<li><a href="{{url('gongzi/huizong')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>工资汇总表一</a></li>
					<li><a href="{{url('gongzi/huizong2')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>工资汇总表二</a></li>
					<li><a href="{{url('gongzi/shui')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>个税表</a></li>
					<li><a href="{{url('gongzi/gongzi_zhaohang')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>工资-招商银行</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>绩效</h3>
				<ul class="sub_menu">
					<li><a href="{{url('gongzi/jixiao')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>绩效明细表</a></li>
                    <li><a href="{{url('gongzi/jiangjin/')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>月绩效奖金</a></li>
                    <li><a href="{{url('gongzi/huizong_jx1/')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>绩效汇总表一</a></li>
                    <li><a href="{{url('gongzi/huizong_jx2/')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>绩效汇总表二</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>三项补贴</h3>
				<ul class="sub_menu">
					<li><a href="{{url('gongzi/sanbu')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>三项补贴表</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>邮箱</h3>
				<ul class="sub_menu">
					<li><a href="{{url('mail')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>邮箱</a></li>
				</ul>
			</li>
        </ul>
	</div>
	<!--左侧导航 结束-->

	<!--主体部分 开始-->
	<div class="main_box">
		<iframe src="{{url('gongzi/mingxi')}}" frameborder="0" width="100%" height="100%" name="main"></iframe>
	</div>
	<!--主体部分 结束-->

	<!--底部 开始-->
	<div class="bottom_box">
		CopyRight © 2015. Powered By <a href="http://www.houdunwang.com">http://www.houdunwang.com</a>.
	</div>
	<!--底部 结束-->
@endsection
