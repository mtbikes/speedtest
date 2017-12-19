<html>
<head>
<title>Results</title>
<style>

body { font-family: sans-serif; }
th { background-color:#999; text-align:center; padding:10px; }
.ltCell { background-color:#FFF; }
.dkCell { background-color:#EFEFEF; }
.sql { font-size:smaller; color:#999; padding:10px; margin:10px; }

/* you could use these to colorize the colors from slow (c0) to fast (c9) */
.c0 { background-color:'#FFB0B0'; }
.c1 { background-color:'#FFD8B0'; }
.c2 { background-color:'#FFE8B0'; }
.c3 { background-color:'#FFFBB0'; }
.c4 { background-color:'#F3FFB0'; }
.c5 { background-color:'#EDFFB0'; }
.c6 { background-color:'#DAFFB0'; }
.c7 { background-color:'#C8FFB0'; }
.c8 { background-color:'#B5FFB0'; }
.c9 { background-color:'#B0FFD8'; }

</style>
<head>
<body>
  <?php
error_reporting(E_ALL);

require_once('telemetry_settings.php');
$conn = mysql_connect($MySql_hostname, $MySql_username, $MySql_password, $MySql_databasename);

$sql = "SELECT timestamp, ip, dl AS download, ul AS upload, ping, jitter, ua AS browser FROM speedtest_users ORDER BY timestamp DESC ";


if ($conn == 0) {
        echo "Connection Failed!";
        exit;

} else {

                mysql_select_db("speedtest");
        $result=mysql_query($sql);

        echo "<table class=\"parc-table\" align=\"left\" border=\"0\" cellpadding=\"7\" cellspacing=\"2\">\n<tr>";


        // -- print field name
        for ($j=0; $j< mysql_num_fields($result); $j++) {
                $fld = mysql_field_name ($result, $j );
                if (strpos($s, $fld) >= 0 ) {
                        echo "  <th align=\"left\" >";
                        echo $fld;
                        echo "</th>\n";
                }
        }
        echo "</tr>";

                $c = 0;

        // end of field names
        while(mysql_fetch_row($result)) {
                        echo "<tr>\n";

               $c=$c+1;
                if ( $c%2 == 0 ) {
                        $bgc = "class=\"ltCell\"";
                } else {
                        $bgc = "class=\"dkCell\"";
                }

                for($i=0;$i<mysql_num_fields($result);$i++) {
                        echo "  <td $bgc>";
                        $x = mysql_result($result, $c-1 ,$i);
                        echo $x;
                        echo "</td>\n";
                }
                echo "</tr>";

                }

        echo "</table >\n";

        // --end of table



                echo "<p>&nbsp;</p><div class=\"sql\">$sql</div>";
}

        mysql_close ($conn);

?>
</body>
</html>
