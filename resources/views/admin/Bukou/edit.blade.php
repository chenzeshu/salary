@extends('layouts/admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="{{url('admin/bukou')}}">首页</a> &raquo; <a href="#">补扣信息管理</a>
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
            <h3>编辑补扣信息</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/bukou/create')}}"><i class="fa fa-plus"></i>添加补扣信息</a>
                <a href="{{url('admin/bukou')}}"><i class="fa fa-recycle"></i>全部补扣信息</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/bukou/'.$field->bk_id)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th>姓名：</th>
                        <td>
                            <input type="text" class="xs" name="bk_name" value="{{$field->bk_name}}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require"></i>补扣类型：</th>
                        <td>
                            <input type="radio" name="bk_type" value="1" onclick="checkType()" @if($field->bk_type==1) checked @endif>病事假　
                            <input type="radio" name="bk_type" value="2" onclick="checkType()" @if($field->bk_type==2) checked @endif>迟到早退　
                            <input type="radio" name="bk_type" value="3" onclick="checkType()" @if($field->bk_type==3) checked @endif>旷工　
                        </td>
                    </tr>
                    <tr id="hour">
                        <th><i class="require"></i>小时数：</th>
                        <td>
                            <input type="text" class="md" name="bk_hour" value="{{$field->bk_hour}}" placeholder="小时数">
                        </td>
                    </tr>
                    <tr id="time">
                        <th><i class="require"></i>迟到早退次数：</th>
                        <td>
                            <input type="text" class="md" name="bk_time" value="{{$field->bk_time}}" placeholder="迟到早退次数">
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
    <script>
        $(function(){
            checkType();
        });

        function checkType(){
            var index =$('input[name=bk_type]:checked').val();
            if(index==1||index==3){
                $('#hour').show();
                $('#time').hide();
            }else if(index==2){
                $('#time').show();
                $('#hour').hide();
            }
        }
    </script>
@endsection