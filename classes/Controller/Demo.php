<?php

class Controller_Demo extends Controller_Website {

    public function action_swiper() {
        $this->content = View::factory('demo_swiper');
    }

    public function action_plyr() {
        $this->content = View::factory('demo_plyr');
    }
    
    public function action_chart() {
        $this->content = View::factory('demo_chart');
    }
    
    public function action_city() {
        $this->content = View::factory('demo_city');
    }
    
    public function action_math() {
        $this->content = View::factory('demo_math');
    }

    public function action_tree() {
        $this->content = View::factory('demo_tree');
    }
}

