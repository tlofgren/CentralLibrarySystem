$(document).ready(function(){

    
    

	$("#checkoutSelect").hide();

// 	$('#patronId').keypress(function(e) {
//     if(e.which == 13) {
    	
//     	$("#patronSelect").hide();
//     	$("#checkoutSelect").show();

//     }
// });

	$('#checkout-field').keypress(function(e) {
    if(e.which == 13) {
    	
       //var result = addBook(this.value);
        

            }

            });

  $("#patron-form").submit(function(event){
    
    $("#patronSelect").hide();
      $("#checkoutSelect").show();

    var idInput = $("#patron-field").val();
    
    $.post("../../PHP Stuff/check_out_items.php", {'patronId' : idInput,}, function(data){

      setCookie("patron_id", idInput);
      var user = JSON.parse(data);
      // global var patron_id = idInput;
      console.log("returned " + user);
      var userName = user.first + ' ' + user.last;

      displayUser(userName);

      
    });
    event.preventDefault();
  });

  $("#checkout-form").submit(function(event){
    var idInput = $("#checkout-field").val();
   // alert (idInput);
   var patron_id = getCookie("patron_id");
    $.post("../../PHP Stuff/check_out_items.php", {'itemId' : idInput, 'patron':patron_id}, function(data){

      
      var item = JSON.parse(data);
      
      console.log("returned " + item);
      var contributorArray = item.contributors;
      
      console.log("authors" + authArray);
      var authList = '';
      for (var i in contributorArray) {
        var authArray = contributorArray[i];
        for(var j=0; j < authArray.length/2; j++){
          authList += authArray[j].first + ' ' + authArray[j].last + "<br>";
        }
      }
      var newRowa = "<tr><td><input type='checkbox' ></td><td>" + item.title +"</td><td>";
       var newRowb =  authList + "</td><td>" + item.id + "</td><td>Fake Due Date</td></tr>";
       var newRow = newRowa + authList + newRowb;
      addBook(newRow);
      
    });
    event.preventDefault();
  });

	$('button').click(function(){
        $("table input[type='checkbox']:checked").parent().parent().remove();
    });

});

 
function setCookie(key, value) {
            var expires = new Date();
            expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
            document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
        }

function getCookie(key) {
            var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
            return keyValue ? keyValue[2] : null;
        }



function addBook(n){
   
   document.getElementById("checkoutTable").insertRow(-1).innerHTML = n;
   
   }


function displayUser(name){
  document.getElementById("userInfo").innerHTML = "Patron: " + name;
}