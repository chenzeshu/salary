<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\CommonController;
use App\Model\Base;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class BaseController extends CommonController
{
    public function index(){
        $data = Base::orderBy('base_id','asc')->paginate(10);
        $links = $data->links();
        return view('admin/Base/index',compact('data'));
    }

    //get  admin/base/create  添加商品
    public function create()
    {
        return view('admin.Base.create');
    }

    public function store()
    {
        $input = Input::except('_token');
//        $input['base_time']=time();
        $rules = [
            'base_name'=>'required',
            'base_gong'=>'required',
            'base_yang'=>'required',
        ];
        $message = [
            'base_name.required' =>'[姓名]必须填写',
            'base_gong.required' =>'[公积金基数]必须填写',
            'base_yang.required' =>'[养老金基数]必须上传'
        ];
        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = Base::create($input);
            if($re){
                return redirect('admin/base');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get  admin/base/{base}/edit  编辑分类 {base}是传参的参数值
    public function edit($base_id)
    {
        $field = Base::find($base_id);
        return view('admin/base/edit',compact('field'));
    }
    //put|patch admin/base/{base}  更新分类 {base}是传参的参数值
    public function update($base_id)
    {
        $input = Input::except('_token','_method');
//        $input['base_time']=time();

        $re = Base::where('base_id',$base_id)->update($input);
        if($re){
            return redirect('admin/base');
        }else{
            return back()->with('errors','商品修改失败,请重试！');
        }
    }

    //delelte admin/base/{base}  删除分类
    public function destroy($base_id)
    {
        $re = Base::where('base_id',$base_id)->delete();
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

    //get  admin/base/{base}  显示单个分类信息
    public function show()
    {

    }

    public function search()
    {
        $input = Input::all();
        $name = $input['name'];
        $info = Base::where("base_name","like","%".$name."%")->orderBy("base_id")->get();   //orderBy模式asc
        return $info;
    }
}
