<?php
class Main extends CI_Controller {
    
    public $data = array();
    
    /**
     * Construct 
     */
    public function __construct() {
        parent::__construct();
    
        $this->data['meta'] = array();
        
        $this->data['css'] = array('style.css');
        
        $this->data['js'] = array('jquery-1.7.2.min.js', 'script.js');
        
        $this->data['site_name'] = 'RedBeanPHP Test Application';
        
        $this->data['page_title'] = '';
        
        $this->data['header'] = '';
        
        $this->data['footer'] = '';
        
        $this->data['full'] = '';
    }
    
    /**
     * Add css
     * 
     * @param string $css 
     */
    protected function _add_css($css) {
        array_push($this->data['css'], $css);
    }
    
    /**
     * Add js
     * 
     * @param string $js 
     */
    protected function _add_js($js) {
        array_push($this->data['js'], $js);
    }

    /**
     * Add html
     * 
     * @param string $string
     * @param string $region 
     */
    protected function _add_html($string, $region) {
        $this->data[$region] .= $string;
    }

    /**
     * Render page
     * 
     * @param string $container 
     */
    protected function _render_page($container = 'container') {
        $this->load->view($container, $this->data);
    }     
}