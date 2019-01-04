<?php
namespace Model;
use Think\Model;

class DriverModel extends Model{

    protected $fields = array('id', 'driver_name', 'driver_idcard', 'driver_age','driver_phone','driver_pwd','driver_lic_time','state','department','lic_type','induction_time','contract_start_time','contract_end_time','address','remarks','is_del','error_num','entity_name');
}