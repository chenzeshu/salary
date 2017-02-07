<?php

namespace App\Http\Controllers\Admin;

use App\Model\Bukou;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class BukouController extends CommonController
{
    public function index(){
        $data = Bukou::orderBy('bk_id','asc')->paginate(10);
        $links = $data->links();
        return view('admin/Bukou/index',compact('data'));
    }

    //get  admin/bukou/create  添加商品
    public function create()
    {
        return view('admin.bukou.create');
    }

    public function store()
    {
        $input = Input::except('_token');
//        $input['bk_time']=time();
        $rules = [
            'bk_name'=>'required',
            'bk_type'=>'required'
        ];
        $message = [
            'bk_name.required' =>'[姓名]必须填写',
            'bk_type.required' =>'[类型]必须填写'
        ];
        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = Bukou::create($input);
            if($re){
                return redirect('admin/bukou');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get  admin/bukou/{bukou}/edit  编辑分类 {bukou}是传参的参数值
    public function edit($bk_id)
    {
        $field = Bukou::find($bk_id);
        return view('admin/bukou/edit',compact('field'));
    }
    //put|patch admin/bukou/{bukou}  更新分类 {bukou}是传参的参数值
    public function update($bk_id)
    {
        $input = Input::except('_token','_method');
//        $input['bk_time']=time();

        $re = Bukou::where('bk_id',$bk_id)->update($input);
        if($re){
            return redirect('admin/bukou');
        }else{
            return back()->with('errors','商品修改失败,请重试！');
        }
    }

    //delelte admin/bukou/{bukou}  删除分类
    public function destroy($bk_id)
    {
        $re = Bukou::where('bk_id',$bk_id)->delete();
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

    //get  admin/bukou/{bukou}  显示单个分类信息
    public function show()
    {

    }

    public function search()
    {
        $input = Input::all();
        $name = $input['name'];
        $info = Bukou::where("bk_name","like","%".$name."%")->orderBy("bk_id")->get();   //orderBy模式asc
        return $info;
    }
}
