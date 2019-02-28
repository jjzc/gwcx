<?php
namespace Admin\Controller;
use Model\ArrangeTypeModel;
use Model\CarModel;
use Model\CostInsuranceModel;
use Model\CostOilModel;
use Model\CostRepairModel;
use Model\CostWashModel;
use Model\DriverModel;
use Model\TravelModel;
use Model\TravelTypeModel;
use Model\UserModel;
use Model\CompanyModel;


class StatisticsController extends CommonController {

    public function byCompany(){
        $company = M("company")->where(array("is_del"=>0))->field("id,company_name")->select();

        $this->assign("company",$company);
        $this->display();
    }

    public function byCompanyData(){


        $mapc["is_del"]=0;
        $map["is_del"]=array('eq',0);
        if(!empty($_POST["startTime"])){
            $map['departure_time']  = array('gt',strtotime($_POST["startTime"]));
        }
        if(!empty($_POST["endTime"])){
            $map['departure_time']  = array('elt',strtotime($_POST["endTime"])+24*3600);
        }
        if((!empty($_POST["startTime"]))&&!empty($_POST["endTime"])){
            $map['departure_time']  = array('between',array(strtotime($_POST["startTime"]),strtotime($_POST["endTime"])+24*3600));
        }
        if($_POST["company"]){
            $mapc["id"]=array("in",$_POST["company"]);
        }

        $companyM=new CompanyModel();
        if(!empty($_REQUEST["searchKey"])){
            $ids = $companyM->where(array("company_name" => array("like", "%" . trim($_REQUEST["searchKey"]) . "%")))->field("id")->select();
            $mapc["id"]=array("IN",$ids ? $this->_array_column($ids,"id") : array(0));
//            $mapc["id"]=array("eq",$ids[0]['id']);
        }


        $companysCount=$companyM->where($mapc)->order("id asc")->select();

        $companys=$companyM->where($mapc)->order("id asc")->limit($_POST["start"],$_POST["length"])->select();

        $cout=0;

        //循环所有单位
        for ($i=0;$i<count($companys)&&count($companys)!=0;$i++){
            $map['company_id']  = array('eq',$companys[$i]["id"]);

            $travelM=new TravelModel();
            //$map['use_user_id']  = array('in',$ids);

            $companys[$i]["companyCount"]=$travelM->where($map)->count();//该单位所有出行记录条数

            //获取待审核的数目
            $companys[$i]["state0"]=$travelM->where($map)->where(array("state"=>"0"))->count();
            //单位审核通过
            $companys[$i]["state1"]=$travelM->where($map)->where(array("state"=>"1"))->count();
            //单位审核驳回
            $companys[$i]["state2"]=$travelM->where($map)->where(array("state"=>"2"))->count();
            //中心审核通过，待派车
            $companys[$i]["state3"]=$travelM->where($map)->where(array("state"=>"3"))->count();
            //中心审核驳回
            $companys[$i]["state4"]=$travelM->where($map)->where(array("state"=>"4"))->count();
            //已派车
            $companys[$i]["state5"]=$travelM->where($map)->where(array("state"=>"5"))->count();
            //正在执行
            $companys[$i]["state6"]=$travelM->where($map)->where(array("state"=>"6"))->count();
            //已完成
            $companys[$i]["state7"]=$travelM->where($map)->where(array("state"=>"7"))->count();

            //申请取消中
            $companys[$i]["state8"]=$travelM->where($map)->where(array("state"=>"8"))->count();
            //取消成功中
            $companys[$i]["state9"]=$travelM->where($map)->where(array("state"=>"9"))->count();
            $companys[$i]["state10"]=$travelM->where($map)->where(array("state"=>"10"))->count();
            $companys[$i]["state11"]=$travelM->where($map)->where(array("state"=>"11"))->count();

            $companys[$i]["companyFinishCount"]=$companys[$i]["state7"];//该单位所有已经出行完成记录条数
            $companys[$i]["companyRateCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("totle_rate");//该单位所有出行费用之和
            $companys[$i]["companyMileageCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("mileage");//该单位所有出行费用之和
            if(empty($companys[$i]["companyRateCount"])){$companys[$i]["companyRateCount"]=0;}
            if(empty($companys[$i]["companyMileageCount"])){$companys[$i]["companyMileageCount"]=0;}

        }

        $resCount=$companyM->where($mapc)->order("id asc")->select();

        //返回数据
        $stat=array();
        $stat["draw"]=$_POST["draw"];
        $stat["recordsTotal"]=count($companysCount);//总记录条数
        $stat["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $stat["data"]=$companys;

        $this->ajaxReturn($stat);
    }

    public function byCompanyToExcel(){
        $mapc["is_del"]=0;
        $map["is_del"]=array('eq',0);
        if(!empty($_POST["startTime"])){
            $map['departure_time']  = array('gt',strtotime($_POST["startTime"]));
        }
        if(!empty($_POST["endTime"])){
            $map['departure_time']  = array('elt',strtotime($_POST["endTime"])+24*3600);
        }
        if((!empty($_POST["startTime"]))&&!empty($_POST["endTime"])){
            $map['departure_time']  = array('between',array(strtotime($_POST["startTime"]),strtotime($_POST["endTime"])+24*3600));
        }
        $companyM=new CompanyModel();
//        if(!empty($_POST["searchKey"])){
//            $ids = $companyM->where(array("company_name" => array("like", "%" . trim($_POST["searchKey"]) . "%")))->field("id")->select();
//            $mapc["id"]=array("IN",$ids ? $this->_array_column($ids,"id") : array(0));
//        }
        if($_POST["company"]){
            $mapc["id"]=array("in",$_POST["company"]);
        }

        $companys=$companyM->where($mapc)->order("id asc")->select();

        $res=array();

        //循环所有单位
        for ($i=0;$i<count($companys)&&count($companys)!=0;$i++){
            $res[$i]["company_name"]=$companys[$i]["company_name"];
            $res[$i]["company_address"]=$companys[$i]["company_address"];
            $res[$i]["company_phone"]=$companys[$i]["company_phone"]." ";
            $res[$i]["company_number"]=$companys[$i]["company_number"];

            if($companys[$i]["is_del"]==0){
                $res[$i]["is_del"]="正常";
            }else{
                $res[$i]["is_del"]="已删除";
            }


            $map['company_id']  = array('eq',$companys[$i]["id"]);

            $travelM=new TravelModel();

            $res[$i]["companyCount"]=$travelM->where($map)->count();//该单位所有出行记录条数

            //获取待审核的数目
            $res[$i]["state0"]=$travelM->where($map)->where(array("state"=>"0"))->count();
            //单位审核通过
            $res[$i]["state1"]=$travelM->where($map)->where(array("state"=>"1"))->count();
            //单位审核驳回
            $res[$i]["state2"]=$travelM->where($map)->where(array("state"=>"2"))->count();
            //中心审核通过，待派车
            $res[$i]["state3"]=$travelM->where($map)->where(array("state"=>"3"))->count();
            //中心审核驳回
            $res[$i]["state4"]=$travelM->where($map)->where(array("state"=>"4"))->count();
            //已派车
            $res[$i]["state5"]=$travelM->where($map)->where(array("state"=>"5"))->count();
            //正在执行
            $res[$i]["state6"]=$travelM->where($map)->where(array("state"=>"6"))->count();
            //已完成
            $res[$i]["state7"]=$travelM->where($map)->where(array("state"=>"7"))->count();

            //申请取消中
            $res[$i]["state8"]=$travelM->where($map)->where(array("state"=>"8"))->count();
            //取消成功中
            $res[$i]["state9"]=$travelM->where($map)->where(array("state"=>"9"))->count();
            $res[$i]["state10"]=$travelM->where($map)->where(array("state"=>"10"))->count();
            $res[$i]["state11"]=$travelM->where($map)->where(array("state"=>"11"))->count();

            $res[$i]["companyRateCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("totle_rate");//该单位所有出行费用之和
            $res[$i]["companyMileageCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("mileage");//该单位所有出行费用之和
            if(empty($res[$i]["companyRateCount"])){$res[$i]["companyRateCount"]=0;}
            if(empty($res[$i]["companyMileageCount"])){$res[$i]["companyMileageCount"]=0;}
        }

        foreach ($res as $field=>$v){
            if($field == 'company_name'){
                $headArr[]='单位名称';
            }
            if($field == 'company_address'){
                $headArr[]='单位地址';
            }
            if($field == 'company_phone'){
                $headArr[]='单位电话';
            }
            if($field == 'company_number'){
                $headArr[]='单位编号';
            }
            if($field == 'is_del'){
                $headArr[]='状态';
            }
            if($field == 'companyCount'){
                $headArr[]='总申请出行数';
            }

            if($field == 'state0'){
                $headArr[]='待单位审核';
            }
            if($field == 'state1'){
                $headArr[]='待中心审核';
            }
            if($field == 'state2'){
                $headArr[]='单位驳回';
            }
            if($field == 'state3'){
                $headArr[]='待派车';
            }
            if($field == 'state4'){
                $headArr[]='中心驳回';
            }
            if($field == 'state5'){
                $headArr[]='已派车';
            }
            if($field == 'state6'){
                $headArr[]='带出车';
            }
            if($field == 'state7'){
                $headArr[]='派车审核驳回';
            }
            if($field == 'state8'){
                $headArr[]='执行任务中';
            }
            if($field == 'state9'){
                $headArr[]='已完成';
            }
            if($field == 'state10'){
                $headArr[]='申请取消中';
            }
            if($field == 'state11'){
                $headArr[]='取消成功';
            }
            if($field == 'companyRateCount'){
                $headArr[]='出行费用';
            }
            if($field == 'companyMileageCount'){
                $headArr[]='出行里程';
            }
        }

        $filename="单位数据统计";

        $this->getExcel($filename,$headArr,$res);

    }

    public function byCar(){
        $car = M("car")->where(array("is_del"=>0))->field("id,car_num")->select();

        $this->assign("car",$car);
        $this->display();
    }

    public function byCarData(){
        $mapc["is_del"]=0;
        $map["is_del"]=array('eq',0);
        if(!empty($_POST["startTime"])){
            $mapTravel['departure_time']  = array('gt',strtotime($_POST["startTime"]));
            $startTime=strtotime($_POST["startTime"]);
        }
        if(!empty($_POST["endTime"])){
            $mapTravel['departure_time']  = array('elt',strtotime($_POST["endTime"])+24*3600);
            $endTime=strtotime($_POST["endTime"])+24*3600;
        }
        if((!empty($_POST["startTime"]))&&!empty($_POST["endTime"])){
            $mapTravel['departure_time']  = array('between',array(strtotime($_POST["startTime"]),strtotime($_POST["endTime"])+24*3600));
            $startTime=strtotime($_POST["startTime"]);
            $endTime=strtotime($_POST["endTime"])+24*3600;
        }
        if(empty($_POST["startTime"])&&empty($_POST["endTime"])){
            $startTime=0;
            $endTime=1893427200;
        }
        if($_POST["car"]){
            $mapc["id"]=array("in",$_POST["car"]);
        }

        $carM=new CarModel();

        if(!empty($_POST["searchKey"])){
            $ids = $carM->where(array("car_num" => array("like", "%" . trim($_POST["searchKey"]) . "%")))->field("id")->select();
            $mapc["id"]=array("IN",$ids ? $this->_array_column($ids,"id") : array(0));
        }

        $resCount=$carM->where($mapc)->order("is_del asc")->select();
        $res=$carM->where($mapc)->order("is_del asc")->limit($_POST["start"],$_POST["length"])->select();

        $costWashM=new CostWashModel();
        $costRepairM=new CostRepairModel();
        $costOilM=new CostOilModel();
        $travelM=new TravelModel();
        $costInsuranceM=new CostInsuranceModel();

        //$mapTravel['departure_time'] = array(array('gt',$startTime),array('lt',$endTime));

        $count=0;

        $cars=array();

        for($i=0;$i<count($res)&& count($res);$i++){

            $cars[$i]["car_num"]=$res[$i]["car_num"];
            $cars[$i]["id"]=$res[$i]["id"];

            //获取洗车花费总数
            $mapwash['wash_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;
            $cars[$i]["costWash"]=$costWashM->where("is_del=0")->where($mapwash)->where(array("car_id"=>$res[$i]["id"]))->sum("cost");
            if(!($cars[$i]["costWash"])){$cars[$i]["costWash"]=0;}

            //获取维修花费总数
            $mapRepair['start_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;
            $cars[$i]["costRepair"]=$costRepairM->where("is_del=0")->where($mapRepair)->where(array("car_id"=>$res[$i]["id"]))->sum("cost");
            if(!($cars[$i]["costRepair"])){$cars[$i]["costRepair"]=0;}

            //获取加油花费总数
            $mapOil['trading_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;
            $cars[$i]["costOil"]=$costOilM->where("is_del=0")->where($mapOil)->where(array("car_id"=>$res[$i]["id"]))->sum("cost");
            if(!($cars[$i]["costOil"])){$cars[$i]["costOil"]=0;}

            //获取过路费

            $cars[$i]["costFees"]=$travelM->where("is_del=0")->where($mapTravel)->where("car_id=".$res[$i]["id"]." and is_del=0")->sum("fees_sum");
            if(!($cars[$i]["costFees"])){$cars[$i]["costFees"]=0;}

            //获取停车费
            $cars[$i]["costParkingRate"]=$travelM->where($mapTravel)->where("car_id=".$res[$i]["id"]." and is_del=0")->sum("parking_rate_sum");
            if(!($cars[$i]["costParkingRate"])){$cars[$i]["costParkingRate"]=0;}

            //获取保险花费总数
            $mapInsurance['pay_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;
            $cars[$i]["costInsurance"]=$costInsuranceM->where($mapInsurance)->where("car_id=".$res[$i]["id"]." and cost_type<3 and is_del=0")->sum("cost");
            if(!($cars[$i]["costInsurance"])){$cars[$i]["costInsurance"]=0;}

            //获取年检花费总数
            $cars[$i]["costInspect"]=$costInsuranceM->where($mapInsurance)->where("car_id=".$res[$i]["id"]." and cost_type=3 and is_del=0")->sum("cost");
            if(!($cars[$i]["costInspect"])){$cars[$i]["costInspect"]=0;}

            //总花费
            $cars[$i]["costSum"]=$cars[$i]["costWash"]+$cars[$i]["costRepair"]+$cars[$i]["costOil"]+$cars[$i]["costInsurance"]+$cars[$i]["costInspect"]+$cars[$i]["costFees"]+$cars[$i]["costParkingRate"];

            //获取出行记录总数
            $cars[$i]["travelSum"]=$travelM->where($mapTravel)->where("car_id=".$res[$i]["id"]." and is_del=0")->where(array("state"=>"9"))->count();

            $cars[$i]["countMaintain"]=$travelM->where($mapTravel)->where("car_id=".$res[$i]["id"]." and is_del=0")->where(array("state"=>"9"))->sum("mileage");

        }

        //返回数据
        $stat=array();
        $stat["draw"]=$_POST["draw"];
        $stat["recordsTotal"]=count($resCount);//总记录条数
        $stat["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $stat["data"]=$cars;

        $this->ajaxReturn($stat);
    }

    public function byCarToExcel(){
        $mapc["is_del"]=0;
        $map["is_del"]=array('eq',0);
        if(!empty($_POST["startTime"])){
            $mapTravel['departure_time']  = array('gt',strtotime($_POST["startTime"]));
            $startTime=strtotime($_POST["startTime"]);
        }
        if(!empty($_POST["endTime"])){
            $mapTravel['departure_time']  = array('elt',strtotime($_POST["endTime"])+24*3600);
            $endTime=strtotime($_POST["endTime"])+24*3600;
        }
        if((!empty($_POST["startTime"]))&&!empty($_POST["endTime"])){
            $mapTravel['departure_time']  = array('between',array(strtotime($_POST["startTime"]),strtotime($_POST["endTime"])+24*3600));
            $startTime=strtotime($_POST["startTime"]);
            $endTime=strtotime($_POST["endTime"])+24*3600;
        }
        if(empty($_POST["startTime"])&&empty($_POST["endTime"])){
            $startTime=0;
            $endTime=1893427200;
        }
        $carM=new CarModel();

//        if(!empty($_POST["searchKey"])){
//            $ids = $carM->where(array("car_num" => array("like", "%" . trim($_POST["searchKey"]) . "%")))->field("id")->select();
//            $mapc["id"]=array("IN",$ids ? $this->_array_column($ids,"id") : array(0));
//        }
        if($_POST["car"]){
            $mapc["id"]=array("in",$_POST["car"]);
        }


        $res=$carM->where($mapc)->order("is_del asc")->select();

        $costWashM=new CostWashModel();
        $costRepairM=new CostRepairModel();
        $costOilM=new CostOilModel();
        $travelM=new TravelModel();
        $costInsuranceM=new CostInsuranceModel();

        //$mapTravel['departure_time'] = array(array('gt',$startTime),array('lt',$endTime));

        $count=0;


        $cars=array();


        for($i=0;$i<count($res)&& count($res);$i++){

            $cars[$i]["car_num"]=$res[$i]["car_num"];

            //获取洗车花费总数
            $mapwash['wash_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;
            $cars[$i]["costWash"]=$costWashM->where("is_del=0")->where($mapwash)->where(array("car_id"=>$res[$i]["id"]))->sum("cost");
            if(!($cars[$i]["costWash"])){$cars[$i]["costWash"]=0;}

            //获取维修花费总数
            $mapRepair['start_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;
            $cars[$i]["costRepair"]=$costRepairM->where("is_del=0")->where($mapRepair)->where(array("car_id"=>$res[$i]["id"]))->sum("cost");
            if(!($cars[$i]["costRepair"])){$cars[$i]["costRepair"]=0;}

            //获取加油花费总数
            $mapOil['trading_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;
            $cars[$i]["costOil"]=$costOilM->where("is_del=0")->where($mapOil)->where(array("car_id"=>$res[$i]["id"]))->sum("cost");
            if(!($cars[$i]["costOil"])){$cars[$i]["costOil"]=0;}

            //获取过路费

            $cars[$i]["costFees"]=$travelM->where("is_del=0")->where($mapTravel)->where("car_id=".$res[$i]["id"]." and is_del=0")->sum("fees_sum");
            if(!($cars[$i]["costFees"])){$cars[$i]["costFees"]=0;}

            //获取停车费
            $cars[$i]["costParkingRate"]=$travelM->where($mapTravel)->where("car_id=".$res[$i]["id"]." and is_del=0")->sum("parking_rate_sum");
            if(!($cars[$i]["costParkingRate"])){$cars[$i]["costParkingRate"]=0;}

            //获取保险花费总数
            $mapInsurance['pay_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;
            $cars[$i]["costInsurance"]=$costInsuranceM->where($mapInsurance)->where("car_id=".$res[$i]["id"]." and cost_type<3 and is_del=0")->sum("cost");
            if(!($cars[$i]["costInsurance"])){$cars[$i]["costInsurance"]=0;}

            //获取年检花费总数
            $cars[$i]["costInspect"]=$costInsuranceM->where($mapInsurance)->where("car_id=".$res[$i]["id"]." and cost_type=3 and is_del=0")->sum("cost");
            if(!($cars[$i]["costInspect"])){$cars[$i]["costInspect"]=0;}

            //总花费
            $cars[$i]["costSum"]=$cars[$i]["costWash"]+$cars[$i]["costRepair"]+$cars[$i]["costOil"]+$cars[$i]["costInsurance"]+$cars[$i]["costInspect"]+$cars[$i]["costFees"]+$cars[$i]["costParkingRate"];

            //获取出行记录总数
            $cars[$i]["travelSum"]=$travelM->where($mapTravel)->where("car_id=".$res[$i]["id"])->count();

            $cars[$i]["countMaintain"]=$travelM->where("is_del=0")->where(array("car_id"=>$res[$i]["id"]))->sum("mileage");
            if(!($cars[$i]["countMaintain"])){$cars[$i]["countMaintain"]=0;}
        }

        foreach ($cars as $field=>$v){

            if($field == 'car_num'){
                $headArr[]='车牌号码';
            }


            if($field == 'costWash'){
                $headArr[]='洗车花费';
            }
            if($field == 'costRepair'){
                $headArr[]='维修花费';
            }

            if($field == 'costOil'){
                $headArr[]='加油花费';
            }
            if($field == 'costInsurance'){
                $headArr[]='保险费用';
            }
            if($field == 'costInspect'){
                $headArr[]='年检费用';
            }

            if($field == 'costFees'){
                $headArr[]='过路费';
            }

            if($field == 'costParkingRate'){
                $headArr[]='停车费';
            }

            if($field == 'costSum'){
                $headArr[]='花费总和';
            }

            if($field == 'countMaintain'){
                $headArr[]='出行里程数';
            }

            if($field == 'travelSum'){
                $headArr[]='出行次数';
            }
        }

        $filename="车辆数据统计";

        $this->getExcel($filename,$headArr,$cars);
    }

    public function byDriver(){
        //获取所有单位
        $drivers=M("Driver")->where("is_del=0")->select();
        $this->assign("drivers",$drivers);

        $this->display();
    }

    public function byDriverData(){
        $mapc["is_del"]=0;
        $map["is_del"]=array('eq',0);
        if(!empty($_POST["startTime"])){
            $mapTravel['departure_time']  = array('gt',strtotime($_POST["startTime"]));
            $startTime=strtotime($_POST["startTime"]);

            $endTime=strtotime("2025-01-01");
        }
        if(!empty($_POST["endTime"])){
            $mapTravel['departure_time']  = array('elt',strtotime($_POST["endTime"])+24*3600);
            $startTime=strtotime("2016-01-01");
            $endTime=strtotime($_POST["endTime"])+24*3600;
        }
        if((!empty($_POST["startTime"]))&&!empty($_POST["endTime"])){
            $mapTravel['departure_time']  = array('between',array(strtotime($_POST["startTime"]),strtotime($_POST["endTime"])+24*3600));
            $startTime=strtotime($_POST["startTime"]);
            $endTime=strtotime($_POST["endTime"])+24*3600;
        }
        if(empty($_POST["startTime"])&&empty($_POST["endTime"])){
            $startTime=0;
            $endTime=1893427200;
        }
//        if(!empty($_POST["searchKey"])){
//            $model = new DriverModel();
//            $ids = $model->where(array("driver_phone|driver_name" => array("like", "%" . trim($_POST["searchKey"]) . "%")))->field("id")->select();
//            $mapc["id"]=array("IN",$ids ? $this->_array_column($ids,"id") : array(0));
//        }
        if($_POST['driver']){
            $mapc["id"]=array("IN",$_POST['driver']);
        }

        $driverM=new DriverModel();
        $resCount=$driverM->where($mapc)->order("is_del asc")->select();
        $res=$driverM->where($mapc)->order("is_del asc")->limit($_POST["start"],$_POST["length"])->select();

        //找出该司机时间段内的出行单数
        $travelM=new TravelModel();

        $count=0;

        //echo($startTime);
        //echo($endTime);

        $drivers=array();

        for($i=0;$i<count($res)&&count($res)!=0;$i++){
            $mapp['is_del']  = array('eq',0);
            $mapp['driver_id']  = array('eq',$res[$i]["id"]);
            $mapp['departure_time'] = array('between',array($startTime,$endTime)) ;

            $drivers[$i]["id"]=$res[$i]["id"];

            $drivers[$i]["driver_name"]=$res[$i]["driver_name"];

            $drivers[$i]["driver_phone"]=$res[$i]["driver_phone"];
            $drivers[$i]["department"]=$res[$i]["department"];
            $drivers[$i]["driver_idcard"]=$res[$i]["driver_idcard"];
            $drivers[$i]["lic_type"]=$res[$i]["lic_type"];
            $drivers[$i]["induction_time"]=$res[$i]["induction_time"];

            $drivers[$i]["count"]=$travelM->where($mapp)->count();//该司机所有出行记录条数
            $drivers[$i]["mileagecount"]=M("Travel")->where($mapp)->sum("mileage");//该司机所有出行记录条数

        }

        //返回数据
        $stat=array();
        $stat["draw"]=$_POST["draw"];
        $stat["recordsTotal"]=count($resCount);//总记录条数
        $stat["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $stat["data"]=$drivers;

        $this->ajaxReturn($stat);
    }

    public function byDriverToExcel(){
        $mapc["is_del"]=0;
        $map["is_del"]=array('eq',0);
        if(!empty($_POST["startTime"])){
            $mapTravel['departure_time']  = array('gt',strtotime($_POST["startTime"]));
            $startTime=strtotime($_POST["startTime"]);
        }
        if(!empty($_POST["endTime"])){
            $mapTravel['departure_time']  = array('elt',strtotime($_POST["endTime"])+24*3600);
            $endTime=strtotime($_POST["endTime"])+24*3600;
        }
        if((!empty($_POST["startTime"]))&&!empty($_POST["endTime"])){
            $mapTravel['departure_time']  = array('between',array(strtotime($_POST["startTime"]),strtotime($_POST["endTime"])+24*3600));
            $startTime=strtotime($_POST["startTime"]);
            $endTime=strtotime($_POST["endTime"])+24*3600;
        }
        if(empty($_POST["startTime"])&&empty($_POST["endTime"])){
            $startTime=0;
            $endTime=1893427200;
        }
//        if(!empty($_POST["searchKey"])){
//            $model = new DriverModel();
//            $ids = $model->where(array("driver_phone|driver_name" => array("like", "%" . trim($_POST["searchKey"]) . "%")))->field("id")->select();
//            $mapc["id"]=array("IN",$ids ? $this->_array_column($ids,"id") : array(0));
//        }
        if($_POST['driver']){
            $mapc["id"]=array("IN",$_POST['driver']);
        }

        $driverM=new DriverModel();
        $res=$driverM->where($mapc)->order("is_del asc")->select();

        //找出该司机时间段内的出行单数
        $travelM=new TravelModel();

        $count=0;

        $drivers=array();

        for($i=0;$i<count($res)&&count($res)!=0;$i++){

            $map['driver_id']  = array('eq',$res[$i]["id"]);
            $map['departure_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;

            $drivers[$i]["driver_name"]=$res[$i]["driver_name"];

            $drivers[$i]["driver_phone"]=$res[$i]["driver_phone"];
            $drivers[$i]["department"]=$res[$i]["department"];
            $drivers[$i]["driver_idcard"]=$res[$i]["driver_idcard"];
            $drivers[$i]["lic_type"]=$res[$i]["lic_type"];
            $drivers[$i]["induction_time"]=date('Y-m-d', $res[$i]["induction_time"]);
            $drivers[$i]["count"]=$travelM->where($map)->count();//该司机所有出行记录条数

            $drivers[$i]["mileagecount"]=M("Travel")->where($map)->sum("mileage");//该司机所有出行记录条数


        }

        foreach ($drivers as $field=>$v){
            if($field == 'driver_name'){
                $headArr[]='司机姓名';
            }
            if($field == 'driver_phone'){
                $headArr[]='联系电话';
            }
            if($field == 'department'){
                $headArr[]='委托管理部门';
            }
            if($field == 'driver_idcard'){
                $headArr[]='身份证号码';
            }
            if($field == 'lic_type'){
                $headArr[]='准驾类型';
            }
            if($field == 'induction_time'){
                $headArr[]='入职时间';
            }
            if($field == 'count'){
                $headArr[]='有效出车数';
            }
            if($field == 'mileagecount'){
                $headArr[]='出车里程数';
            }

        }

        $filename="司机数据统计";

        $this->getExcel($filename,$headArr,$drivers);
    }

    public function byUser(){
        $this->display();
    }

    public function byUserData(){
        $mapc["is_del"]=0;
        $map["is_del"]=array('eq',0);
        if(!empty($_POST["startTime"])){
            $mapTravel['departure_time']  = array('gt',strtotime($_POST["startTime"]));
            $startTime=strtotime($_POST["startTime"]);

            $endTime=strtotime("2025-01-01");
        }
        if(!empty($_POST["endTime"])){
            $mapTravel['departure_time']  = array('elt',strtotime($_POST["endTime"])+24*3600);
            $startTime=strtotime("2016-01-01");
            $endTime=strtotime($_POST["endTime"])+24*3600;
        }
        if((!empty($_POST["startTime"]))&&!empty($_POST["endTime"])){
            $mapTravel['departure_time']  = array('between',array(strtotime($_POST["startTime"]),strtotime($_POST["endTime"])+24*3600));
            $startTime=strtotime($_POST["startTime"]);
            $endTime=strtotime($_POST["endTime"])+24*3600;
        }
        if(empty($_POST["startTime"])&&empty($_POST["endTime"])){
            $startTime=0;
            $endTime=1893427200;
        }
        if(!empty($_POST["key"])){

            $model = new UserModel();
            $ids = $model->where(array("user_phone|user_name"=>array("like","%".trim($_POST["key"])."%")))->field("id")->select();
            //$map['company_id'] = array('eq',$_POST["company"]);
            $mapc["id"]=array("IN",$ids ? $this->_array_column($ids,"id") : array(0));
        }

        $resCount=M("User")->where($mapc)->order("is_del asc")->select();
        $res=M("User")->where($mapc)->order("is_del asc")->limit($_POST["start"],$_POST["length"])->select();

        //找出该司机时间段内的出行单数
        $travelM=new TravelModel();

        $count=0;

        $users=array();

        for($i=0;$i<count($res)&&count($res)!=0;$i++){

            $map['user_id']  = array('eq',$res[$i]["id"]);
            $map['departure_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;

            $users[$i]["id"]=$res[$i]["id"];
            $users[$i]["user_name"]=$res[$i]["user_name"];
            $users[$i]["user_phone"]=$res[$i]["user_phone"];
            $users[$i]["user_idcard"]=$res[$i]["user_idcard"];
            $users[$i]["user_sex"]=$res[$i]["user_sex"];
            $users[$i]["count"]=$travelM->where($map)->count();//该司机所有出行记录条数

        }

        //返回数据
        $stat=array();
        $stat["draw"]=$_POST["draw"];
        $stat["recordsTotal"]=count($resCount);//总记录条数
        $stat["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $stat["data"]=$users;

        $this->ajaxReturn($stat);
    }


    public function byUserToExcel(){
        $mapc["is_del"]=0;
        $mapc["is_del"]=0;
        $map["is_del"]=array('eq',0);
        if(!empty($_POST["startTime"])){
            $mapTravel['departure_time']  = array('gt',strtotime($_POST["startTime"]));
            $startTime=strtotime($_POST["startTime"]);
        }
        if(!empty($_POST["endTime"])){
            $mapTravel['departure_time']  = array('elt',strtotime($_POST["endTime"])+24*3600);
            $endTime=strtotime($_POST["endTime"])+24*3600;
        }
        if((!empty($_POST["startTime"]))&&!empty($_POST["endTime"])){
            $mapTravel['departure_time']  = array('between',array(strtotime($_POST["startTime"]),strtotime($_POST["endTime"])+24*3600));
            $startTime=strtotime($_POST["startTime"]);
            $endTime=strtotime($_POST["endTime"])+24*3600;
        }
        if(empty($_POST["startTime"])&&empty($_POST["endTime"])){
            $startTime=0;
            $endTime=1893427200;
        }


        if(!empty($_POST["searchKey"])){
            $model = new UserModel();
            $ids = $model->where(array("user_phone|user_name"=>array("like","%".trim($_POST["searchKey"])."%")))->field("id")->select();
            $mapc["id"]=array("IN",$ids ? $this->_array_column($ids,"id") : array(0));
        }

        $res=M("User")->where($mapc)->order("is_del asc")->limit($_POST["start"],$_POST["length"])->select();

        //找出该司机时间段内的出行单数
        $travelM=new TravelModel();
        $users=array();

        for($i=0;$i<count($res)&&count($res)!=0;$i++){

            $map['user_id']  = array('eq',$res[$i]["id"]);
            $map['departure_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;

            $users[$i]["user_name"]=$res[$i]["user_name"];
            $users[$i]["user_phone"]=$res[$i]["user_phone"];
            $users[$i]["user_idcard"]=$res[$i]["user_idcard"];
            $users[$i]["user_sex"]=$res[$i]["user_sex"];
            $users[$i]["count"]=$travelM->where($map)->count();//该司机所有出行记录条数

        }

        foreach ($users as $field=>$v){
            if($field == 'user_name'){
                $headArr[]='用户姓名';
            }
            if($field == 'user_phone'){
                $headArr[]='手机号';
            }
            if($field == 'user_idcard'){
                $headArr[]='身份证号码';
            }
            if($field == 'user_sex'){
                $headArr[]='性别';
            }
            if($field == 'count'){
                $headArr[]='有效出车数';
            }

        }

        $filename="用户数据统计";

        $this->getExcel($filename,$headArr,$users);
    }





















    public function getCompanyList($startTime="",$endTime=""){
        if(!empty($_POST)){
            $this->redirect("getCompanyList",array("startTime"=>$_POST["startTime"],"endTime"=>$_POST["endTime"]));
        }else{

            $this->assign("startTime",$startTime);
            $this->assign("endTime",$endTime);


            if(!empty($startTime)){
                $startTime=strtotime($startTime);
            }else{
                $startTime=0;
            }
            if(!empty($endTime)){
                $endTime=strtotime($endTime);
            }else{
                $endTime=time();
            }

            $this->assign("startTimeStamp",$startTime);
            $this->assign("endTimeStamp",$endTime);

            $this->display();

        }

    }

    public function companyListgetData($startTime="",$endTime=""){


        $companyM=new CompanyModel();
        $companys=$companyM->order("is_del asc")->select();


        $cout=0;

        //循环所有单位
        for ($i=0;$i<count($companys)&&count($companys)!=0;$i++){
            $travelM=new TravelModel();
            //$map['use_user_id']  = array('in',$ids);
            $map['departure_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;
            $map['company_id']  = array('eq',$companys[$i]["id"]);


            $companys[$i]["companyCount"]=$travelM->where($map)->count();//该单位所有出行记录条数

            //获取待审核的数目
            $companys[$i]["state0"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"0"))->count();
            //单位审核通过
            $companys[$i]["state1"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"1"))->count();
            //单位审核驳回
            $companys[$i]["state2"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"2"))->count();
            //中心审核通过，待派车
            $companys[$i]["state3"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"3"))->count();
            //中心审核驳回
            $companys[$i]["state4"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"4"))->count();
            //已派车
            $companys[$i]["state5"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"5"))->count();
            //正在执行
            $companys[$i]["state6"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"6"))->count();
            //已完成
            $companys[$i]["state7"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"7"))->count();

            //申请取消中
            $companys[$i]["state8"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"8"))->count();
            //取消成功中
            $companys[$i]["state9"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"9"))->count();
            //里程数据统计 20180326陈庄更新
            $companys[$i]["state10"]=$travelM->where("is_del=0")->where($map)->sum("mileage");

            //出行费用统计　　20180326陈庄更新
            $companys[$i]["state11"]=$travelM->where("is_del=0")->where($map)->sum("totle_rate");


            //获取已经销单数量
            $companys[$i]["del"]=$travelM->where("is_del=1")->where($map)->count();

            //$cout+=$companys[$i]["companyCount"];


            $companys[$i]["companyFinishCount"]=$companys[$i]["state7"];//该单位所有已经出行完成记录条数
            $companys[$i]["companyRateCount"]=$travelM->where($map)->where("is_del=0")->where(array("state"=>"7"))->sum("totle_rate");//该单位所有出行费用之和
            if(empty($companys[$i]["companyRateCount"])){$companys[$i]["companyRateCount"]=0;}


        }



        $this->ajaxReturn($companys);
    }

    //单位数据统计导出excel
    public function getCompanyListToExcel($startTime="",$endTime=""){
        $companyM=new CompanyModel();
        $companys=$companyM->order("is_del asc")->select();

        $res=array();

        for ($i=0;$i<count($companys)&&count($companys)!=0;$i++){

            $travelM=new TravelModel();
            $map['company_id']  = array('eq',$companys[$i]["id"]);
            $map['departure_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;

            $res[$i]["company_name"]=$companys[$i]["company_name"];
            $res[$i]["company_address"]=$companys[$i]["company_address"];
            $res[$i]["company_phone"]=$companys[$i]["company_phone"]." ";
            $res[$i]["company_number"]=$companys[$i]["company_number"];

            if($companys[$i]["is_del"]==0){
                $res[$i]["is_del"]="正常";
            }else{
                $res[$i]["is_del"]="已删除";
            }


            $res[$i]["companyCount"]=$travelM->where($map)->count();//该单位所有出行记录条数

            $res[$i]["companyRateCount"]=$travelM->where($map)->where(array("state"=>"7"))->sum("totle_rate");//该单位所有出行费用之和
            if(empty($res[$i]["companyRateCount"])){$res[$i]["companyRateCount"]=0;}
            //里程数据统计 20180326陈庄更新
            $res[$i]["state10"]=$travelM->where("is_del=0")->where($map)->sum("mileage");
            //出行费用统计　　20180326陈庄更新
            $res[$i]["state11"]=$travelM->where("is_del=0")->where($map)->sum("totle_rate");
            //获取待审核的数目
            $res[$i]["state0"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"0"))->count();
            //单位审核通过
            $res[$i]["state1"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"1"))->count();
            //单位审核驳回
            $res[$i]["state2"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"2"))->count();
            //中心审核通过，待派车
            $res[$i]["state3"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"3"))->count();
            //中心审核驳回
            $res[$i]["state4"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"4"))->count();
            //已派车
            $res[$i]["state5"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"5"))->count();
            //正在执行
            $res[$i]["state6"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"6"))->count();
            //已完成
            $res[$i]["state7"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"7"))->count();
            //申请取消中
            $res[$i]["state8"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"8"))->count();
            //取消成功中
            $res[$i]["state9"]=$travelM->where("is_del=0")->where($map)->where(array("state"=>"9"))->count();

            $res[$i]["del"]=$travelM->where("is_del=1")->where($map)->count();
        }

        //dump($res);

        foreach ($res as $field=>$v){
            if($field == 'company_name'){
                $headArr[]='单位名称';
            }
            if($field == 'company_address'){
                $headArr[]='单位地址';
            }
            if($field == 'company_phone'){
                $headArr[]='单位电话';
            }
            if($field == 'company_number'){
                $headArr[]='单位编号';
            }
            if($field == 'is_del'){
                $headArr[]='状态';
            }
            if($field == 'companyCount'){
                $headArr[]='总申请出行数';
            }

            if($field == 'state11'){
                $headArr[]='出行花费';
            }
            if($field == 'state10'){
                $headArr[]='行驶里程';
            }
            if($field == 'state0'){
                $headArr[]='待单位审核';
            }
            if($field == 'state1'){
                $headArr[]='待中心审核';
            }
            if($field == 'state2'){
                $headArr[]='单位驳回';
            }
            if($field == 'state3'){
                $headArr[]='待派车';
            }
            if($field == 'state4'){
                $headArr[]='中心驳回';
            }
            if($field == 'state5'){
                $headArr[]='已派车';
            }
            if($field == 'state6'){
                $headArr[]='执行任务中';
            }
            if($field == 'state7'){
                $headArr[]='已完成';
            }
            if($field == 'state8'){
                $headArr[]='申请取消中';
            }
            if($field == 'state9'){
                $headArr[]='取消成功';
            }
            if($field == 'del'){
                $headArr[]='已销单';
            }





        }

        $filename=date("Y-m-d",$startTime)."至".date("Y-m-d",$endTime)."单位数据统计";

        $this->getExcel($filename,$headArr,$res);

    }

    public function getCompanyDetail($companyId,$startTimeStamp,$endTimeStamp){
        $this->assign("startTimeStamp",$startTimeStamp);
        $this->assign("endTimeStamp",$endTimeStamp);
        $this->assign("companyId",$companyId);

        $this->display();
    }

    public function getCompanyDetailToExcel($companyId,$startTimeStamp,$endTimeStamp){


        $travelM=new TravelModel();
        //$map['user_id']  = array('in',$ids);
        $map["company_id"]=array("eq",$companyId);
        $map['departure_time'] = array(array('gt',$startTimeStamp),array('lt',$endTimeStamp)) ;



        $res=$travelM->where($map)->order("id desc")->select();

        $this->travelToExcel($res);




    }

    public function CompanyDetailGetData($companyId,$startTimeStamp="",$endTimeStamp=""){

//        $userM= new UserModel();
//        $ids = $userM->where(array("user_company"=>$companyId))->getField("id",true);
//        if(empty($ids)){
//            $ids[]=0;
//        }

        $travelM=new TravelModel();
        $map['company_id']  = array('eq',$companyId);
        $map['departure_time'] = array(array('gt',$startTimeStamp),array('lt',$endTimeStamp)) ;

        $res=$travelM->where($map)->order("id desc")->select();

        $travelTypeM=new TravelTypeModel();

        for ($i = 0; $i < count($res)&&count($res)!=0; $i++) {
            $traverType=$travelTypeM->find($res[$i]["travel_type_id"]);
            $res[$i]["travel_type_name"]=$traverType["travel_name"];

            //获取出行人信息
            $userM=new UserModel();
            $user=$userM->find($res[$i]["use_user_id"]);
            $res[$i]["user_name"]=$user["user_name"];

            //获取出行人单位信息
            $companyM=new CompanyModel();
            $company=$companyM->find($res[$i]["company_id"]);
            $res[$i]["user_company"]=$company["company_name"];

        }

        $this->ajaxReturn($res);
    }




    //获取出行详情
    public function travelDetail($id){
        $travelM=new TravelModel();
        $travel=$travelM->find($id);
        $this->assign("travel",$travel);

        //申请人个人信息
        $userM=new UserModel();
        $user=$userM->find($travel["user_id"]);
        $this->assign("user",$user);

        //申请人公司信息
        $companyM=new CompanyModel();
        $company=$companyM->find($travel["company_id"]);
        $this->assign("company",$company);


        //出行类型信息
        $travelTypeM=new TravelTypeModel();
        $travel_type=$travelTypeM->find($travel["travel_type_id"]);
        $this->assign("travel_type",$travel_type);


        //用车人个人信息
        $use_user=$userM->find($travel["use_user_id"]);
        $this->assign("use_user",$use_user);


        //需要派车情况下，查询是否已经派车
        $had_send_car=false;
        $is_owner=false;
        if($travel["is_arrange_car"]=="1"){
            if(isset($travel["arrange_type_id"])||isset($travel["car_id"])){
                $had_send_car=true;

                if(isset($travel["arrange_type_id"])){
                    //获取第三方公司信息
                    $arrange_typeM=new ArrangeTypeModel();
                    $arrange_type=$arrange_typeM->find($travel["arrange_type_id"]);
                    $this->assign("arrange_type",$arrange_type);
                }else{
                    $is_owner=true;
                    $carM=new  CarModel();
                    $driverM=new DriverModel();

                    $car=$carM->find($travel["car_id"]);
                    $driver=$driverM->find($travel["driver_id"]);



                    $this->assign("car",$car);
                    $this->assign("driver",$driver);
                }



            }
        }
        $this->assign("is_owner",$is_owner);
        $this->assign("had_send_car",$had_send_car);

        //获取出行凭据
        if($travel["credential"]==""){
            $this->assign("havadata",0);
        }else{
            $this->assign("havadata",1);
        }
        $credentials=explode("|", $travel["credential"]);
        $this->assign("credentials",$credentials);

        //获取所有状态为1车辆
        $carM=new CarModel();
        $cars=$carM->where("state=1")->select();
        $this->assign("cars",$cars);

        //获取所有状态为0的司机
        $driverM=new DriverModel();
        $drivers=$driverM->where("state=0")->select();
        $this->assign("drivers",$drivers);

        //获取所有第三方出行公司
        $arrange_type=new ArrangeTypeModel();
        $arrange_types=$arrange_type->select();
        $this->assign("arrange_types",$arrange_types);


        $this->display();
    }

    private  function getExcel($fileName,$headArr,$data){
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        import("Org.Util.PHPExcel");
        import("Org.Util.PHPExcel.Writer.Excel5");
        import("Org.Util.PHPExcel.IOFactory.php");

        $date = date("Y_m_d",time());
        $fileName .= ".xls";

        //创建PHPExcel对象，注意，不能少了\
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();

        //设置表头
        $key = ord("A");
        $key2 = ord("@");
        //print_r($headArr);exit;
        foreach($headArr as $v){

            if($key>ord("Z")){
                $key2 += 1;
                $key = ord("A");
                $colum = chr($key2).chr($key);//超过26个字母时才会启用  dingling 20150626
            }else{
                if($key2>=ord("A")){
                    $colum = chr($key2).chr($key);
                }else{
                    $colum = chr($key);
                }
            }
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1',$v);
            $key += 1;
        }

        $column = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();

        //print_r($data);exit;
        foreach($data as $key => $rows){ //行写入
            $span = ord("A");
            $span2 = ord("@");

            foreach($rows as $keyName=>$value){// 列写入
                if($span>ord("Z")){
                    $span2 += 1;
                    $span = ord("A");
                    $j = chr($span2).chr($span);//超过26个字母时才会启用  dingling 20150626
                }else{
                    if($span2>=ord("A")){
                        $j = chr($span2).chr($span);
                    }else{
                        $j = chr($span);
                    }
                }
                $objActSheet->setCellValue($j.$column,$value);
                $span++;
            }
            $column++;
        }

        $fileName = iconv("utf-8", "gb2312", $fileName);

        //重命名表
        //$objPHPExcel->getActiveSheet()->setTitle('test');
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        ob_end_clean();//清除缓冲区,避免乱码
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }


    public function getCarList($startTime="",$endTime=null){
        if(isset($end_time)){$end_time=time();}

        if(!empty($_POST)){
            $this->redirect("getCarList",array("startTime"=>$_POST["startTime"],"endTime"=>$_POST["endTime"]));
        }else{

            $this->assign("startTime",$startTime);
            $this->assign("endTime",$endTime);


            if(!empty($startTime)){
                $startTime=strtotime($startTime);
            }else{
                $startTime=0;
            }
            if(!empty($endTime)){
                $endTime=strtotime($endTime);
            }else{
                $endTime=time();
            }

            $this->assign("startTimeStamp",$startTime);
            $this->assign("endTimeStamp",$endTime);
        }





        $this->display();


    }

    public function CarListGetData($startTime="",$endTime=""){
        $carM=new CarModel();
        $res=$carM->order("is_del asc")->select();

        $costWashM=new CostWashModel();
        $costRepairM=new CostRepairModel();
        $costOilM=new CostOilModel();
        $travelM=new TravelModel();
        $costInsuranceM=new CostInsuranceModel();

        $mapTravel['departure_time'] = array(array('gt',$startTime),array('lt',$endTime));

        $count=0;


        for($i=0;$i<count($res)&& count($res);$i++){

            //获取洗车花费总数
            $mapwash['wash_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;
            $res[$i]["costWash"]=$costWashM->where("is_del=0")->where($mapwash)->where(array("car_id"=>$res[$i]["id"]))->sum("cost");
            if(!($res[$i]["costWash"])){$res[$i]["costWash"]=0;}

            //获取维修花费总数
            $mapRepair['start_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;
            $res[$i]["costRepair"]=$costRepairM->where("is_del=0")->where($mapRepair)->where(array("car_id"=>$res[$i]["id"]))->sum("cost");
            if(!($res[$i]["costRepair"])){$res[$i]["costRepair"]=0;}

            //获取加油花费总数
            $mapOil['trading_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;
            $res[$i]["costOil"]=$costOilM->where("is_del=0")->where($mapOil)->where(array("car_id"=>$res[$i]["id"]))->sum("cost");
            if(!($res[$i]["costOil"])){$res[$i]["costOil"]=0;}

            //获取过路费

            $res[$i]["costFees"]=$travelM->where("is_del=0")->where($mapTravel)->where("car_id=".$res[$i]["id"]." and is_del=0")->sum("fees_sum");
            if(!($res[$i]["costFees"])){$res[$i]["costFees"]=0;}

            //获取停车费
            $res[$i]["costParkingRate"]=$travelM->where($mapTravel)->where("car_id=".$res[$i]["id"]." and is_del=0")->sum("parking_rate_sum");
            if(!($res[$i]["costParkingRate"])){$res[$i]["costParkingRate"]=0;}

            //获取保险花费总数
            $mapInsurance['pay_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;
            $res[$i]["costInsurance"]=$costInsuranceM->where($mapInsurance)->where("car_id=".$res[$i]["id"]." and cost_type<3 and is_del=0")->sum("cost");
            if(!($res[$i]["costInsurance"])){$res[$i]["costInsurance"]=0;}

            //获取年检花费总数
            $res[$i]["costInspect"]=$costInsuranceM->where($mapInsurance)->where("car_id=".$res[$i]["id"]." and cost_type=3 and is_del=0")->sum("cost");
            if(!($res[$i]["costInspect"])){$res[$i]["costInspect"]=0;}

            //总花费
            $res[$i]["costSum"]=$res[$i]["costWash"]+$res[$i]["costRepair"]+$res[$i]["costOil"]+$res[$i]["costInsurance"]+$res[$i]["costInspect"]+$res[$i]["costFees"]+$res[$i]["costParkingRate"];

            //获取出行记录总数
            $res[$i]["travelSum"]=$travelM->where($mapTravel)->where("car_id=".$res[$i]["id"])->count();

            $res[$i]["countMaintain"]=$travelM->where("is_del=0")->where(array("car_id"=>$res[$i]["id"]))->sum("mileage");
            if(!($res[$i]["countMaintain"])){$res[$i]["countMaintain"]=0;}

            if($res[$i]["is_del"]=="0"){
                $res[$i]["is_del"]="正常";
            }else{
                $res[$i]["is_del"]="已删除";
            }


        }
        $this->ajaxReturn($res);
    }

    public function getCarListToExcel($startTime="",$endTime=""){
        $carM=new CarModel();
        $res=$carM->order("is_del asc")->select();

        $costWashM=new CostWashModel();
        $costRepairM=new CostRepairModel();
        $costOilM=new CostOilModel();
        $travelM=new TravelModel();
        $costInsuranceM=new CostInsuranceModel();

        $mapTravel['departure_time'] = array(array('gt',$startTime),array('lt',$endTime));


        for($i=0;$i<count($res)&& count($res);$i++){

            //获取洗车花费总数
            $mapwash['wash_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;
            $res[$i]["costWash"]=$costWashM->where($mapwash)->where(array("car_id"=>$res[$i]["id"]))->sum("cost");
            if(!($res[$i]["costWash"])){$res[$i]["costWash"]=0;}

            //获取维修花费总数
            $mapRepair['start_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;
            $res[$i]["costRepair"]=$costRepairM->where($mapRepair)->where(array("car_id"=>$res[$i]["id"]))->sum("cost");
            if(!($res[$i]["costRepair"])){$res[$i]["costRepair"]=0;}

            //获取加油花费总数
            $mapOil['trading_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;
            $res[$i]["costOil"]=$costOilM->where($mapOil)->where(array("car_id"=>$res[$i]["id"]))->sum("cost");
            if(!($res[$i]["costOil"])){$res[$i]["costOil"]=0;}

            //获取保险花费总数

            $mapInsurance['pay_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;
            $res[$i]["costInsurance"]=$costInsuranceM->where($mapInsurance)->where("car_id=".$res[$i]["id"]." and cost_type<3")->sum("cost");
            if(!($res[$i]["costInsurance"])){$res[$i]["costInsurance"]=0;}

            //获取年检花费总数
            $res[$i]["costInspect"]=$costInsuranceM->where($mapInsurance)->where("car_id=".$res[$i]["id"]." and cost_type=3")->sum("cost");
            if(!($res[$i]["costInspect"])){$res[$i]["costInspect"]=0;}

            //获取过路费
            $res[$i]["costFees"]=$travelM->where($mapTravel)->where("car_id=".$res[$i]["id"])->sum("fees_sum");
            if(!($res[$i]["costFees"])){$res[$i]["costFees"]=0;}

            //获取停车费
            $res[$i]["costParkingRate"]=$travelM->where($mapTravel)->where("car_id=".$res[$i]["id"])->sum("parking_rate_sum");
            if(!($res[$i]["costParkingRate"])){$res[$i]["costParkingRate"]=0;}
            $res[$i]["costSum"]=$res[$i]["costWash"]+$res[$i]["costRepair"]+$res[$i]["costOil"]+$res[$i]["costInsurance"]+$res[$i]["costInspect"]+$res[$i]["costFees"]+$res[$i]["costParkingRate"];

            $res[$i]["countMaintain"]=$travelM->where(array("car_id"=>$res[$i]["id"]))->sum("mileage");
            if(!($res[$i]["countMaintain"])){$res[$i]["countMaintain"]=0;}

            //获取出行记录总数
            $res[$i]["travelSum"]=$travelM->where($mapTravel)->where("car_id=".$res[$i]["id"])->count();


            if($res[$i]["is_law_car"]==1){
                $res[$i]["is_law_car"]="是";
            }else{
                $res[$i]["is_law_car"]="否";
            }

            if($res[$i]["is_del"]=="0"){
                $res[$i]["is_del"]="正常";
            }else{
                $res[$i]["is_del"]="已删除";
            }

            unset($res[$i]["color"]);
            unset($res[$i]["imei"]);
            unset($res[$i]["next_maintain_num"]);
            unset($res[$i]["next_inspect_time"]);
            unset($res[$i]["maintain_interval"]);
            unset($res[$i]["state"]);

        }



        foreach ($res as $field=>$v){
            if($field == 'id'){
                $headArr[]='ID';
            }

            if($field == 'car_num'){
                $headArr[]='车牌号码';
            }





            if($field == 'seat_num'){
                $headArr[]='座位数';
            }

            if($field == 'engine_num'){
                $headArr[]='发动机号';
            }

            if($field == 'frame_num'){
                $headArr[]='车架号';
            }

            if($field == 'compulsory_insurance_time'){
                $headArr[]='交强险到期时间';
            }

            if($field == 'commercial_insurance_time'){
                $headArr[]='商业险到期时间';
            }

            if($field == 'car_name'){
                $headArr[]='车型';
            }

            if($field == 'is_law_car'){
                $headArr[]='是否为执法车';
            }

            if($field == 'number'){
                $headArr[]='编号';
            }

            if($field == 'brand'){
                $headArr[]='车辆品牌';
            }

            if($field == 'buy_time'){
                $headArr[]='购车时间';
            }

            if($field == 'old_company'){
                $headArr[]='原属单位';
            }

            if($field == 'new_company'){
                $headArr[]='现属单位';
            }

            if($field == 'hava_driver_lince'){
                $headArr[]='是否有行驶证';
            }

            if($field == 'have_registration'){
                $headArr[]='车牌号';
            }

            if($field == 'have_tax'){
                $headArr[]='是否有车辆购置税';
            }

            if($field == 'remarks'){
                $headArr[]='备注';
            }

            if($field == 'is_del'){
                $headArr[]='状态';
            }

            if($field == 'costWash'){
                $headArr[]='洗车花费';
            }
            if($field == 'costRepair'){
                $headArr[]='维修花费';
            }

            if($field == 'costOil'){
                $headArr[]='加油花费';
            }
            if($field == 'costInsurance'){
                $headArr[]='保险费用';
            }
            if($field == 'costInspect'){
                $headArr[]='年检费用';
            }

            if($field == 'costFees'){
                $headArr[]='过路费';
            }

            if($field == 'costParkingRate'){
                $headArr[]='停车费';
            }

            if($field == 'costSum'){
                $headArr[]='花费总和';
            }

            if($field == 'countMaintain'){
                $headArr[]='出行里程数';
            }

            if($field == 'travelSum'){
                $headArr[]='出行次数';
            }



        }




        $filename=date("Y-m-d",$startTime)."至".date("Y-m-d",$endTime);

        $this->getExcel($filename,$headArr,$res);


    }

    //获取车辆花费统计数据
    public function getCarCostList($carId,$startTimeStamp,$endTimeStamp){

        $this->assign("carId",$carId);
        $this->assign("startTimeStamp",$startTimeStamp);
        $this->assign("endTimeStamp",$endTimeStamp);

        $this->display();
    }

    public function CarCostGetData($carId,$startTimeStamp,$endTimeStamp){

        $costWashM=new CostWashModel();
        $costRepairM=new CostRepairModel();
        $costOilM=new CostOilModel();
        $costInsuranceM=new CostInsuranceModel();
        $travelM=new TravelModel();

        $res=array();

        $data=array();

        //获取洗车记录
        $mapwash['wash_time'] = array(array('gt',$startTimeStamp),array('lt',$endTimeStamp)) ;
        $resWash=$costWashM->where($mapwash)->where(array("car_id"=>$carId))->select();

        for($i=0;$i<count($resWash)&&count($resWash)!=0;$i++){
            $data["costTime"]=$resWash[$i]["wash_time"];
            $data["purpose"]="洗车消费";
            $data["cost"]=$resWash[$i]["cost"];

            array_push($res,$data);
        }



        //获取维修记录
        $mapwash['start_time'] = array(array('gt',$startTimeStamp),array('lt',$endTimeStamp)) ;
        $resWash=$costRepairM->where($mapwash)->where(array("car_id"=>$carId))->select();

        for($i=0;$i<count($resWash)&&count($resWash)!=0;$i++){
            $data["costTime"]=$resWash[$i]["start_time"];
            $data["purpose"]="车辆维修--".$resWash[$i]["reason"];
            $data["cost"]=$resWash[$i]["cost"];

            array_push($res,$data);
        }


        //获取加油记录
        $mapwash['trading_time'] = array(array('gt',$startTimeStamp),array('lt',$endTimeStamp)) ;
        $resWash=$costOilM->where($mapwash)->where(array("car_id"=>$carId))->select();

        for($i=0;$i<count($resWash)&&count($resWash)!=0;$i++){
            $data["costTime"]=$resWash[$i]["trading_time"];
            $data["purpose"]="加油";
            $data["cost"]=$resWash[$i]["cost"];

            array_push($res,$data);
        }



        //获取保险，年检费用

        $mapwash['pay_time'] = array(array('gt',$startTimeStamp),array('lt',$endTimeStamp)) ;
        $resWash=$costInsuranceM->where($mapwash)->where("car_id=".$carId." and cost_type<3")->select();

        for($i=0;$i<count($resWash)&&count($resWash)!=0;$i++){
            $data["costTime"]=$resWash[$i]["pay_time"];
            $data["purpose"]="保险费用";
            $data["cost"]=$resWash[$i]["cost"];

            array_push($res,$data);
        }

        //获取年检费用

        $mapwash['pay_time'] = array(array('gt',$startTimeStamp),array('lt',$endTimeStamp)) ;
        $resWash=$costInsuranceM->where($mapwash)->where("car_id=".$carId." and cost_type=3")->select();

        for($i=0;$i<count($resWash)&&count($resWash)!=0;$i++){
            $data["costTime"]=$resWash[$i]["pay_time"];
            $data["purpose"]="年检费用";
            $data["cost"]=$resWash[$i]["cost"];

            array_push($res,$data);
        }

        //获取过路费记录
        $mapTravel['start_use_car_time'] = array(array('gt',$startTimeStamp),array('lt',$endTimeStamp)) ;
        $resWash=$travelM->where($mapTravel)->where("is_del=0 and fees_sum>0 and car_id=".$carId)->select();
        for($i=0;$i<count($resWash)&&count($resWash)!=0;$i++){
            $data["costTime"]=$resWash[$i]["start_use_car_time"];
            $data["purpose"]="出行过路费";
            $data["cost"]=$resWash[$i]["fees_sum"];

            array_push($res,$data);
        }

        //获取停车费记录
        $mapTravel['start_use_car_time'] = array(array('gt',$startTimeStamp),array('lt',$endTimeStamp)) ;
        $resWash=$travelM->where($mapTravel)->where("is_del=0 and parking_rate_sum>0 and car_id=".$carId)->select();
        for($i=0;$i<count($resWash)&&count($resWash)!=0;$i++){
            $data["costTime"]=$resWash[$i]["start_use_car_time"];
            $data["purpose"]="出行停车费";
            $data["cost"]=$resWash[$i]["parking_rate_sum"];

            array_push($res,$data);
        }


        $this->ajaxReturn($res);
    }


    public function getCarTravelList($carId,$startTimeStamp,$endTimeStamp){
        $this->assign("startTimeStamp",$startTimeStamp);
        $this->assign("endTimeStamp",$endTimeStamp);
        $this->assign("carId",$carId);

        $this->display();
    }

    public function CarTravelListGetData($carId,$startTimeStamp="",$endTimeStamp=""){



        $travelM=new TravelModel();
        $map['car_id']  = array('eq',$carId);
        $map['departure_time'] = array(array('gt',$startTimeStamp),array('lt',$endTimeStamp)) ;



        $res=$travelM->where($map)->order("id desc")->select();

        $travelTypeM=new TravelTypeModel();

        for ($i = 0; $i < count($res)&&count($res)!=0; $i++) {
            $traverType=$travelTypeM->find($res[$i]["travel_type_id"]);
            $res[$i]["travel_type_name"]=$traverType["travel_name"];

            //获取出行人信息
            $userM=new UserModel();
            $user=$userM->find($res[$i]["use_user_id"]);
            $res[$i]["user_name"]=$user["user_name"];

            //获取出行人单位信息
            $companyM=new CompanyModel();
            $company=$companyM->find($res[$i]["company_id"]);
            $res[$i]["user_company"]=$company["company_name"];
        }

        $this->ajaxReturn($res);
    }

    public function getCarTravelListToExcel($carId,$startTimeStamp="",$endTimeStamp=""){
        $travelM=new TravelModel();
        $map['car_id']  = array('eq',$carId);
        $map['departure_time'] = array(array('gt',$startTimeStamp),array('lt',$endTimeStamp)) ;



        $res=$travelM->where($map)->where("is_del=0")->order("id desc")->select();
        $this->travelToExcel($res);
    }



    //获取司机数据统计
    public function getDriverList($startTime="",$endTime=null){
        if(isset($end_time)){$end_time=time();}

        if(!empty($_POST)){
            $this->redirect("getDriverList",array("startTime"=>$_POST["startTime"],"endTime"=>$_POST["endTime"]));
        }else{

            $this->assign("startTime",$startTime);
            $this->assign("endTime",$endTime);


            if(!empty($startTime)){
                $startTime=strtotime($startTime);
            }else{
                $startTime=0;
            }
            if(!empty($endTime)){
                $endTime=strtotime($endTime);
            }else{
                $endTime=time();
            }

            $this->assign("startTimeStamp",$startTime);
            $this->assign("endTimeStamp",$endTime);
        }

        $this->display();
    }

    public function driverListGetData($startTime="",$endTime=""){

        $driverM=new DriverModel();
        $res=$driverM->order("is_del asc")->select();

        //找出该司机时间段内的出行单数
        $travelM=new TravelModel();

        $count=0;

        for($i=0;$i<count($res)&&count($res)!=0;$i++){

            $map['driver_id']  = array('eq',$res[$i]["id"]);
            $map['departure_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;


            $res[$i]["count"]=$travelM->where($map)->count();//该司机所有出行记录条数


            if($res[$i]["is_del"]=="0"){
                $res[$i]["is_del"]="正常";
            }else{
                $res[$i]["is_del"]="已删除";
            }

        }




        $this->ajaxReturn($res);
    }

    //司机导出EXCEL
    public function driverListToExcel($startTime="",$endTime=""){
        $driverM=new DriverModel();
        $res=$driverM->order("is_del asc")->select();

        //找出该司机时间段内的出行单数
        $travelM=new TravelModel();
        for($i=0;$i<count($res)&&count($res)!=0;$i++){

            $map['driver_id']  = array('eq',$res[$i]["id"]);
            $map['departure_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;

            if($res[$i]["is_del"]=="0"){
                $res[$i]["is_del"]="正常";
            }else{
                $res[$i]["is_del"]="已删除";
            }

            $res[$i]["count"]=$travelM->where($map)->count();//该单位所有出行记录条数

            if(($res[$i]["driver_lic_time"])){
                $res[$i]["driver_lic_time"]=date("Y-m-d H:i:s",$res[$i]["driver_lic_time"]);
            }else{
                $res[$i]["driver_lic_time"]="";
            }

            if(($res[$i]["induction_time"])){
                $res[$i]["induction_time"]=date("Y-m-d H:i:s",$res[$i]["induction_time"]);
            }else{
                $res[$i]["induction_time"]="";
            }

            if(($res[$i]["contract_start_time"])){
                $res[$i]["contract_start_time"]=date("Y-m-d H:i:s",$res[$i]["contract_start_time"]);
            }else{
                $res[$i]["contract_start_time"]="";
            }

            if(($res[$i]["contract_end_time"])){
                $res[$i]["contract_end_time"]=date("Y-m-d H:i:s",$res[$i]["contract_end_time"]);
            }else{
                $res[$i]["contract_end_time"]="";
            }

            $res[$i]["driver_idcard"]=$res[$i]["driver_idcard"]." ";
            $res[$i]["driver_phone"]=$res[$i]["driver_phone"]." ";




            unset($res[$i]["driver_age"]);
            unset($res[$i]["state"]);
            unset($res[$i]["driver_pwd"]);
            unset($res[$i]["error_num"]);
            unset($res[$i]["entity_name"]);
        }





        foreach ($res as $field=>$v){
            if($field == 'id'){
                $headArr[]='ID';
            }

            if($field == 'driver_name'){
                $headArr[]='司机姓名';
            }

            if($field == 'driver_idcard'){
                $headArr[]='身份证号码';
            }

            if($field == 'driver_phone'){
                $headArr[]='手机号码';
            }

            if($field == 'driver_lic_time'){
                $headArr[]='驾驶证到期时间';
            }

            if($field == 'department'){
                $headArr[]='委托管理部门';
            }

            if($field == 'lic_type'){
                $headArr[]='准驾车型';
            }

            if($field == 'induction_time'){
                $headArr[]='入职时间';
            }

            if($field == 'contract_start_time'){
                $headArr[]='合同开始时间';
            }

            if($field == 'contract_end_time'){
                $headArr[]='合同结束时间';
            }

            if($field == 'address'){
                $headArr[]='地址';
            }

            if($field == 'remarks'){
                $headArr[]='备注';
            }

            if($field == 'is_del'){
                $headArr[]='状态';
            }

            if($field == 'count'){
                $headArr[]='出行总数';
            }







        }


        $filename=date("Y-m-d",$startTime)."至".date("Y-m-d",$endTime);

        $this->getExcel($filename,$headArr,$res);
    }



    public function getDriverTravelList($driverId,$startTimeStamp,$endTimeStamp){
        $this->assign("startTimeStamp",$startTimeStamp);
        $this->assign("endTimeStamp",$endTimeStamp);
        $this->assign("driverId",$driverId);

        $this->display();
    }


    public function driverTravelListGetData($driverId,$startTimeStamp="",$endTimeStamp=""){



        $travelM=new TravelModel();
        $map['driver_id']  = array('eq',$driverId);
        $map['departure_time'] = array(array('gt',$startTimeStamp),array('lt',$endTimeStamp)) ;



        $res=$travelM->where($map)->where("is_del=0")->order("id desc")->select();

        $travelTypeM=new TravelTypeModel();

        for ($i = 0; $i < count($res)&&count($res)!=0; $i++) {
            $traverType=$travelTypeM->find($res[$i]["travel_type_id"]);
            $res[$i]["travel_type_name"]=$traverType["travel_name"];

            //获取出行人信息
            $userM=new UserModel();
            $user=$userM->find($res[$i]["use_user_id"]);
            $res[$i]["user_name"]=$user["user_name"];

            //获取出行人单位信息
            $companyM=new CompanyModel();
            $company=$companyM->find($res[$i]["company_id"]);
            $res[$i]["user_company"]=$company["company_name"];

        }

        $this->ajaxReturn($res);
    }

    //司机出行数据导出Excel
    public function getDriverTravelListToExcel($driverId,$startTimeStamp="",$endTimeStamp=""){
        $travelM=new TravelModel();
        $map['driver_id']  = array('eq',$driverId);
        $map['departure_time'] = array(array('gt',$startTimeStamp),array('lt',$endTimeStamp)) ;



        $res=$travelM->where("is_del=0")->where($map)->order("id desc")->select();

        $this->travelToExcel($res);
    }

    public function getUserList($startTime="",$endTime=null){
        if(isset($end_time)){$end_time=time();}

        if(!empty($_POST)){
            $this->redirect("getUserList",array("startTime"=>$_POST["startTime"],"endTime"=>$_POST["endTime"]));
        }else{

            $this->assign("startTime",$startTime);
            $this->assign("endTime",$endTime);


            if(!empty($startTime)){
                $startTime=strtotime($startTime);
            }else{
                $startTime=0;
            }
            if(!empty($endTime)){
                $endTime=strtotime($endTime);
            }else{
                $endTime=time();
            }

            $this->assign("startTimeStamp",$startTime);
            $this->assign("endTimeStamp",$endTime);
        }

        $this->display();
    }


    public function userListGetData($startTime="",$endTime=""){


        $userM=new UserModel();
        $res=$userM->order("is_del asc")->select();

        //找出该司机时间段内的出行单数
        $travelM=new TravelModel();
        for($i=0;$i<count($res)&&count($res)!=0;$i++){

            $map['user_id']  = array('eq',$res[$i]["id"]);
            $map['departure_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;


            $res[$i]["count"]=$travelM->where($map)->count();//该单位所有出行记录条数


            if($res[$i]["is_del"]==0){
                $res[$i]["is_del"]="正常";
            }else{
                $res[$i]["is_del"]="已删除";
            }

        }



        $this->ajaxReturn($res);
    }


    public function getUserListToExcel($startTime="",$endTime=""){

        $userM=new UserModel();
        $res=$userM->order("is_del asc")->select();

        //找出该司机时间段内的出行单数
        $travelM=new TravelModel();
        for($i=0;$i<count($res)&&count($res)!=0;$i++){

            $map['user_id']  = array('eq',$res[$i]["id"]);
            $map['departure_time'] = array(array('gt',$startTime),array('lt',$endTime)) ;


            $res[$i]["count"]=$travelM->where($map)->count();//该单位所有出行记录条数

            if($res[$i]["is_del"]==0){
                $res[$i]["is_del"]="正常";
            }else{
                $res[$i]["is_del"]="已删除";
            }

            //unset($res[$i]["is_del"]);
            unset($res[$i]["user_pwd"]);
            unset($res[$i]["user_company"]);
            unset($res[$i]["user_state"]);
            unset($res[$i]["user_birthday"]);
            unset($res[$i]["error_msg"]);

            unset($res[$i]["first_letter_full_spell"]);
            unset($res[$i]["full_spell"]);
            unset($res[$i]["first_letter"]);


        }



        foreach ($res as $field=>$v){
            if($field == 'id'){
                $headArr[]='ID';
            }

            if($field == 'user_phone'){
                $headArr[]='手机号码';
            }

            if($field == 'user_sex'){
                $headArr[]='性别';
            }

            if($field == 'user_email'){
                $headArr[]='邮箱';
            }

            if($field == 'user_name'){
                $headArr[]='姓名';
            }

            if($field == 'user_idcard'){
                $headArr[]='身份证号码';
            }

            if($field == 'is_del'){
                $headArr[]='状态';
            }

            if($field == 'count'){
                $headArr[]='出行总数';
            }





        }


        $filename=date("Y-m-d",$startTime)."至".date("Y-m-d",$endTime);

        $this->getExcel($filename,$headArr,$res);



    }


    public function getUserTravelList($userId,$startTimeStamp,$endTimeStamp){
        $this->assign("startTimeStamp",$startTimeStamp);
        $this->assign("endTimeStamp",$endTimeStamp);
        $this->assign("userId",$userId);

        $this->display();
    }


    public function userTravelListGetData($userId,$startTimeStamp="",$endTimeStamp=""){



        $travelM=new TravelModel();
        $map['user_id']  = array('eq',$userId);
        $map['departure_time'] = array(array('gt',$startTimeStamp),array('lt',$endTimeStamp)) ;



        $res=$travelM->where($map)->order("id desc")->select();



        $travelTypeM=new TravelTypeModel();

        for ($i = 0; $i < count($res)&&count($res)!=0; $i++) {
            $traverType=$travelTypeM->find($res[$i]["travel_type_id"]);
            $res[$i]["travel_type_name"]=$traverType["travel_name"];

            //获取出行人信息
            $userM=new UserModel();
            $user=$userM->find($res[$i]["use_user_id"]);
            $res[$i]["user_name"]=$user["user_name"];

            //获取出行人单位信息
            $companyM=new CompanyModel();
            $company=$companyM->find($res[$i]["company_id"]);
            $res[$i]["user_company"]=$company["company_name"];

        }

        $this->ajaxReturn($res);
    }

    //用户数据导出
    public function getUserTravelListToExcel($userId,$startTimeStamp="",$endTimeStamp=""){
        $travelM=new TravelModel();
        $map['user_id']  = array('eq',$userId);
        $map['departure_time'] = array(array('gt',$startTimeStamp),array('lt',$endTimeStamp)) ;



        $res=$travelM->where($map)->order("id desc")->select();

        $this->travelToExcel($res);

    }

    public function travelToExcel($res,$filename="出行详情"){
        $travelTypeM=new TravelTypeModel();
        $driverM=new DriverModel();
        $companyM=new CompanyModel();
        $carM=new CarModel();
        $userM=new UserModel();
        $arrange_typeM=new ArrangeTypeModel();

        $travles=array();

        //进行数据处理
        for ($i = 0; $i < count($res)&&count($res)!=0; $i++) {
            //id
            $travles[$i]["id"]=$res[$i]["id"];
            //流水号
            $travles[$i]["serial_number"]=$res[$i]["serial_number"]." ";
            //出车单号
            $travles[$i]["dispatch_number"]=$res[$i]["dispatch_number"]." ";

            //是否已经删除
            if($res[$i]["is_del"]==0){
                $travles[$i]["is_del"]="正常";
            }else{
                $travles[$i]["is_del"]="已销单";
            }
            
            //获取出行人信息
            $user=$userM->find($res[$i]["user_id"]);
            $travles[$i]["user_id"]=$user["user_name"];

            //用车人信息
            $use_user=$userM->find($res[$i]["use_user_id"]);
            $travles[$i]["use_user_id"]=$use_user["user_name"];

            //出发地点
            $travles[$i]["from_place"]=$res[$i]["from_place"];
            //目的地
            $travles[$i]["to_place"]=$res[$i]["to_place"];

            //预约时间
            if(isset($res[$i]["departure_time"])){
                $travles[$i]["departure_time"]=date("Y-m-d H:i:s",$res[$i]["departure_time"]);
            }else{
                $travles[$i]["departure_time"]="";
            }
            //乘车人数
            $travles[$i]["people_num"]=$res[$i]["people_num"];
            //乘车人
            $travles[$i]["travel_people"]=$res[$i]["travel_people"];
            //出行是由
            $travles[$i]["travel_reason"]=$res[$i]["travel_reason"];
            //出行性质
            $travles[$i]["travel_nature"]=$res[$i]["travel_nature"];
            //出行类型
            $traverType=$travelTypeM->find($res[$i]["travel_type_id"]);
            $travles[$i]["travel_name"]=$traverType["travel_name"];
            //第三方用车单位
            if(isset($res[$i]["arrange_type_id"])){
                $arrange_type=$arrange_typeM->find($res[$i]["arrange_type_id"]);
                $travles[$i]["arrange_type_id"]=$arrange_type["arrange_name"];
            }else{
                $travles[$i]["arrange_type_id"]="";
            }
            //获取车牌号码
            $car=$carM->find($res[$i]["car_id"]);
            $travles[$i]["car_id"]=$car["car_num"];
            //获取司机姓名
            $driver=$driverM->find($res[$i]["driver_id"]);
            $travles[$i]["driver_id"]=$driver["driver_name"];
            //单位审核结果
            if(isset($res[$i]["manage_res"])){
                if($res[$i]["manage_res"]==0){
                    $travles[$i]["manage_res"]="驳回";
                }else{
                    $travles[$i]["manage_res"]="通过";
                }
            }else{
                $travles[$i]["manage_res"]="未填写";
            }
            //单位驳回原因
            $travles[$i]["manage_error_msg"]=$res[$i]["manage_error_msg"];
            //单位审核时间
            if(isset($res[$i]["manage_time"])){
                $travles[$i]["manage_time"]=date("Y-m-d H:i:s",$res[$i]["manage_time"]);
            }else{
                $travles[$i]["manage_time"]="";
            }
            //中心审核结果
            if(isset($res[$i]["center_res"])){
                if($res[$i]["center_res"]==0){
                    $travles[$i]["center_res"]="驳回";
                }else{
                    $travles[$i]["center_res"]="通过";
                }
            }else{
                $travles[$i]["center_res"]="未填写";
            }
            //中心驳回原因
            $travles[$i]["center_error_msg"]=$res[$i]["center_error_msg"];
            //中心审核时间
            if(isset($res[$i]["center_time"])){
                $travles[$i]["center_time"]=date("Y-m-d H:i:s",$res[$i]["center_time"]);
            }else{
                $travles[$i]["center_time"]="";
            }
            //派车时间
            if(isset($res[$i]["send_car_time"])){
                $travles[$i]["send_car_time"]=date("Y-m-d H:i:s",$res[$i]["send_car_time"]);
            }else{
                $travles[$i]["send_car_time"]="";
            }
            //出车时间
            if(isset($res[$i]["start_car_time"])){
                $travles[$i]["start_car_time"]=date("Y-m-d H:i:s",$res[$i]["start_car_time"]);
            }else{
                $travles[$i]["start_car_time"]="";
            }
            //完成出行时间
            if(isset($res[$i]["finish_time"])){
                $travles[$i]["finish_time"]=date("Y-m-d H:i:s",$res[$i]["finish_time"]);
            }else{
                $travles[$i]["finish_time"]="";
            }
            //提交时间
            if(isset($res[$i]["sign_time"])){
                $travles[$i]["sign_time"]=date("Y-m-d H:i:s",$res[$i]["sign_time"]);
            }else{
                $travles[$i]["sign_time"]="";
            }
            //取消原因
            $travles[$i]["cancel_reason"]=$res[$i]["cancel_reason"];
            //申请取消时间
            if(isset($res[$i]["cancel_time"])){
                $travles[$i]["cancel_time"]=date("Y-m-d H:i:s",$res[$i]["cancel_time"]);
            }else{
                $travles[$i]["cancel_time"]="";
            }
            //开始用车时间
            if(isset($res[$i]["start_use_car_time"])){
                $travles[$i]["start_use_car_time"]=date("Y-m-d H:i:s",$res[$i]["start_use_car_time"]);
            }else{
                $travles[$i]["start_use_car_time"]="";
            }
            //结束用车时间
            if(isset($res[$i]["end_use_car_time"])){
                $travles[$i]["end_use_car_time"]=date("Y-m-d H:i:s",$res[$i]["end_use_car_time"]);
            }else{
                $travles[$i]["end_use_car_time"]="";
            }

            $travles[$i]["start_kilometers"]=$res[$i]["start_kilometers"];
            $travles[$i]["end_kilometers"]=$res[$i]["end_kilometers"];
            $travles[$i]["mileage"]=$res[$i]["mileage"];
            $travles[$i]["fees_num"]=$res[$i]["fees_num"];
            $travles[$i]["fees_sum"]=$res[$i]["fees_sum"];
            $travles[$i]["parking_rate_num"]=$res[$i]["parking_rate_num"];
            $travles[$i]["parking_rate_sum"]=$res[$i]["parking_rate_sum"];
            $travles[$i]["service_charge"]=$res[$i]["service_charge"];
            $travles[$i]["driver_cost"]=$res[$i]["driver_cost"];
            $travles[$i]["over_time_cost"]=$res[$i]["over_time_cost"];
            $travles[$i]["over_mileage_cost"]=$res[$i]["over_mileage_cost"];
            $travles[$i]["else_cost"]=$res[$i]["else_cost"];
            $travles[$i]["totle_rate"]=$res[$i]["totle_rate"];
            $travles[$i]["attitude"]=$res[$i]["attitude"];
            $travles[$i]["evaluate"]=$res[$i]["evaluate"];


            $travles[$i]["pay_type"]=$res[$i]["pay_type"];

            $company=$companyM->find($user["user_company"]);
            $travles[$i]["user_company"]=$company["company_name"];



        }


        foreach ($travles as $field=>$v){
            if($field == 'id'){
                $headArr[]='ID';
            }

            if($field == 'serial_number'){
                $headArr[]='流水号';
            }

            if($field == 'dispatch_number'){
                $headArr[]='出车单号';
            }
            if($field == 'is_del'){
                $headArr[]='是否销单';
            }


            if($field == 'user_id'){
                $headArr[]='申请人';
            }

            if($field == 'use_user_id'){
                $headArr[]='用车人';
            }

            if($field == 'from_place'){
                $headArr[]='出发地';
            }

            if($field == 'to_place'){
                $headArr[]='目的地';
            }

            if($field == 'departure_time'){
                $headArr[]='预约时间';
            }

            if($field == 'people_num'){
                $headArr[]='乘车人数';
            }

            if($field == 'travel_people'){
                $headArr[]='乘车人';
            }

            if($field == 'travel_reason'){
                $headArr[]='出行事由';
            }

            if($field == 'travel_nature'){
                $headArr[]='出行性质';
            }

            if($field == 'travel_name'){
                $headArr[]='出行类型';
            }

            if($field == 'arrange_type_id'){
                $headArr[]='第三方用车单位';
            }

            if($field == 'car_id'){
                $headArr[]='车牌号';
            }

            if($field == 'driver_id'){
                $headArr[]='驾驶员';
            }

            if($field == 'manage_res'){
                $headArr[]='单位审核结果';
            }
            if($field == 'manage_error_msg'){
                $headArr[]='单位驳回原因';
            }
            if($field == 'manage_time'){
                $headArr[]='单位审核时间';
            }

            if($field == 'center_res'){
                $headArr[]='中心审核结果';
            }
            if($field == 'center_error_msg'){
                $headArr[]='中心驳回原因';
            }
            if($field == 'center_time'){
                $headArr[]='中心审核时间';
            }

            if($field == 'send_car_time'){
                $headArr[]='派车时间';
            }

            if($field == 'start_car_time'){
                $headArr[]='出车时间';
            }

            if($field == 'finish_time'){
                $headArr[]='完成出行时间';
            }

            if($field == 'sign_time'){
                $headArr[]='提交时间';
            }

            if($field == 'cancel_reason'){
                $headArr[]='取消出行原因';
            }

            if($field == 'cancel_time'){
                $headArr[]='申请取消时间';
            }

//            if($field == 'state'){
//                $headArr[]='状态';
//            }

            if($field == 'start_use_car_time'){
                $headArr[]='开始用车时间';
            }

            if($field == 'end_use_car_time'){
                $headArr[]='结束用车时间';
            }

            if($field == 'start_kilometers'){
                $headArr[]='开始公里数';
            }

            if($field == 'end_kilometers'){
                $headArr[]='结束公里数';
            }

            if($field == 'mileage'){
                $headArr[]='行驶里程';
            }

            if($field == 'fees_num'){
                $headArr[]='路桥费单据张数';
            }

            if($field == 'fees_sum'){
                $headArr[]='路桥费总金额';
            }

            if($field == 'parking_rate_num'){
                $headArr[]='停车费单据张数';
            }

            if($field == 'parking_rate_sum'){
                $headArr[]='停车费单据总金额';
            }

            if($field == 'service_charge'){
                $headArr[]='出行服务费';
            }

            if($field == 'driver_cost'){
                $headArr[]='司机住宿等花费';
            }

            if($field == 'over_time_cost'){
                $headArr[]='超时费';
            }

            if($field == 'over_mileage_cost'){
                $headArr[]='超公里费';
            }

            if($field == 'else_cost'){
                $headArr[]='其他费用';
            }

            if($field == 'totle_rate'){
                $headArr[]='总金额';
            }

            if($field == 'attitude'){
                $headArr[]='服务评分';
            }

            if($field == 'evaluate'){
                $headArr[]='评价';
            }

            if($field == 'pay_type'){
                $headArr[]='支付方式';
            }

            if($field == 'user_company'){
                $headArr[]='申请单位';
            }

        }


        //$filename=date("Y-m-d",$startTime)."至".date("Y-m-d",$endTime);

        $this->getExcel($filename,$headArr,$travles);
    }




    public function viewTravelList($company="",$car="",$driver="",$user="",$startTime="",$endTime=""){
        $this->assign("company",$company);
        $this->assign("car",$car);
        $this->assign("driver",$driver);
        $this->assign("user",$user);
        $this->assign("startTime",$startTime);
        $this->assign("endTime",$endTime);
        $this->display();
    }


    public function getViewTravelList(){
        if(!empty($_POST["startTime"])){
            $map['departure_time']  = array('gt',strtotime($_POST["startTime"]));
        }
        if(!empty($_POST["endTime"])){
            $map['departure_time']  = array('elt',strtotime($_POST["endTime"])+24*3600);
        }

        if((!empty($_POST["startTime"]))&&!empty($_POST["endTime"])){
            $map['departure_time']  = array('between',array(strtotime($_POST["startTime"]),strtotime($_POST["endTime"])+24*3600));

        }

        //获取筛选条件
        $map["is_del"]=array('eq',0);

        //查询指定单位
        if(!empty($_POST["company"])){
            $map["company_id"]=array('eq',$_POST["company"]);
        }

        //查询指定司机
        if(!empty($_POST["driver"])){
            $map["driver_id"]=array('eq',$_POST["driver"]);
        }

        //查询指定车辆
        if(!empty($_POST["car"])){
            $map["car_id"]=array('eq',$_POST["car"]);
        }

        //查询指定用户
        if(!empty($_POST["user"])){
            $map["user_id"]=array('eq',$_POST["user"]);
        }



        $resCount=M("Travel")->where($map)->select();

        $res=M("Travel")->where($map)->order("id desc")->limit($_POST["start"],$_POST["length"])->select();

        //返回数据
        $travels=array();
        $travels["draw"]=$_POST["draw"];
        $travels["recordsTotal"]=count($resCount);//总记录条数
        $travels["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $travels["data"]=$this->getAllInfo($res);

        $this->ajaxReturn($travels);
    }


    private function getAllInfo($res){
        for ($i = 0; $i < count($res)&&count($res)!=0; $i++) {
            //获取出行类型信息
            $traverType=M("TravelType")->find($res[$i]["travel_type_id"]);
            $res[$i]["travel_type_name"]=$traverType["travel_name"];

            //获取出行人信息
            $userM=new UserModel();
            $user=$userM->find($res[$i]["use_user_id"]);
            $res[$i]["user_name"]=$user["user_name"];

            //获取出行人单位信息
            $companyM=new CompanyModel();
            $company=$companyM->find($user["user_company"]);
            $res[$i]["user_company"]=$company["company_name"];


            if($res[$i]["driver_id"]!=""&&$res[$i]["driver_id"]!=null){
                $driver=M("Driver")->find($res[$i]["driver_id"]);
                $res[$i]["driver_name"] = $driver["driver_name"];

            }else{
                $res[$i]["driver_name"] = $res[$i]["jj_driver_name"];
            }
            if($res[$i]["car_id"]!=""&&$res[$i]["car_id"]!=null) {
                $car=M("Car")->find($res[$i]["car_id"]);
                $res[$i]["car_num"] = $car["car_num"];
            }else{
                $res[$i]["car_num"] = $res[$i]["jj_car_num"];
            }
        }


        return $res;
    }

}