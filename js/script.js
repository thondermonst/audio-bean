$(document).ready(function() {
    if($('#disc_submit').length > 0) {
        disc_form_validate();
    } 
    
    if($('#artist_submit').length > 0) {
        artist_form_validate();
    }
});

function disc_form_validate() {
    $('#disc_submit').click(function() {
        if($('#title').val() == '') {
            var $message = 'Please fill in a title.';

            $('.message').html($message);
            $('.message').show();
            
            return false;
        } else {
            return;
        }
    });
}

function artist_form_validate() {
    $('#artist_submit').click(function() {
        if($('#name').val() == '') {
            var $message = 'Please fill in a name.';
        
            $('.message').html($message);
            $('.message').show();
            
            return false;
        } else {
            return;
        }
    });
}