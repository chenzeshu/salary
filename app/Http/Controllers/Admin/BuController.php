<?php

namespace App\Http\Controllers\Admin;

use App\Model\Bu;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class BuController extends Controller
{
    public function index(){
        $data = Bu::where('bu_date',1)->orderBy('bu_id','asc')->paginate(10);
        $links = $data->links();
        return view('admin/bu/index',compact('data'));
    }

    public function indexs()
    {
        $data = Bu::where('bu_date',2)->orderBy('bu_id','asc')->paginate(10);
        $links = $data->links();
        return view('admin/bu/index_shang',compact('data'));
    }

    //get  admin/bu/create  添加商品
    public function create()
    {
        return view('admin.bu.create');
    }

    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'bu_name'=>'required',
            'bu_if'=>'required',
            'bu_date'=>'required',
            'bu_limit'=>'required'
        ];
        $message = [
            'bu_name.required' =>'[姓名]必须填写',
            'bu_if.required' =>'[是否交发票]必须选择',
            'bu_date.required' =>'[本月还是上月]必须选择',
            'bu_limit.required' =>'[三补额度]必须填写'
        ];
        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = Bu::create($input);
            if($re){
                return redirect('admin/bu');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get  admin/bu/{bu}/edit  编辑分类 {bu}是传参的参数值
    public function edit($bu_id)
    {
        $field = Bu::find($bu_id);
        return view('admin/bu/edit',compact('field'));
    }
    //put|patch admin/bu/{bu}  更新分类 {bu}是传参的参数值
    public function update($bu_id)
    {
        $input = Input::except('_token','_method');
        $re = Bu::where('bu_id',$bu_id)->update($input);
        if($re){
            return redirect('admin/bu');
        }else{
            return back()->with('errors','商品修改失败,请重试！');
        }
    }

    //delelte admin/bu/{bu}  删除分类
    public function destroy($bu_id)
    {
        $re = Bu::where('bu_id',$bu_id)->delete();
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

    //get  admin/bu/{bu}  显示单个分类信息
    public function show()
    {

    }

    public function search()
    {
        $input = Input::all();
        $name = $input['name'];
        $info = Bu::where("bu_name","like","%".$name."%")->orderBy("bu_name")->get();   //orderBy模式asc
        return $info;
    }
}
