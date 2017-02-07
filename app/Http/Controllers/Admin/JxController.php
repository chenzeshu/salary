<?php

namespace App\Http\Controllers\Admin;

use App\Model\Jx;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class JxController extends CommonController
{
    public function index(){
        $data = Jx::orderBy('jx_id','asc')->paginate(10);
        $links = $data->links();
        return view('admin/jx/index',compact('data'));
    }

    //get  admin/jx/create  添加商品
    public function create()
    {
        return view('admin.jx.create');
    }

    public function store()
    {
        $input = Input::except('_token');
//        $input['jx_time']=time();
        $rules = [
            'jx_name'=>'required',
            'jx_real'=>'required',
        ];
        $message = [
            'jx_name.required' =>'[姓名]必须填写',
            'jx_real.required' =>'[上月绩效]必须填写'
        ];
        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = jx::create($input);
            if($re){
                return redirect('admin/jx');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get  admin/jx/{jx}/edit  编辑分类 {jx}是传参的参数值
    public function edit($jx_id)
    {
        $field = jx::find($jx_id);
        return view('admin/jx/edit',compact('field'));
    }
    //put|patch admin/jx/{jx}  更新分类 {jx}是传参的参数值
    public function update($jx_id)
    {
        $input = Input::except('_token','_method');
//        $input['jx_time']=time();

        $re = jx::where('jx_id',$jx_id)->update($input);
        if($re){
            return redirect('admin/jx');
        }else{
            return back()->with('errors','商品修改失败,请重试！');
        }
    }

    //delelte admin/jx/{jx}  删除分类
    public function destroy($jx_id)
    {
        $re = jx::where('jx_id',$jx_id)->delete();
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

    //get  admin/jx/{jx}  显示单个分类信息
    public function show()
    {

    }

    public function search()
    {
        $input = Input::all();
        $name = $input['name'];
        $info = jx::where("jx_name","like","%".$name."%")->orderBy("jx_id")->get();   //orderBy模式asc
        return $info;
    }
}
