@extends('layouts/admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/job')}}">首页</a> &raquo; <a href="#">人员岗位信息管理</a>
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->

    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
        <div class="result_wrap">
            <div class="result_title">
                <h3>人员岗位信息列表</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/job/create')}}"><i class="fa fa-plus"></i>添加人员岗位信息</a>
                    <a href="{{url('admin/job')}}"><i class="fa fa-recycle"></i>全部人员岗位信息</a>
                    <input type="text" name="job_name" class="xs" placeholder="填写查找姓名" id="search">
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
                        <th>部门一</th>
                        <th>部门二</th>
                        <th>入职日期（年月日）</th>
                        <th>初定岗工资</th>
                        <th>调岗日期（年月日）</th>
                        <th>调岗工资（数字）</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">{{$v->job_id}}</td>
                        <td>
                            <a href="#">{{$v->job_name}}</a>
                        </td>
                        <td>@if($v->job_bumen1==1)管理总部
                                @elseif($v->job_bumen1==2) 业务总部
                            @else 云卫通
                                @endif
                        </td>
                        <td>@if($v->job_bumen2==1)管理总部
                            @elseif($v->job_bumen2==2) 业务总部
                            @elseif($v->job_bumen2==3) 云卫通
                            @else 技术部
                            @endif</td>
                        <td>{{date('Y-m-d',$v->job_date_enter)}}</td>
                        <td>{{$v->job_salary_enter}}</td>
                        <td>{{date('Y-m-d',$v->job_date_change)}}</td>
                        <td>{{$v->job_salary_change}}</td>
                        <td>
                            <a href="{{url('admin/job/change/'.$v->job_id)}}">调岗</a>
                            <a href="{{url('admin/job/'.$v->job_id.'/edit')}}">修改</a>
                            <a href="javascript:"onclick="deleteObj({{$v->job_id}})">删除</a>
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
        function deleteObj(job_id){
            layer.confirm('确定删除这位仁兄？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/job/')}}/"+job_id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
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
        //搜索符合条件的+Unix时间戳=>Js时间戳=>得到日期（补0)
            function searchName(){
            var name = $('#search').val();
            if(name){
               $.post('{{url('admin/job/search')}}',{"job_name":name,"_token":"{{csrf_token()}}"},function(data){
                   $('table tr:gt(0)').empty();
                      $.each(data,function(k,v){
                          var time_enter = v.job_date_enter*1000;  //unix时间戳*1000方便让js计算
                          var date_enter = new Date(time_enter);   //实例化Date对象
                          var enter = date_enter.getFullYear()+"-"+AppendZero(date_enter.getMonth()+1)+"-"+AppendZero(date_enter.getDate()); //组装日期
                          var time_change = v.job_date_change*1000;
                          var date_change = new Date(time_change);
                          var change = date_change.getFullYear()+"-"+AppendZero(date_change.getMonth()+1)+"-"+AppendZero(date_change.getDate());
                          var url = "job/"+v.job_id+"/edit";      //比较方便的逃避133行直接写要改引号，兼容Larvel的方法;
                          var url2 = 'javascript:onclick=deleteObj('+v.job_id+')';  //这个更舒服了，直接兼容了js+laravel
                          var url3 = "job/change/"+v.job_id;
                            $('table').append("<tr><td>"+v.job_id+"</td><td>"+v.job_name+"</td><td>"+v.job_bumen1+"</td>" +
                                    "<td>"+v.job_bumen2+"</td><td>"+enter+"</td><td>"+v.job_salary_enter+"</td><td>"+change+"</td><td>"+v.job_salary_change+"</td>" +
                                    "<td><a href="+url3+">调岗</a><a href="+url+">修改</a><a href="+url2+">删除</a></td></tr>")
                      })
                })
            }else{
               alert("请输入信息");
            }
        }

          {{--function changeOrder(obj,job_id){--}}
              {{--var order = $(obj).val();--}}
              {{--$.post('{{url('admin/job/changeorder')}}',{'_token':"{{csrf_token()}}",'order':order,'job_id':job_id},function (data) {--}}
                  {{--if(data.status=='0'){--}}
                      {{--layer.alert(data.msg,{icon: 6});--}}
                  {{--}else{--}}
                      {{--layer.alert(data.msg,{icon: 5});--}}
                  {{--}--}}
              {{--})--}}
          {{--}--}}

    </script>
@endsection
