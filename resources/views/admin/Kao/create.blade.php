@extends('layouts/admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="{{url('admin/kao')}}">首页</a> &raquo; <a href="#">月考核表信息管理</a>
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
            <h3>添加月考核信息</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/kao/create')}}"><i class="fa fa-plus"></i>添加月考核表信息</a>
                <a href="{{url('admin/kao')}}"><i class="fa fa-recycle"></i>全部月考核表信息</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/kao/')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th>姓名：</th>
                        <td>
                            <input type="text" class="xs" name="kao_name" value="">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require"></i>是否提交月考核表</th>
                        <td>
                            <input type="radio" name="kao_if" value="1">已提交　
                            <input type="radio" name="kao_if" value="2">未提交　
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