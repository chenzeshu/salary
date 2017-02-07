@extends('layouts/admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/bu')}}">首页</a> &raquo; <a href="#">三补信息管理</a>
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>三补信息列表</h3>
        </div>
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/bu/create')}}"><i class="fa fa-plus"></i>添加三补信息</a>
                <a href="{{url('admin/bu')}}"><i class="fa fa-recycle"></i>全部三补信息</a>
                <input type="text" name="bu_name" class="xs" placeholder="填写查找姓名" id="search">
                <input type="button" value="查找" onclick="searchName()">
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc">ID</th>
                    <th>姓名</th>
                    <th>是否交过三补发票</th>
                    <th>三补额度</th>
                    <th>本月or上月</th>
                    <th>操作</th>
                </tr>
                @foreach($data as $v)
                    <tr>
                        <td class="tc">{{$v->bu_id}}</td>
                        <td>
                            <a href="#">{{$v->bu_name}}</a>
                        </td>
                        <td>@if($v->bu_if==1) 是
                            @else 否 @endif</td>
                        <td>{{$v->bu_limit}}</td>
                        <td>@if($v->bu_date==1) 本月
                            @else 上月 @endif</td>
                        <td>
                            <a href="{{url('admin/bu/'.$v->bu_id.'/edit')}}">修改</a>
                            <a href="javascript:"onclick="deleteObj({{$v->bu_id}})">删除</a>
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
        function deleteObj(bu_id){
            layer.confirm('确定删除这位仁兄？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/bu/')}}/"+bu_id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
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
            $.post("{{url('admin/bu/search')}}",{name:val,'_token':'{{csrf_token()}}'},function(data){
                $('tr:gt(0)').remove();
                $(data).each(function(k,v){
                    var url1 ="bu/"+v.bu_id+"/edit";
                    var url2 = 'javascript:onclick=deleteObj('+v.bu_id+')';
                    if(v.bu_if==1){ v.bu_if="是";  }else { v.bu_if="否";}
                    if(v.bu_date==1){ v.bu_date="本月";  }else { v.bu_date="上月";}
                    $('tr:first').after("<tr><td class='tc'>"+v.bu_id+"</td>" +
                            "<td>"+v.bu_name+"</td>" +
                            "<td>"+v.bu_if+"</td>" +
                            "<td>"+v.bu_limit+"</td>" +
                            "<td>"+v.bu_date+"</td>" +
                            "<td><a href='"+url1+"'>修改</a><a href="+url2+">删除</a></td></tr>");
                })
            });
        }
        {{--function changeOrder(obj,bu_id){--}}
        {{--var order = $(obj).val();--}}
        {{--$.post('{{url('admin/bu/changeorder')}}',{'_token':"{{csrf_token()}}",'order':order,'bu_id':bu_id},function (data) {--}}
        {{--if(data.status=='0'){--}}
        {{--layer.alert(data.msg,{icon: 6});--}}
        {{--}else{--}}
        {{--layer.alert(data.msg,{icon: 5});--}}
        {{--}--}}
        {{--})--}}
        {{--}--}}

    </script>
@endsection
