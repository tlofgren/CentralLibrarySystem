$(document).ready(function(){

    
    

	$("#checkoutSelect").hide();

	$('#patronId').keypress(function(e) {
    if(e.which == 13) {
    	
    	$("#patronSelect").hide();
    	$("#checkoutSelect").show();

    }
});

	$('#checkout-field').keypress(function(e) {
    if(e.which == 13) {
    	
       //var result = addBook(this.value);
        

            }

            });

  $("#checkout-form").submit(function(event){
    var idInput = $("#checkout-field").val();
   // alert (idInput);
    $.post("../../PHP Stuff/check_out_items.php", {'itemId' : idInput}, function(data){

      
      var item = JSON.parse(data);
      
      console.log("returned " + item);
      var newRow = "<tr><td><input type='checkbox' ></td><td>" + item.title +"</td><td> fake author</td><td>" + item.id + "</td><td>Fake Due Date</td></tr>";
      addBook(newRow);
      // $('#checkoutTable tr').last().html("<td>" + item.title +"</td>");

      // $.ajax({
      //   url: "../../PHP Stuff/check_out_items.php",
      //   data: "{'itemId' : idInput}",
      //   success: function(data){
      //     alert
      //   }

      // })
    });
    event.preventDefault();
  });

	$('button').click(function(){
        $("table input[type='checkbox']:checked").parent().parent().remove();
    });

});



rows = ["<tr> <td><input type='checkbox' ></td> <td>Harry Potter</td> <td>JK Rowling</td><td>0</td> <td>03/14/1999</td> </tr>", 
        "<tr> <td><input type='checkbox' ></td> <td>LOTR</td> <td>JRR Tolkien</td><td>1</td> <td>03/14/1999</td> </tr>",
        "<tr> <td><input type='checkbox'></td> <td>Interracial Hole Stretchers 2</td> <td>Dave</td><td>2</td> <td>03/14/1999</td> </tr>"];

function addBook(n){
   
   document.getElementById("checkoutTable").insertRow(-1).innerHTML = n;
   
   }
