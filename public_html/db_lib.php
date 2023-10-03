<?php
$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = NULL; // edit the login credentials in connectToDB()
$show_debug_alert_messages = True; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())
function connectToDB()
{
  $env = parse_ini_file('.env');
  global $db_conn;
  $ociUser = $env["DB_USERNAME"];   // Your username is ora_{CWL_ID}
  $ociPass = $env["DB_PASSWORD"];     // The password is a{student number}
  // Eg. ora_platypus is the username and a12345678 is the password.

  $db_conn = oci_connect($ociUser, $ociPass, "dbhost.students.cs.ubc.ca:1522/stu");

  if ($db_conn) {
    // debugAlertMessage("Database is Connected", "success");
    return true;
  } else {
    debugAlertMessage("Cannot connect to Database", "warning");
    $e = OCI_Error(); // For OCILogon errors pass no handle
    debugAlertMessage(htmlentities($e['message']), "error");
    return false;
  }
}

function disconnectFromDB()
{
  global $db_conn;

  // debugAlertMessage("Disconnected from Database", "info");
  oci_close($db_conn);
}

function debugAlertMessage($message, $type)
{
  global $show_debug_alert_messages;

  if ($show_debug_alert_messages) {
    echo "<script type='text/javascript'>console.log('Debug Message:',`" . $message . "`); toastr." . $type . "(`" . $message . "`)</script>";
  }
}

function executeSqlFromFile($filepath)
{
  global $db_conn;

  $sql_content = file_get_contents($filepath);
  // split the SQL string into individual statements
  $sql_statements = explode(';', $sql_content);

  // execute each SQL statement
  foreach ($sql_statements as $statement) {
    if (trim($statement) !== '') {
      $result = executePlainSQL($statement);
    }
  }

  return $result;
}
function executePlainSQL($cmdstr)
{
  global $db_conn, $success;

  $statement = oci_parse($db_conn, $cmdstr);
  //There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

  if (!$statement) {
    $e = OCI_Error($db_conn); // For OCIParse errors pass the connection handle
    debugAlertMessage("Cannot parse the following command: \n" . htmlentities($e['message']), "error");
    $success = False;
  }

  $r = oci_execute($statement, OCI_DEFAULT);
  if (!$r) {
    $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
    debugAlertMessage("Cannot execute the following command: \n" . htmlentities($e['message']), "error");
    $success = False;
  }

  return $statement;
}

function executeBoundSQL($cmdstr, $list)
{

  global $db_conn, $success;
  $statement = OCIParse($db_conn, $cmdstr);

  if (!$statement) {
    echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
    $e = OCI_Error($db_conn);
    echo htmlentities($e['message']);
    $success = False;
  }

  foreach ($list as $tuple) {
    foreach ($tuple as $bind => $val) {
      //echo $val;
      //echo "<br>".$bind."<br>";
      OCIBindByName($statement, $bind, $val);
      unset($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
    }

    $r = OCIExecute($statement, OCI_DEFAULT);
    if (!$r) {
      echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
      $e = OCI_Error($statement); // For OCIExecute errors, pass the statementhandle
      echo htmlentities($e['message']);
      echo "<br>";
      $success = False;
    }
  }
}
