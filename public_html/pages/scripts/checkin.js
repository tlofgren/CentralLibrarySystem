 /* CLS
  * checkin.js
  * 
  */

$(document).ready(function(){
  $("#checkin-form").submit(function(event){
    var field = $(this).children("#checkin-field");
    var statusMenu = "<select class='item_status' name='item_status_options' size='1' >\n" +
                        "<option value='Normal' selected>Checked in</option>\n" +
                        "<option value='Damaged/In Repair'>Damaged/In Repair</option>\n" +
                        "<option value='In Transit'>In Transit</option>\n" +
                        "<option value='Lost'>Lost</option>\n" +
                      "</select>\n" +
                      "<span class='statusChangeNotification'>status changed</span>\n";
    if (isItemIDValid(field.val()))
    {
      $('#checkInTable')
      field.siblings("#itemID-error").css("display", "none"); //hide error msg
      $.post("../../PHP Stuff/check_in_items.php", {'itemId' : field.val()}, function(data){
          var item = JSON.parse(data);
          if (item.error == undefined)
          {
            var newRow = document.createElement("tr");
            var cells = "<td>" + item.title + "</td>\n<td>";
            for (var role in item.contributors)
            {
              item.contributors[role].forEach(function(value){
                cells += value.last + ", " + value.first + "; ";
              });
            }
            cells = cells.substring(0, cells.length - 2);
            cells += "<td>" + item.call_no + "</td>\n" +
                     "<td>\n" + statusMenu + "\n</td>"; //\n<td class='statusChangeNotification'></td>
            newRow.innerHTML = cells;
            $('#checkInTable').append(newRow);
          }
          else
          {
            console.log("error set in response from database");
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
    // if ($(this).val() !== "Normal")
    // {
    //   alert("You changed status to " + $(this).val());
      
    // }
    alert("You changed status to " + $(this).val());

  });
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