<?php
require_once 'rb.php';

class Artist_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        
        R::setup('mysql:host=localhost; dbname=rb_test','rb_test','rb_test');
    }
    
    public function getAllArtists() {
        $count = R::count('artist');
        
        $artists = R::findAll('artist', 'ORDER BY name ASC');
        
        $result = array(
            'count' => $count,
            'artists' => $artists
        );
        
        return $result;     
    }
    
    public function getArtist($aid) {
        $artist = R::load('artist', $aid);
        
        return $artist;
    }
    
    public function addArtist($artist) {
        $new_artist = R::dispense('artist');
        
        $new_artist->name = $artist['name'];
        
        $id = R::store($new_artist);
        
        return $id;
    }
    
    public function updateArtist($artist) {
        $up_artist = R::load('artist', $artist['id']);
        
        $up_artist->name = $artist['name'];
        
        R::store($up_artist);
        
        return;
    }
    
    public function deleteArtist($aid) {
        $del_artist = R::load('artist', $aid);
        
        R::trash($del_artist);
        
        return;
    }
    
    public function checkDuplicateArtist($artist) {
        $duplicate = R::find('artist', ' name LIKE "' . $artist['name'] . '"');
        
        $dup_found = FALSE;
        
        if(count($duplicate) > 0) {
            $dup_found = TRUE;
        }
        
        return $dup_found;
    }
}