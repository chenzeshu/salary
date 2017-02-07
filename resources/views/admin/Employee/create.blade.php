@extends('layouts/admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="{{url('admin/employee')}}">首页</a> &raquo; <a href="#">员工信息管理</a>
    </div>
    <!--面包屑导航 结束-->
    <div class="result_wrap">
        <div class="result_title">
            <div class="mark">
                @if(is_object($errors))
                    @if(count($errors)>0)
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    @endif
                @else
                    <p>{{$errors}}</p>
                @endif
            </div>
        </div>
    </div>
	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>添加员工信息</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/employee/create')}}"><i class="fa fa-plus"></i>添加员工信息</a>
                <a href="{{url('admin/employee')}}"><i class="fa fa-recycle"></i>全部员工信息</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/employee/')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th>姓名：</th>
                    <td>
                        <input type="text" class="xs" name="e_name" value="">
                    </td>
                </tr>
                <tr>
                    <th>身份证号</th>
                    <td>
                        <input type="text" class="md" name="e_credit" value="">
                    </td>
                </tr>
                <tr>
                    <th>招行卡号</th>
                    <td>
                        <input type="text" class="md" name="e_zhao" value="">
                    </td>
                </tr>
                <tr>
                    <th>中行卡号</th>
                    <td>
                        <input type="text" class="md" name="e_zhong" value="">
                    </td>
                </tr>
                <tr>
                    <th>合同类型</th>
                    <td>
                        <input type="radio"  name="e_type" value="1">固定期合同　
                        <input type="radio"  name="e_type" value="2">非固定期合同　
                        <input type="radio"  name="e_type" value="3">试用期
                        <input type="radio"  name="e_type" value="4">集中返聘
                    </td>
                </tr>
                <tr>
                    <th>是/否宿舍</th>
                    <td>
                        <input type="radio"  name="e_dorm" value="1">是　
                        <input type="radio"  name="e_dorm" value="2">否　
                    </td>
                </tr>
                <tr>
                    <th>邮箱</th>
                    <td>
                        <input type="text"  name="e_mail" placeholder="填写邮箱">　
                    </td>
                </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

@endsection