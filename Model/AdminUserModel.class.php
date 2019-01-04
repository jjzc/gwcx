<?php
namespace Model;
use Think\Model;

class AdminUserModel extends Model{
    protected $fields = array('id', 'user_name', 'user_pwd', 'user_group','error_num');
    
}