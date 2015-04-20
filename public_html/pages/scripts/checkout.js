$(document).ready(function(){

    
    
  //hides checkout form until patron has been input
  $("#checkoutSelect").hide();



  
  //check if valid patron # is input, hide patron input and displays checkout form
  $("#patron-form").submit(function(event){
    
    
    var idInput = $("#patron-field").val();
    
    $.post("../../cls_scripts/check_out_items.php", {'patronId' : idInput,}, function(data){

     
      var user = JSON.parse(data);
      if (user.error==undefined) {
         //create a cookie with patron id to use on checkout form
      setCookie("patron_id", idInput);
        $("#patronSelect").hide();
      $("#checkoutSelect").show();
      console.log("returned " + user);
      var userName = user.first + ' ' + user.last;

      displayUser(userName);
    }

    else{
      alert("Patron not found");
    }
      
    });
    event.preventDefault();
  });



  $("#checkout-form").submit(function(event){
    var idInput = $("#checkout-field").val();

   var patron_id = getCookie("patron_id");
    $.post("../../cls_scripts/check_out_items.php", {'itemId' : idInput, 'patron':patron_id}, function(data){

      
      var item = JSON.parse(data);
      
      console.log("returned " + item);
      if(item.error == undefined){
      
      //loop to get names of authors
      var authList = '';
      for (var role in item.contributors) {
        item.contributors[role].forEach(function(value){
          authList += value.last + ', ' + value.first + "<br>";
        });
      }
      var newRowa = "<tr><td>" + item.title +"</td><td>";
       var newRowb =  authList + "</td><td>" + item.mediaitem_id + "</td><td>" + item.due_date +"</td></tr>";
       var newRow = newRowa + newRowb;
      addBook(newRow);
    }

    else{
      alert('Item not found in catalog');
    }
      
    });
    event.preventDefault();
  });

  $('button').click(function(){
        $("table input[type='checkbox']:checked").parent().parent().remove();
    });

  //When user clicks textfield, text is selected for easy re-entry
  $('#checkout-field').click(function() {
    $(this).select();
  });

});

 
 //stores a cookie with patron_id
function setCookie(key, value) {
            var expires = new Date();
            expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
            document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
        }
//function to get cookie info
function getCookie(key) {
            var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
            return keyValue ? keyValue[2] : null;
        }


//adds book to table
function addBook(n){
   
   document.getElementById("checkoutTable").insertRow(-1).innerHTML = n;
   
   }

//adds patron name to page after database finds patron
function displayUser(name){
  document.getElementById("userInfo").innerHTML = "Patron: " + name;
}