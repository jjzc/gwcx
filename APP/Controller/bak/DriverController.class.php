<?php
namespace APP\Controller;
use Model\CarModel;
use Model\CostOilModel;
use Model\DriverModel;
use Model\SetModel;
use Model\TravelModel;
use Model\UserModel;
use Think\Controller;
class DriverController extends Controller {
    public function login(){
        if(empty($_POST["driver_phone"])){
            $this->ajaxReturn(array("code"=>-1));//错误
        }

        if(empty($_POST["driver_pwd"])){
            $this->ajaxReturn(array("code"=>-1));//错误
        }

        //获取用户名
        $driverM=new DriverModel();
        //$driver=$driverM->getByDriverPhone($_POST["driver_phone"]);
        $driver=$driverM->where(array("driver_phone"=>$_POST["driver_phone"],"is_del"=>0))->find();

        if($driver){
            //验证错误次数是否为5次
            if($driver["error_num"]>=5){
                $this->ajaxReturn(array("code"=>2));//账号冻结
            }else{
                //验证密码是否正确
                if($driver["driver_pwd"]==md5(md5($_POST["driver_pwd"]).md5($_POST["driver_pwd"]))){
                    $driver["error_num"]=0;
                    $driverM->save($driver);
                    $this->ajaxReturn(array("code"=>1,"driver"=>$driver));//登录成功
                }else{
                    $driver["error_num"]=$driver["error_num"]+1;
                    $driverM->save($driver);
                    $this->ajaxReturn(array("code"=>3));//密码错误
                }
            }
        }else{
            $this->ajaxReturn(array("code"=>4));//账号不存在
        }
    }

    //检查是否有出行任务
    public function checkTask(){
        if(empty($_POST["driverId"])){
            return null;
        }else{
            //检查司机状态
            $driverM=new DriverModel();
            $driver=$driverM->find($_POST["driverId"]);
            if($driver["state"]>=3&&$driver["state"]<=8){
                //获取最后一次出行
                $travelM=new TravelModel();
                $map["driver_id"]=$_POST["driverId"];
                $map["state"]=array("LT",7);
                $map["is_del"]=0;
                $travel=$travelM->where($map)->order("id desc")->select();


                $userM=new UserModel();
                $user=$userM->find($travel[0]["use_user_id"]);

                $this->ajaxReturn(array("code"=>1,"travel"=>$travel[0],"driver"=>$driver,"user"=>$user));
            }else{
                $this->ajaxReturn(array("code"=>0));
            }
        }
    }

    //通过出行ID，获取出行详情
    public function getTravelDetail(){
        if(empty($_POST["travelId"])){
            return null;
        }else{
            $travelM=new TravelModel();
            $travel=$travelM->find($_POST["travelId"]);
            $this->ajaxReturn(array("travel"=>$travel));
        }
    }

