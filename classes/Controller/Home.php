<?php

class Controller_Home extends Controller_Website {

    public function action_index() {
        $this->content = View::factory('index');
    }
    
}

