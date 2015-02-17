<?php
//Require Main.php
require 'main.php';

class Index extends Main {
    
	/**
	 * @var str
	 */
	private $_active;
	
    /**
     * Construct
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Index
     */
    public function index() {
        //Redirect to disc
        $this->disc();
    }
    
    /**
     * Disc
     * 
     * @param int $offset
     */
    public function disc($offset = 0) {
    	//Set active
    	$this->_active = 'disc';
    	
        //Set page title
        $this->data['page_title'] = 'Discs';
        
        //Load disc model
        $this->load->model('Disc_model');
        
        //Header
        $this->_create_header();

        //Set message
        $message = (isset($_REQUEST['message'])) ? $_REQUEST['message'] : '';
        
        //Create disc listing
        $discs = $this->Disc_model->getAllDiscs($offset);
        
        //Create full page
        $this->_add_html($this->load->view('disc', array('discs' => $discs, 'message' => $message), TRUE), 'full');
        
        //Footer
        $this->_create_footer();
        
        //Render page
        $this->_render_page();
    }
    
    
    /**
     * Add Disc
     */
    public function adddisc() {
    	//Set active
    	$this->_active = 'disc';
    	
        //Set page title
        $this->data['page_title'] = 'Add a disc';
        
        //Header
        $this->_create_header();
        
        //Get disc form
        $form = $this->_disc_form();
        
        //Create full page
        $this->_add_html($this->load->view('adddisc', array('form' => $form), TRUE), 'full');
        
        //Footer
        $this->_create_footer();
        
        //Render page
        $this->_render_page();
    }
    
    /**
     * Update Disc
     * 
     * @param int $did
     */
    public function updatedisc($did) {
    	//Set active
    	$this->_active = 'disc';
    	
        //Set page title
        $this->data['page_title'] = 'Update a disc';
        
        //Header
        $this->_create_header();
        
        //Get disc form
        $form = $this->_disc_form($did);

        //Create full page
        $this->_add_html($this->load->view('adddisc', array('form' => $form), TRUE), 'full');
        
        //Footer
        $this->_create_footer();
        
        //Render page
        $this->_render_page();
    }
    
    /**
     * Delete Disc
     * 
     * @param int $did
     */
    public function deletedisc($did) {
        //Delete disc
        $this->load->model('Disc_model');
        
        $this->Disc_model->deleteDisc($did);
        
        //Return to disc page
        $this->disc();
    }


    /**
     * Submit Disc
     */
    public function submitdisc() {
        $this->load->model('Artist_model');
        
        if(isset($_REQUEST['id'])) {
            $artist = $this->Artist_model->getArtist($_REQUEST['artist']);

            $this->load->model('Disc_model');
 
            if($_REQUEST['id'] == 0) {
                $duplicate = $this->Disc_model->checkDuplicateDisc($_REQUEST);
                
                if($duplicate) {
                    //Get title from $_REQUEST
                    $title = $_REQUEST['title'];

                    //Reset $_REQUEST
                    $_REQUEST = array();

                    $_REQUEST['message'] = '"' . $title . '" by "' . $artist->name . '" already exists.';
                } else {
                    $this->Disc_model->addDisc($_REQUEST);

                    //Get title from $_REQUEST
                    $title = $_REQUEST['title'];

                    //Reset $_REQUEST
                    $_REQUEST = array();

                    //Put message in request
                    $_REQUEST['message'] = '"' . $title . '" by "' . $artist->name . '" was added to the datadase.';
                }
            } else {
                $this->Disc_model->updateDisc($_REQUEST);

                //Get title from $_REQUEST
                $title = $_REQUEST['title'];

                //Reset $_REQUEST
                $_REQUEST = array();

                //Put message in request
                $_REQUEST['message'] = '"' . $title . '" by "' . $artist->name . '" was updated.';
            }

        }
        
        $this->disc();
    }
    
    /**
     * Artist
     * 
     * @param int $offset
     */
    public function artist($offset = 0) {
    	//Set active
    	$this->_active = 'artist';
    	
        //Set page title
        $this->data['page_title'] = 'Artists';
        
        //Load artist model
        $this->load->model('Artist_model');
        
        //Header
        $this->_create_header();
        
        //Set message
        $message = (isset($_REQUEST['message'])) ? $_REQUEST['message'] : '';
        
        //Create artist listing
        $artists = $this->Artist_model->getAllArtists($offset);
        
        //Create full page
        $this->_add_html($this->load->view('artist', array('artists' => $artists, 'message' => $message), TRUE), 'full');
        
        //Footer
        $this->_create_footer();
        
        //Render page
        $this->_render_page();
    }

