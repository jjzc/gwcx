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

    /*
     * 获取洗车记录
     */
    public function getWashRecord(){
    	//接收用户输入时间区间
		/*if(!empty($_POST["startTime"])){
            $map['start_time']  = array('gt',strtotime($_POST["startTime"]));//大于time区间
        }
        if(!empty($_POST["endTime"])){
            $map['end_time']  = array('elt',strtotime($_POST["endTime"])+24*3600);//小于等于time区间
        }*/
       //获取用户输入time区间筛选
    	if(!empty($_POST["startTime"])&&!empty($_POST["endTime"])){
            $map['wash_time']  = array('between',array(strtotime($_POST["startTime"]),strtotime($_POST["endTime"])+24*3600-1));
        }
        //获取用户输入车牌号
        if(!empty($_POST["car"])){
        	$key = $_POST["car"];
            $map['car_id'] = array('eq', $key);
        }
        //获取用户输入洗车地点
        if(!empty($_POST["wash_site"])){
        	$key = $_POST["wash_site"];
            $map['wash_shop_id'] = array('eq', $key);//根据表内ID值比对
        }
        
        $map["is_del"]=0;
        $resCount=M("CostWash")->where($map)->select();

        $total_cost = M("CostWash")->where($map)->sum("cost");

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
        $cars["total_cost"] = $total_cost;
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
            A("UserCenter")->logCreatWeb("删除洗车记录 ID为".$_POST["id"]);
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    /*
     * 新增洗车记录页面
     */
    public function addWashRecord($id = null){
        $cars=M("Car")->where("is_del=0")->select();
        $this->assign("cars",$cars);

        $shops=M("WashShop")->select();
        $this->assign("shops",$shops);

        if($id){
            $washRecord = M("costWash")->find($id);
            $this->assign("washRecord",$washRecord);
        }

        $this->display();
    }

    public function addWashRecordDo(){
        $_POST["wash_time"]=strtotime($_POST["wash_time"]);

        $id = $_POST["id"];

        if($id){
            $_POST["utime"] = time();

            $res=M("CostWash")->save($_POST);
            $car=M("Car")->find($_POST["car_id"]);
            A("UserCenter")->logCreatWeb("修改洗车记录 车牌为".$car["car_num"]);

        }else{
            $_POST["ctime"] = time();
            $_POST["utime"] = time();

            $res=M("CostWash")->add($_POST);
            $car=M("Car")->find($_POST["car_id"]);
            A("UserCenter")->logCreatWeb("添加洗车记录 车牌为".$car["car_num"]);
        }

        if($res){
            $this->ajaxReturn(array("code"=>1,'msg'=>$id ? '修改成功!':'新增成功!'));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }



    /*
     * 获取维修记录
     */
    public function getRepairRecord(){
       // $key= $_POST["search"]["value"];
		//接收用户输入时间区间
		if(!empty($_POST["startTime"])){
            $map['start_time']  = array('gt',strtotime($_POST["startTime"]));//大于time区间
        }
        if(!empty($_POST["endTime"])){
            $map['end_time']  = array('elt',strtotime($_POST["endTime"])+24*3600);//小于等于time区间
        }
        //接收用户输入车牌号
        if(!empty($_POST["car"])){
        	$key=$_POST["car"];
            //$map['car_num | seat_num | engine_num | frame_num | maintain_interval | compulsory_insurance_time | commercial_insurance_time | car_name | brand |old_company|new_company'] = array('like', "%$key%");
//            $map['car'] = array('like', "%$key%");
            $map['car_id'] = array('eq', "$key");
        }
        
        //接收用户输入维修地点
 	 	 if(!empty($_POST["repairsite"])){
       		$key=$_POST["repairsite"];//维修地点
            $map['repair_shop_id'] = array('eq', $key);//根据表内ID值比对
        }
 	 	//接收用户输入维修类型
 	 	 if(!empty($_POST["repairshop"])){
       		$key=$_POST["repairshop"];//维修类型
            $map['type'] = array('eq', $key);//根据表内ID值比对
        }
 	 	
		$map["is_del"]=0;
        $resCount=M("CostRepair")->where($map)->select();

//        @file_put_contents($_SERVER["DOCUMENT_ROOT"]."/jzw.txt"," sql:".M("CostRepair")->getLastSql(),FILE_APPEND);
        $total_cost = M("CostRepair")->where($map)->sum("cost");

        $order=array();
        switch ($_POST["order"][0]["column"])
        {
           case 1:
               $order["car_id"]=$_POST["order"][0]["dir"];
                break;
          //  case 2:
              //  $order["repair_shop_id"]=$_POST["order"][0]["dir"];
           //    break;
           // case 3:
             //   $order["type"]=$_POST["order"][0]["dir"];
             //  break;
            case 4:
             //  $order["reason"]=$_POST["order"][0]["dir"];
              //  break;
            case 5:
               // $mappp['repair_type_name'] =$_POST["order"][0]["dir"];
               // $repairname=M("RepairType")->find($resCount["type"]);
             //  $order["type"]=$repairname["id"];
                break;
           // case 6:
             //   $order["start_time"]=$_POST["order"][0]["dir"];
              //  break;
          //  case 7:
               // $order["end_time"]=$_POST["order"][0]["dir"];
              //  break;
        }
		
		
		if(!empty($_POST["car"])){
			$card_num= $_POST["car"];
			
            $map['car_id'] = array('like', "%$card_num%");
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
        $cars["total_cost"] = $total_cost;
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
        A("UserCenter")->logCreatWeb("删除维修记录 ID为".$_POST["id"]);
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

        $id = intval($_REQUEST["id"]);
        if($id){
            $repairRecord = M("costRepair")->find($id);
            $this->assign("repairRecord",$repairRecord);
        }

        $this->display();
    }

    /*
     * 新增维修记录写入数据
     */
    public function addRepairRecordDo(){
        $_POST["start_time"]=strtotime($_POST["start_time"]);//转换为时间戳格式
        $_POST["end_time"]=strtotime($_POST["end_time"]);//转换为时间戳格式


        $id = intval($_POST["id"]);

        if($id){
            $_POST["utime"] = time();
            $res=M("CostRepair")->save($_POST);
        }else{
            $_POST["ctime"] = time();
            $_POST["utime"] = time();
            $res=M("CostRepair")->add($_POST);
        }

        $type = $id ? '修改' : '新增';

        if($res){
            $car=M("Car")->find($_POST["car_id"]);
            A("UserCenter")->logCreatWeb($type."维修记录 车牌为".$car["car_num"]);
            $this->ajaxReturn(array("code"=>1,"msg"=>$type."成功!"));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }
	//调用加油站数据
	public function oilRecord(){
		$cars=M("car")->where("is_del=0")->select();
        $this->assign("cars",$cars);
		
		$shops=M("OilShop")->select();
		$this->assign("shops",$shops);
		
		$this->display();
	}
	//调用维修站数据
	public function repairRecord(){
		$cars=M("car")->where("is_del=0")->select();
        $this->assign("cars",$cars);
		
		$shops=M("repairShop")->select();
		$this->assign("shops",$shops);
		
		$type=M("repairType")->select();
		$this->assign("type",$type);
		
		$this->display();
	}
	//调用洗车数据
	public function washRecord(){
		$cars=M("car")->where("is_del=0")->select();
        $this->assign("cars",$cars);
		
		$shops=M("washShop")->select();
		$this->assign("shops",$shops);
		
		$this->display();
	}
	//调用年检数据
	public function insuranceRecord(){
		$cars=M("car")->where("is_del=0")->select();
        $this->assign("cars",$cars);
		$this->display();
	}
	
    /*
     * 获取加油记录
     */
    public function getOilRecord(){
		//搜索条件
		$startTime= $_POST["startTime"];
		$endTime= $_POST["endTime"];
		
		if(!empty($_POST["startTime"])){
            $map['trading_time']  = array('gt',strtotime($_POST["startTime"]));
        }
        if(!empty($_POST["endTime"])){
            $map['trading_time']  = array('elt',strtotime($_POST["endTime"])+24*3600);
        }

        if(!empty($_POST["startTime"])&&!empty($_POST["endTime"])){
            $map['trading_time']  = array('between',array(strtotime($_POST["startTime"]),strtotime($_POST["endTime"])+24*3600-1));
        }

		
		if($_POST["car"]!=0){
            $map['car_id'] = array('eq',$_POST["car"]);
        }
        if($_POST["oilshop"]!=0){
            $map['oil_shop_id'] = array('eq',$_POST["oilshop"]);
        }
		
		if(!empty($_POST["card_num"])){
			$card_num= $_POST["card_num"];
			
            $map['card_num'] = array('like', "%$card_num%");
        }
		
		if(!empty($_POST["serial_number"])){
			$serial_number= $_POST["serial_number"];
			
            $map['serial_number'] = array('like', "%$serial_number%");
        }

		//接收用户输入加油量
 	 	 if(!empty($_POST["fuel_charge"])){
       		$key=$_POST["fuel_charge"];//维修地点
            $map['fuel_charge'] = array('eq', $key);//根据表内ID值比对
        }

		//接收用户输入油耗
 	 	 if(!empty($_POST["oil_wear"])){
       		$key=$_POST["oil_wear"];//维修地点
            $map['oil_wear'] = array('eq', $key);//根据表内ID值比对
        }
		
        
		//搜索条件
		
        $map["is_del"]=0;




        $resCount=M("CostOil")->where($map)->select();

        $total_cost = M("CostOil")->where($map)->sum("cost");
        $total_fuel_charge = M("CostOil")->where($map)->sum("fuel_charge");


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

        $res=M("CostOil")->where($map)->order($order)->order("trading_time desc")->limit($_POST["start"],$_POST["length"])->select();
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
        $cars["total_cost"]=$total_cost;
        $cars["total_fuel_charge"]=$total_fuel_charge;
        $cars["data"]=$res;

        $this->ajaxReturn($cars);
    }


    /*
     * 删除加油记录
     */
    public function delOilRecord(){
        $record["id"]=$_POST["id"];
        $record["is_del"]=1;
        $res=M("CostOil")->save($record);
        A("UserCenter")->logCreatWeb("删除加油记录 ID为".$_POST["id"]);
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

        $id = intval($_REQUEST["id"]);
        if($id){
            $oilRecord = M("costOil")->find($id);
            $this->assign("oilRecord",$oilRecord);
        }

        $this->display();
    }

    /*
     * 新增维修记录写入数据
     */
    public function addOilRecordDo(){
        $_POST["trading_time"]=strtotime($_POST["trading_time"]);//转换为时间戳格式

        $id = intval($_POST["id"]);

        if($id){
            $_POST["utime"] = time();
            $res=M("CostOil")->save($_POST);
        }else{
            $_POST["ctime"] = time();
            $_POST["utime"] = time();
            $res=M("CostOil")->add($_POST);

        }

        $type = $id ? '修改' : '新增';


        if($res){

            $car=M("Car")->find($_POST["car_id"]);
            A("UserCenter")->logCreatWeb($type."加油记录 车牌号为".$car["car_num"]);

            $this->ajaxReturn(array("code"=>1,"msg"=>$type."成功!"));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }
	//年检保养
    public function getInsuranceRecord(){
    	//接收用户输入时间区间
		if(!empty($_POST["startTime"])){
            $map['effect_time']  = array('gt',strtotime($_POST["startTime"]));//大于time区间
        }
        if(!empty($_POST["endTime"])){//本次保养和下次保养时间都必须在此区间内
            $map['expire_time']  = array('elt',strtotime($_POST["endTime"])+24*3600);//小于等于time区间
        }
    	
    	//接收用户输入车牌号
 	 	 if(!empty($_POST["car"])){
       		$key=$_POST["car"];//维修类型
          	$map['car_id'] = array('eq', $key);//根据表内ID值比对
      	}
    
        $map["is_del"]=0;
        $resCount=M("CostInsurance")->where($map)->select();

        $total_cost = M("CostInsurance")->where($map)->sum("cost");   //总花费

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
        $cars["total_cost"] = $total_cost;
        $cars["data"]=$res;

        $this->ajaxReturn($cars);
    }

    public function addInsuranceRecord(){
        $carM=new CarModel();
        $cars=$carM->where("is_del=0")->select();
        $this->assign("cars",$cars);

        $id = intval($_REQUEST["id"]);
        if($id){
            $insuranceRecord = M("costInsurance")->find($id);
            $this->assign("insuranceRecord",$insuranceRecord);
        }

        $this->display();
    }

    public function addInsuranceRecordDo(){
        $_POST["pay_time"]=strtotime($_POST["pay_time"]);//转换为时间戳格式
        $_POST["effect_time"]=strtotime($_POST["effect_time"]);//转换为时间戳格式
        $_POST["expire_time"]=strtotime($_POST["expire_time"]);//转换为时间戳格式

        $id = intval($_POST["id"]);

        if($id){
            $_POST["utime"] = time();
            $res=M("CostInsurance")->save($_POST);
        }else{
            $_POST["ctime"] = time();
            $_POST["utime"] = time();
            $res=M("CostInsurance")->add($_POST);
        }

        $type = $id ? '修改' : '新增';

//        @file_put_contents($_SERVER["DOCUMENT_ROOT"]."/jzw.txt","\n\n sql:".M("CostInsurance")->getLastSql(),FILE_APPEND);
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
            if($_POST["cost_type"]==4){
                $data["vehicle_time"]=$_POST["expire_time"];
            }

            $car=M("Car")->find($_POST["car_id"]);
            A("UserCenter")->logCreatWeb($type."保险/保养记录,车牌号为".$car["car_num"]);
            $carM=new CarModel();

//            @file_put_contents($_SERVER["DOCUMENT_ROOT"]."/jzw.txt","\n\n data:".json_encode($data),FILE_APPEND);
            if($carM->save($data)){

                $this->ajaxReturn(array("code"=>1,"msg"=>$type."成功!"));

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

        $car=M("Car")->find($_POST["car_id"]);
        A("UserCenter")->logCreatWeb("删除保险/保养记录,车牌号为".$car["car_num"]);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }


    //洗车记录导出excel
    public function washRecordToExcel($page = 1){
        $Model = new CostWashModel();

        $start_time = $_POST["startTime"];//开始时间
        $end_time = $_POST["endTime"];//结束时间
        $car_id = $_POST["car"];//车牌号
        $wash_site = $_POST["wash_site"];//洗车地点

        $where = " where is_del = 0 ";

        if(!empty($start_time)){
            $where .= " and wash_time >= ".strtotime($start_time." 00:00:00");
        }
        if(!empty($end_time)){
            $where .= " and wash_time <= ".strtotime($end_time." 23:59:59");
        }
        if(!empty($car_id)){
            $where .= " and car_id = ".$car_id;
        }
        if(!empty($wash_site)){
            $where .= " and wash_shop_id = ".$wash_site;
        }

        $sort = " order by id asc";
        $sql = "select *  from ot_cost_wash";
        $limit = " limit ".(($page - 1)*1000).",1000 ";
        $list = $Model->query($sql.$where.$sort.$limit);
        if($list){
            register_shutdown_function(array(&$this, 'washRecordToExcel'), $page+1);

            //洗车商店
            $wash_shop=M("WashShop")->select();
            $wash_shops = array_column($wash_shop,"shop_name","id");

            //车牌号列表
            $car=M("car")->where("is_del=0")->select();
            $cars = array_column($car,"car_num","id");

            //导出数据
            header ( "Content-Type: text/html; charset=gbk" );
            header ( "Content-type:application/vnd.ms-excel" );
            $excel_name = "洗车记录";
            header ( "Content-Disposition:filename=" . iconv ( "UTF-8", "GBK", $excel_name ) . ".csv" );
            $fp = fopen('php://output', 'a');

            if($page == 1){
                $column_name = array("车牌号","洗车地点","洗车时间","费用","创建时间");
                foreach ($column_name as $i => $v) {
                    $column_name[$i] = iconv('utf-8', 'GB18030', $v);
                }
                fputcsv($fp, $column_name);
            }

            foreach ($list as $k=>$v){

                $data = array();
                $data[] = iconv('utf-8', 'GB18030', $cars[$v["car_id"]]);
                $data[] = iconv('utf-8', 'GB18030', $wash_shops[$v["wash_shop_id"]]);
                $data[] = iconv('utf-8', 'GB18030', date("Y-m-d",$v['wash_time']));
                $data[] = iconv('utf-8', 'GB18030', $v['cost']);
                $data[] = iconv('utf-8', 'GB18030', date("Y-m-d",$v['ctime']));
                fputcsv($fp, $data);
            }
            unset($list);
            ob_flush();
            flush();
        }else{
//            if($page==1)
//                $this->error("NullData");
            exit();
        }

    }

    //维护记录导出
    public function repairRecordToExcel($page = 1){
        $Model = new CostRepairModel();

        $start_time = trim($_POST["startTime"]);//开始时间
        $end_time = trim($_POST["endTime"]);//结束时间
        $car_id = trim($_POST["car"]);//车牌号
        $repairsite = intval($_POST["repairsite"]);//維修地点
        $repairshop = intval($_POST["repairshop"]);//维修类型

        $where = " where is_del = 0 ";

        if(!empty($start_time)){
            $where .= " and start_time > ".strtotime($start_time." 00:00:00");
        }
        if(!empty($end_time)){
            $where .= " and end_time <= ".strtotime($end_time." 23:59:59");
        }
        if(!empty($car_id)){
            $where .= " and car_id = ".$car_id;
        }
        if(!empty($repairsite)){
            $where .= " and repair_shop_id = ".$repairsite;
        }
        if(!empty($repairshop)){
            $where .= " and type = ".$repairshop;
        }

        $sort = " order by id asc";
        $sql = "select *  from ot_cost_repair";
        $limit = " limit ".(($page - 1)*1000).",1000 ";
        $list = $Model->query($sql.$where.$sort.$limit);
        if($list){
            register_shutdown_function(array(&$this, 'repairRecordToExcel'), $page+1);

            //维修地点
            $repair_shop=M("RepairShop")->select();
            $repair_shops = array_column($repair_shop,"shop_name","id");

            //维修类型
            $repair_type=M("RepairType")->select();
            $repair_types = array_column($repair_type,"repair_type_name","id");

            //车牌号列表
            $car=M("car")->where("is_del=0")->select();
            $cars = array_column($car,"car_num","id");

            //导出数据
            header ( "Content-Type: text/html; charset=gbk" );
            header ( "Content-type:application/vnd.ms-excel" );
            $excel_name = "维修记录";
            header ( "Content-Disposition:filename=" . iconv ( "UTF-8", "GBK", $excel_name ) . ".csv" );
            $fp = fopen('php://output', 'a');

            if($page == 1){
                $column_name = array("车牌号","维修地点","维修类型","维修原因","费用","进厂时间","出厂时间");
                foreach ($column_name as $i => $v) {
                    $column_name[$i] = iconv('utf-8', 'GB18030', $v);
                }
                fputcsv($fp, $column_name);
            }

            foreach ($list as $k=>$v){

                $data = array();
                $data[] = iconv('utf-8', 'GB18030', $cars[$v["car_id"]]);
                $data[] = iconv('utf-8', 'GB18030', $repair_shops[$v["repair_shop_id"]]);
                $data[] = iconv('utf-8', 'GB18030', $repair_types[$v["type"]]);
                $data[] = iconv('utf-8', 'GB18030', $v["reason"]);
                $data[] = iconv('utf-8', 'GB18030', $v['cost']);
                $data[] = iconv('utf-8', 'GB18030', date("Y-m-d",$v['start_time']));
                $data[] = iconv('utf-8', 'GB18030', date("Y-m-d",$v['end_time']));
                fputcsv($fp, $data);
            }
            unset($list);
            ob_flush();
            flush();
        }else{
//            if($page==1)
//                $this->error("NullData");
            exit();
        }
    }

    //加油记录导出
    public function oilRecordToExcel($page = 1){
        $Model = new CostRepairModel();

        $start_time = trim($_POST["startTime"]);//开始时间
        $end_time = trim($_POST["endTime"]);//结束时间
        $car_id = trim($_POST["car"]);//车牌号
        $oilshop = trim($_POST["oilshop"]);//加油地点
        $card_num = trim($_POST["card_num"]);//卡号
        $serial_number = trim($_POST["serial_number"]);//流水号
        $fuel_charge = trim($_POST["fuel_charge"]);//加油量
        $oil_wear = trim($_POST["oil_wear"]);//百公里油耗

        $where = " where is_del = 0 ";

        if(!empty($start_time)){
            $where .= " and trading_time > ".strtotime($start_time." 00:00:00");
        }
        if(!empty($end_time)){
            $where .= " and trading_time <= ".strtotime($end_time." 23:59:59");
        }
        if(!empty($car_id)){
            $where .= " and car_id = ".$car_id;
        }
        if(!empty($oilshop)){
            $where .= " and oil_shop_id = ".$oilshop;
        }
        if(!empty($card_num)){
            $where .= " and card_num = ".$card_num;
        }
        if(!empty($serial_number)){
            $where .= " and serial_number = ".$serial_number;
        }
        if(!empty($fuel_charge)){
            $where .= " and fuel_charge = ".$fuel_charge;
        }
        if(!empty($oil_wear)){
            $where .= " and oil_wear = ".$oil_wear;
        }

        $sort = " order by id asc";
        $sql = "select *  from ot_cost_oil";
        $limit = " limit ".(($page - 1)*1000).",1000 ";
        $list = $Model->query($sql.$where.$sort.$limit);
        if($list){
            register_shutdown_function(array(&$this, 'oilRecordToExcel'), $page+1);

            //加油站
            $oil_shop=M("OilShop")->select();
            $oil_shops = array_column($oil_shop,"oil_name","id");

            //车牌号列表
            $car=M("car")->where("is_del=0")->select();
            $cars = array_column($car,"car_num","id");

            //导出数据
            header ( "Content-Type: text/html; charset=gbk" );
            header ( "Content-type:application/vnd.ms-excel" );
            $excel_name = "加油记录";
            header ( "Content-Disposition:filename=" . iconv ( "UTF-8", "GBK", $excel_name ) . ".csv" );
            $fp = fopen('php://output', 'a');

            if($page == 1){
                $column_name = array("车牌号","加油地点","加油量","油耗","费用","卡号","POS号","流水号","加油时间");
                foreach ($column_name as $i => $v) {
                    $column_name[$i] = iconv('utf-8', 'GB18030', $v);
                }
                fputcsv($fp, $column_name);
            }

            foreach ($list as $k=>$v){

                $data = array();
                $data[] = iconv('utf-8', 'GB18030', $cars[$v["car_id"]]);
                $data[] = iconv('utf-8', 'GB18030', $oil_shops[$v["oil_shop_id"]]);
                $data[] = iconv('utf-8', 'GB18030', $v["fuel_charge"]);
                $data[] = iconv('utf-8', 'GB18030', $v["oil_wear"]);
                $data[] = iconv('utf-8', 'GB18030', $v["cost"]);
                $data[] = iconv('utf-8', 'GB18030', $v['card_num']);
                $data[] = iconv('utf-8', 'GB18030', $v['pos_num']);
                $data[] = iconv('utf-8', 'GB18030', $v['serial_number']);
                $data[] = iconv('utf-8', 'GB18030', date("Y-m-d",$v['trading_time']));
                fputcsv($fp, $data);
            }
            unset($list);
            ob_flush();
            flush();
        }else{
//            if($page==1)
//                $this->error("NullData");
            exit();
        }
    }

    public function insuranceRecordToExcel($page = 1){
        $Model = new CostInsuranceModel();

        $start_time = trim($_POST["startTime"]);//开始时间
        $end_time = trim($_POST["endTime"]);//结束时间
        $car_id = intval($_POST["car"]);//车牌号

        $where = " where is_del = 0 ";

        if(!empty($start_time)){
            $where .= " and effect_time > ".strtotime($start_time." 00:00:00");
        }
        if(!empty($end_time)){
            $where .= " and expire_time <= ".strtotime($end_time." 23:59:59");
        }
        if(!empty($car_id)){
            $where .= " and car_id = ".$car_id;
        }

        $sort = " order by id asc";
        $sql = "select *  from ot_cost_insurance";
        $limit = " limit ".(($page - 1)*1000).",1000 ";
        $list = $Model->query($sql.$where.$sort.$limit);
        if($list){
            register_shutdown_function(array(&$this, 'oilRecordToExcel'), $page+1);

            //缴费类型
            $type = array( 1 => "交强险" ,  2 => "商业险" , 3 => "年检" , 4 => "车船税");

            //车牌号列表
            $car=M("car")->where("is_del=0")->select();
            $cars = array_column($car,"car_num","id");

            //导出数据
            header ( "Content-Type: text/html; charset=gbk" );
            header ( "Content-type:application/vnd.ms-excel" );
            $excel_name = "年检/保养记录";
            header ( "Content-Disposition:filename=" . iconv ( "UTF-8", "GBK", $excel_name ) . ".csv" );
            $fp = fopen('php://output', 'a');

            if($page == 1){
                $column_name = array("车牌号","缴费类型","花费","缴费时间","生效时间","到期时间");
                foreach ($column_name as $i => $v) {
                    $column_name[$i] = iconv('utf-8', 'GB18030', $v);
                }
                fputcsv($fp, $column_name);
            }

            foreach ($list as $k=>$v){

                $data = array();
                $data[] = iconv('utf-8', 'GB18030', $cars[$v["car_id"]]);
                $data[] = iconv('utf-8', 'GB18030', $type[$v["cost_type"]]);
                $data[] = iconv('utf-8', 'GB18030', $v["cost"]);
                $data[] = iconv('utf-8', 'GB18030', date("Y-m-d",$v['pay_time']));
                $data[] = iconv('utf-8', 'GB18030', date("Y-m-d",$v['effect_time']));
                $data[] = iconv('utf-8', 'GB18030', date("Y-m-d",$v['expire_time']));
                fputcsv($fp, $data);
            }
            unset($list);
            ob_flush();
            flush();
        }else{
//            if($page==1)
//                $this->error("NullData");
            exit();
        }
    }
}