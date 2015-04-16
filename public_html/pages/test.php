<!DOCTYPE html>
<html>
<body>
  <!-- <h1>Debugging only page</h1> -->
<?php
/* check_in_items.php
 * CLS
 */

/**TODO
require library of php functions
check POST array for vars
call functions to check in items
*/

if (isset($_POST['itemId']))
{
  $_POST['dummyKey'] = 'dummyValue';
  echo json_encode($_POST);
}
// print_r($_POST);
?>
</body>
</html>