"use strict";

// -----INDEX TABLE ALL USERS-----
function usersTable(page) {

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            document.querySelector('#usersTable').innerHTML = this.responseText;          
        }
    }

    xhttp.open("GET", "users_action.php?page="+page, true);
    
    xhttp.send();
  
};

// ----POKE----
function poke_user(button) {
    
    // var poked = button.getAttribute('data-email');
    var id = button.getAttribute('data-id');
    var email = button.getAttribute('data-email');

    document.querySelector('#poke_number'+id).innerHTML++;

    $.ajax({
        
        url: "add_poke_action.php",
        type: "POST",
        data:{
            email: email,
        },
        success: function(){},
    });
};

//----SEARCH----

$(document).on('click', '#search', function(search_input) {

    var search_input = $('#search_input').val();
    var search_input_length = search_input.length;

    if(search_input_length < 3 || search_input_length == 0) {
        $('#search_feedback').css('display', 'block');
        $('#search_feedback').html('need min 3 symbols');

        
    } else {
        $('#search_feedback').css('display', 'none');
        $('#clear').css('display', 'block');
        $('#usersTable').html('');

        var xhttp=new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("usersTable").innerHTML=this.responseText;
          }
        }
        xhttp.open("GET","users_search.php?q="+search_input,true);
        xhttp.send();
      }
})

// ---CLEAR SEARCH

$(document).on('click', '#clear', function() {
    $('#usersTable').html('');
    $('#search_input').html('');
    usersTable(1);
    $('#clear').css('display', 'none');
});


$(document).ready(function() {
    usersTable(1);
})
