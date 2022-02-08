"use strict";

// -----INDEX TABLE ALL USERS-----
function pokesTable(page) {

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            document.querySelector('#pokesTable').innerHTML = this.responseText;          
        }
    }

    xhttp.open("GET", "pokes_action.php?page="+page, true);
    
    xhttp.send();
  
};

//----SEARCH----

$(document).on('click', '#search', function(search_input, from_date, to_date) {

    var search_input = $('#search_input').val();
    var from_date = $('#from').val();
    var to_date = $('#to').val();

    var search_input_length = search_input.length;

    if(from_date == "") {
        var from_date = "0000-00-00";
    }
    if(to_date == "") {
        var to_date = "2999-12-31";
    };

        $('#search_feedback').css('display', 'none');
        $('#clear').css('display', 'block');
        $('#pokesTable').html('');

        var xhttp=new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("pokesTable").innerHTML=this.responseText;
          }
        }

        xhttp.open("GET","pokes_search.php?q="+search_input+"&from="+from_date+"&to="+to_date, true);
        xhttp.send();

})


// ----DATE PICKER

  $( function() {
    var date_format = "yy-mm-dd";

      var from = $("#from").datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1,
          dateFormat: date_format,

        }).on( "change", function() {

          to.datepicker( "option", "minDate", getDate( this ) );

        });

      var to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat: date_format,

      }).on( "change", function() {

        from.datepicker( "option", "maxDate", getDate( this ) );

      });
 
    function getDate( element ) {

      var date;

      try {
        date = $.datepicker.parseDate( date_format, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );

$(document).ready(function() {
    pokesTable(1);

    // ---CLEAR SEARCH

    $(document).on('click', '#clear', function() {
        $('#from').html('');
        $('#to').html('');
        $('#search_input').html('');
        $('#pokesTable').html('');
      
        $('#clear').css('display', 'none');
        
        pokesTable(1);
    });
    
})
