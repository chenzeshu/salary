<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => ['web']], function () {\
//权限控制器
Route::any('admin/auth', 'Entrust\EntrustController@index');
//测试
Route::any('admin/', 'Admin\loginController@register');
    //后台登陆
    Route::any('admin/login', 'Admin\loginController@login');
    Route::get('admin/code', 'Admin\loginController@code');
    Route::get('admin/logout', 'Admin\loginController@logout');
    //Word 导出
    Route::get('excel/wordexport','WordController@export');
    //EXCEL导出
    Route::get('excel/export_mingxi','ExcelController@export_mingxi');
    Route::get('excel/export_huizong1','ExcelController@export_huizong1');  //生成汇总_部门1Excel
    Route::get('excel/export_huizong2','ExcelController@export_huizong2');  //生成汇总_部门2Excel
    Route::get('excel/export_shui','ExcelController@export_shui');          //生成汇总_部门2Excel
    Route::get('excel/export_gongzi','ExcelController@export_gongzi');      //生成工资发放表
    Route::get('excel/export_jixiao','ExcelController@export_jixiao');      //生成绩效明细表
    Route::get('excel/export_jiangjin','ExcelController@export_jiangjin');  //生成越绩效奖金表
    Route::get('excel/export_jxhz1','ExcelController@export_jxhz1');        //生成绩效明细表
    Route::get('excel/export_jxhz2','ExcelController@export_jxhz2');        //生成绩效明细表
    Route::get('excel/export_sanbu','ExcelController@export_sanbu');        //生成绩效明细表
    //EXCEL导入
    Route::get('excel/import','ExcelController@import');
    //发送右键
    Route::get('mail','MailController@index');
    Route::any('mail/name/','MailController@laSend');      //专人发送
    Route::get('mail/all','MailController@allSend');      //全部发送
    Route::get('mail/send','MailController@send');       //phpmail
    Route::get('mail/laSend','MailController@laSend');  //自带mail模块
});

Route::group(['middleware'=>['web','admin.login'],'prefix'=>'admin','namespace' => 'Admin'], function () {
    //工资的路由
    Route::any('index', 'IndexController@index');
    Route::any('index2', 'IndexController@index2');
    Route::any('pass', 'IndexController@pass');  //改密码
    //员工基本job表
    Route::resource('job', 'JobController');
    Route::resource('job/search', 'JobController@search');
    Route::resource('job/change', 'JobController@change');
    Route::get('job/job_name/{job_name}', 'JobController@detail');
    //公积金、养老金基数
    Route::resource('base', 'BaseController');
    Route::resource('base/search', 'BaseController@search');
    //员工奖惩表
    Route::resource('reward', 'RewardController');
    Route::resource('reward/search', 'RewardController@search');
//    Route::any('base/changeorder','BaseController@changeOrder');
    //员工信息表
    Route::resource('employee', 'EmployeeController');
    Route::resource('employee/search', 'EmployeeController@search');
    //员工加班表
    Route::resource('jia', 'JiaController');
    Route::resource('jia/search', 'JiaController@search');
    //员工三补
    Route::resource('bu', 'BuController');
    Route::any('shang', 'BuController@indexs');
    Route::resource('bu/search', 'BuController@search');
    //员工月考核表
    Route::resource('kao', 'KaoController');
    Route::resource('kao/search', 'KaoController@search');
    //上月绩效实发数
    Route::resource('jx', 'JxController');
    Route::resource('jx/search', 'JxController@search');
    //补扣工资
    Route::resource('bukou', 'BukouController');
    Route::resource('bukou/search', 'BukouController@search');
    //扣三补
    Route::resource('koubu', 'KoubuController');
    Route::resource('koubu/search', 'KoubuController@search');
});

Route::group(['middleware'=>['web','admin.login'],'prefix'=>'gongzi','namespace' => 'Gongzi'], function () {
    //1.工资-明细、汇总
    Route::resource('mingxi', 'MxController');
    Route::resource('huizong', 'HzController');  //仅仅是需要index和searchName，另外不提供input的修改了
    Route::any('huizong2','HzController@index2');  //汇总表2(部门2)
    Route::any('god_mingxi','MxController@god');  //更新zw-gz-mx表
    Route::any('lin_mingxi','MxController@changeLin');  //更新zw-gz-mx表的lin
    Route::any('mx/search','MxController@search');  //
    //3.工资-个人所得税
    Route::resource('shui', 'ShuiController');
    Route::resource('shui/search', 'ShuiController@search');
    //4.工资发放表
    Route::resource('gongzi_zhaohang', 'ShuiController@fagongzi');
    //5.绩效工资明细表
    Route::resource('jixiao', 'JxController');
    Route::any('god_jixiao','JxController@god');  //更新zw-gz-mx表
    Route::any('changeif_jixiao','JxController@changeIf'); //开关上调20%状态
    Route::any('jiangjin','JxController@jiangjin'); //月绩效奖金
    Route::any('huizong_jx1','JxController@huizong1'); //绩效汇总表1
    Route::any('huizong_jx2','JxController@huizong2'); //绩效汇总表2
    //8.三补表
    Route::any('sanbu','JxController@sanbu'); //绩效汇总表2
});


