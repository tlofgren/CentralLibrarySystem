/* CLS
 * checkin.js
 * 
 */

 function itemStatusChanged(selected)
 {
 	// alert("Item status changed" + selected.value);
 }

 $($(".status").change(
 	function(){
 		alert("You changed status ");
 	})
 );

 $(document).ready(function(){
    $("#status1").change(function(){
        $(this).css("border-right", "1px solid");
    });
});

 $(document).ready(function (){
  $("#checkin-field").keyup(function(event){
    if (event.which == 13)  //enter key
    {
      if (isItemIDValid($(this).val()))
      {
        //query database
        //if found, check in book
        alert("valid number!");
        $(this).siblings("#itemID-error").css("display", "none");
      }
      else
      {
        $(this).siblings("#itemID-error").css("display", "block");
      }
    }
  });
});

 function isItemIDValid(input)
 {
 	return !isNaN(input);
 }