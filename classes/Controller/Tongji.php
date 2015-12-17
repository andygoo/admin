<?php

class Controller_Tongji extends Controller_Website {

    public function action_click() {
        $date_start = Arr::get($_GET, 'date_start', date('Ymd', strtotime('-1 day')));
        $date_end = Arr::get($_GET, 'date_end', date('Ymd', strtotime('-1 day')));
        $plat = Arr::get($_GET, 'plat');
        $type = Arr::get($_GET, 'type');

        $where = array(
            "plat" => intval($plat),
            "type" => $type,
            "date" => array(
                '$gte' => $date_start,
                '$lte' => $date_end,
            ),
        );
        $where = array_filter_recursive($where);
        
        $field = 'date';
        $order = 'desc';
        if (isset($_GET['sort'])) {
            list($field, $order) = explode('|', $_GET['sort']);
            if (!in_array($field, array('type', 'num')) || !in_array($order, array('asc', 'desc'))) {
                $field = 'date';
                $order = 'desc';
            }
        }
        $sort = array($field => $order=='asc' ? 1 : -1);
        
        $con = new MongoClient("mongodb://192.168.1.106:27017");
        $mongo  = $con->tongji;
        $total = $mongo->stat_click->find($where)->count();
        $pager = new Pager($total, 10);
        $list = $mongo->stat_click->find($where)->limit($pager->size)->skip($pager->offset)->sort($sort);
        
        //$plats = array(1=>'pc', 2=>'wap', 3=>'android', 4=>'ios');
        $plats = array(3=>'android', 4=>'ios');
        
        $this->content = View::factory('tongji_click');
	    $this->content->list = $list;
	    $this->content->plats = $plats;
	    $this->content->field = $field;
	    $this->content->order = $order;
	    $this->content->pager = $pager;
    }

    public function action_rate() {
        $date_start = Arr::get($_GET, 'date_start', date('Ymd', strtotime('-1 day')));
        $date_end = Arr::get($_GET, 'date_end', date('Ymd', strtotime('-1 day')));
        $plat = Arr::get($_GET, 'plat');
        $entrance = Arr::get($_GET, 'entrance');
        $where = array(
            'date|>=' => $date_start,
            'date|<=' => $date_end,
            'plat' => $plat,
            'entrance' => $entrance,
        );
        $where['ORDER'] = 'date desc';
        $where = array_filter($where, 'strlen');
        
        $model = Model::factory('stat_conv');
        $total = $model->count($where);
        $pager = new Pager($total, 10);
        $list = $model->select($pager->offset, $pager->size, $where);
        
        $plats = array(
            1 => 'pc', 
            2 => 'wap', 
            3 => 'android', 
            4 => 'ios',
        );
        $entra = array(
            'home_search' => '首页搜索', 
            'home_price' => '首页价格区', 
            'home_brand' => '首页品牌区', 
        );
        
        $this->content = View::factory('stat_rate');
	    $this->content->list = $list;
	    $this->content->plats = $plats;
	    $this->content->entra = $entra;
	    $this->content->pager = $pager;
    }
    
}

function array_filter_recursive($input) {
    foreach ($input as &$value) {
        if (is_array($value)) {
            $value = array_filter_recursive($value);
        }
    }
    return array_filter($input);
}
