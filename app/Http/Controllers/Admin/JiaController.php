<?php

namespace App\Http\Controllers\Admin;

use App\Model\Jia;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class JiaController extends CommonController
{
    public function index(){
        $data = Jia::orderBy('jia_id','asc')->paginate(10);
        $links = $data->links();
        return view('admin/jia/index',compact('data'));
    }

    //get  admin/jia/create  添加商品
    public function create()
    {
        return view('admin.jia.create');
    }

    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'jia_name'=>'required',
//            'jia_date'=>'required',
            'jia_hour'=>'required'
        ];
        $message = [
            'jia_name.required' =>'[姓名]必须填写',
//            'jia_date.required' =>'[加班月份]必须填写',
            'jia_hour.required' =>'[加班小时数]必须填写'
        ];
        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            //转时间戳
//            $input['jia_date'] = strtotime($input['jia_date']);
            $re = Jia::create($input);
            if($re){
                return redirect('admin/jia');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get  admin/jia/{jia}/edit  编辑分类 {jia}是传参的参数值
    public function edit($jia_id)
    {
        $field = Jia::find($jia_id);
        return view('admin/jia/edit',compact('field'));
    }
    //put|patch admin/jia/{jia}  更新分类 {jia}是传参的参数值
    public function update($jia_id)
    {
        $input = Input::except('_token','_method');
//        $input['jia_date'] = strtotime($input['jia_date']);
        $re = Jia::where('jia_id',$jia_id)->update($input);
        if($re){
            return redirect('admin/jia');
        }else{
            return back()->with('errors','商品修改失败,请重试！');
        }
    }

    //delelte admin/jia/{jia}  删除分类
    public function destroy($jia_id)
    {
        $re = jia::where('jia_id',$jia_id)->delete();
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

    //get  admin/jia/{jia}  显示单个分类信息
    public function show()
    {

    }

    public function search()
    {
        $input = Input::all();
        $name = $input['name'];
        $info = Jia::where("jia_name","like","%".$name."%")->orderBy("jia_name")->get();   //orderBy模式asc
        return $info;
    }
}
