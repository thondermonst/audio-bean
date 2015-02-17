<?php
require_once 'rb.php';

class Disc_model extends CI_Model {
    
	/**
	 * Construct
	 */
    public function __construct() {
        parent::__construct();
        
        R::setup('mysql:host=localhost; dbname=rb_test','rb_test','rb_test');
    }
    
    /**
     * Get all discs
     * 
     * @param int $limit
     * @param int $offset
     * @return RedBean_OODBBean[]
     */
    public function getAllDiscs($limit, $offset) {
        $count = R::count('disc');
        
        $discs = R::findAll('disc', ' ORDER BY artist ASC, year ASC LIMIT ' . $limit . ' OFFSET ' . $offset);
        
        foreach($discs as $key => $disc) {
            $artist = R::load('artist', $disc->artist);
            
            $discs[$key]->artist = $artist->name;
        }        
        
        $result = array(
            'count' => $count,
            'discs' => $discs
        );
        
        return $result;        
    }
    
    /**
     * Get disc
     * 
     * @param int $did
     * @return RedBean_OODBBean
     */
    public function getDisc($did) {
        $disc = R::load('disc', $did);
        
        return $disc;
    }
    
    /**
     * Get discs by artist
     * 
     * @param int $aid
     * @return RedBean_OODBBean[]
     */
    public function getDiscsByArtist($aid) {
        $discs = R::find('disc', ' artist = ' . $aid . ' ORDER BY year ASC');
        
        return $discs;
    }

    /**
     * Add disc
     * 
     * @param array $disc
     * @return int
     */
    public function addDisc($disc) {
        $new_disc = R::dispense('disc');
        
        $new_disc->title = $disc['title'];
        $new_disc->artist = $disc['artist'];
        $new_disc->year = $disc['year'];
        
        $id = R::store($new_disc);
        
        return $id;
    }
    
    /**
     * Update disc
     * 
     * @param array $disc
     */
    public function updateDisc($disc) {
        $up_disc = R::load('disc', $disc['id']);
        
        $up_disc->title = $disc['title'];
        $up_disc->artist = $disc['artist'];
        $up_disc->year = $disc['year'];
        
        $id = R::store($up_disc);
        
        return;
    }
    
    /**
     * Delete disc
     * 
     * @param int $did
     */
    public function deleteDisc($did) {
        $del_disc = R::load('disc', $did);
        
        R::trash($del_disc);
        
        return;
    }
    
    /**
     * Check duplicate disc
     * 
     * @param array $disc
     * @return boolean
     */
    public function checkDuplicateDisc($disc) {
        $duplicate = R::find('disc', 'title LIKE "' . $disc['title'] . '" AND artist = ' . $disc['artist']);
        
        $dup_found = FALSE;
        
        if(count($duplicate) > 0) {
            $dup_found = TRUE;
        }
        
        return $dup_found;
    }
}