    /**
     * Add Artist
     */
    public function addartist() {
    	//Set active
    	$this->_active = 'artist';
    	
        //Set page title
        $this->data['page_title'] = 'Add an artist';
        
        //Header
        $this->_create_header();
        
        //Get artist
        $form = $this->_artist_form();
        
        //Create full page
        $this->_add_html($this->load->view('addartist', array('form' => $form), TRUE), 'full');
        
        //Footer
        $this->_create_footer();
        
        //Render page 
        $this->_render_page();
    }
    
    /**
     * Update Artist
     * 
     * @param int $aid
     */
    public function updateartist($aid) {
    	//Set active
    	$this->_active = 'artist';
    	
        //Set page title
        $this->data['page_title'] = 'Update an artist';
        
        //Header
        $this->_create_header();
        
        //Get artist
        $form = $this->_artist_form($aid);
        
        //Create full page
        $this->_add_html($this->load->view('addartist', array('form' => $form), TRUE), 'full');
        
        //Footer
        $this->_create_footer();
        
        //Render page 
        $this->_render_page();
    }
    
    /**
     * Delete Artist
     * 
     * @param int $aid
     */
    public function deleteartist($aid) {
        //Delete artists
        $this->load->model('Disc_model');
        $this->load->model('Artist_model');
        
        //Get artist
        $artist = $this->Artist_model->getArtist($aid);
        
        //Check for discs
        $discs = $this->Disc_model->getDiscsByArtist($aid);
        
        if(count($discs) > 0) {
            $_REQUEST['message'] = 'Artist "' . $artist->name . '" still has ' . count($discs) . ' discs in the database. Delete these first.';
        } else {
            $this->Artist_model->deleteArtist($aid);
            
            $_REQUEST['message'] = 'Artist "' . $artist->name . '" was deleted.';
        }
        
        //Return to artist page
        $this->artist();
    }


    /**
     * Submit Artist
     */
    public function submitartist() {
        $this->load->model('Artist_model');

        if (isset($_REQUEST['id'])) {
            if ($_REQUEST['id'] == 0) {
                $duplicate = $this->Artist_model->checkDuplicateArtist($_REQUEST);
                
                if ($duplicate) {
                    //Get name from $_REQUEST
                    $name = $_REQUEST['name'];

                    //Reset $_REQUEST
                    $_REQUEST = array();
                    
                    $_REQUEST['message'] = 'Artist "' . $name . '" already exists.';
                } else {
                    $this->Artist_model->addArtist($_REQUEST);

                    //Get name from $_REQUEST
                    $name = $_REQUEST['name'];

                    //Reset $_REQUEST
                    $_REQUEST = array();

                    $_REQUEST['message'] = 'Artist "' . $name . '" was added to the database.';
                }
            } else {
                $this->Artist_model->updateArtist($_REQUEST);

                //Get name from $_REQUEST
                $name = $_REQUEST['name'];

                //Reset $_REQUEST
                $_REQUEST = array();

                $_REQUEST['message'] = 'Artist "' . $name . '" was updated.';
            }
        }
        
        $this->artist();
    }
    
    /**
     * About
     */
    public function about() {
    	//Set active
    	$this->_active =  'about';
    	
    	//Set page title
    	$this->data['page_title'] = 'About';
    	
    	//Header
    	$this->_create_header();
    	
    	//Create full page
    	$this->_add_html($this->load->view('about', array(), TRUE), 'full');

    	//Footer
    	$this->_create_footer();
    	
    	//Render page
    	$this->_render_page();
    }

    /**
     * Make navigation
     * 
     * @return array
     */
    private function _make_nav() {
        $tabs = array(
            '0' => array(
                'title' => 'Discs',
                'mname' => 'disc'
            ),
            '1' => array(
                'title' => 'Artists',
                'mname' => 'artist'
            )
        );
        
        foreach($tabs as $key => $tab) {
            if($tab['mname'] == $this->_active) {
                $tabs[$key]['state'] = 'active'; 
            } else {
                $tabs[$key]['state'] = 'inactive';
            }
        }
        
        return $tabs;
    }
    
    /**
     * Make subnav
     * 
     * @return array
     */
    private function _make_subnav() {
    	$tabs = array(
    		'0' => array(
    			'title' => 'About',
    			'mname' => 'about'
    		)
    	);
    	
    	foreach($tabs as $key => $tab) {
    		if($tab['mname'] == $this->_active) {
    			$tabs[$key]['state'] = 'active';
    		} else {
    			$tabs[$key]['state'] = 'inactive';
    		}
    	}
    	
    	return $tabs;
    }
    