    //司机对订单的操作
    public function handleTravel(){
        if(empty($_POST["travelId"])){
            return null;
        }
        if(empty($_POST["driverId"])){
            return null;
        }
        if(empty($_POST["code"])){
            return null;
        }
        $code=$_POST["code"];
        $driverM=new DriverModel();
        $travelM=new TravelModel();

        //确认订单操作
        if($code==1){
            //改变司机状态即可
            $driver=$driverM->find($_POST["driverId"]);
            $driver["state"]=4;
            if($driverM->save($driver)){
                $travel=$travelM->find($_POST["travelId"]);
                R('Push/sendMessage',array('user',$travel["user_id"],"您的出行申请司机已确认订单！确认时间".date("Y-m-d H:i:s",time()),"司机已确认订单"));


                $this->ajaxReturn(array("code"=>1));
            }else{
                $this->ajaxReturn(array("code"=>0));
            }
        }

        //前往出发地点操作
        if($code==2){
            //改变司机状态
            $driver=$driverM->find($_POST["driverId"]);
            $driver["state"]=5;
            if($driverM->save($driver)){
                //修改出行状态为已出车
                $travel=$travelM->find($_POST["travelId"]);
                $travel["state"]=8;
                $travel["start_car_time"]=time();
                //开始用车时间
                $travel["start_use_car_time"]=time();
                if(isset($_POST["start"])){
                    $travel["start_kilometers"]=$_POST["start"];
                }
                
                //设置出车时间为当前时间
                if($travelM->save($travel)){
                    R('Push/sendMessage',array('user',$travel["user_id"],"您的出行申请司机已前往预约地点！出车时间".date("Y-m-d H:i:s",time()),"司机已前往预约地点"));

                    $this->ajaxReturn(array("code"=>1));
                }else{
                    $this->ajaxReturn(array("code"=>0));
                }
            }else{
                $this->ajaxReturn(array("code"=>0));
            }
        }

        //到达出发地点操作
        if($code==3){
            //改变司机状态
            $driver=$driverM->find($_POST["driverId"]);
            $driver["state"]=6;
            if($driverM->save($driver)){
                $travel=$travelM->find($_POST["travelId"]);
                R('Push/sendMessage',array('user',$travel["user_id"],"您的出行申请司机已到达预约地点！到达时间".date("Y-m-d H:i:s",time()),"司机已到达预约地点"));

                $this->ajaxReturn(array("code"=>1));
            }else{
                $this->ajaxReturn(array("code"=>0));
            }
        }

        //前往目的地点操作
        if($code==4){
            //改变司机状态
            $driver=$driverM->find($_POST["driverId"]);
            $driver["state"]=7;
            if($driverM->save($driver)){
                $travel=$travelM->find($_POST["travelId"]);
                $travel["boarding_time"]=time();//上车时间
                if($travelM->save($travel)){
                    $this->ajaxReturn(array("code"=>1));
                }else{
                    $this->ajaxReturn(array("code"=>0));
                }
            }else{
                $this->ajaxReturn(array("code"=>0));
            }
        }

        //到达目的地点操作
        if($code==5){
            //改变司机状态
            $driver=$driverM->find($_POST["driverId"]);
            $driver["state"]=8;
            if($driverM->save($driver)){
                $time=time();
                //修改出行状态为已完成
                $travel=$travelM->find($_POST["travelId"]);
                $travel["state"]=9;
                $travel["alighting_time"]=$time;//下车时间

                $setM=new SetModel();
                $set=$setM->find(1);

                $carM=M("car");
                $car=$carM->find($travel["car_id"]);                

                $travel["mileage"]=0;


                 //计算乘客里程数
                    $url = 'http://yingyan.baidu.com/api/v3/track/getdistance';

                    $post_data['ak'] = $set["ak"];
                    $post_data['service_id']      = $set["service_id"];

                    //当设置里面使用了GPS，并且车辆绑定了IMEI串码
                    if($set["is_use_gps"]==1&&isset($car["imei"])){
                        $post_data['entity_name'] = $car["imei"];
                    }else{
                        $post_data['entity_name'] = $driver["entity_name"];
                    }

                    $post_data['start_time'] = $travel["boarding_time"];
                    $post_data['end_time'] = $travel["alighting_time"];
                    $post_data['is_processed'] =1;
                    $post_data['process_option'] ="need_denoise=1,need_vacuate=1,need_mapmatch=1,radius_threhold=0,transport_mode=driving";
                    $post_data['supplement_mode'] = "driving";
                    $res =  $this->request_post($url, $post_data);
                    $obj = json_decode($res);



                    
                    $travel["mileage"]=round($obj->{'distance'}/1000,2);

                // do{
                //     //计算乘客里程数
                //     $url = 'http://yingyan.baidu.com/api/v3/track/getdistance';

                //     $post_data['ak'] = $set["ak"];
                //     $post_data['service_id']      = $set["service_id"];

                //     //当设置里面使用了GPS，并且车辆绑定了IMEI串码
                //     if($set["is_use_gps"]==1&&isset($car["imei"])){
                //         $post_data['entity_name'] = $car["imei"];
                //     }else{
                //         $post_data['entity_name'] = $driver["entity_name"];
                //     }

                //     $post_data['start_time'] = $travel["boarding_time"];
                //     $post_data['end_time'] = $travel["alighting_time"];
                //     $post_data['is_processed'] =1;
                //     $post_data['process_option'] ="need_denoise=1,need_vacuate=1,need_mapmatch=1,radius_threhold=0,transport_mode=driving";
                //     $post_data['supplement_mode'] = "driving";
                //     $res =  $this->request_post($url, $post_data);
                //     $obj = json_decode($res);



                    
                //     $travel["mileage"]=round($obj->{'distance'}/1000,2);

                // }while ($travel["mileage"]==0);


                

                //http://yingyan.baidu.com/api/v3/track/getdistance?service_id=146602&entity_name=柳强&is_processed=1&process_option=need_denoise=1,radius_threshold=20,need_mapmatch=1,transport_mode=driving&supplement_mode=driving&start_time=1506684112&end_time=1506684871&ak=tgXj9S1lLWl0ie7vGx3oYNzQkM3rLbO0


                if($travelM->save($travel)){
                    $this->ajaxReturn(array("code"=>1));
                }else{
                    $this->ajaxReturn(array("code"=>0));
                }
            }else{
                $this->ajaxReturn(array("code"=>0));
            }
        }

        //返回车辆中心
        if($code==6){
            //改变司机状态
            $driver=$driverM->find($_POST["driverId"]);
            $driver["state"]=0;
            if($driverM->save($driver)){
                //结束用车时间
                $travel=$travelM->find($_POST["travelId"]);
                $travel["end_use_car_time"]=time();

                if($travelM->save($travel)){
                    $this->ajaxReturn(array("code"=>1));
                }else{
                    $this->ajaxReturn(array("code"=>0));
                }
            }else{
                $this->ajaxReturn(array("code"=>0));
            }
        }

    }

