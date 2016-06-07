<?php

class Controller_Auction extends Controller_Website {

    public function action_list() {
        $where = array();
        $where['status'] = Arr::get($_GET, 'status');
        $where = array_filter($where);
        
        $m_auction = Model::factory('auction', 'paimai');
        $total = $m_auction->count($where);
        $pager = new Pager($total, 10);
        $list = $m_auction->select($pager->offset, $pager->size, $where)->as_array();

        $this->content = View::factory('auction_list');
        $this->content->list = $list;
        $this->content->pager = $pager;
    }

    public function action_add() {
        if (!empty($_POST)) {
            $data = $this->_get_data($_POST);
            $m_auction = Model::factory('auction', 'paimai');
            $ret = $m_auction->insert($data);
            if ($ret !== false) {
                $this->redirect('auction/list');
            }
        }
        
        $this->content = View::factory('auction_add');
        $this->content->info = null;
    }

    public function action_edit() {
        $id = Arr::get($_GET, 'id');
        $m_auction = Model::factory('auction', 'paimai');
        $info = $m_auction->getRowById($id);

        if (!empty($_POST)) {
            $data = $this->_get_data($_POST);
            $ret = $m_auction->updateById($data, $id);
            if ($ret !== false) {
                $this->redirect('auction/list');
            }
        }
        
        $this->content = View::factory('auction_edit');
        $this->content->info = $info;
    }

    public function action_del() {
        $id = Arr::get($_GET, 'id');
        $m_auction = Model::factory('auction', 'paimai');
        $ret = $m_auction->deleteById($id);
        if ($ret !== false) {
            $this->redirect(Request::$referrer);
        }
    }

    public function action_close() {
        $id = $_GET['id'];
        $data = array(
            'status' => '0',
        );
        $m_auction = Model::factory('auction', 'paimai');
        $ret = $m_auction->updateById($data, $id);
        if ($ret !== false) {
            $this->redirect(Request::$referrer);
        }
    }
    
    public function action_open() {
        $id = $_GET['id'];
        $data = array(
            'status' => '1',
        );
        $m_auction = Model::factory('auction', 'paimai');
        $ret = $m_auction->updateById($data, $id);
        if ($ret !== false) {
            $this->redirect(Request::$referrer);
        }
    }

    protected function _get_data($post) {
        $data = array();
        $data['start_time'] = strtotime($post['start_date'] . ' ' . $post['start_time']);
        $data['end_time'] = strtotime($post['start_date'] . ' ' . $post['end_time']);
        $data['start_price'] = $post['start_price'];
        $data['step_price'] = $post['step_price'];
        $data['reserve_price'] = $post['reserve_price'];
        $data['desc'] = strip_tags($post['desc']);
        $data['pic'] = json_encode($post['pic']);
        return $data;
    }
    
}
