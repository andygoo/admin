<?php

class Controller_Ad extends Controller_Website {
    
    public $plats = array('pc', 'wap', 'app');
    public $cities = array(12=>'北京', 15=>'重庆', 45=>'成都', 103=>'郑州', 113=>'济南', 67=>'苏州');
    public $types = array(
            'pc_home_top_slider'=>'pc首页顶部轮播图', 
            'pc_home_mid_banner'=>'pc首页中间运营图', 
            'wap_home_top_slider'=>'wap首页顶部轮播图', 
            'app_home_top_slider'=>'app首页顶部轮播图', 
            'm_home_mid_banner'=>'移动端首页中间运营图',
            'm_home_btm_posts'=>'移动端首页底部买车分享贴',
    );

    public function before() {
        parent::before();

        View::bind_global('types', $this->types);
        View::bind_global('plats', $this->plats);
        View::bind_global('cities', $this->cities);
    }
    
    public function action_list() {
        $where = array();
        $where['ORDER'] = '`order` ASC, id DESC';
        $where['type'] = Arr::get($_GET, 'type', 'pc_home_top_slider');
        $where = array_filter($where);
        $plat = Arr::get($_GET, 'plat');
        if (!empty($plat)) {
            $where['plat'] = array('LIKE' => "%$plat%");
        }
        
        $m_ad = Model::factory('ad');
        $list = $m_ad->getAll($where)->as_array();

        $this->content = View::factory('ad_list');
        $this->content->list = $list;
    }

    public function action_add() {
        $m_ad = Model::factory('ad');
    
        if (!empty($_POST)) {
            $data = $this->_get_data($_POST);
            $data['created_at'] = strtotime('now');
            $ret = $m_ad->insert($data);
            if ($ret !== false) {
                $this->redirect('ad/list');
            }
        }
        $info = null;
    
        $this->content = View::factory('ad_add');
        $this->content->info = $info;
    }
    
    public function action_edit() {
        $id = $_GET['id'];
        $m_ad = Model::factory('ad');
    
        if (!empty($_POST)) {
            $data = $this->_get_data($_POST);
            $data['updated_at'] = strtotime('now');
            $ret = $m_ad->updateById($data, $id);
            if ($ret !== false) {
                $this->redirect('ad/list');
            }
        }
        $info = $m_ad->getRowById($id);
    
        $this->content = View::factory('ad_edit');
        $this->content->info = $info;
    }
    
    public function action_del() {
        $id = $_GET['id'];
        $model = Model::factory('ad');
        $ret = $model->deleteById($id);
        if ($ret !== false) {
            $this->redirect(Request::$referrer);
        }
    }
    
    protected function _get_data($post) {
        $post['plat'] = empty($post['plat']) ? '' : '|'.implode('|', $post['plat']).'|';
        $post['city'] = empty($post['city']) ? '' : '|'.implode('|', $post['city']).'|';
        return array_intersect_key($post, array_flip(array('title','pic_url','link_url','type','order','plat','city')));
    }
}

