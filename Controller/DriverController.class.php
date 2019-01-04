<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/28
 * Time: 14:17
 */

namespace Admin\Controller;
use Model\SetModel;


class DriverController  extends CommonController
{
    public function allDrivers(){
        $this->display();
    }

    public function getAllDrivers(){

        $map["is_del"]=0;

        $key= $_POST["search"]["value"];
        if(!empty($key)){
            $map['driver_name | driver_idcard | driver_phone | driver_lic_time | department | lic_type | address | remarks '] = array('like', "%$key%");
        }
        $resCount=M("Driver")->where($map)->select();

        $order=array();
        switch ($_POST["order"][0]["column"])
        {
            case 1:
                $order["driver_name"]=$_POST["order"][0]["dir"];
                break;
            case 2:
                $order["driver_phone"]=$_POST["order"][0]["dir"];
                break;
            case 3:
                $order["department"]=$_POST["order"][0]["dir"];
                break;
            case 4:
                $order["driver_idcard"]=$_POST["order"][0]["dir"];
                break;
            case 5:
                $order["lic_type"]=$_POST["order"][0]["dir"];
                break;
            case 6:
                $order["induction_time"]=$_POST["order"][0]["dir"];
                break;
            case 9:
                $order["is_dx"]=$_POST["order"][0]["dir"];
                break;
            case 10:
                $order["state"]=$_POST["order"][0]["dir"];
                break;
        }

        $res=M("Driver")->where($map)->order($order)->limit($_POST["start"],$_POST["length"])->select();

        for($i=0;$i<count($res)&&count($res)!=0;$i++){
            $mapp['driver_id']  = array('eq',$res[$i]["id"]);
            $mapp['is_del']  = array('eq',0);
            $res[$i]["count"]=M("Travel")->where($mapp)->count();//该司机所有出行记录条数

            $res[$i]["mileagecount"]=M("Travel")->where($mapp)->sum("mileage");//该司机所有出行记录条数


        }

        //返回数据
        $cars=array();
        $cars["draw"]=$_POST["draw"];
        $cars["recordsTotal"]=count($resCount);//总记录条数
        $cars["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $cars["data"]=$res;

        $this->ajaxReturn($cars);
    }

    public function recycleDrivers(){
        $this->display();
    }

    public function getRecycleDrivers(){
        $resCount=M("Driver")->where("is_del=1")->select();
        $map["is_del"]=1;
        $order=array();
        switch ($_POST["order"][0]["column"])
        {
            case 1:
                $order["driver_name"]=$_POST["order"][0]["dir"];
                break;
            case 2:
                $order["driver_phone"]=$_POST["order"][0]["dir"];
                break;
            case 3:
                $order["department"]=$_POST["order"][0]["dir"];
                break;
            case 4:
                $order["driver_idcard"]=$_POST["order"][0]["dir"];
                break;
            case 5:
                $order["lic_type"]=$_POST["order"][0]["dir"];
                break;
            case 6:
                $order["induction_time"]=$_POST["order"][0]["dir"];
                break;
            case 8:
                $order["state"]=$_POST["order"][0]["dir"];
                break;
        }

        $res=M("Driver")->where($map)->order($order)->limit($_POST["start"],$_POST["length"])->select();

        for($i=0;$i<count($res)&&count($res)!=0;$i++){
            $map['driver_id']  = array('eq',$res[$i]["id"]);
            $res[$i]["count"]=M("Travel")->where("is_del=0")->where($map)->count();//该单位所有出行记录条数
        }

        //返回数据
        $cars=array();
        $cars["draw"]=$_POST["draw"];
        $cars["recordsTotal"]=count($resCount);//总记录条数
        $cars["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $cars["data"]=$res;

        $this->ajaxReturn($cars);
    }



    public function addDriver(){
        $this->display();
    }
    public function addDriverDo(){
        //先查询数据库内是否存在同样的手机号
        //ump($_POST);

        $map["driver_phone"]=$_POST["driver_phone"];
        $map["is_del"]=0;
        $d=M("Driver")->where($map)->count();
        if($d){
            //存在这样的人
            $this->ajaxReturn(array("code"=>0,"error"=>"该手机号码已经存在"));
        }else{
            //存入数据
            $_POST["driver_lic_time"]=strtotime($_POST["driver_lic_time"]);
            $_POST["induction_time"]=strtotime($_POST["induction_time"]);
            $_POST["contract_start_time"]=strtotime($_POST["contract_start_time"]);
            $_POST["contract_end_time"]=strtotime($_POST["contract_end_time"]);
            $_POST["driver_pwd"]=md5(md5($_POST["driver_pwd"]).md5($_POST["driver_pwd"]));

            $res=M("Driver")->add($_POST);
            if($res){
                A("UserCenter")->logCreatWeb("新增司机 ".$_POST["driver_name"]);

                //判断文件是否存在
                $file='Public/images/driver/'.$res.'.png';
                if (is_file($file) == false) {
                    $img = $_POST['driverNamePhonto'];


                    $img = str_replace('data:image/png;base64,', '', $img);
                    //$img = str_replace(' ', '+', $img);
                    $data = base64_decode($img);
                    $success = file_put_contents($file, $data);


                    //新增司机时就直接创建终端
                    $drivers=M("Driver")->where(array("is_del"=>0,"entity_name"=>"0"))->select();

                    //获取配置信息
                    $setM=new SetModel();
                    $set=$setM->find(1);

                    for ($i=0;$i<count($drivers)&&count($drivers)!=0;$i++){
                        //$drivers[$i]["driver_pwd"]=md5(md5($drivers[$i]["driver_phone"]).md5($drivers[$i]["driver_phone"]));

                        //发送POST请求
                        $url = 'http://yingyan.baidu.com/api/v3/entity/add';
                        $post_data['ak']       = $set["ak"];
                        $post_data['service_id']      = $set["service_id"];
                        $post_data['entity_name'] = $drivers[$i]["driver_name"];
                        //$post_data = array();
                        $res = $this->request_post($url, $post_data);
                        $obj = json_decode($res);

                        if($obj->{'state'}==0){
                            $drivers[$i]["entity_name"]=$drivers[$i]["driver_name"];
                            M("Driver")->save($drivers[$i]);

                        }
                        //检查是否存在司机姓名图片

                    }


                    $this->ajaxReturn(array("code"=>1));
                }
            }else{
                $this->ajaxReturn(array("code"=>0,"error"=>"操作失败，请重试！"));
            }
        }

    }

    public function delDriver(){

        $driver["id"]=$_POST["id"];
        $driver["is_del"]=1;

        $driverinfo=M("Driver")->find($_POST["id"]);

        A("UserCenter")->logCreatWeb("删除司机 ".$driverinfo["driver_name"]);

        $res=M("Driver")->save($driver);



        if($res){
            $this->ajaxReturn(array("code"=>$res));
        }else{
            $this->ajaxReturn(array("code"=>$res,"error"=>"操作失败，请重试！"));
        }

    }


    public function editDriver($id){
        $driver=M("Driver")->find($id);
        $this->assign("driver",$driver);
        $this->display();
    }

    public function viewDriver($id){
        $driver=M("Driver")->find($id);
        $this->assign("driver",$driver);
        $this->display();
    }

    public function editDriverDo(){
        if(empty($_POST["driver_pwd"])){
            unset($_POST["driver_pwd"]);
        }else{
            $_POST["driver_pwd"]=md5(md5($_POST["driver_pwd"]).md5($_POST["driver_pwd"]));
        }

        //$driverM=M("Driver");
        $_POST["driver_lic_time"]=strtotime($_POST["driver_lic_time"]);
        $_POST["induction_time"]=strtotime($_POST["induction_time"]);
        $_POST["contract_start_time"]=strtotime($_POST["contract_start_time"]);
        $_POST["contract_end_time"]=strtotime($_POST["contract_end_time"]);
        $res=M("Driver")->save($_POST);

        $file='Public/images/'.$_POST["id"].'.png';
        if (is_file($file) == false) {
            $img = $_POST['driverNamePhonto'];
            $img = str_replace('data:image/png;base64,', '', $img);
            //$img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $success = file_put_contents($file, $data);
        }




        if($res){

            $driverinfo=M("Driver")->find($_POST["id"]);
            A("UserCenter")->logCreatWeb("修改司机 ".$driverinfo["driver_name"]);

            $this->ajaxReturn(array("code"=>$res));
        }else{
            $this->ajaxReturn(array("code"=>$res,"error"=>"操作失败，请重试！"));
        }


    }











    //发送POST请求方法
    private function request_post($url = '', $post_data = array()) {
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
        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);

        return $data;
    }
}