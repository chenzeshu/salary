<?php

namespace App\Http\Controllers\Admin;

use App\Model\Job;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class JobController extends CommonController
{
    public function index(){
        $data = Job::where('job_real',1)->orderBy('job_id','asc')->paginate(10);
        $links = $data->links();
        return view('admin/job/index',compact('data'));
    }

    public function detail($job_name)
    {
        $data = Job::where('job_name',$job_name)->orderBy('job_date_change','asc')->paginate(10);
        $links = $data->links();
        return view('admin/job/detail',compact('data'));
    }

    //get  admin/job/create  添加商品
    public function create()
    {
        return view('admin.job.create');
    }

    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'job_name'=>'required',
            'job_bumen1'=>'required',
            'job_bumen2'=>'required',
            'job_date_enter'=>'required',
            'job_salary_enter'=>'required'
        ];
        $message = [
            'job_name.required' =>'[姓名]必须填写',
            'job_bumen1.required' =>'[部门1]必须填写',
            'job_bumen2.required' =>'[部门2]必须填写',
            'job_date_enter.required' =>'[定岗日期]必须选择',
            'job_salary_enter.required' =>'[定岗工资]必须填写'
        ];
        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            //如果是调岗，那么将原来的job_real标签由默认的1变成0，而新调岗生成的自然是1
            //帮助汇总表筛除同一个人的前身
            $job = Job::where('job_name',$input['job_name'])->get();
            foreach($job as $k=>$v){
                $array = [
                    'job_real'=>0
                ];
                Job::where("job_id",$v->job_id)->update($array);
            }

            //转时间戳
            $input['job_date_enter'] = strtotime($input['job_date_enter']);
            if (isset($input['job_date_change'])){
                $input['job_date_change'] = strtotime($input['job_date_change']);
            }
            $re = Job::create($input);
            if($re){
                return redirect('admin/job');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get  admin/job/{job}/edit  编辑分类 {job}是传参的参数值
    public function edit($job_id)
    {
        $field = Job::find($job_id);
        return view('admin/job/edit',compact('field'));
    }
    //put|patch admin/job/{job}  更新分类 {job}是传参的参数值
    public function update($job_id)
    {
        $input = Input::except('_token','_method');
        $input['job_date_enter'] = strtotime($input['job_date_enter']);
        if (isset($input['job_date_change'])){
            $input['job_date_change'] = strtotime($input['job_date_change']);
        }
        $re = Job::where('job_id',$job_id)->update($input);
        if($re){
            return redirect('admin/job');
        }else{
            return back()->with('errors','商品修改失败,请重试！');
        }
    }

    //delelte admin/job/{job}  删除分类
    public function destroy($job_id)
    {
        $re = Job::where('job_id',$job_id)->delete();
        if($re){
            $data = [
                'status'=> 0,   //因为是ajax异步返回，所以返回一个json数据
                'msg' => '删除成功',
            ];
        }else{
            $data = [
                'status'=> 1,   //因为是ajax异步返回，所以返回一个json数据
                'msg' => '删除失败，请稍后重试',
            ];
        }
        return $data;
    }

    //get  admin/job/{job}  显示单个分类信息
    public function show()
    {

    }

    public function search()
    {
        $input = Input::all();
        $name = $input['job_name'];
        $info = Job::where("job_name","like","%".$name."%")->orderBy("job_name")->orderBy("job_date_change","desc")->get();   //orderBy模式asc
        return $info;
    }

    public function change($job_id)
    {
        $field = Job::find($job_id);
        return view('admin.job.change',compact('field'));
    }
}
