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
  $result = get_copy_info($_POST['itemId']);
  echo json_encode($result);
}
?>
