<?php
require_once 'rb.php';

class Artist_model extends CI_Model {
    
	/**
	 * Construct
	 */
    public function __construct() {
        parent::__construct();
        
        R::setup('mysql:host=localhost; dbname=rb_test','rb_test','rb_test');
    }
    
    /**
     * Get all artists
     * 
     * @param int $limit
     * @param int $offset
     * @return RedBean_OODBBean[]
     */
    public function getAllArtists($limit, $offset) {
        $count = R::count('artist');
        
        $artists = R::findAll('artist', 'ORDER BY name ASC LIMIT ' . $limit . ' OFFSET ' . $offset);
        
        $result = array(
            'count' => $count,
            'artists' => $artists
        );
        
        return $result;     
    }
    
    /**
     * Get artist
     * 
     * @param int $aid
     * @return RedBean_OODBBean
     */
    public function getArtist($aid) {
        $artist = R::load('artist', $aid);
        
        return $artist;
    }
    
    /**
     * Add artist
     * 
     * @param array $artist
     * @return int
     */
    public function addArtist($artist) {
        $new_artist = R::dispense('artist');
        
        $new_artist->name = $artist['name'];
        
        $id = R::store($new_artist);
        
        return $id;
    }
    
    /**
     * Update artist
     * 
     * @param array $artist
     */
    public function updateArtist($artist) {
        $up_artist = R::load('artist', $artist['id']);
        
        $up_artist->name = $artist['name'];
        
        R::store($up_artist);
        
        return;
    }
    
    /**
     * Delete artist
     * 
     * @param int $aid
     */
    public function deleteArtist($aid) {
        $del_artist = R::load('artist', $aid);
        
        R::trash($del_artist);
        
        return;
    }
    
    /**
     * Check duplicate artist
     * 
     * @param array $artist
     * @return boolean
     */
    public function checkDuplicateArtist($artist) {
        $duplicate = R::find('artist', ' name LIKE "' . $artist['name'] . '"');
        
        $dup_found = FALSE;
        
        if(count($duplicate) > 0) {
            $dup_found = TRUE;
        }
        
        return $dup_found;
    }
}