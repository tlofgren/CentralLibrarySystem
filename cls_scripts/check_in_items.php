<?php
/* check_in_items.php
 * CLS
 */

/**TODO
require library of php functions
check POST array for vars
call functions to check in items
*/

require_once('../DB_scripts/Queries.php');

if (isset($_POST['itemId']))
{
  $checkin_result = check_in($_POST['itemId']);
  if (isset($checkin_result['error']))
    echo json_encode($checkin_result);
  else
  {
    $checkin_result = get_copy_info($_POST['itemId']);
    echo json_encode($checkin_result);
  }
}

if (isset($_POST['statusChange']))
{
  $result = change_status($_POST['barcode'], $_POST['statusChange']);
  // $result = change_status(-1, $_POST['statusChange']);
  echo json_encode($result);
}

?>
