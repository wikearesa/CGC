<?php
$conn = oci_connect('EDW', 'edw', '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=10.253.1.59)(PORT=1521)) (CONNECT_DATA=(SERVER=DEDICATED) (SERVICE_NAME = EDWPROD)))');
if (!$conn){
$e = oci_error();
print htmlentities($e['message']);
exit;
}
else{
//echo 'Koneksi Sukses!!.'; 
//oci_close($conn);

}