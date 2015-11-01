<?php

class Controller_Category extends Controller_Website {

    public function action_list() {
        $m_category = Model::factory('category');
        
        $where = array();
        $where['ORDER'] = 'id ASC';
        $total = $m_category->count();
        $pager = new Pager($total, 20);
        $list = $m_category->select($pager->offset, $pager->size, $where)->as_array();

        $cat_list = $m_category->getAll()->as_array('id', 'name');
        foreach ($list as &$item) {
            $item['parent_name'] = isset($cat_list[$item['parent_id']]) ? $cat_list[$item['parent_id']] : '';
        }
        
        $this->content = View::factory('category_list');
        $this->content->list = $list;
        $this->content->pager = $pager;
    }
    
    public function action_tree() {
        $m_category = Model::factory('category');
        $cat_list = $m_category->getAll()->as_array('id');
        $cat_tree = Category::get_children_tree($cat_list);
        
        $this->content = View::factory('category_tree');
        $this->content->cat_list = $cat_list;
        $this->content->cat_tree = $cat_tree;
    }

    public function action_add() {
        $m_category = Model::factory('category');

        if (!empty($_POST)) {
            $data = $this->_get_data($_POST);
            $ret = $m_category->insert($data);
            if ($ret !== false) {
                $this->redirect('category/list');
            }
        }
        
        $cat_list = $m_category->getAll(array('status'=>'open'))->as_array('id');
        $cat_tree = Category::get_children_tree($cat_list);
        
        $this->content = View::factory('category_add');
        $this->content->cat_list = $cat_list;
        $this->content->cat_tree = $cat_tree;
        $this->content->info = null;
    }

    public function action_edit() {
        $id = $_GET['id'];
        $m_category = Model::factory('category');
        
        if (!empty($_POST)) {
            $data = $this->_get_data($_POST);
            $ret = $m_category->update($data, $id);
            if ($ret !== false) {
                $this->redirect('category/list');
            }
        }

        $cat_list = $m_category->getAll(array('status'=>'open'))->as_array('id');
        $cat_tree = Category::get_children_tree($cat_list);
        
        $info = $m_category->getRow($id);
        
        $this->content = View::factory('category_edit');
        $this->content->cat_list = $cat_list;
        $this->content->cat_tree = $cat_tree;
        $this->content->info = $info;
    }

    public function action_del() {
        $id = $_GET['id'];
        $model = Model::factory('category');
        $ret = $model->del($id);
        if ($ret !== false) {
            $this->redirect(Request::$referrer);
        }
    }

    protected function _get_data($post) {
        $data = array();

        $data['parent_id'] = Arr::get($post, 'parent_id');
        $data['name'] = Arr::get($post, 'name');
        $data['status'] = Arr::get($post, 'status');
        
        return $data;
    }
    
}

