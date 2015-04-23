<?php

/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of home
 *
 */
class Home extends CI_Controller {
	
	public function index() {
		$this->load->view('user_wall');
                
	}
        
        public function wall()
        {
            $data['page_title'] = 'Wall';
            $this->load->view('templates/page_head', $data);            
            $this->load->view('templates/nav');
			//$this->load->view('templates/left_nav');
            //$this->load->view('user_wall');
            $this->load->view('templates/page_foot');
                
        }
        
        public function user()
        {
            $data['page_title'] = 'Profile';
            $this->load->view('templates/page_head', $data);            
            $this->load->view('templates/nav');
            $this->load->view('templates/left_nav');
            $this->load->view('user_profile');
            $this->load->view('templates/page_foot');
        }
}
