@extends('layouts/admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="{{url('admin/koubu')}}">首页</a> &raquo; <a href="#">三补扣除管理</a>
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
            <h3>编辑三补扣除</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/koubu/create')}}"><i class="fa fa-plus"></i>添加三补扣除</a>
                <a href="{{url('admin/koubu')}}"><i class="fa fa-recycle"></i>全部三补扣除</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/koubu/'.$field->kb_id)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th>姓名：</th>
                        <td>
                            <input type="text" class="xs" name="kb_name" value="{{$field->kb_name}}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require"></i>补扣类型：</th>
                        <td>
                            <input type="radio" name="kb_type" value="1" onclick="checkType()" @if($field->kb_type==1) checked @endif>病事假　
                            <input type="radio" name="kb_type" value="2" onclick="checkType()" @if($field->kb_type==2) checked @endif>迟到早退　
                            <input type="radio" name="kb_type" value="3" onclick="checkType()" @if($field->kb_type==3) checked @endif>旷工　
                        </td>
                    </tr>
                    <script src="{{asset('/resources/org/laydate/laydate.js')}}" type="text/javascript" charset="utf-8"></script>
                    <tr>
                        <th><i class="require"></i>开始日期：</th>
                        <td>
                            <input class="laydate-icon" name="kb_date_begin" onclick="laydate()"  placeholder="开始日期" value="{{date('Y-m-d',$field->kb_date_begin)}}">
                        </td>
                    </tr>
                    <tr id="time">
                        <th><i class="require"></i>结束日期</th>
                        <td>
                            <input class="laydate-icon" name="kb_date_end" onclick="laydate()"  placeholder="结束日期" value="{{date('Y-m-d',$field->kb_date_end)}}">
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