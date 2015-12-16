<?php

class Controller_Stat extends Controller_Website {

    public function action_click() {
        $date_start = Arr::get($_GET, 'date_start');
        $date_end = Arr::get($_GET, 'date_end');
        $plat = Arr::get($_GET, 'plat');
        $type = Arr::get($_GET, 'type');
        $where = array(
            'date|>=' => $date_start,
            'date|<=' => $date_end,
            'plat' => $plat,
            'type' => $type,
        );
        $where = array_filter($where, 'strlen');
        
        $field = 'date';
        $order = 'desc';
        if (isset($_GET['sort'])) {
            list($field, $order) = explode('|', $_GET['sort']);
            if (in_array($order, array('asc', 'desc'))) {
                $where['ORDER'] = $field . ' ' . $order;
            }
        }
        
        $model = Model::factory('stat_click');
        $total = $model->count($where);
        $pager = new Pager($total, 10);
        $list = $model->select($pager->offset, $pager->size, $where);
        
        $plats = array(1=>'pc', 2=>'wap', 3=>'android', 4=>'ios');
        
        $this->content = View::factory('stat_click');
	    $this->content->list = $list;
	    $this->content->plats = $plats;
	    $this->content->field = $field;
	    $this->content->order = $order;
	    $this->content->pager = $pager;
    }

    public function action_rate() {
        $date = Arr::get($_GET, 'date');
        $plat = Arr::get($_GET, 'plat');
        $entrance = Arr::get($_GET, 'entrance');
        $where = array(
            'date' => $date,
            'plat' => $plat,
            'entrance' => $entrance,
        );
        $where['ORDER'] = 'date desc';
        $where = array_filter($where, 'strlen');
        
        $model = Model::factory('stat_conv');
        $total = $model->count($where);
        $pager = new Pager($total, 10);
        $list = $model->select($pager->offset, $pager->size, $where);
        
        $plats = array(1=>'pc', 2=>'wap', 3=>'android', 4=>'ios');
        
        $this->content = View::factory('stat_rate');
	    $this->content->list = $list;
	    $this->content->plats = $plats;
	    $this->content->pager = $pager;
    }
    
}