    //司机完成服务操作
    public  function endService(){
        $driverId=$_POST["driverId"];
        $travelId=$_POST["travelId"];
        $fees_sum=$_POST["fees_sum"];
        $parking_rate_sum=$_POST["parking_rate_sum"];
        $service_charge=$_POST["service_charge"];
        $driver_cost=$_POST["driver_cost"];
        $over_time_cost=$_POST["over_time_cost"];
        $over_mileage_cost=$_POST["over_mileage_cost"];
        $oil_cost=$_POST["oil_cost"];
        $else_cost=$_POST["else_cost"];

        $driverM=new DriverModel();
        $travelM=new TravelModel();


        $driver=$driverM->find($_POST["driverId"]);
        $driver["state"]=0;
        if($driverM->save($driver)){
            //结束用车时间
            $travel=$travelM->find($_POST["travelId"]);
            $travel["end_use_car_time"]=time();

            $travel["fees_sum"]=$fees_sum;
            $travel["parking_rate_sum"]=$parking_rate_sum;
            $travel["service_charge"]=$service_charge;
            $travel["driver_cost"]=$driver_cost;
            $travel["over_time_cost"]=$over_time_cost;
            $travel["over_mileage_cost"]=$over_mileage_cost;
            $travel["else_cost"]=$else_cost;
            $travel["totle_rate"]=$fees_sum+$parking_rate_sum+$service_charge+$driver_cost+$over_time_cost+$over_mileage_cost+$else_cost;

            $travel["end_kilometers"]=$_POST["end_miniter"];

            $setM=new SetModel();
            $set=$setM->find(1);

            $carM=M("car");
            $car=$carM->find($travel["car_id"]);

            $travel["total_mileage"]=$travel["end_kilometers"]-$travel["start_kilometers"];
            $travel["mileage"]=$travel["total_mileage"];

             // //计算乘客里程数
             //    $url = 'http://yingyan.baidu.com/api/v3/track/getdistance';

             //    $post_data['ak'] = $set["ak"];
             //    $post_data['service_id']      = $set["service_id"];

             //    //当设置里面使用了GPS，并且车辆绑定了IMEI串码
             //    if($set["is_use_gps"]==1&&isset($car["imei"])){
             //        $post_data['entity_name'] = $car["imei"];
             //    }else{
             //        $post_data['entity_name'] = $driver["entity_name"];
             //    }
                
             //    $post_data['start_time'] = $travel["start_use_car_time"];
             //    $post_data['end_time'] = $travel["end_use_car_time"];
             //    $post_data['is_processed'] =1;
             //    $post_data['process_option'] ="need_denoise=1,need_vacuate=1,need_mapmatch=1,radius_threhold=0,transport_mode=driving";
             //    $post_data['supplement_mode'] = "driving";
             //    $res =  $this->request_post($url, $post_data);
             //    $obj = json_decode($res);

                
             //    $travel["total_mileage"]=round($obj->{'distance'}/1000,2);

            // do{
            //     //计算乘客里程数
            //     $url = 'http://yingyan.baidu.com/api/v3/track/getdistance';

            //     $post_data['ak'] = $set["ak"];
            //     $post_data['service_id']      = $set["service_id"];

            //     //当设置里面使用了GPS，并且车辆绑定了IMEI串码
            //     if($set["is_use_gps"]==1&&isset($car["imei"])){
            //         $post_data['entity_name'] = $car["imei"];
            //     }else{
            //         $post_data['entity_name'] = $driver["entity_name"];
            //     }
                
            //     $post_data['start_time'] = $travel["start_use_car_time"];
            //     $post_data['end_time'] = $travel["end_use_car_time"];
            //     $post_data['is_processed'] =1;
            //     $post_data['process_option'] ="need_denoise=1,need_vacuate=1,need_mapmatch=1,radius_threhold=0,transport_mode=driving";
            //     $post_data['supplement_mode'] = "driving";
            //     $res =  $this->request_post($url, $post_data);
            //     $obj = json_decode($res);

                
            //     $travel["total_mileage"]=round($obj->{'distance'}/1000,2);

            // }while ($travel["total_mileage"]==0);

            // $url = 'http://yingyan.baidu.com/api/v3/track/getdistance';
            // $post_data['ak'] = $set["ak"];
            // $post_data['service_id']      = $set["service_id"];

            // $post_data['entity_name'] = $driver["entity_name"];
            // $post_data['start_time'] = $travel["start_use_car_time"];
            // $post_data['end_time'] = $travel["end_use_car_time"];
            // $post_data['is_processed'] =1;
            // $post_data['process_option'] ="need_denoise=1,need_vacuate=1,need_mapmatch=1,radius_threhold=0,transport_mode=driving";
            // $post_data['supplement_mode'] = "driving";

            // $res =  $this->request_post($url, $post_data);

            // $obj = json_decode($res);

            // $travel["total_mileage"]=round($obj->{'distance'}/1000,2);



            if($travelM->save($travel)){
                //释放车辆
                $carM=new CarModel();
                $car=$carM->find($travel["car_id"]);
                $car["state"]=1;
                $carM->save($car);

                if($oil_cost>0){
                    //添加加油记录
                    $costOilM=new CostOilModel();
                    $data=array(
                        "car_id"=>$travel["car_id"],
                        "cost"=>$oil_cost,
                        "trading_time"=>time(),
                        "is_del"=>0
                    );
                    if($costOilM->add($data)){
                        $this->ajaxReturn(array("code"=>1));
                    }else{
                        $this->ajaxReturn(array("code"=>0));
                    }
                }else{
                    $this->ajaxReturn(array("code"=>1));
                }

            }else{
                $this->ajaxReturn(array("code"=>0));
            }
        }else{
            $this->ajaxReturn(array("code"=>0));
        }


    }

