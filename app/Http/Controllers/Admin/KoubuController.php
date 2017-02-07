<?php

namespace App\Http\Controllers\Admin;

use App\Model\Koubu;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class KoubuController extends CommonController
{
    public function index(){
        $data = Koubu::orderBy('kb_id','asc')->paginate(10);
        $links = $data->links();
        return view('admin/koubu/index',compact('data'));
    }

    //get  admin/koubu/create  添加商品
    public function create()
    {
        return view('admin.koubu.create');
    }

    public function store()
    {
        $input = Input::except('_token');
//        $input['kb_time']=time();
        $rules = [
            'kb_name'=>'required',
            'kb_type'=>'required',
            'kb_date_begin'=>'required',
            'kb_date_end'=>'required'
        ];
        $message = [
            'kb_name.required' =>'[姓名]必须填写',
            'kb_type.required' =>'[类型]必须填写',
            'kb_date_begin.required' =>'[开始日期]必须填写',
            'kb_date_end.required' =>'[结束日期]必须填写'
        ];
        $validator = Validator::make($input,$rules,$message);
        $input['kb_date_begin'] =strtotime( $input['kb_date_begin']);
        $input['kb_date_end']=strtotime( $input['kb_date_end']);
        $input['kb_date_sum']=  ($input['kb_date_end']-$input['kb_date_begin'])/86400;
        if($validator->passes()){
            $re = Koubu::create($input);
            if($re){
                return redirect('admin/koubu');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get  admin/koubu/{koubu}/edit  编辑分类 {koubu}是传参的参数值
    public function edit($kb_id)
    {
        $field = Koubu::find($kb_id);
        return view('admin/koubu/edit',compact('field'));
    }
    //put|patch admin/koubu/{koubu}  更新分类 {koubu}是传参的参数值
    public function update($kb_id)
    {
        $input = Input::except('_token','_method');

        $input['kb_date_begin']=strtotime( $input['kb_date_begin']);
        $input['kb_date_end']=strtotime( $input['kb_date_end']);
        $input['kb_date_sum']=  ($input['kb_date_end']-$input['kb_date_begin'])/86400;

        $re = Koubu::where('kb_id',$kb_id)->update($input);
        if($re){
            return redirect('admin/koubu');
        }else{
            return back()->with('errors','商品修改失败,请重试！');
        }
    }

    //delelte admin/koubu/{koubu}  删除分类
    public function destroy($kb_id)
    {
        $re = Koubu::where('kb_id',$kb_id)->delete();
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

    //get  admin/koubu/{koubu}  显示单个分类信息
    public function show()
    {

    }

    public function search()
    {
        $input = Input::all();
        $name = $input['name'];
        $info = Koubu::where("kb_name","like","%".$name."%")->orderBy("kb_id")->get();   //orderBy模式asc
        return $info;
    }
}
