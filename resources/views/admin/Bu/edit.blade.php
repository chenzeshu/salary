@extends('layouts/admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="{{url('admin/bu')}}">首页</a> &raquo; <a href="#">三补信息管理</a>
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
            <h3>编辑三补信息</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/bu/create')}}"><i class="fa fa-plus"></i>添加三补信息</a>
                <a href="{{url('admin/bu')}}"><i class="fa fa-recycle"></i>全部三补信息</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/bu/'.$field->bu_id)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th>姓名：</th>
                        <td>
                            <input type="text" class="xs" name="bu_name" value="{{$field->bu_name}}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require"></i>是否交过三补：</th>
                        <td>
                            <input type="radio" name="bu_if" value="1" @if($field->bu_if==1) checked @endif>交过　
                            <input type="radio" name="bu_if" value="2" @if($field->bu_if==2) checked @endif>没有交　
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require"></i>三补额度：</th>
                        <td>
                            <input type="text" name="bu_limit" value="{{$field->bu_limit}}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require"></i>本月or上月：</th>
                        <td>
                            <input type="radio" name="bu_date" value="1" @if($field->bu_date==1) checked @endif>本月　
                            <input type="radio" name="bu_date" value="2" @if($field->bu_date==2) checked @endif>上月　
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