@extends('layouts/admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/koubu')}}">首页</a> &raquo; <a href="#">三补扣除管理</a>
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->

    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
        <div class="result_wrap">
            <div class="result_title">
                <h3>三补扣除列表</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/koubu/create')}}"><i class="fa fa-plus"></i>添加三补扣除</a>
                    <a href="{{url('admin/koubu')}}"><i class="fa fa-recycle"></i>全部三补扣除</a>
                    <input type="text" name="kb_name" class="xs" placeholder="填写查找姓名" id="search">
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
                        <th>开始日期</th>
                        <th>结束日期</th>
                        <th>天数</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">{{$v->kb_id}}</td>
                        <td>
                            <a href="#">{{$v->kb_name}}</a>
                        </td>
                        <td>@if($v->kb_type==1) 婚假 @elseif($v->kb_type==2) 产假  @else 病事假 @endif</td>
                        <td>{{date('Y-m-d',$v->kb_date_begin)}}</td>
                        <td>{{date('Y-m-d',$v->kb_date_end)}}</td>
                        <td>{{$v->kb_date_sum}}</td>
                        <td>
                            <a href="{{url('admin/koubu/'.$v->kb_id.'/edit')}}">修改</a>
                            <a href="javascript:"onclick="deleteObj({{$v->kb_id}})">删除</a>
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
        function deleteObj(kb_id){
            layer.confirm('确定删除这位仁兄？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/koubu/')}}/"+kb_id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
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
        //补0函数
        function AppendZero(obj)
        {
            if(obj<10) return "0" +""+ obj;
            else return obj;
        }

        function searchName(){
            var val = $('#search').val();
            $.post("{{url('admin/koubu/search')}}",{name:val,'_token':'{{csrf_token()}}'},function(data){
                $('tr:gt(0)').remove();
                    $(data).each(function(k,v){
                        var url1 ="koubu/"+v.kb_id+"/edit";
                        var url2 = 'javascript:onclick=deleteObj('+v.kb_id+')';
                        var time_enter = v.kb_date_begin*1000;  //unix时间戳*1000方便让js计算
                        var date_enter = new Date(time_enter);   //实例化Date对象
                        var enter = date_enter.getFullYear()+"-"+AppendZero(date_enter.getMonth()+1)+"-"+AppendZero(date_enter.getDate()); //组装日期
                        var time_change =v.kb_date_end*1000;
                        var date_change = new Date(time_change);
                        var end = date_change.getFullYear()+"-"+AppendZero(date_change.getMonth()+1)+"-"+AppendZero(date_change.getDate());
                        console.log(enter+"11"+end);
                        if(v.kb_type==1){
                            $('tr:first').after("<tr><td class='tc'>"+v.kb_id+"</td>" +
                                    "<td>"+v.kb_name+"</td>" +
                                    "<td>婚假</td>" +
                                    "<td>"+enter+"</td>" +
                                    "<td>"+end+"</td>" +
                                    "<td>"+v.kb_date_sum+"</td>" +
                                    "<td><a href='"+url1+"'>修改</a><a href="+url2+">删除</a></td></tr>");
                        }else if(v.kb_type==2){
                            $('tr:first').after("<tr><td class='tc'>"+v.kb_id+"</td>" +
                                    "<td>"+v.kb_name+"</td>" +
                                    "<td>产假</td>" +
                                    "<td>"+enter+"</td>" +
                                    "<td>"+end+"</td>" +
                                    "<td>"+v.kb_date_sum+"</td>" +
                                    "<td><a href='"+url1+"'>修改</a><a href="+url2+">删除</a></td></tr>");
                        }else{
                            $('tr:first').after("<tr><td class='tc'>"+v.kb_id+"</td>" +
                                    "<td>"+v.kb_name+"</td>" +
                                    "<td>病事假</td>" +
                                    "<td>"+enter+"</td>" +
                                    "<td>"+end+"</td>" +
                                    "<td>"+v.kb_date_sum+"</td>" +
                                    "<td><a href='"+url1+"'>修改</a><a href="+url2+">删除</a></td></tr>");
                        }

                    })
            });
        }
          {{--function changeOrder(obj,kb_id){--}}
              {{--var order = $(obj).val();--}}
              {{--$.post('{{url('admin/koubu/changeorder')}}',{'_token':"{{csrf_token()}}",'order':order,'kb_id':kb_id},function (data) {--}}
                  {{--if(data.status=='0'){--}}
                      {{--layer.alert(data.msg,{icon: 6});--}}
                  {{--}else{--}}
                      {{--layer.alert(data.msg,{icon: 5});--}}
                  {{--}--}}
              {{--})--}}
          {{--}--}}

    </script>
@endsection