    public function getMyTask(){
        if(!empty($_POST)){

            $travelId=$_POST["travelId"];
            $page=$_POST["pageIndex"];
            $pageSize=$_POST["pageSize"];

            $travelM=new TravelModel();
            //$borrow_car_model= new BorrowCarModel();
            $count_res=$travelM->where("driver_id=".$travelId)->select();

            //总记录数
            $count_record=count($count_res);
            $count_page=ceil($count_record/$pageSize);

            $resault=$travelM->order("id desc")->where("driver_id=".$travelId)->limit($page*$pageSize,$pageSize)->select();

            //$travelTypeM=new TravelTypeModel();
            $carM=new CarModel();
            $driverM=new DriverModel();
            for($i=0;$i<count($resault)&&count($resault)!=0;$i++){
                //通过出行类型ID查询出行类型名称
                //$travelType=$travelTypeM->find($resault[$i]["travel_type_id"]);
                //$resault[$i]["travel_type_name"]=$travelType["travel_name"];

                //通过车辆id返回车牌号
                if(!empty($resault[$i]["car_id"])){
                    $car=$carM->find($resault[$i]["car_id"]);
                    $resault[$i]["car_num"]=$car["car_num"];
                }
            }

            $res=array(
                "last"=>false,
                "content"=>$resault
            );

            if(($page+1)==$count_page){
                $res["last"]=true;
            }

            //echo(json_encode($res));
            $this->ajaxReturn($res);


        }else{
            return null;
        }
    }


    //获取设置信息
    public function getSystemInfo(){
        $setM=new SetModel();
        $set=$setM->find(1);

        $this->ajaxReturn(array("center_address"=>$set["center_address"],center_location=>$set["center_location"]));
    }

    //辅助方法，发送get请求
    protected function request_post($url = '', $post_data = array()) {
        if (empty($url) || empty($post_data)) {
            return false;
        }

        $o = "";
        foreach ( $post_data as $k => $v )
        {
            $o.= "$k=" . urlencode( $v ). "&" ;
        }
        $post_data = substr($o,0,-1);

        $postUrl = $url;
        $curlPost = $post_data;
        $ch = curl_init();//初始化curl

        curl_setopt($ch, CURLOPT_URL,$postUrl."?".$curlPost);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上

        $data = curl_exec($ch);//运行curl
        curl_close($ch);

        return $data;
    }



}