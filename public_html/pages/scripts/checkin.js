 /* CLS
  * checkin.js
  * 
  */

$(document).ready(function(){
  // $("#checkin-field").keyup(function(event){
  //   if (event.which == 13)  //enter key
  //   {
  //     var input = $(this).val();
  //     if (isItemIDValid(input))
  //     {
  //       alert("valid number: " + input);
  //       //query database
  //       // $.post("../../php/check_in_items.php", {key:input}, function(){
  //       //   alert("YES IT WORKED!");
  //       // });
  //       // $.post("./checkin.php", {id:input}, function(){
  //       //   alert("test worked posting to same page");
  //       // });
        
  //       //if found, check in book
  //       $(this).siblings("#itemID-error").css("display", "none"); //hide error msg
  //     }
  //     else
  //     {
  //       $(this).siblings("#itemID-error").css("display", "block");
  //     }
  //   }
  // });

  $("#checkin-form").submit(function(event){
    var field = $(this).children("#checkin-field");
    if (isItemIDValid(field.val()))
    {
      field.siblings("#itemID-error").css("display", "none"); //hide error msg
      $.post("../../PHP Stuff/check_in_items.php", {'itemId' : field.val()}, function(data){
          var item = JSON.parse(data);
          if (item.error == undefined)
          {
            var newRow = document.createElement("tr");
            var cells = "<td>" + item.title + "</td><td>";
            for (var role in item.contributors)
            {
              item.contributors[role].forEach(function(value){
                cells += value.last + ", " + value.first + "; ";
              });
            }
            cells = cells.substring(0, cells.length - 2);
            cells += "<td>" + item.call_no + "</td>" +
                     "<td>" + item.status + "</td>";    //TODO: make status a dropdown with a class
            newRow.innerHTML = cells;
            $('#checkInTable').append(newRow);
          }
          else
          {
            console.log("error set in response");
            $('#itemID-error').html("There was an error connecting to the catalog. Please contact your web administrator.");
            field.siblings("#itemID-error").css("display", "block");
          }
        });
    }
    else
    {
      field.siblings("#itemID-error").css("display", "block"); //display error msg
    }
    event.preventDefault();
  });

  $("#status1").change(function(){
    // alert("You changed status to " + $('[name="item_status_options[]"]').val());
    if ($(this).val() === "Damaged")
    {
      alert("You changed status to Damaged");
      
    }
  });

  // $("#sub").click(function(event){
  //   // alert("in click event");
  //   event.preventDefault(); //$(this).serialize()
  //   alert("f1 = " + $(this).children('#f1').val());
  //   // $.post("./checkin.php", {id:$('#f1').val()}, function(){
  //   //       alert("test worked posting to same page for form?");
  //   //     });

    
  // });
});

 function isItemIDValid(input)
 {
 	return !isNaN(input);
 }

  // $($(".status").change(
  // function(){
  //  alert("You changed status ");
  // })
 // );

 // $(document).ready(function(){
    // $("#status1").change(function(){
    //     $(this).css("background-color", "#D6D6FF");
    // });
    // $(this).html() += "<option value='status4'>status 4</option>";
      // var newOpt = document.createElement("option");
      // newOpt.innerHTML = "status4";
      // $(this).append(newOpt);
// });

/* possible addons:
 * animation on rows
 * check for floating pt notation (eg 1e6)
 */