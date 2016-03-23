<?php

require APPPATH . 'vendor/qiniu/autoload.php';

use Qiniu\Auth;
use Qiniu\Storage\BucketManager;

class Controller_Qiniu extends Controller_Website {

    public function action_uptoken() {
        $qiniu_config = Kohana::config('qiniu.default');
        $accessKey = $qiniu_config['access_key'];
        $secretKey = $qiniu_config['secret_key'];
    
        $bucket = 'jiesc-net';
        $auth = new Auth($accessKey, $secretKey);
        $token = $auth->uploadToken($bucket);
        echo json_encode(array('uptoken'=>$token));
        exit;
    }
    
    public function action_upload() {
        $where = array();
        $where['ORDER'] = 'id DESC';
        $m_upload = Model::factory('upload_qiniu');
        $total = $m_upload->count($where);
        $pager = new Pager($total, 10);
        $list = $m_upload->select($pager->offset, $pager->size, $where)->as_array();
        
        $this->content = View::factory('upload_qiniu');
        $this->content->list = $list;
        $this->content->pager = $pager;
    }
    
    public function action_add() {
        $img_url = Arr::get($_GET, 'img_url');
        $file_size = Arr::get($_GET, 'file_size');
        $img_width = Arr::get($_GET, 'img_width');
        $img_height = Arr::get($_GET, 'img_height');
        if (!empty($img_url)) {
            $file_type = explode('.', $img_url);
            $data = array(
                'user_name' => $this->user['username'],
                'file_src' => $img_url,
                'file_type' => end($file_type),
                'file_size' => $file_size,
                'img_width' => $img_width,
                'img_height' => $img_height,
                'add_time' => strtotime('now'),
            );
            $uploadModel = Model::factory('upload_qiniu');
            $uploadModel->insert($data);
        }
    }

    public function action_del() {
        $id = Arr::get($_GET, 'id');
        $uploadModel = Model::factory('upload_qiniu');
    
        $ret = $uploadModel->deleteById($id);
        if ($ret !== false) {
            $this->redirect(Request::$referrer);
        }
    }
    
    protected function _del($key) {
        $qiniu_config = Kohana::config('qiniu.default');
        $accessKey = $qiniu_config['access_key'];
        $secretKey = $qiniu_config['secret_key'];
    
        $bucket = 'jiesc-net';
        $auth = new Auth($accessKey, $secretKey);
        
        $bucketMgr = new BucketManager($auth);
        $err = $bucketMgr->delete($bucket, $key);
        if ($err === null) {
            return true;
        } else {
            return false;
        }
    }
}
