$(document).ready(function(){

    
    

	$("#availableHoldsField").hide();
  $("#unavailableHoldsField").hide();

	$('#patronId').keypress(function(e) {
    if(e.which == 13) {
    	
    	$("#patronSelect").hide();
    	$("#availableHoldsField").show();
      $("#unavailableHoldsField").show();

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
      var contributorArray = item.contributors;
      var authArray = contributorArray.authors;
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





function addBook(n){
   
   document.getElementById("checkoutTable").insertRow(-1).innerHTML = n;
   
   }