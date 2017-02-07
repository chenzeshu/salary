<?php

namespace App\Http\Controllers\Admin;

use App\Model\Bu;
use App\Model\Kao;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class KaoController extends CommonController
{
    public function index(){
        $data = Kao::orderBy('kao_id','asc')->paginate(10);
        $num = 0;
        $links = $data->links();
        return view('admin/kao/index',compact('data','num'));
    }

    //get  admin/kao/create  添加商品
    public function create()
    {
        return view('admin.kao.create');
    }

    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'kao_name'=>'required',
            'kao_if'=>'required'
        ];
        $message = [
            'kao_name.required' =>'[姓名]必须填写',
            'kao_if.required' =>'[是否提交]必须选择'
        ];
        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = Kao::create($input);
            if($re){
                return redirect('admin/kao');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get  admin/kao/{kao}/edit  编辑分类 {kao}是传参的参数值
    public function edit($kao_id)
    {
        $field = Kao::find($kao_id);
        return view('admin/kao/edit',compact('field'));
    }
    //put|patch admin/kao/{kao}  更新分类 {kao}是传参的参数值
    public function update($kao_id)
    {
        $input = Input::except('_token','_method');
        $re = Kao::where('kao_id',$kao_id)->update($input);
        if($re){
            return redirect('admin/kao');
        }else{
            return back()->with('errors','数据修改失败,请重试！');
        }
    }

    //delelte admin/kao/{kao}  删除分类
    public function destroy($kao_id)
    {
        $re = Kao::where('kao_id',$kao_id)->delete();
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

    //get  admin/kao/{kao}  显示单个分类信息
    public function show()
    {

    }

    public function search()
    {
        $input = Input::all();
        $name = $input['name'];
        $info = Kao::where("kao_name","like","%".$name."%")->orderBy("kao_name")->get();   //orderBy模式asc
        return $info;
    }
}
