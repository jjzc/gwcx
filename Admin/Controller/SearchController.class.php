<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/2
 * Time: 21:00
 */

namespace Admin\Controller;

use Model\PayTypeModel;
use Model\SetModel;
use Model\TravelNatureModel;
use Model\TravelTempModel;
use Think\Controller;
use Model\TravelModel;
use Model\TravelTypeModel;
use Model\CarModel;
use Model\DriverModel;
use Model\ArrangeTypeModel;
use Model\UserModel;
use Model\CompanyModel;

class SearchController extends CommonController
{


    //获取单位关键字搜索的下拉列表数据
    public function companyList()
    {
        $key = trim($_REQUEST['key']);
        if (empty($key)) {
            $this->ajaxReturn(array("data" => ""));
        }

        $model = new CompanyModel();
        $data  = $model->where(array("is_del"=>0,"company_name" => array("like", "%" . $key . "%")))->limit(20)->field("id , company_name as name")->select();
        $this->ajaxReturn(array("data" => $data));
    }

    //获取车牌号关键字搜索的下拉列表数据
    public function carList()
    {
        $key = trim($_REQUEST['key']);
        if (empty($key)) {
            $this->ajaxReturn(array("data" => ""));
        }

        $model = new CarModel();
        $data  = $model->where(array("is_del"=>0,"car_num" => array("like", "%" . $key . "%")))->limit(20)->field("id,car_num as name")->select();
        $this->ajaxReturn(array("data" => $data));
    }

    //获取用户关键字（姓名和手机号码）搜索的下拉列表数据
    public function userList()
    {
        $key = trim($_REQUEST['key']);
        if (empty($key)) {
            $this->ajaxReturn(array("data" => ""));
        }

        $model = new UserModel();

        $data = $model->where(array("is_del"=>0,"user_phone" => array("like", "%" . $key . "%")))->limit(20)->field("user_phone as name")->select();

        if (empty($data)) {
            $data = $model->where(array("is_del"=>0,"user_name" => array("like", "%" . $key . "%")))->limit(20)->field("user_name as name")->select();
        }

        $this->ajaxReturn(array("data" => $data));
    }

    //获取司机关键字(姓名和手机号码)搜索的下拉列表数据
    public function driverList()
    {
        $key = trim($_REQUEST['key']);
        if (empty($key)) {
            $this->ajaxReturn(array("data" => ""));
        }

        $model = new DriverModel();

        $data = $model->where(array("is_del"=>0,"driver_phone" => array("like", "%" . $key . "%")))->limit(20)->field("id , driver_phone as name")->select();

        if (empty($data)) {
            $data = $model->where(array("is_del"=>0,"driver_name" => array("like", "%" . $key . "%")))->limit(20)->field("id , driver_name as name")->select();
        }

        $this->ajaxReturn(array("data" => $data));
    }

}


