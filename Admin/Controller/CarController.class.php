<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/28
 * Time: 14:07
 */

namespace Admin\Controller;


use Model\CarTypeModel;
use Model\PayTypeModel;
use Model\SetModel;
use Model\TravelNatureModel;
use Model\TravelTempModel;
use PHPExcel;
use Think\Controller;
use Model\TravelModel;
use Model\TravelTypeModel;
use Model\CarModel;
use Model\DriverModel;
use Model\ArrangeTypeModel;
use Model\UserModel;
use Model\CompanyModel;
use Think\Upload;
use Model\CostWashModel;
use Model\CostRepairModel;
use Model\CostOilModel;
use Model\CostInsuranceModel;

class CarController extends CommonController
{
    public function allCars(){
        $this->display();
    }

    public function getAllCars(){
        //$_POST["order"][0]["column"];
        //$_POST["order"][0]["dir"];



        //dump($_POST);



        $key= $_POST["search"]["value"];
        $map["is_del"]=0;
        if(!empty($key)){
            $map['car_num | seat_num | engine_num | frame_num | maintain_interval | compulsory_insurance_time | commercial_insurance_time | car_name | brand |old_company|new_company'] = array('like', "%$key%");
        }
        $resCount=M("Car")->where($map)->select();

        $order=array();
        switch ($_POST["order"][0]["column"])
        {
            case 1:
                $order["number"]=$_POST["order"][0]["dir"];
                break;
            case 2:
                $order["car_num"]=$_POST["order"][0]["dir"];
                break;
            case 3:
                $order["type_id"]=$_POST["order"][0]["dir"];
                break;
            case 4:
                $order["is_law_car"]=$_POST["order"][0]["dir"];
                break;
            case 5:
                $order["car_name"]=$_POST["order"][0]["dir"];
                break;
            case 6:
                $order["seat_num"]=$_POST["order"][0]["dir"];
                break;
//            case 7:
//                $order["id"]=$_POST["order"][0]["dir"];
//                break;
            case 8:
                $order["is_dx"]=$_POST["order"][0]["dir"];
                break;
            case 9:
                $order["state"]=$_POST["order"][0]["dir"];
                break;
        }

        $res=M("Car")->where($map)->order($order)->limit($_POST["start"],$_POST["length"])->select();

        //此处需要再次处理下数据
        $costWashM=new CostWashModel();
        $costRepairM=new CostRepairModel();
        $costOilM=new CostOilModel();
        $travelM=new TravelModel();
        $costInsuranceM=new CostInsuranceModel();
        $carTypeM=new CarTypeModel();
        for($i=0;$i<count($res)&& count($res);$i++){

            //获取洗车花费总数
            $res[$i]["costWash"]=$costWashM->where (array("car_id"=>$res[$i]["id"]))->where("is_del=0")->sum("cost");
            if(!($res[$i]["costWash"])){$res[$i]["costWash"]=0;}

            //获取维修花费总数
            $res[$i]["costRepair"]=$costRepairM->where(array("car_id"=>$res[$i]["id"]))->where("is_del=0")->sum("cost");
            if(!($res[$i]["costRepair"])){$res[$i]["costRepair"]=0;}

            //获取加油花费总数
            $res[$i]["costOil"]=$costOilM->where(array("car_id"=>$res[$i]["id"]))->where("is_del=0")->sum("cost");
            if(!($res[$i]["costOil"])){$res[$i]["costOil"]=0;}

            //获取过路费
            $res[$i]["costFees"]=$travelM->where("car_id=".$res[$i]["id"])->where("is_del=0")->sum("fees_sum");
            if(!($res[$i]["costFees"])){$res[$i]["costFees"]=0;}

            //获取停车费
            $res[$i]["costParkingRate"]=$travelM->where("car_id=".$res[$i]["id"])->where("is_del=0")->sum("parking_rate_sum");
            if(!($res[$i]["costParkingRate"])){$res[$i]["costParkingRate"]=0;}


            //获取保险花费总数
            $res[$i]["costInsurance"]=$costInsuranceM->where("car_id=".$res[$i]["id"]." and cost_type<3 and is_del=0")->sum("cost");
            if(!($res[$i]["costInsurance"])){$res[$i]["costInsurance"]=0;}

            //获取年检花费总数
            $res[$i]["costInspect"]=$costInsuranceM->where("car_id=".$res[$i]["id"]." and cost_type=3 and is_del=0")->sum("cost");
            if(!($res[$i]["costInspect"])){$res[$i]["costInspect"]=0;}



            $res[$i]["costSum"]=$res[$i]["costWash"]+$res[$i]["costRepair"]+$res[$i]["costOil"]+$res[$i]["costInsurance"]+$res[$i]["costInspect"]+$res[$i]["costFees"]+$res[$i]["costParkingRate"];





            $res[$i]["countMaintain"]=$travelM->where(array("car_id"=>$res[$i]["id"]))->where("is_del=0")->sum("mileage");
            if(!($res[$i]["countMaintain"])){$res[$i]["countMaintain"]=0;}
            $carType=$carTypeM->find($res[$i]["type_id"]);
            $res[$i]["carTypeName"]=$carType["type_name"];


        }

        //返回数据
        $cars=array();
        $cars["draw"]=$_POST["draw"];
        $cars["recordsTotal"]=count($resCount);//总记录条数
        $cars["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $cars["data"]=$res;




        $this->ajaxReturn($cars);
    }

    public function recycleCars(){
        $this->display();
    }

    public function getRecycleCars(){
        $resCount=M("Car")->where("is_del=1")->select();

        $map["is_del"]=0;
        $order=array();
        switch ($_POST["order"][0]["column"])
        {
            case 1:
                $order["number"]=$_POST["order"][0]["dir"];
                break;
            case 2:
                $order["car_num"]=$_POST["order"][0]["dir"];
                break;
            case 3:
                $order["type_id"]=$_POST["order"][0]["dir"];
                break;
            case 4:
                $order["is_law_car"]=$_POST["order"][0]["dir"];
                break;
            case 5:
                $order["car_name"]=$_POST["order"][0]["dir"];
                break;
            case 6:
                $order["seat_num"]=$_POST["order"][0]["dir"];
                break;
//            case 7:
//                $order["id"]=$_POST["order"][0]["dir"];
//                break;
            case 8:
                $order["state"]=$_POST["order"][0]["dir"];
                break;
        }

        $res=M("Car")->where("is_del=1")->order($order)->limit($_POST["start"],$_POST["length"])->select();

        //此处需要再次处理下数据
        $costWashM=new CostWashModel();
        $costRepairM=new CostRepairModel();
        $costOilM=new CostOilModel();
        $travelM=new TravelModel();
        $costInsuranceM=new CostInsuranceModel();
        $carTypeM=new CarTypeModel();
        for($i=0;$i<count($res)&& count($res);$i++){

            //获取洗车花费总数
            $res[$i]["costWash"]=$costWashM->where (array("car_id"=>$res[$i]["id"]))->where("is_del=0")->sum("cost");
            if(!($res[$i]["costWash"])){$res[$i]["costWash"]=0;}

            //获取维修花费总数
            $res[$i]["costRepair"]=$costRepairM->where(array("car_id"=>$res[$i]["id"]))->where("is_del=0")->sum("cost");
            if(!($res[$i]["costRepair"])){$res[$i]["costRepair"]=0;}

            //获取加油花费总数
            $res[$i]["costOil"]=$costOilM->where(array("car_id"=>$res[$i]["id"]))->where("is_del=0")->sum("cost");
            if(!($res[$i]["costOil"])){$res[$i]["costOil"]=0;}

            //获取过路费
            $res[$i]["costFees"]=$travelM->where("car_id=".$res[$i]["id"])->where("is_del=0")->sum("fees_sum");
            if(!($res[$i]["costFees"])){$res[$i]["costFees"]=0;}

            //获取停车费
            $res[$i]["costParkingRate"]=$travelM->where("car_id=".$res[$i]["id"])->where("is_del=0")->sum("parking_rate_sum");
            if(!($res[$i]["costParkingRate"])){$res[$i]["costParkingRate"]=0;}


            //获取保险花费总数
            $res[$i]["costInsurance"]=$costInsuranceM->where("car_id=".$res[$i]["id"]." and cost_type<3 and is_del=0")->sum("cost");
            if(!($res[$i]["costInsurance"])){$res[$i]["costInsurance"]=0;}

            //获取年检花费总数
            $res[$i]["costInspect"]=$costInsuranceM->where("car_id=".$res[$i]["id"]." and cost_type=3 and is_del=0")->sum("cost");
            if(!($res[$i]["costInspect"])){$res[$i]["costInspect"]=0;}



            $res[$i]["costSum"]=$res[$i]["costWash"]+$res[$i]["costRepair"]+$res[$i]["costOil"]+$res[$i]["costInsurance"]+$res[$i]["costInspect"]+$res[$i]["costFees"]+$res[$i]["costParkingRate"];





            $res[$i]["countMaintain"]=$travelM->where(array("car_id"=>$res[$i]["id"]))->where("is_del=0")->sum("mileage");
            if(!($res[$i]["countMaintain"])){$res[$i]["countMaintain"]=0;}
            $carType=$carTypeM->find($res[$i]["type_id"]);
            $res[$i]["carTypeName"]=$carType["type_name"];


        }

        //返回数据
        $cars=array();
        $cars["draw"]=$_POST["draw"];
        $cars["recordsTotal"]=count($resCount);//总记录条数
        $cars["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $cars["data"]=$res;

        $this->ajaxReturn($cars);
    }

    public function allCarTypes(){


        $this->display();
    }

    public function getAllCarTypes(){
        $resCount=M("CarType")->select();

        $res=M("CarType")->limit($_POST["start"],$_POST["length"])->select();

        //返回数据
        $carTypes=array();
        $carTypes["draw"]=$_POST["draw"];
        $carTypes["recordsTotal"]=count($resCount);//总记录条数
        $carTypes["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $carTypes["data"]=$res;

        $this->ajaxReturn($carTypes);
    }

    public function addCar(){
        $carTypes=M("CarType")->select();
        $this->assign("carTypes",$carTypes);

        //获取所有单位
        $companys=M("Company")->where("is_del=0")->select();
        $this->assign("companys",$companys);

        //获取所有定向司机
        $drivers=M("Driver")->where("is_del=0 and is_dx=1 and is_band=0")->select();
        $this->assign("drivers",$drivers);

        $this->display();
    }

    public function addCarDo(){
        $carM=new CarModel();

        $_POST["compulsory_insurance_time"]=strtotime($_POST["compulsory_insurance_time"]);
        $_POST["commercial_insurance_time"]=strtotime($_POST["commercial_insurance_time"]);
        $_POST["next_inspect_time"]=strtotime($_POST["next_inspect_time"]);
        $_POST["buy_time"]=strtotime($_POST["buy_time"]);

        if($_POST["is_dx"]==1){
            //将司机的is_band属性设置为1
            $driver_id=$_POST["driver_id"];
            $driver["id"]=$driver_id;
            $driver["is_band"]=1;
            M("Driver")->save($driver);
        }else{
            unset($_POST["company_id"]);
            unset($_POST["driver_id"]);
        }


        A("UserCenter")->logCreatWeb("添加车辆 ".$_POST["car_num"]);

        if($carM->add($_POST)){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    public function delCar(){
        $id=$_POST["id"];

        $car["id"]=$id;
        $car["is_del"]=1;

        $carinfo=M("Car")->find($id);
        A("UserCenter")->logCreatWeb("删除车辆 ".$carinfo["car_num"]);

        $res=M("Car")->save($car);
        $this->ajaxReturn(array("code"=>$res));
    }

    /*
     * 新增车辆类型页面展示
     */
    public function addCarType(){
        $this->display();
    }



    /*
     * 新增车辆数据写入
     */
    public function addCarTypeDo(){
        $res=M("CarType")->add($_POST);
        if($res){

            A("UserCenter")->logCreatWeb("添加车辆类型 ".$_POST["type_name"]);

            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    public function editCarType($id){
        $carType=M("CarType")->find($id);
        $this->assign("carType",$carType);
        $this->display();
    }

    public function editCarTypeDo(){
        $old=M("CarType")->find($_POST["id"]);
        $res=M("CarType")->save($_POST);

        A("UserCenter")->logCreatWeb("修改车辆类型 原车辆类型".$old["type_name"]." 新车辆类型".$_POST["type_name"] );
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    /*
     * 修改查看车辆展示页面
     */
    public function editCar($id){
        $car=M("Car")->find($id);
        $this->assign("car",$car);

        $carTypes=M("CarType")->select();
        $this->assign("carTypes",$carTypes);

        //获取所有单位
        $companys=M("Company")->where("is_del=0")->select();
        $this->assign("companys",$companys);

        //获取所有定向司机
        $drivers=M("Driver")->where("is_del=0 and is_dx=1")->select();
        $this->assign("drivers",$drivers);

        $this->display();
    }

    public function viewCar($id){
        $car=M("Car")->find($id);
        $this->assign("car",$car);

        $carTypes=M("CarType")->select();
        $this->assign("carTypes",$carTypes);

        $this->display();
    }

    /*
     * 修改车辆数据写入
     */
    public function editCarDo(){
        $res=M("Car")->save($_POST);
        A("UserCenter")->logCreatWeb("修改车辆信息 ".$_POST["car_num"]);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }


}