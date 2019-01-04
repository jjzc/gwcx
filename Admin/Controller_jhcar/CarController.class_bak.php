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
        $res=M("CarType")->save($_POST);
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
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    /*
     * 获取洗车记录
     */
    public function getWashRecord(){
        $map["is_del"]=0;
        $resCount=M("CostWash")->where($map)->select();


        $order=array();
        switch ($_POST["order"][0]["column"])
        {
            case 1:
                $order["car_id"]=$_POST["order"][0]["dir"];
                break;
            case 2:
                $order["wash_shop_id"]=$_POST["order"][0]["dir"];
                break;
            case 3:
                $order["wash_time"]=$_POST["order"][0]["dir"];
                break;
            case 4:
                $order["cost"]=$_POST["order"][0]["dir"];
                break;
        }

        $res=M("CostWash")->where($map)->order($order)->limit($_POST["start"],$_POST["length"])->select();
        for($i=0;$i<count($res)&& count($res);$i++){
            $carM=new CarModel();
            $car=$carM->find($res[$i]["car_id"]);
            $res[$i]["car_num"]=$car["car_num"];


            $washshop=M("WashShop")->find($res[$i]["wash_shop_id"]);
            $res[$i]["shop_name"]=$washshop["shop_name"];
        }

        //返回数据
        $cars=array();
        $cars["draw"]=$_POST["draw"];
        $cars["recordsTotal"]=count($resCount);//总记录条数
        $cars["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $cars["data"]=$res;

        $this->ajaxReturn($cars);
    }

    /*
     * 删除洗车记录
     */
    public function delWashRecord(){
        $record["id"]=$_POST["id"];
        $record["is_del"]=1;
        $res=M("CostWash")->save($record);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    /*
     * 新增洗车记录页面
     */
    public function addWashRecord(){
        $cars=M("Car")->where("is_del=0")->select();
        $this->assign("cars",$cars);

        $shops=M("WashShop")->select();
        $this->assign("shops",$shops);

        $this->display();
    }

    public function addWashRecordDo(){
        $_POST["wash_time"]=strtotime($_POST["wash_time"]);
        $res=M("CostWash")->add($_POST);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }



    /*
     * 获取维修记录
     */
    public function getRepairRecord(){
        $map["is_del"]=0;
        $resCount=M("CostRepair")->where($map)->select();


        $order=array();
        switch ($_POST["order"][0]["column"])
        {
            case 1:
                $order["car_id"]=$_POST["order"][0]["dir"];
                break;
            case 2:
                $order["repair_shop_id"]=$_POST["order"][0]["dir"];
                break;
            case 3:
                $order["type"]=$_POST["order"][0]["dir"];
                break;
            case 4:
                $order["reason"]=$_POST["order"][0]["dir"];
                break;
            case 5:
                $order["cost"]=$_POST["order"][0]["dir"];
                break;
            case 6:
                $order["start_time"]=$_POST["order"][0]["dir"];
                break;
            case 7:
                $order["end_time"]=$_POST["order"][0]["dir"];
                break;
        }

        $res=M("CostRepair")->where($map)->order($order)->limit($_POST["start"],$_POST["length"])->select();
        for($i=0;$i<count($res)&& count($res);$i++){
            $carM=new CarModel();
            $car=$carM->find($res[$i]["car_id"]);
            $res[$i]["car_num"]=$car["car_num"];

            $repairShop=M("RepairShop")->find($res[$i]["repair_shop_id"]);
            $res[$i]["shop_name"]=$repairShop["shop_name"];
            $repairType=M("RepairType")->find($res[$i]["type"]);
            $res[$i]["repairTypeName"]=$repairType["repair_type_name"];

            $res[$i]["frame_num"]=$car["frame_num"];
            $res[$i]["engine_num"]=$car["engine_num"];
            $res[$i]["buy_time"]=$car["buy_time"];
            $res[$i]["new_company"]=$car["new_company"];
            $res[$i]["old_company"]=$car["old_company"];
        }

        //返回数据
        $cars=array();
        $cars["draw"]=$_POST["draw"];
        $cars["recordsTotal"]=count($resCount);//总记录条数
        $cars["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $cars["data"]=$res;

        $this->ajaxReturn($cars);
    }

    /*
     * 删除维修记录
     */
    public function delRepairRecord(){
        $record["id"]=$_POST["id"];
        $record["is_del"]=1;
        $res=M("CostRepair")->save($record);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    /*
     * 新增维修记录
     */
    public function addRepairRecord(){
        $carM=new CarModel();
        $cars=$carM->where("is_del=0")->select();
        $this->assign("cars",$cars);

        $shops=M("RepairShop")->select();
        $this->assign("shops",$shops);


        $repairTypes=M("RepairType")->select();
        $this->assign("repairTypes",$repairTypes);

        $this->display();
    }

    /*
     * 新增维修记录写入数据
     */
    public function addRepairRecordDo(){
        $_POST["start_time"]=strtotime($_POST["start_time"]);//转换为时间戳格式
        $_POST["end_time"]=strtotime($_POST["end_time"]);//转换为时间戳格式

        $res=M("CostRepair")->add($_POST);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    /*
     * 获取加油记录
     */
    public function getOilRecord(){
        $map["is_del"]=0;
        $resCount=M("CostOil")->where($map)->select();


        $order=array();
        switch ($_POST["order"][0]["column"])
        {
            case 1:
                $order["car_id"]=$_POST["order"][0]["dir"];
                break;
            case 2:
                $order["oil_shop_id"]=$_POST["order"][0]["dir"];
                break;
            case 3:
                $order["cost"]=$_POST["order"][0]["dir"];
                break;
            case 4:
                $order["card_num"]=$_POST["order"][0]["dir"];
                break;
            case 5:
                $order["pos_num"]=$_POST["order"][0]["dir"];
                break;
            case 6:
                $order["serial_number"]=$_POST["order"][0]["dir"];
                break;
            case 7:
                $order["trading_time"]=$_POST["order"][0]["dir"];
                break;
        }

        $res=M("CostOil")->where($map)->order($order)->limit($_POST["start"],$_POST["length"])->select();
        for($i=0;$i<count($res)&& count($res);$i++){
            $carM=new CarModel();
            $car=$carM->find($res[$i]["car_id"]);
            $res[$i]["car_num"]=$car["car_num"];

            $oilshop=M("OilShop")->find($res[$i]["oil_shop_id"]);
            $res[$i]["oil_name"]=$oilshop["oil_name"];
        }

        //返回数据
        $cars=array();
        $cars["draw"]=$_POST["draw"];
        $cars["recordsTotal"]=count($resCount);//总记录条数
        $cars["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $cars["data"]=$res;

        $this->ajaxReturn($cars);
    }


    /*
     * 删除维修记录
     */
    public function delOilRecord(){
        $record["id"]=$_POST["id"];
        $record["is_del"]=1;
        $res=M("CostOil")->save($record);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    /*
     * 新增维修记录
     */
    public function addOilRecord(){
        $carM=new CarModel();
        $cars=$carM->where("is_del=0")->select();
        $this->assign("cars",$cars);

        $shops=M("OilShop")->select();
        $this->assign("shops",$shops);



        $this->display();
    }

    /*
     * 新增维修记录写入数据
     */
    public function addOilRecordDo(){
        $_POST["trading_time"]=strtotime($_POST["trading_time"]);//转换为时间戳格式

        $res=M("CostOil")->add($_POST);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    public function getInsuranceRecord(){
        $map["is_del"]=0;
        $resCount=M("CostInsurance")->where($map)->select();


        $order=array();
        switch ($_POST["order"][0]["column"])
        {
            case 1:
                $order["car_id"]=$_POST["order"][0]["dir"];
                break;
            case 2:
                $order["cost_type"]=$_POST["order"][0]["dir"];
                break;
            case 3:
                $order["cost"]=$_POST["order"][0]["dir"];
                break;
            case 4:
                $order["pay_time"]=$_POST["order"][0]["dir"];
                break;
            case 5:
                $order["effect_time"]=$_POST["order"][0]["dir"];
                break;
            case 6:
                $order["expire_time"]=$_POST["order"][0]["dir"];
                break;
        }

        $res=M("CostInsurance")->where($map)->order($order)->limit($_POST["start"],$_POST["length"])->select();
        for($i=0;$i<count($res)&& count($res);$i++){
            $carM=new CarModel();
            $car=$carM->find($res[$i]["car_id"]);
            $res[$i]["car_num"]=$car["car_num"];
        }

        //返回数据
        $cars=array();
        $cars["draw"]=$_POST["draw"];
        $cars["recordsTotal"]=count($resCount);//总记录条数
        $cars["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $cars["data"]=$res;

        $this->ajaxReturn($cars);
    }

    public function addInsuranceRecord(){
        $carM=new CarModel();
        $cars=$carM->where("is_del=0")->select();
        $this->assign("cars",$cars);




        $this->display();
    }

    public function addInsuranceRecordDo(){
        $_POST["pay_time"]=strtotime($_POST["pay_time"]);//转换为时间戳格式
        $_POST["effect_time"]=strtotime($_POST["effect_time"]);//转换为时间戳格式
        $_POST["expire_time"]=strtotime($_POST["expire_time"]);//转换为时间戳格式

        $res=M("CostInsurance")->add($_POST);
        if($res){
            $data=array();
            $data["id"]=$_POST["car_id"];
            if($_POST["cost_type"]==1){
                $data["compulsory_insurance_time"]=$_POST["expire_time"];
            }
            if($_POST["cost_type"]==2){
                $data["commercial_insurance_time"]=$_POST["expire_time"];
            }
            if($_POST["cost_type"]==3){
                $data["next_inspect_time"]=$_POST["expire_time"];
            }
            $carM=new CarModel();
            if($carM->save($data)){
                $this->ajaxReturn(array("code"=>1));
            }else{
                $this->ajaxReturn(array("code"=>0));
            }

        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    public function delInsuranceRecord(){
        $record["id"]=$_POST["id"];
        $record["is_del"]=1;
        $res=M("CostInsurance")->save($record);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }



}