    /**
     * Disc Form
     * 
     * @param int $did
     * @return string
     */
    private function _disc_form($did = 0) {
        //Get all artists
        $this->load->model('Artist_model');
        
        $artists = $this->Artist_model->getAllArtists();
        
        //If no artists found, return message
        if($artists['count'] == 0) {
            $form = '<div id="noartists">No artists found. Please add an artist before inserting a disc.</div>';
        
            return $form;
        }
        
        foreach($artists['artists'] as $a) {
            $new_artists[$a->id] = $a->name; 
        }
        
        $artists['artists'] = $new_artists;
        
        //Get years
        $years = array();
        
        for($i = 1950;$i <= date('Y');$i++) {
            $years[$i] = $i;
        }
        
        if($did == 0) {
            //New form
            $form = form_open('index/submitdisc');
            
            $form .= form_hidden('id', 0);
            
            $form .= '<div class="form_item">';
            $form .= form_label('Title of the disc', 'title');
            $form .= form_input(array('name' => 'title', 'id' => 'title'));
            $form .= '</div>';
            
            $form .= '<div class="form_item">';
            $form .= form_label('Artist', 'artist');
            $form .= form_dropdown('artist', $artists['artists']);
            $form .= '</div>';
            
            $form .= '<div class="form_item">';
            $form .= form_label('Year', 'year');
            $form .= form_dropdown('year', $years);
            $form .= '</div>';
            
            $form .= '<div class="form_item">';
            $form .= form_submit(array('name' => 'submit', 'value' => 'ADD >', 'id' => 'disc_submit'));
            $form .= '</div>';
            
            $form .= form_close();
        } else {
            //Existing disc
            $this->load->model('Disc_model');
            
            $disc = $this->Disc_model->getDisc($did);
            
            $form = form_open('index/submitdisc');
            
            $form .= form_hidden('id', $disc->id);
            
            $form .= '<div class="form_item">';
            $form .= form_label('Title of the disc', 'title');
            $form .= form_input(array('name' => 'title', 'id' => 'title', 'value' => $disc->title));
            $form .= '</div>';
            
            $form .= '<div class="form_item">';
            $form .= form_label('Artist', 'artist') . '<br />';
            $form .= form_dropdown('artist', $artists['artists'], $disc->artist);
            $form .= '</div>';
            
            $form .= '<div class="form_item">';
            $form .= form_label('Year', 'year') . '<br />';
            $form .= form_dropdown('year', $years, $disc->year);
            $form .= '</div>';
            
            $form .= '<div class="form_item">';
            $form .= form_submit(array('name' => 'submit', 'value' => 'UPDATE >', 'id' => 'disc_submit'));
            $form .= '</div>';
            
            $form .= form_close();
        }
        
        return $form;
    }
    
    /**
     * Artist Form
     * 
     * @param int $aid
     * @return string
     */
    private function _artist_form($aid = 0) {
        if($aid == 0) {
            //New artist
            $form = form_open('index/submitartist');
            
            $form .= form_hidden('id', 0);
            
            $form .= '<div class="form_item">';
            $form .= form_label('Name of the artist', 'name');
            $form .= form_input(array('name' => 'name', 'id' => 'name'));
            $form .= '</div>';
            
            $form .= '<div class="form_item">';
            $form .= form_submit(array('name' => 'submit', 'value' => 'ADD >', 'id' => 'artist_submit'));
            $form .= '</div>';
            
            $form .= form_close();
        } else {
            //Existing artist
            $this->load->model('Artist_model');
            $artist = $this->Artist_model->getArtist($aid);
            
            $form = form_open('index/submitartist');
            
            $form .= form_hidden('id', $artist->id);
            
            $form .= '<div class="form_item">';
            $form .= form_label('Name of the artist', 'name');
            $form .= form_input(array('name' => 'name', 'id' => 'name', 'value' => $artist->name));
            $form .= '</div>';
            
            $form .= '<div class="form_item">';
            $form .= form_submit(array('name' => 'submit', 'value' => 'UPDATE >', 'id' => 'artist_submit'));
            $form .= '</div>';
            
            $form .= form_close();
        }
        
        return $form;
    }
    
    /**
     * Create header
     */
    private function _create_header() {
    	//Create navigation
    	$nav = $this->_make_nav();
    	
    	//Create header
    	$this->_add_html($this->load->view('header', array('nav' => $nav), TRUE), 'header');    	
    }
    
    /**
     * Create footer
     */
    private function _create_footer() {
    	//Create subnavigation
    	$subnav = $this->_make_subnav();
    	
    	//Create footer
    	$this->_add_html($this->load->view('footer', array('subnav' => $subnav), TRUE), 'footer');    	
    }
}