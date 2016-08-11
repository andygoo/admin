<?php

class Controller_Category extends Controller_Website {

    public function action_list() {
        $m_category = Model::factory('category');
        
        $where = array();
        $where['ORDER'] = 'id ASC';
        $list = $m_category->getAll($where)->as_array();
        $cat_list = array_column($list, 'name', 'id');
        foreach ($list as &$item) {
            $item['parent_name'] = isset($cat_list[$item['parent_id']]) ? $cat_list[$item['parent_id']] : '';
        }
        
        $this->content = View::factory('category_list');
        $this->content->list = $list;
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
                $this->redirect('category/tree');
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
            $ret = $m_category->updateById($data, $id);
            if ($ret !== false) {
                $this->redirect('category/tree');
            }
        }

        $cat_list = $m_category->getAll(array('status'=>'open'))->as_array('id');
        $cat_tree = Category::get_children_tree($cat_list);
        
        $info = $m_category->getRowById($id);
        
        $this->content = View::factory('category_edit');
        $this->content->cat_list = $cat_list;
        $this->content->cat_tree = $cat_tree;
        $this->content->info = $info;
    }

    public function action_del() {
        $id = $_GET['id'];
        $model = Model::factory('category');
        $ret = $model->deleteById($id);
        if ($ret !== false) {
            $this->redirect(Request::$referrer);
        }
    }

    protected function _get_data($post) {
        return array_intersect_key($post, array_flip(array('parent_id','name','status')));
    }
    
}

