<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/31
 * Time: 13:12
 */

namespace Home\Controller;
use Think\Controller;

class DownController extends Controller
{
    /**
     * 获取最新APP下载地址
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function download()
    {
        $versionM=M("app_version");

        $userApp=$versionM->where("type='user'")->order("id desc")->find();
        $driverApp=$versionM->where("type='driver'")->order("id desc")->find();
        $adminApp=$versionM->where("type='center'")->order("id desc")->find();

        $this->assign("userApp",$userApp);
        $this->assign("driverApp",$driverApp);
        $this->assign("adminApp",$adminApp);



        $this->display();
    }
}
