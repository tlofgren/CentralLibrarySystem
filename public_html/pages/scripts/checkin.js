 /*CLS
  * checkin.js
  * 
  */

$(document).ready(function(){
  $("#checkin-field").keyup(function(event){
    if (event.which == 13)  //enter key
    {
      var input = $(this).val();
      if (isItemIDValid(input))
      {
        alert("valid number: " + input);
        //query database
        // $.post("../../php/check_in_items.php", {key:input}, function(){
        //   alert("YES IT WORKED!");
        // });
        // $.post("./checkin.php", {id:input}, function(){
        //   alert("test worked posting to same page");
        // });
        
        //if found, check in book
        $(this).siblings("#itemID-error").css("display", "none"); //hide error msg
      }
      else
      {
        $(this).siblings("#itemID-error").css("display", "block");
      }
    }
  });

  $("#checkin-form").submit(function(event){
    var idInput = $(this).children("#checkin-field").val();
    // alert("in submit function:");
    $.post("test.php", {'itemId' : JSON.stringify(idInput)}, function(data){
      // alert("posted successfully? " + data);
      // $('#specialStatus').html(data);
      // var postArray = [];
      // for (var d in data)
        // postArray.push(data[d] + "FROG");
      var p = JSON.parse(data);
      var post = [];
      for (a in p)
        post.push(p[a]);
      console.log(postArray);
    });
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