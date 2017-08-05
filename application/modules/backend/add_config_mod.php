<?php

class add_config_mod extends Module{
    public $notice = '';
    public $type   = 0; 
    function __construct()
    {
        $user_info  = $this->users_lib->adminInfo();        
        if($user_info['role'] != 1){
            redirect(site_url());
        }
        $this->load->library('upload');
        $this->load->model('gk_model', 'fe_model');
    }
    function script(){        

        $js = array(
                'header' => array(
                ),
                'footer' => array(
                    'libs/elfinder/elrte.full.js',
                    'libs/elfinder/elfinder.full.js',
                    'libs/elfinder/elfinder.en.js',
                    'libs/jquery-ui-1.8.13.custom.min.js',
                    //'libs/bootbox.min.js',
                    'libs/jquery.livequery.js',
                    //'backend/jquery.Jcrop.js',
                    //'backend/cropsetup.js',
                    'libs/jquery.validate.js',
                     'backend/about_img.js'
                    
                )   
        );
        
        $css = array(
            'css/elfinder.full.css',            
            'css/elrte.min.css',
            'css/jquery-ui-1.8.13.custom.css',
            'backend/jquery.Jcrop.css',
            'backend/styles.css',
        );
        return array('js'=>$js,'css'=>$css);
    }
    
    function submit(){        
        $id                     = $this->input->post('id');        
        $data['name']    = $this->input->post('name');   
        $data['key'] = $this->input->post('key');
        $data['value'] = $this->input->post('value');
                     
        $data['time_created']    = time();       
     
        //upload anh
		
      
        if(!$id)
        {
            $id = $this->fe_model->insert(FE_SYSTEM_CONFIG, $data);
            $this->notice = 'Success';
            //redirect('admin/photo');
            redirect('admin/config_sys');
        }
        else if($id > 0)
        {
            $this->fe_model->update(FE_SYSTEM_CONFIG, array('id' => $id), $data);
            $this->notice = 'Update success';            
           redirect('admin/config_sys');
        }
    }
    
    function draw($params){
			
        $this->load->skins('backend');        
        if($params['mode'] == '')
        {   
            $condition = $like = array();
            if($_GET['title'] != '')
            {
                $like['title'] = $this->input->get('title');
                $end_url .= 'title=' . $this->input->get('title');
                $end_url .= '&';
            }
            
            if($_GET['category'] != '')
            {
                $condition['guide_category_id'] = $this->input->get('category');
                $end_url .= 'category=' . $this->input->get('category');
                $end_url .= '&';
            }
			
            $total_data            = $this->fe_model->count(FE_SYSTEM_CONFIG, $condition, $like);
            $config['base_url']    = site_url('admin/banner/index');
            $config['end_url']     = ($end_url == '' ? '' : rtrim($end_url,'&'));
            $config['per_page']    = 20;
            $config['total_rows']  = $total_data;
            $config['num_links']   = 2;
            $config['uri_segment'] = 4;
            $offset                = $params['page'];
            if ( ! is_numeric($offset) || $offset == 0)
            {
                $offset = 1;
            }
            $offset = ($offset - 1)*$config['per_page'];
            $this->load->library('pagination');
            $this->pagination->initialize($config);

            
           

              $this->load->helper('form');        
			
            $assign = array(
                'data'          => $data,               
                
                'total_data'    => $total_data,
                'offset'        => $offset,
                'notice'        => $this->notice,
                'paging'        => $this->pagination->create_links_page(),
                'title'         => $like['title'],
                'category'      => $condition['guide_category_id'],
                'form_cat'      => form_open('add_config_mod', '',array('enctype'=>'multipart/form-data', 'id' => 'form_cat')),
                'data_cat'      => $data_cat
            );
            
            $this->smarty->assign($assign);
            return $this->smarty->display_module('config/index.html');
        }
       
        if($params['mode'] == 'form')
        {
            $id = $params['id'];
            if($id)
            {
                $data = $this->fe_model->select_one(FE_SYSTEM_CONFIG, '*', array('id' => $id));
                $page_title = 'Edit config - '.$data['title'].' | Admin';
            }
            else
            {
                $page_title = 'Add new config | Admin';
            }            
           
            $this->load->helper('form'); 
			
            $assign = array(
                'id'            => $id,
                'page_title'    => $page_title,              
                'form_edit'     => form_open('backend/add_config_mod', '',array('enctype'=>'multipart/form-data', 'id' => 'add_config_mod')),
                'notice'        => $this->notice,
                'data'          => $data,                        
            );			
            
            $this->smarty->assign($assign);
            return $this->smarty->display_module('config/form.html');
        }
    }
}

?>