<?php

class Controller_Article extends Controller_Website {

    public function action_list() {
        $m_category = Model::factory('category');
        $cat_list = $m_category->getAll()->as_array('id');
        $cat_tree = Category::get_children_tree($cat_list);
        
        $where = array();
        $where['ORDER'] = 'featured DESC,id DESC';
        
        $cid = Arr::get($_GET, 'cid', 0) ?: 0;
        $ids = Category::get_children_ids($cat_list, $cid);
        array_push($ids, $cid);
        $where['cid'] = $ids;
        
        $title = Arr::get($_GET, 'title');
        if (!empty($title)) {
            $where['title|LIKE'] = "%$title%";
        }
        $where['status'] = Arr::get($_GET, 'status');
        $where = array_filter($where);
        
        $m_article = Model::factory('article');
        $total = $m_article->count($where);
        $pager = new Pager($total, 10);
        $list = $m_article->select($pager->offset, $pager->size, $where)->as_array();

        foreach($list as &$item) {
            $cid = $item['cid'];
            $item['cat_name'] = isset($cat_list[$cid]['name']) ? $cat_list[$cid]['name'] : '';
        }
        
        $this->content = View::factory('article_list');
        $this->content->list = $list;
        $this->content->pager = $pager;
        $this->content->cat_list = $cat_list;
        $this->content->cat_tree = $cat_tree;
    }

    public function action_add() {
        if (!empty($_POST)) {
            $data = $this->_get_data($_POST);
            $data['add_time'] = $data['edit_time'];
            $m_article = Model::factory('article');
            $ret = $m_article->insert($data);
            if ($ret !== false) {
                $this->redirect('article/list');
            }
        }
        $m_category = Model::factory('category');
        $cat_list = $m_category->getAll(array('status'=>'open'))->as_array('id');
        $cat_tree = Category::get_children_tree($cat_list);
        
        $this->content = View::factory('article_add');
        $this->content->cat_list = $cat_list;
        $this->content->cat_tree = $cat_tree;
        $this->content->info = null;
    }

    public function action_edit() {
        $id = Arr::get($_GET, 'id');
        $m_article = Model::factory('article');
        $info = $m_article->getRow($id);

        if (!empty($_POST)) {
            $data = $this->_get_data($_POST);
            $ret = $m_article->update($data, $id);
            if ($ret !== false) {
                $this->redirect('article/list');
            }
        }
        
        $m_category = Model::factory('category');
        $cat_list = $m_category->getAll(array('status'=>'open'))->as_array('id');
        $cat_tree = Category::get_children_tree($cat_list);
        
        $this->content = View::factory('article_edit');
        $this->content->cat_list = $cat_list;
        $this->content->cat_tree = $cat_tree;
        $this->content->info = $info;
    }

    public function action_del() {
        $id = $_GET['id'];
        $m_article = Model::factory('article');
        $ret = $m_article->delete($id);
        if ($ret !== false) {
            $this->redirect(Request::$referrer);
        }
    }

    public function action_close() {
        $id = $_GET['id'];
        $data = array(
            'status' => 'close',
        );
        $m_article = Model::factory('article');
        $ret = $m_article->update($data, $id);
        if ($ret !== false) {
            $this->redirect(Request::$referrer);
        }
    }
    
    public function action_open() {
        $id = $_GET['id'];
        $data = array(
            'status' => 'open',
        );
        $m_article = Model::factory('article');
        $ret = $m_article->update($data, $id);
        if ($ret !== false) {
            $this->redirect(Request::$referrer);
        }
    }

    protected function _get_data($post) {
        $data = array();

        $data['cid'] = $post['cid'];
        $data['title'] = $post['title'];
        $data['brief'] = $post['brief'];
        $data['pic'] = $post['pic'];
        $data['content'] = $post['content'];
        $data['edit_time'] = strtotime('now');

        return $data;
    }
    
}
