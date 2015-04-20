 /* CLS
  * checkin.js
  * 
  */

$(document).ready(function(){
  $("#checkin-form").submit(function(event){
    var field = $(this).children("#checkin-field");
    var statusMenu = "<select class='item_status' name='item_status_options' onchange='itemStatusChanged(this)' size='1' >\n" +
                        "<option value='Normal' selected>Checked in</option>\n" +
                        "<option value='Damaged/In Repair'>Damaged/In Repair</option>\n" +
                        "<option value='In Transit'>In Transit</option>\n" +
                        "<option value='Lost'>Lost</option>\n" +
                      "</select>\n" +
                      "<span class='statusChangeNotification'>Item status updated</span>\n";
    if (isItemIDValid(field.val()))
    {
      $('#checkInTable')
      field.siblings("#itemID-error").css("display", "none"); //hide error msg
      $.post("../../cls_scripts/check_in_items.php", {'itemId' : field.val()}, function(data){
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
                     "<td class='barcode'>" + field.val() + "</td>\n" + //barcode
                     "<td>\n" + statusMenu + "\n</td>"; //\n<td class='statusChangeNotification'></td>
            newRow.innerHTML = cells;
            $('#checkInTable').append(newRow);
          }
          else
          {
            console.log("error set in response from database");
            console.log("Error code " + item.error_code + ": '" + item.error + 
                        "' response returned from database when attempting to check in " + field.val());
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

  //When user clicks textfield, text is selected for easy re-entry
  $('#checkin-field').click(function(){
    $(this).select();
  });
});

 function isItemIDValid(input)
 {
 	return !isNaN(input);
 }

 function itemStatusChanged(element)
 {
  // alert($(element).parent().prev().html());
  var barcode = $(element).parent().siblings('.barcode').html();
  var notification = $(element).siblings(".statusChangeNotification");
  $.post("../../cls_scripts/check_in_items.php", {'statusChange' : $(element).val(), 'barcode' : barcode},
    function(response){
      var respObj = JSON.parse(response);
      notification.css("display", "inline");
      if (respObj.error == undefined)
      {
        setTimeout(function(){
          notification.fadeOut(4000);
        }, 2500);
      }
      else
      {
        console.log("Error code " + respObj.error_code + ": '" + respObj.error + 
          "' response returned from database when attempting to change status of barcode " + barcode +
          " to '" + $(element).val() + "'");
        notification.css("color", "red");
        notification.html("There was an error updating the database. Please contact your web administrator.");
      }
    });
 }

/* possible addons:
 * animation on rows
 * check for floating pt notation (eg 1e6)
 */
