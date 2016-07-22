<?php

class Controller_Order extends Controller_Website {

    public function action_list() {
        $where = array('ORDER' => 'id DESC');
        $m_order = Model::factory('orders');
        
        $size = 10;
        $total = $m_order->count($where);
        $pager = new Pager($total, $size);
        $list = $m_order->select($pager->offset, $size, $where)->as_array();

        $order_status_arr = array(
            '0' => '未支付', //立即支付
            '1' => '待发货', //
            '2' => '已发货', //确认发货
            '3' => '已完成', //
        );
        foreach ($list as &$item) {
            $item['order_status'] = isset($order_status_arr[$item['status']]) ? $order_status_arr[$item['status']] : '';
        }
        unset($item);
        
        $this->content = View::factory('order_list');
        $this->content->list = $list;
        $this->content->pager = $pager;
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
        $ret = $m_order->update(array('status'=>2), array('id'=>$order_id));
        if ($ret !== false) {
            $this->redirect(Request::$referrer);
        }
    }
}

