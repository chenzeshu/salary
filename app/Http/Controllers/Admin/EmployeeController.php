<?php

namespace App\Http\Controllers\Admin;

use App\Model\Employee;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends CommonController
{
    public function index(){
        $data = Employee::orderBy('e_id','asc')->paginate(10);
        $links = $data->links();
        return view('admin/Employee/index',compact('data'));
    }

    //get  admin/Employee/create  添加商品
    public function create()
    {
        return view('admin.Employee.create');
    }

    public function store()
    {
        $input = Input::except('_token');
//        $input['e_time']=time();
        $rules = [
            'e_name'=>'required',
            'e_credit'=>'required',
            'e_zhao'=>'required',
            'e_zhong'=>'required',
            'e_type'=>'required',
            'e_dorm'=>'required'
        ];
        $message = [
            'e_name.required' =>'[姓名]必须填写',
            'e_credit.required' =>'[身份证号]必须填写',
            'e_zhao.required' =>'[招行卡号]必须上传',
            'e_zhong.required' =>'[中行卡号]必须填写',
            'e_type.required' =>'[合同类型]必须选择',
            'e_dorm.required' =>'[是否住宿舍]必须选择'
        ];
        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = Employee::create($input);
            if($re){
                return redirect('admin/employee');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get  admin/Employee/{Employee}/edit  编辑分类 {Employee}是传参的参数值
    public function edit($e_id)
    {
        $field = Employee::find($e_id);
        return view('admin/Employee/edit',compact('field'));
    }
    //put|patch admin/Employee/{Employee}  更新分类 {Employee}是传参的参数值
    public function update($e_id)
    {
        $input = Input::except('_token','_method');
//        $input['e_time']=time();

        $re = Employee::where('e_id',$e_id)->update($input);
        if($re){
            return redirect('admin/employee');
        }else{
            return back()->with('errors','商品修改失败,请重试！');
        }
    }

    //delelte admin/Employee/{Employee}  删除分类
    public function destroy($e_id)
    {
        $re = Employee::where('e_id',$e_id)->delete();
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

    //get  admin/Employee/{Employee}  显示单个分类信息
    public function show()
    {

    }

    public function search()
    {
        $input = Input::all();
        $name = $input['name'];
        $info = Employee::where("e_name","like","%".$name."%")->orderBy("e_name")->get();   //orderBy模式asc
        return $info;
    }
}
