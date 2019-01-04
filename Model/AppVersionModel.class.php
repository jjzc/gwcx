<?php
namespace Model;

use Think\Model\AdvModel;

class AppVersionModel extends AdvModel {
    protected $fields = array('id', 'add_data', 'url', 'version','type');
}