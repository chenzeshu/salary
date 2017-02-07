@extends('layouts/admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/bukou')}}">首页</a> &raquo; <a href="#">补扣信息管理</a>
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->

    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
        <div class="result_wrap">
            <div class="result_title">
                <h3>补扣信息列表</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/bukou/create')}}"><i class="fa fa-plus"></i>添加补扣信息</a>
                    <a href="{{url('admin/bukou')}}"><i class="fa fa-recycle"></i>全部补扣信息</a>
                    <input type="text" name="bk_name" class="xs" placeholder="填写查找姓名" id="search">
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
                        <th>类型</th>
                        <th>补扣小时数||旷工次数</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">{{$v->bk_id}}</td>
                        <td>
                            <a href="#">{{$v->bk_name}}</a>
                        </td>
                        <td>@if($v->bk_type==1) 病事假 @elseif($v->bk_type==2) 迟到早退  @else 旷工 @endif</td>
                        <td>@if($v->bk_type==1||$v->bk_type==3) {{$v->bk_hour}}小时 @else 迟到早退 {{$v->bk_time}}次 @endif</td>
                        <td>
                            <a href="{{url('admin/bukou/'.$v->bk_id.'/edit')}}">修改</a>
                            <a href="javascript:"onclick="deleteObj({{$v->bk_id}})">删除</a>
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
        function deleteObj(bk_id){
            layer.confirm('确定删除这位仁兄？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/bukou/')}}/"+bk_id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
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
            $.post("{{url('admin/bukou/search')}}",{name:val,'_token':'{{csrf_token()}}'},function(data){
                $('tr:gt(0)').remove();
                    $(data).each(function(k,v){
                        var url1 ="bukou/"+v.bk_id+"/edit";
                        var url2 = 'javascript:onclick=deleteObj('+v.bk_id+')';
                        if(v.bk_type==1){
                            $('tr:first').after("<tr><td class='tc'>"+v.bk_id+"</td>" +
                                    "<td>"+v.bk_name+"</td>" +
                                    "<td>病事假</td>" +
                                    "<td>"+v.bk_hour+"小时</td>" +
                                    "<td><a href='"+url1+"'>修改</a><a href="+url2+">删除</a></td></tr>");
                        }else if(v.bk_type==2){
                            $('tr:first').after("<tr><td class='tc'>"+v.bk_id+"</td>" +
                                    "<td>"+v.bk_name+"</td>" +
                                    "<td>迟到早退</td>" +
                                    "<td>迟到早退"+v.bk_time+"次</td>" +
                                    "<td><a href='"+url1+"'>修改</a><a href="+url2+">删除</a></td></tr>");
                        }else{
                            $('tr:first').after("<tr><td class='tc'>"+v.bk_id+"</td>" +
                                    "<td>"+v.bk_name+"</td>" +
                                    "<td>旷工</td>" +
                                    "<td>"+v.bk_hour+"小时</td>" +
                                    "<td><a href='"+url1+"'>修改</a><a href="+url2+">删除</a></td></tr>");
                        }

                    })
            });
        }
          {{--function changeOrder(obj,bk_id){--}}
              {{--var order = $(obj).val();--}}
              {{--$.post('{{url('admin/bukou/changeorder')}}',{'_token':"{{csrf_token()}}",'order':order,'bk_id':bk_id},function (data) {--}}
                  {{--if(data.status=='0'){--}}
                      {{--layer.alert(data.msg,{icon: 6});--}}
                  {{--}else{--}}
                      {{--layer.alert(data.msg,{icon: 5});--}}
                  {{--}--}}
              {{--})--}}
          {{--}--}}

    </script>
@endsection
