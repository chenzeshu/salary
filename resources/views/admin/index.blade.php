@extends('layouts.admin')
@section('content')
	<!--头部 开始-->
	<div class="top_box">
		<div class="top_left">
			<div class="logo">工资管理页面</div>
			<ul>
				<li><a href="#" class="active">首页--数据表</a></li>
				<li><a href="{{url('admin/index2')}}">二页--输出表</a></li>
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
				<h3><i class="fa fa-fw fa-clipboard"></i>岗位信息</h3>
				<ul class="sub_menu">
					<li><a href="{{url('admin/job')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>岗位工资列表</a></li>
					<li><a href="{{url('admin/job/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加岗位工资</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>员工管理</h3>
				<ul class="sub_menu">
					<li><a href="{{url('admin/employee')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>员工信息列表</a></li>
					<li><a href="{{url('admin/employee/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加员工信息</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>基数列表</h3>
				<ul class="sub_menu">
					<li><a href="{{url('admin/base')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>基数列表</a></li>
					<li><a href="{{url('admin/base/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加基数信息</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>员工奖惩</h3>
				<ul class="sub_menu">
					<li><a href="{{url('admin/reward')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>奖惩列表</a></li>
					<li><a href="{{url('admin/reward/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加奖惩</a></li>
				</ul>
			</li>
            <li>
            	<h3><i class="fa fa-fw fa-clipboard"></i>加班管理</h3>
                <ul class="sub_menu">
                    <li><a href="{{url('admin/jia')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>加班信息列表</a></li>
					<li><a href="{{url('admin/jia/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加加班信息</a></li>
                </ul>
            </li>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>三补管理</h3>
				<ul class="sub_menu">
					<li><a href="{{url('admin/bu')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>本月三补列表</a></li>
					<li><a href="{{url('admin/shang')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>上月三补列表</a></li>
					<li><a href="{{url('admin/bu/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加三补</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>三补扣除管理</h3>
				<ul class="sub_menu">
					<li><a href="{{url('admin/koubu')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>当月扣补信息</a></li>
					<li><a href="{{url('admin/koubu/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加扣补信息</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>补扣工资管理</h3>
				<ul class="sub_menu">
					<li><a href="{{url('admin/bukou')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>补扣信息列表</a></li>
					<li><a href="{{url('admin/bukou/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加补扣信息</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>月表管理</h3>
				<ul class="sub_menu">
					<li><a href="{{url('admin/kao')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>月考核表列表</a></li>
					<li><a href="{{url('admin/kao/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加考核信息</a></li>
				</ul>
			</li>
			@role('owner')
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>上月绩效查看</h3>
				<ul class="sub_menu">
					<li><a href="{{url('admin/jx')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>上月绩效列表</a></li>
					<li><a href="{{url('admin/jx/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加上月绩效</a></li>
				</ul>
			</li>
			@endrole
        </ul>
	</div>
	<!--左侧导航 结束-->

	<!--主体部分 开始-->
	<div class="main_box">
		<iframe src="{{url('admin/job')}}" frameborder="0" width="100%" height="100%" name="main"></iframe>
	</div>
	<!--主体部分 结束-->

	<!--底部 开始-->
	<div class="bottom_box">
		CopyRight © 2016. Powered By <a href="http://www.jianshu.com/users/adc147f1ec89/latest_articles">http://www.chenzeshu.com</a>.
	</div>
	<!--底部 结束-->
@endsection
