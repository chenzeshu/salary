@extends('layouts/admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/kao')}}">首页</a> &raquo; <a href="#">月考核表信息管理</a>
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
        <div class="result_wrap">
            <div class="result_title">
                <h3>月考核表信息列表</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/kao/create')}}"><i class="fa fa-plus"></i>添加月考核表信息</a>
                    <a href="{{url('admin/kao')}}"><i class="fa fa-recycle"></i>全部月考核表信息</a>
                    <input type="text" name="kao_name" class="xs" placeholder="填写查找姓名" id="search">
                    <input type="button" value="查找" onclick="searchName()">
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        {{--<th class="tc">ID</th>--}}
                        <th class="tc">计数ID</th>
                        <th>姓名</th>
                        <th>是否提交月考核表</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        {{--<td class="tc">{{$v->kao_id}}</td>--}}
                        <td class="tc">{{$num=$num+1}} </td>
                        <td>
                            <a href="#">{{$v->kao_name}}</a>
                        </td>
                        <td>
                            <a href="#">@if($v->kao_if==1)提交@else 未提交 @endif</a>
                        </td>
                        <td>
                            <a href="{{url('admin/kao/'.$v->kao_id.'/edit')}}">修改</a>
                            <a href="javascript:"onclick="deleteObj({{$v->kao_id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="page_list">
                   {{$data->links()}}
                </div>
            </div>
        </div>
    <!--搜索结果页面 列表 结束-->

    <style>
        .result_content ul li span{
            padding:6px 12px;
        }
    </style>
    <script>
        //删除分类
        function deleteObj(kao_id){
            layer.confirm('确定删除这位仁兄？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/kao/')}}/"+kao_id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
                    if(data.status=='0'){
                        layer.msg(data.msg, {icon: 6});
                        setTimeout(function(){
                            location.href = location.href;
                        },900)
                    }else if(data.status=='1'){
                        layer.msg(data.msg, {icon: 5});
                        setTimeout(function(){
                            location.href = location.href;
                        },900)
                    }else{
                        layer.msg(data.msg, {icon: 5});
                        setTimeout(function(){
                            location.href = location.href;
                        },900)
                    }
                });
            });
        }
        function searchName(){
            var val = $('#search').val();

            $.post("{{url('admin/kao/search')}}",{name:val,'_token':'{{csrf_token()}}'},function(data){
                $('tr:gt(0)').remove();
                $(data).each(function(k,v){
                    var url1 ="kao/"+v.kao_id+"/edit";
                    var url2 = 'javascript:onclick=deleteObj('+v.kao_id+')';
                    if(v.kao_if==1){
                        v.kao_if="提交";
                    }else {
                        v.kao_if="未提交";
                    }
                    $('tr:first').after("<tr><td class='tc'>"+v.kao_id+"</td>" +
                            "<td>"+v.kao_name+"</td>" +
                            "<td>"+v.kao_if+"</td>" +
                            "<td><a href='"+url1+"'>修改</a><a href="+url2+">删除</a></td></tr>");
                })
            });
        }
          {{--function changeOrder(obj,kao_id){--}}
              {{--var order = $(obj).val();--}}
              {{--$.post('{{url('admin/kao/changeorder')}}',{'_token':"{{csrf_token()}}",'order':order,'kao_id':kao_id},function (data) {--}}
                  {{--if(data.status=='0'){--}}
                      {{--layer.alert(data.msg,{icon: 6});--}}
                  {{--}else{--}}
                      {{--layer.alert(data.msg,{icon: 5});--}}
                  {{--}--}}
              {{--})--}}
          {{--}--}}

    </script>
@endsection
