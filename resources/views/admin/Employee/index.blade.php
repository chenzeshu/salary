@extends('layouts/admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/employee')}}">首页</a> &raquo; <a href="#">员工信息管理</a>
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->

    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
        <div class="result_wrap">
            <div class="result_title">
                <h3>员工信息列表</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/employee/create')}}"><i class="fa fa-plus"></i>添加员工信息</a>
                    <a href="{{url('admin/employee')}}"><i class="fa fa-recycle"></i>全部员工信息</a>
                    <input type="text" name="e_name" class="xs" placeholder="填写查找姓名" id="search">
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
                        <th>身份证号</th>
                        <th>招行卡号</th>
                        <th>中行卡号</th>
                        <th>合同类型</th>
                        <th>是/否宿舍</th>
                        <th>邮箱</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">{{$v->e_id}}</td>
                        <td>
                            <a href="#">{{$v->e_name}}</a>
                        </td>
                        <td>{{$v->e_credit}}</td>
                        <td>{{$v->e_zhao}}</td>
                        <td>{{$v->e_zhong}}</td>
                        <td>@if($v->e_type==1) 固定期合同
                        @elseif($v->e_type==2) 非固定期合同
                        @elseif($v->e_type==3) 试用期
                        @elseif($v->e_type==4) 集中返聘
                        @endif
                        </td>
                        <td>@if($v->e_dorm==1) 是
                            @elseif($v->e_dorm==2) 否
                            @endif
                        </td>
                        <td>{{$v->e_mail}}</td>
                        <td>
                            <a href="{{url('admin/employee/'.$v->e_id.'/edit')}}">修改</a>
                            <a href="javascript:"onclick="deleteObj({{$v->e_id}})">删除</a>
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
        function deleteObj(e_id){
            layer.confirm('确定删除这位仁兄？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/employee/')}}/"+e_id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
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
            $.post("{{url('admin/employee/search')}}",{name:val,'_token':'{{csrf_token()}}'},function(data){
                $('tr:gt(0)').remove();
                $(data).each(function(k,v){
                    var url1 ="employee/"+v.e_id+"/edit";
                    var url2 = 'javascript:onclick=deleteObj('+v.e_id+')';
                    if(v.e_type==1){v.e_type="固定期";}else if(v.e_type==2){ v.e_type="非固定期";}else{v.e_type="试用期";}
                    if(v.e_dorm==1){ v.e_dorm="是";}else{v.e_dorm="否";}
                    $('tr:first').after("<tr><td class='tc'>"+v.e_id+"</td>" +
                            "<td>"+v.e_name+"</td>" +
                            "<td>"+v.e_credit+"</td>" +
                            "<td>"+v.e_zhao+"</td>" +
                            "<td>"+v.e_zhong+"</td>" +
                            "<td>"+v.e_type+"</td>" +
                            "<td>"+v.e_dorm+"</td>" +
                            "<td><a href='"+url1+"'>修改</a><a href="+url2+">删除</a></td></tr>");
                })
            });
        }
          {{--function changeOrder(obj,e_id){--}}
              {{--var order = $(obj).val();--}}
              {{--$.post('{{url('admin/employee/changeorder')}}',{'_token':"{{csrf_token()}}",'order':order,'e_id':e_id},function (data) {--}}
                  {{--if(data.status=='0'){--}}
                      {{--layer.alert(data.msg,{icon: 6});--}}
                  {{--}else{--}}
                      {{--layer.alert(data.msg,{icon: 5});--}}
                  {{--}--}}
              {{--})--}}
          {{--}--}}

    </script>
@endsection
