<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/31
 * Time: 13:59
 */

namespace Home\Controller;
use Model\ArrangeTypeModel;
use Model\CarModel;
use Model\DriverModel;
use Model\MessageModel;
use Think\Controller;
use Model\UserModel;
use Model\TravelModel;
use Model\TravelTypeModel;
use Model\CompanyModel;

class CompanyController extends CommonController
{
    public function reviewTravel(){
        $this->display();
    }

    public function allUsers(){
        $this->display();
    }

    public function getAllUsers(){
        $map["is_del"]=0;


        $map["user_company"]=session("user_company");

        $key= $_POST["search"]["value"];
        if(!empty($key)){
            $map['user_phone|user_name'] = array('like', "%$key%");
        }

        $order=array();

        $userM=M("User");
        $resCount=$userM->where($map)->order($order)->select();
        $users=$userM->where($map)->order($order)->limit($_POST["start"],$_POST["length"])->select();

        //返回数据
        $res=array();
        $res["draw"]=$_POST["draw"];
        $res["recordsTotal"]=count($resCount);//总记录条数
        $res["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $res["data"]=$users;

        $this->ajaxReturn($res);

    }

    public function addUser(){
        $company_id=session("user_company");
        $this->assign("company_id",$company_id);
        $this->display();
    }


    public function addUserDo(){
        $_POST["user_pwd"]=md5(md5($_POST["user_pwd"]).md5($_POST["user_pwd"]));
        $_POST["user_state"]=1;

        $res=M("User")->add($_POST);

        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>$res,"error"=>"操作失败，请重试！"));
        }
    }


    public function impUser(){
        $company_id=session("user_company");
        $this->assign("company_id",$company_id);
        $this->display();
    }


    public function impUserDo(){
        $upload = new \Think\Upload();
        // 实例化上传类
        $upload -> maxSize = 50000000000;
        // 设置附件上传大小
        $upload->exts      =     array('xls','xlsx');// 设置附件上传类
        // 设置附件上传类型
        $upload -> rootPath = './Public/excel/';
        // 设置附件上传根目录
        $upload -> savePath = '';
        // 设置附件上传（子）目录
        // 上传文件
        $info = $upload -> uploadOne($_FILES["excel"]);

        $filename = './Public/excel/'.$info['savepath'].$info['savename'];
        $exts = $info['ext'];



        if(!$info) {// 上传错误提示错误信息
            //$this->error($upload->getError());
            //dump($info);

            $this->ajaxReturn(array("code"=>0));
        }else {// 上传成功

            $res = $this->exceldata_import($filename, $exts,$_POST["user_company"]);

            $this->ajaxReturn(array("code"=>1));

        }
    }

    protected function exceldata_import($filename, $exts='xls',$company_id)
    {
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        import("Org.Util.PHPExcel");
        //创建PHPExcel对象，注意，不能少了\
        $PHPExcel=new \PHPExcel();
        //如果excel文件后缀名为.xls，导入这个类
        if($exts == 'xls'){
            import("Org.Util.PHPExcel.Reader.Excel5");
            $PHPReader=new \PHPExcel_Reader_Excel5();
        }else if($exts == 'xlsx'){
            import("Org.Util.PHPExcel.Reader.Excel2007");
            $PHPReader=new \PHPExcel_Reader_Excel2007();
        }


        //载入文件
        $PHPExcel=$PHPReader->load($filename);

        //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
        $currentSheet=$PHPExcel->getSheet(0);
        //获取总列数
        $allColumn=$currentSheet->getHighestColumn();
        //获取总行数
        $allRow=$currentSheet->getHighestRow();
        //循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始

        $companyM=M("Company");



        for($currentRow=2;$currentRow<=$allRow;$currentRow++){
            //从哪列开始，A表示第一列
            $data=array();

            for($currentColumn='A';$currentColumn<=$allColumn;$currentColumn++){
                //数据坐标
                $address=$currentColumn.$currentRow;
                //读取到的数据，保存到数组$arr中
                $cell =$currentSheet->getCell($address)->getValue();
                //$cell = $data[$currentRow][$currentColumn];
                if($cell instanceof PHPExcel_RichText){
                    $cell  = $cell->__toString();
                }


                //处理数据
                switch ($currentColumn){
                    case "A":
                        $data["user_name"]=$cell;
                        break;
                    case "B":
                        $data["user_phone"]=$cell;
                        break;
                }

            }


            //dump($data);

            //检测这个手机号号码是否存在了
            $adminUser=M("User")->getByUserPhone($data["user_phone"]);

            if($adminUser){

            }else{
                $user=array();
                $user["user_name"]=$data["user_name"];
                $user["user_phone"]=$data["user_phone"];
                $user["user_pwd"]=md5(md5($data["user_phone"]).md5($data["user_phone"]));
                $user["user_company"]=$company_id;
                $user["user_state"]=1;
                $user["is_del"]=0;
                M("User")->add($user);
            }








        }




    }


    public function getReviewTravel(){
        $map["is_del"]=0;
        //$user=M("User")->find(session("user_id"));
        //$map["user_id"]=$user["id"];
        //$this->assign("user",$user);

        $map["company_id"]=session("user_company");
        $map["state"]=0;

        $key= $_POST["search"]["value"];
        if(!empty($key)){
            $map['serial_number | from_place | to_place | people_num | travel_people | travel_reason | route '] = array('like', "%$key%");
        }

        $order=array();
        switch ($_POST["order"][0]["column"])
        {
            case 1:
                $order["serial_number"]=$_POST["order"][0]["dir"];
                break;
            case 2:
                $order["from_place"]=$_POST["order"][0]["dir"];
                break;
            case 3:
                $order["to_place"]=$_POST["order"][0]["dir"];
                break;
            case 4:
                $order["departure_time"]=$_POST["order"][0]["dir"];
                break;
            case 5:
                $order["travel_type_id"]=$_POST["order"][0]["dir"];
                break;
            case 10:
                $order["state"]=$_POST["order"][0]["dir"];
                break;

        }

        $travelM=new TravelModel();
        $resCount=$travelM->where($map)->order($order)->select();
        $travels=$travelM->where($map)->order($order)->limit($_POST["start"],$_POST["length"])->select();

        $travelTypeM=new TravelTypeModel();
        for ($i = 0; $i < count($travels)&&count($travels)!=0; $i++) {
            $traverType=$travelTypeM->find($travels[$i]["travel_type_id"]);
            $travels[$i]["travel_type_name"]=$traverType["travel_name"];
        }

        //返回数据
        $res=array();
        $res["draw"]=$_POST["draw"];
        $res["recordsTotal"]=count($resCount);//总记录条数
        $res["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $res["data"]=$travels;

        $this->ajaxReturn($res);
    }

    public function reviewTravelDo(){
        $id=$_POST["id"];
        $travel=M("Travel")->find($id);
        $travelM=new TravelModel();

        //审核通过
        if($_POST["type"]==1){
            //判断状态
            if($travel["is_need_center_review"]==1){
                $travel["state"]=1;
            }else{
                if($travel["is_arrange_car"]==1){
                    $travel["state"]=3;
                }else{
                    $travel["state"]=9;
                }
            }


            $travel["manage_res"]=1;
            $travel["manage_time"]=time();

            if(M("Travel")->save($travel)){
                $travel=$travelM->find($_POST["id"]);
                $data=array(
                    "to_user_id"=>$travel["user_id"],
                    "title"=>"出行申请单位审核通过",
                    "content"=>"恭喜您，您的出行申请单位管理员审核通过，通过时间为".date("Y-m-d H:i:s",time()),
                    "creat_time"=>time(),
                    "is_read"=>0
                );
                $messageM=new MessageModel();
                $messageM->add($data);

                $this->ajaxReturn(array("code"=>1));
            }else{
                $this->ajaxReturn(array("code"=>0,"error"=>"操作失败"));
            }

        }else{
            $travel["state"]=2;
            $travel["manage_res"]=0;
            $travel["manage_time"]=time();
            $travel["manage_error_msg"]=$_POST["manage_error_msg"];
            if(M("Travel")->save($travel)){
                $travel=$travelM->find($_POST["id"]);

                $data=array(
                    "to_user_id"=>$travel["user_id"],
                    "title"=>"出行申请单位审核未通过",
                    "content"=>"对不起，您的出行申请单位管理员审核未通过，审核时间：".date("Y-m-d H:i:s",time()),
                    "creat_time"=>time(),
                    "is_read"=>0
                );
                $messageM=new MessageModel();
                $messageM->add($data);
                $this->ajaxReturn(array("code"=>1));
            }else{
                $this->ajaxReturn(array("code"=>0,"error"=>"操作失败"));
            }
        }
    }

    public function allTravels(){
        //获取所有司机
        $drivers=M("driver")->where("is_del=0")->select();
        $this->assign("drivers",$drivers);
        //获取所有车辆
        $cars=M("car")->where("is_del=0")->select();
        $this->assign("cars",$cars);

        $this->display();
    }

    public function toExcel(){

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


        if($_POST["car"]!=0){
            $map['car_id'] = array('eq',$_POST["car"]);
        }
        if($_POST["driver"]!=0){
            $map['driver_id'] = array('eq',$_POST["driver"]);
        }
        if(!empty($_POST["state"])) {
            if ($_POST["state"] != "all") {
                $map['state'] = array('eq', $_POST["state"]);
            }
        }


        $map["company_id"]=session("user_company");


        $res=M("Travel")->where($map)->order("id asc")->select();
        $this->travelToExcel($res);
    }


    public function travelToExcel($res,$filename="单位出行详情"){
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

    public function getAllTravels(){
        $map["is_del"]=0;
        //$user=M("User")->find(session("user_id"));
        //$map["user_id"]=$user["id"];
        //$this->assign("user",$user);


        //获取筛选条件
        if(!empty($_POST["startTime"])){
            $map['departure_time']  = array('gt',strtotime($_POST["startTime"]));
        }
        if(!empty($_POST["endTime"])){
            $map['departure_time']  = array('elt',strtotime($_POST["endTime"])+24*3600);
        }

        if((!empty($_POST["startTime"]))&&!empty($_POST["endTime"])){
            $map['departure_time']  = array('between',array(strtotime($_POST["startTime"]),strtotime($_POST["endTime"])+24*3600));
        }

        if($_POST["car"]!=0){
            $map['car_id'] = array('eq',$_POST["car"]);
        }
        if($_POST["driver"]!=0){
            $map['driver_id'] = array('eq',$_POST["driver"]);
        }

        if(!empty($_POST["state"])){
            if($_POST["state"]!="all"){
                $map['state'] = array('eq',$_POST["state"]);
            }
        }


        $map["company_id"]=session("user_company");


        $key= $_POST["search"]["value"];
        if(!empty($key)){
            $map['serial_number | from_place | to_place | people_num | travel_people | travel_reason | route '] = array('like', "%$key%");
        }

        $order=array();
        switch ($_POST["order"][0]["column"])
        {
            case 1:
                $order["serial_number"]=$_POST["order"][0]["dir"];
                break;
            case 2:
                $order["from_place"]=$_POST["order"][0]["dir"];
                break;
            case 3:
                $order["to_place"]=$_POST["order"][0]["dir"];
                break;
            case 4:
                $order["departure_time"]=$_POST["order"][0]["dir"];
                break;
            case 5:
                $order["travel_type_id"]=$_POST["order"][0]["dir"];
                break;
            case 10:
                $order["state"]=$_POST["order"][0]["dir"];
                break;

        }

        $travelM=new TravelModel();
        $resCount=$travelM->where($map)->order($order)->select();
        $travels=$travelM->where($map)->order($order)->limit($_POST["start"],$_POST["length"])->select();

        $travelTypeM=new TravelTypeModel();
        for ($i = 0; $i < count($travels)&&count($travels)!=0; $i++) {
            $traverType=$travelTypeM->find($travels[$i]["travel_type_id"]);
            $travels[$i]["travel_type_name"]=$traverType["travel_name"];
        }

        //返回数据
        $res=array();
        $res["draw"]=$_POST["draw"];
        $res["recordsTotal"]=count($resCount);//总记录条数
        $res["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $res["data"]=$travels;

        $this->ajaxReturn($res);
    }
}