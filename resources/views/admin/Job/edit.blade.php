@extends('layouts/admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="{{url('admin/job')}}">首页</a> &raquo; <a href="#">人员岗位信息管理</a>
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
            <h3>编辑人员岗位信息</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/job/create')}}"><i class="fa fa-plus"></i>添加人员岗位信息</a>
                <a href="{{url('admin/job')}}"><i class="fa fa-recycle"></i>全部人员岗位信息</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/job/'.$field->job_id)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th>姓名：</th>
                    <td>
                        <input type="text" class="xs" name="job_name" value="{{$field->job_name}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require"></i>部门一：</th>
                    <td>
                        <select name="job_bumen1" id="">
                            <option value="1" @if($field->job_bumen1==1) selected @endif>管理总部</option>
                            <option value="2" @if($field->job_bumen1==2) selected @endif>业务总部</option>
                            <option value="3" @if($field->job_bumen1==3) selected @endif>云卫通</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require"></i>部门二：</th>
                    <td>
                        <select name="job_bumen2" id="">
                            <option value="1" @if($field->job_bumen2==1) selected @endif>管理总部</option>
                            <option value="2" @if($field->job_bumen2==2) selected @endif>业务总部</option>
                            <option value="3" @if($field->job_bumen2==3) selected @endif>云卫通</option>
                            <option value="4" @if($field->job_bumen2==4) selected @endif>技术部</option>
                        </select>
                    </td>
                </tr>
                <script src="{{asset('/resources/org/laydate/laydate.js')}}" type="text/javascript" charset="utf-8"></script>
                <tr>
                    <th><i class="require"></i>入职日期：</th>
                    <td>
                        <input class="laydate-icon" name="job_date_enter" onclick="laydate()"  placeholder="选择日期" value="{{date('Y-m-d',$field->job_date_enter)}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require"></i>初定岗工资：</th>
                    <td>
                        <input type="text" name="job_salary_enter" value="{{$field->job_salary_enter}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require"></i>调岗日期（初定不填）：</th>
                    <td>
                        <input class="laydate-icon" name="job_date_change" onclick="laydate()"  placeholder="选择日期" value="{{date('Y-m-d',$field->job_date_change)}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require"></i>调岗工资（初定不填）：</th>
                    <td>
                        <input type="text" name="job_salary_change" value="{{$field->job_salary_change}}">
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