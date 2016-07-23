<?php

class Controller_Order extends Controller_Website {

    public function action_list() {
        $date = Arr::get($_GET, 'date', date('Y-m-d'));
        $s_date = strtotime($date);
        $e_date = $s_date + 86400;
        $pay_status = Arr::get($_GET, 'pay_status');
        $deliver_status = Arr::get($_GET, 'deliver_status');
        
        $where = array();
        $where['pay_status'] = $pay_status;
        $where['deliver_status'] = $deliver_status;
        $where = array_filter($where, 'strlen');
        $where['created_at'] = array('>' => $s_date, '<' => $e_date);
        $where['ORDER'] = 'id DESC';
        $m_order = Model::factory('orders');
        
        $size = 10;
        $total = $m_order->count($where);
        $pager = new Pager($total, $size);
        $list = $m_order->select($pager->offset, $size, $where)->as_array();

        $pay_status_arr = array(
            0 => '未支付',
            1 => '已支付',
        );
        $deliver_status_arr = array(
            0 => '未发货',
            1 => '已发货',
        );
        foreach ($list as &$item) {
            $item['pay_status'] = isset($pay_status_arr[$item['pay_status']]) ? $pay_status_arr[$item['pay_status']] : '';
            $item['deliver_status'] = isset($deliver_status_arr[$item['deliver_status']]) ? $deliver_status_arr[$item['deliver_status']] : '';
        }
        unset($item);
        
        $this->content = View::factory('order_list');
        $this->content->list = $list;
        $this->content->pager = $pager;
        $this->content->pay_status_arr = $pay_status_arr;
        $this->content->deliver_status_arr = $deliver_status_arr;
    }

    public function action_goods() {
        $order_id = Arr::get($_GET, 'order_id');

        $m_order = Model::factory('orders');
        $info = $m_order->getRow(array('id'=>$order_id));
        
        $m_order_goods = Model::factory('order_goods');
        $list = $m_order_goods->getAll(array('order_id'=>$order_id));
        
        $this->content = View::factory('order_goods');
        $this->content->info = $info;
        $this->content->list = $list;
    }
    
    public function action_deliver() {
        $order_id = Arr::get($_GET, 'order_id');

        $m_order = Model::factory('orders');
        $ret = $m_order->update(array('deliver_status'=>1), array('id'=>$order_id));
        if ($ret !== false) {
            $this->redirect('order/list');
        }
    }
}

