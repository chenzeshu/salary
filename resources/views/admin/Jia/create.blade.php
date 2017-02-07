@extends('layouts/admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="{{url('admin/jia')}}">首页</a> &raquo; <a href="#">加班信息管理</a>
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
            <h3>添加加班信息</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/jia/create')}}"><i class="fa fa-plus"></i>添加加班信息</a>
                <a href="{{url('admin/jia')}}"><i class="fa fa-recycle"></i>全部加班信息</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/jia/')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th>姓名：</th>
                        <td>
                            <input type="text" class="xs" name="jia_name" value="">
                        </td>
                    </tr>
                    {{--<script src="{{asset('/resources/org/laydate/laydate.js')}}" type="text/javascript" charset="utf-8"></script>--}}
                    {{--<tr>--}}
                        {{--<th><i class="require"></i>加班年月：</th>--}}
                        {{--<td>--}}
                            {{--<input class="laydate-icon" name="jia_date" onclick="laydate({istime: true, format: 'YYYY-MM'})"  placeholder="选择日期">--}}
                        {{--选择年月即可--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    <tr>
                        <th><i class="require"></i>当月加班小时数：</th>
                        <td>
                            <input type="text" name="jia_hour" onchange="checkNum(this)">
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交" >
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
<script>
    function checkNum(obj){
        var num = $(obj).val();
        var reg = /^\d+$/;
        if(num.match(reg)){
            $('input[type=submit]').val('提交');
            $('input[type=submit]').attr("disabled",false);
        }else {
            $('input[type=submit]').val('需填写数字');
            $('input[type=submit]').prop("disabled","true");
        }
    }
</script>
@endsection