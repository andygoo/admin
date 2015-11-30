<?php

class Controller_Demo extends Controller_Website {

    public function action_swiper() {
        $this->content = View::factory('demo_swiper');
    }
    
}

