<?php

class Controller_Upload extends Controller_Website {

    public function action_ajaxadd() {
        header('Content-Type: application/json; charset=utf-8');
        $file = $_FILES['file'];
        if (!Upload::valid($file)) {
            $ret = array('status' => 'error', 'msg' => '不是有效的文件');
            echo json_encode($ret, JSON_UNESCAPED_UNICODE);
            exit;
        } elseif (!Upload::not_empty($file)) {
            $ret = array('status' => 'error','msg' => '上传文件为空');
            echo json_encode($ret, JSON_UNESCAPED_UNICODE);
            exit;
        } elseif (!Upload::type($file, array('jpg', 'png', 'gif'))) {
            $ret = array('status' => 'error','msg' => '文件格式只能为jpg,png,gif');
            echo json_encode($ret, JSON_UNESCAPED_UNICODE);
            exit;
        } elseif (!Upload::size($file, '8M')) {
            $ret = array('status' => 'error','msg' => '文件大小不能超过8M');
            echo json_encode($ret, JSON_UNESCAPED_UNICODE);
            exit;
        }
        $file_src = $this->_add($file);
        if ($file_src !== false) {
            $ret = array('status' => 'ok','data' => $file_src);
        } else {
            $ret = array('status' => 'error','msg' => '未知错误');
        }
        echo json_encode($ret, JSON_UNESCAPED_UNICODE);
        exit;
    }

    public function action_add() {
        $file = $_FILES['image'];
        if (!Upload::valid($file)) {
            $ret = array('status' => 'error', 'msg' => '不是有效的文件');
            $this->content = json_encode($ret, JSON_UNESCAPED_UNICODE);
            return;
        } elseif (!Upload::not_empty($file)) {
            $ret = array('status' => 'error','msg' => '上传文件为空');
            $this->content = json_encode($ret, JSON_UNESCAPED_UNICODE);
            return;
        } elseif (!Upload::type($file, array('jpg', 'png'))) {
            $ret = array('status' => 'error','msg' => '文件格式只能为jpg,png');
            $this->content = json_encode($ret, JSON_UNESCAPED_UNICODE);
            return ;
        } elseif (!Upload::size($file, '8M')) {
            $ret = array('status' => 'error','msg' => '文件大小不能超过8M');
            $this->content = json_encode($ret, JSON_UNESCAPED_UNICODE);
            return;
        }
        $this->_add($file);
        $this->redirect(Request::$referrer);
    }
    
    public function action_list() {
        $where = array();
        $where['ORDER'] = 'id DESC';
        
        $m_upload = Model::factory('upload');
        $total = $m_upload->count($where);
        $pager = new Pager($total, 10);
        $list = $m_upload->select($pager->offset, $pager->size, $where)->as_array();
    
        $this->content = View::factory('upload_list');
        $this->content->list = $list;
        $this->content->pager = $pager;
    }

    public function action_pics() {
        $where = array();
        $where['ORDER'] = 'id DESC';
    
        $m_upload = Model::factory('upload');
        $total = $m_upload->count($where);
        $pager = new Pager($total, 16);
        $list = $m_upload->select($pager->offset, $pager->size, $where)->as_array();
    
        $this->content = View::factory('upload_pics');
        $this->content->list = $list;
        $this->content->pager = $pager;
    }
    
    public function action_grid() {
        $where = array();
        $where['ORDER'] = 'id DESC';
        $q = Arr::get($_GET, 'q', '');
        if (!empty($q)) {
            $where['file_src|LIKE'] = "$q%";
        }
    
        $m_upload = Model::factory('upload');
        $total = $m_upload->count($where);
        $pager = new Pager($total, 20);
        $list = $m_upload->select($pager->offset, $pager->size, $where)->as_array();

        if ($this->auto_render !== TRUE) {
            $this->content = View::factory('upload_grid_increment');
            $this->content->list = $list;
            $nexturl = '';
            if ($pager->next_page) {
                $nexturl = $pager->url($pager->next_page);
            }
            header('Content-Type: application/json; charset=utf-8');
            $ret = array(
                'content'=>(string)$this->content, 
                'nexturl'=>$nexturl, 
            );
            echo json_encode($ret);
            exit;
        } else {
            $this->content = View::factory('upload_grid');
        }
    
        $this->content->list = $list;
        $this->content->pager = $pager;
        
        echo $this->content;exit;
    }
    
    public function action_del() {
        $id = Arr::get($_GET, 'id');
        $uploadModel = Model::factory('upload');
        $info = $uploadModel->getRow($id);

        $file_path = $info['file_path'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    
        $ret = $uploadModel->delete($id);
        if ($ret !== false) {
            $this->redirect(Request::$referrer);
        }
    }

    protected function _add($file) {
        $file_type = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $filename = strtotime('now').str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT) . '.' . $file_type;
        $directory = realpath(APPPATH . '../upload');
        $sub_directory = date('Y/m/d');
        $sub_directory = str_replace('/', DIRECTORY_SEPARATOR, $sub_directory);
        $upload_dir = $directory.DIRECTORY_SEPARATOR.$sub_directory;
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, TRUE);
        }
        if (!is_writable($upload_dir)) {
            chmod($upload_dir, 0755);
        }
        $file_path = Upload::save($file, $filename, $upload_dir);
    
        list($width, $height) = getimagesize($file_path);
        $file_src = str_replace($directory, '', $file_path);
        $file_src = str_replace('\\', '/', $file_src);
    
        $data = array(
            'user_name' => $this->user['username'],
            'file_type' => $file_type,
            'file_size' => $file['size'],
            'img_width' => $width,
            'img_height' => $height,
            'file_path' => $file_path,
            'file_src' => trim($file_src,'/'),
            'add_time' => strtotime('now'),
        );
        $uploadModel = Model::factory('upload');
        $ret = $uploadModel->insert($data);
        if($ret !== false) {
            return $file_src;
        } else {
            return false;
        }
    }
    
}
