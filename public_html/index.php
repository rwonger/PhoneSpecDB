<html lang="en">

<head>
  <title>Project</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<!-- Import PHP Libs -->
<?php
require __DIR__ . "/db_lib.php";
?>
<script>
  toastr.options = {
    "newestOnTop": true,
    "positionClass": "toast-bottom-right",
  }
</script>

<body>
  <div class="w-full p-10 dark:bg-gray-600 bg-white">


    <div style="text-align: right;">
      <h1 class="w-full text-xl text-right text-white"> User: PLACEHOLDER
      </h1>
    </div>

    <form action="index.php" method="GET">
      <button style="background:#384454;color:white;border-radius: 6px;padding: 8px 25px;" type="submit">Refresh Page
      </button>
    </form>

    <div class="w-full dark:text-white text-black">
      <h1 class='dark:text-white text-3xl pb-2'>Phone Comparison Index</h1>
      <p>A table of all entries currently in the database. <br>
        To create a new comparison table, select the entries you wish to add and press the 'Create New Comparison Table' button. Don't forget to give a title! <br>
      Refresh the page after creating your table via the 'Refresh Page' button to use it in other page functions</p>
      <br>
      <form action="index.php" method="POST">
        <input type="hidden" id="createNewComparison" name="createNewComparison" value="true">
        <!-- TABLE TEMPLATE -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="p-4">
                  <div class="flex items-center">
                    <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-all-search" class="sr-only">checkbox</label>
                  </div>
                </th>
                <th scope="col" class="px-6 py-3">
                  Phone Model
                </th>
                <th scope="col" class="px-6 py-3">
                  Price (in CAD)
                </th>
                <th scope="col" class="px-6 py-3">
                  Release Date
                </th>
                <th scope="col" class="px-6 py-3">
                  Weight
                </th>
                <th scope="col" class="px-6 py-3">
                  Storage
                </th>
                <th scope="col" class="px-6 py-3">
                  Memory
                </th>
                <th scope="col" class="px-6 py-3">
                  Operating System
                </th>
                <th scope="col" class="px-6 py-3">
                  Phone Length
                </th>
                <th scope="col" class="px-6 py-3">
                  Phone Width
                </th>
                <th scope="col" class="px-6 py-3">
                  Display Type
                </th>
                <th scope="col" class="px-6 py-3">
                  Processor Chip
                </th>
                <th scope="col" class="px-6 py-3">
                  Charging Port
                </th>
              </tr>
            </thead>
            <tbody>
              <?php getTableRows(); ?>
            </tbody>
          </table>
        </div>
        <div class="flex mt-4 ">
          <button style="background:#384454;color:white;border-radius: 6px;padding: 8px 25px;" type="submit">Create New Comparison Table
          </button>
          <input type='text' name="cTitle" placeholder="Table Title" class='ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' required>
        </div>
      </form>
    </div>
    <div class="w-full dark:text-white text-black">
      <!-- <form action="index.php" method="GET"> -->
      <!--   <button type="submit">Get Phone Colours</button> -->
      <!-- </form> -->
      <h1 class="text-2xl">Statistics</h1>
      <?php getStatistics(); ?>
    </div>
    <br>
    <div class="w-full dark:text-white text-black">
      <h1 class='dark:text-white text-3xl pb-2'>Load Comparison Table</h1>
      <p>Select a comparison table using the menu below, and press the 'Load Comparison' Button.</p>
      <br>
      <form action="index.php" method="GET">
        <input type="hidden" id="loadComparison" name="loadComparison" value="true">
        <select id="tableTitles" style="background:#384454;color:white;border-radius: 6px;padding: 8px 25px;" name="selectedCID">
          <option value="">- Select Comparison -</option>
          <?php
          $titles = getTitles();
          foreach ($titles as $title) {
            echo "<option value='" . htmlentities($title['CID']) . "'>" . htmlentities($title['TITLE']) . "</option>";
          }
          ?>
        </select>
        <button style="background:#384454;color:white;border-radius: 6px;padding: 8px 25px;" type="submit">Load Comparison
        </button>
      </form>
    </div>
    <div class="w-full dark:text-white text-black">
      <h1 class='dark:text-white text-3xl pb-2'>Load Accessory Table</h1>
      <p>Select an accessory category, info and action using the menu below. Press the 'Search' Button to display the table.</p>
      <br>
      <form action="index.php" method="GET">
        <input type="hidden" id="searchAccessories" name="searchAccessories" value="true">
        <select id="tableAccessoryFrom" style="background:#384454;color:white;border-radius: 6px;padding: 8px 25px;" name="selectedAccType">
          <option value="">- Select Accessory Category-</option>
          <?php
          $accessories = array(
            array("id" => "HEADPHONES", "Type" => "Headphones"),
            array("id" => "CHARGER", "Type" => "Chargers"),
            array("id" => "CASE", "Type" =>  "Cases")
          );

          foreach ($accessories as $accessory) {
            echo "<option value='" . htmlentities($accessory['id']) . "'>" . htmlentities($accessory['Type']) . "</option>";
          }
          ?>
        </select>

        <select id="tableAccessoryFrom" style="background:#384454;color:white;border-radius: 6px;padding: 8px 25px;" name="selectedAccInfo">
          <option value="">- Select Info -</option>
          <?php
          $accessories = array(
            array("id" => "TYPE", "Type" => "Headphone Type"),
            array("id" => "VOLTAGE", "Type" => "Charger Voltage"),
            array("id" => "WATERPROOF", "Type" =>  "Waterproof Case")
          );


          foreach ($accessories as $accessory) {
            echo "<option value='" . htmlentities($accessory['id']) . "'>" . htmlentities($accessory['Type']) . "</option>";
          }
          ?>
        </select>
        <select id="tableAccessoryAction" style="background:#384454;color:white;border-radius: 6px;padding: 8px 25px;" name="selectedAccAction">
          <option value="">- Select Action -</option>
          <?php
          $accessories = array(
            array("action" => "TYPE = 'in-ear'", "Type" => "In-Ear"),
            array("action" => "TYPE = 'over-ear'", "Type" => "Over-Ear"),
            array("action" => "VOLTAGE < 50", "Type" => "Under 50 volts"),
            array("action" => "VOLTAGE >= 50", "Type" => "Over 50 volts"),
            array("action" => "WATERPROOF = 'True'", "Type" =>  "Is Waterproof"),
            array("action" => "WATERPROOF = 'False'", "Type" =>  "Not Waterproof")
          );

          foreach ($accessories as $accessory) {
            echo "<option value='" . htmlentities($accessory['action']) . "'>" . htmlentities($accessory['Type']) . "</option>";
          }
          ?>
        </select>
        <button style="background:#384454;color:white;border-radius: 6px;padding: 8px 25px;" type="submit">Search
        </button>
      </form>
    </div>

    <h1 class='dark:text-white text-3xl pb-2'>Load Camera Info Table</h1>
    <p>Select a phone model using the menu below to search for the cameras associated with that model. <br>
      Press the 'Find Camera Info' Button to display the table.</p>
    <br>
    <form action="index.php" method="GET">
      <input type="hidden" id="searchCamera" name="searchCamera" value="true">
      <select id="getPhoneTable" style="background:#384454;color:white;border-radius: 6px;padding: 8px 25px;" name="selectedPhone">
        <option value="">- Select Phone Model -</option>
        <?php
        $phoneModels = getPhoneModels();

        foreach ($phoneModels as $phoneModel) {
          echo "<option value='" . htmlentities($phoneModel['phoneModel']) . "'>" . htmlentities($phoneModel['phoneModel']) . "</option>";
        }
        ?>
      </select>
      <button style="background:#384454;color:white;border-radius: 6px;padding: 8px 25px;" type="submit">Find Camera Info
      </button>
    </form>

    <div id="tableDisplay">
    </div>

    <h2 class='dark:text-white text-3xl pb-2'>Select by Operating System:</h2>
    <p>Select an operating system in the menu below to see all phone models and pricing associated with it.</p>
    <br>
    <form action="index.php" method="POST" class="mb-8">
      <select id="joinConditionDropdown" name="joinCondition" style="background:#384454;color:white;border-radius: 6px;padding: 8px 25px;">
        <option value="">- Select OS -</option>
        <option value="android">android</option>
        <option value="iOS">iOS</option>

      </select>
      <button style="background:#384454;color:white;border-radius: 6px;padding: 8px 25px;" type="submit">Show Products
      </button>
    </form>


    <?php
    function getPhoneModels()
    {
      $array = array();
      $result = executePlainSQL("SELECT distinct phoneModel FROM CAMERA");
      while ($row = OCI_Fetch_Array($result, OCI_ASSOC + OCI_RETURN_NULLS)) {
        $model = $row['PHONEMODEL'];
        if (!empty($model)) {
          $array[] = array('phoneModel' => $model);
        }
      }
      return $array;
    }
    function handleSearchAccessories()
    {
      $category = $_GET['selectedAccType'];
      $info = $_GET['selectedAccInfo'];
      $action = $_GET['selectedAccAction'];
      $model = "MODEL";

      $result = executePlainSQL("SELECT $model, $info FROM $category WHERE $action");

      echo "<h1 class='dark:text-white text-3xl pb-2'>Accessory Table:   " . $category . "</h1>";
      echo '<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Accessory Model
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ' . $info . '
                    </th>
                </tr>
                </thead>
                <tbody>
                ' . getAccessoryResults($result) . '
                </tbody>
            </table>
        </div>';
    }


    function getAccessoryResults($result)
    {
      $tableContent = '';
      $info = $_GET['selectedAccInfo'];

      while ($row = OCI_Fetch_Array($result, OCI_ASSOC)) {
        $tableContent .=
          "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>
            <td class='w-4 p-4'>
              <div class='flex items-center'>
                <input id='checkbox-table-search-1' type='checkbox' name='selectedItems[]' value='" . $row["MODEL"] . "' class='w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'>
                <label for='checkbox-table-search-1' class='sr-only'>checkbox</label>
              </div>
            </td>
      <th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>" . $row["MODEL"] . "</th>
          <td class='px-6 py-4'>
            " . $row["" . $info . ""] . "
          </td>
          ";
      }

      return $tableContent;
    }



    function getTitles()
    {
      $array = array();
      $result = executePlainSQL("SELECT title, cid FROM MAKECOMTITLE");
      while ($row = OCI_Fetch_Array($result, OCI_ASSOC + OCI_RETURN_NULLS)) {
        $title = $row['TITLE'];
        $cid = $row['CID'];
        if (!empty($title) && !empty($cid)) {
          $array[] = array('CID' => $cid, 'TITLE' => $title);
        }
      }
      return $array;
    }

    function getStatistics()
    {
      // Nested Aggregation GROUP BY
      $res = executePlainSQL("SELECT companyName, max_weight
                              FROM (
                                  SELECT companyName, MAX(weight) AS max_weight
                                  FROM PRODUCESCOMPANY
                                  JOIN PHONEWEIGHT
                                  ON PRODUCESCOMPANY.model = PHONEWEIGHT.model
                                  GROUP BY companyName
                              ) subq
                              WHERE max_weight = (
                                  SELECT MIN(max_weight)
                                  FROM (
                                      SELECT MAX(weight) AS max_weight
                                      FROM PRODUCESCOMPANY
                                      JOIN PHONEWEIGHT
                                      ON PRODUCESCOMPANY.model = PHONEWEIGHT.model
                                      GROUP BY companyName
                                  ))");
      while ($row = OCI_Fetch_Array($res, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo "<p class='italic'>The manufacturer that sells the phone with the lowest max weight is <span class='font-bold'>" . $row["COMPANYNAME"] . "</span> with a phone at <span class='font-bold'>" . $row["MAX_WEIGHT"] . "</span> grams.<p>";
      }
      // Aggregation GROUP BY
      echo "<div class='flex gap-2 mt-1'>
      <div class='w-1/3'><p class='mb-2'>Number of phones produced by manufacturer</p>
        <div class='relative my-2 overflow-x-auto shadow-md sm:rounded-lg'>
          <table class='w-full text-sm text-left text-gray-500 dark:text-gray-400'>
            <thead class='text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400'>
                <th scope='col' class='px-6 py-3'>
                  Manufacturer
                </th>
                <th scope='col' class='px-6 py-3'>
                  Phone Count
                </th>
            </thead>
            <tbody>";
      $res = executePlainSQL("SELECT companyName, COUNT(*) as COUNT
                              FROM PRODUCESCOMPANY
                              GROUP BY companyName");
      while ($row = OCI_Fetch_Array($res, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'><td class='px-6 py-4'>" . $row["COMPANYNAME"] . "</td>";
        echo "<td class='px-6 py-4'>" . $row["COUNT"] . "</td></tr>";
      }

      echo "</tbody>
          </table>
        </div>
      </div>";
      // Query DIVISION
      echo "
      <div class='w-1/3'><p class='mb-2'>Phones that come in all available colours.</p>
      <div class='relative my-2 overflow-x-auto shadow-md sm:rounded-lg'>
        <table class='w-full text-sm text-left text-gray-500 dark:text-gray-400'>
          <thead class='text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400'>
              <th scope='col' class='px-6 py-3'>
                Phone
              </th>
          </thead>
          <tbody>";
      $res = executePlainSQL("SELECT MODEL
                              FROM COMESIN
                              GROUP BY MODEL
                              HAVING COUNT(DISTINCT colourType) = (SELECT COUNT(*) FROM COLOUR)");
      while ($row = OCI_Fetch_Array($res, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'><td class='px-6 py-4'>" . $row["MODEL"] . "</td>";
      }

      echo "</tbody></table></div></div>";
      echo "<div class='w-1/3'>
      <form class='mb-2' action='index.php' method='GET'>
        <p>Manufacturers that produce phones below $
          <input name='statsPriceBelow' class='ml-0.5 rounded-md text-black px-2' type='number' placeholder='543' required/>
          <button class='px-2 py-0.5 bg-gray-700 text-white rounded-md' type='submit' for='statsPriceBelow'>Search</button>
        </p>
      </form>
      <div class='relative overflow-x-auto shadow-md sm:rounded-lg'>
        <table class='w-full text-sm text-left text-gray-500 dark:text-gray-400'>
          <thead class='text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400'>
              <th scope='col' class='px-6 py-3'>
                Manufacturer
              </th>
              <th scope='col' class='px-6 py-3'>
                Price
              </th>
          </thead>
      <tbody id='statsPriceBelowTable'>
      <tbody>
      </table>
      </div>
      </div>";
    }

    function getTableRows()
    {
      // if db connection succeeds
      if (connectToDB()) {
        // display the table rows
        $result = executeSqlFromFile("./sql/select_phone_table.sql");
        echo parseTableRows($result);
        // disconnect from the db
        disconnectFromDB();
      }
    }

    function handlePOSTRequest()
    {
      if (connectToDB()) {
        if (array_key_exists('createNewComparison', $_POST)) {
          handleCreateComparison();
        } else if (array_key_exists('deleteTable', $_POST)) {
          handleDeleteTable();
        } else if (array_key_exists('updateTitle', $_POST)) {
          handleUpdateCompTitle();
        } else if (array_key_exists('joinCondition', $_POST)) {
          handleJoin();
        }

        disconnectFromDB();
      }
    }

    function handleGETRequest()
    {
      if (connectToDB()) {
        if (array_key_exists('loadComparison', $_GET)) {
          handleLoadComparison();
        } else if (array_key_exists('searchAccessories', $_GET)) {
          handleSearchAccessories();
          //} else if (array_key_exists('searchTable', $_GET)) {
          // handleSearchTable();
        } else if (array_key_exists('statsPriceBelow', $_GET)) {
          handlePriceBelow();
        } else if (array_key_exists('searchCamera', $_GET)) {
          handleFindCamera();
        }

        disconnectFromDB();
      }
    }

    if (isset($_POST['createNewComparison']) || isset($_POST['deleteTable']) || isset($_POST['updateTitle']) || isset($_POST['joinCondition'])) {
      handlePOSTRequest();
    } else if (isset($_GET['loadComparison']) || isset($_GET['searchAccessories']) || isset($_GET['statsPriceBelow']) || isset($_GET['searchCamera'])) {
      handleGETRequest();
    }

    function parseTableRows($result)
    {
      $tableContent = "";

      while ($row = OCI_Fetch_Array($result, OCI_ASSOC + OCI_RETURN_NULLS)) {
        $tableContent .= "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>
            <td class='w-4 p-4'>
              <div class='flex items-center'>
                <input id='checkbox-table-search-1' type='checkbox' name='selectedItems[]' value='" . $row["MODEL"] . "' class='w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'>
                <label for='checkbox-table-search-1' class='sr-only'>checkbox</label>
              </div>
            </td>
      <th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>" . $row["MODEL"] . "</th>
          <td class='px-6 py-4'>
            " . $row["PRICE"] . "
          </td>
          <td class='px-6 py-4'>
            " . $row["RELEASEDATE"] . "
          </td>
          <td class='px-6 py-4'>
            " . $row["WEIGHT"] . "
          </td>
          <td class='px-6 py-4'>
            " . $row["STORAGESIZE"] . "
          </td>
          <td class='px-6 py-4'>
            " . $row["MEMORY"] . "
          </td>
          <td class='px-6 py-4'>
            " . $row["OS"] . "
          </td>
          <td class='px-6 py-4'>
            " . $row["LENGTH"] . "
          </td>
          <td class='px-6 py-4'>
            " . $row["WIDTH"] . "
          </td>
          <td class='px-6 py-4'>
            " . $row["DISPLAYTYPE"] . "
          </td>
          <td class='px-6 py-4'>
            " . $row["PROCESSOR"] . "
          </td>
          <td class='px-6 py-4'>
            " . $row["CHARGINGPORT"] . "
          </td>";
      }
      return $tableContent;
    }

    function handleCreateComparison()
    {
      global $db_conn;

      $cid = rand(100000, 999999); // generates a random 6-digit number
      $title = $_POST['cTitle'];
      $uid = 3; // predetermined value for now
      $priv = 'admin'; // predetermined for now

      if ($title == NULL) {
        $title = "Comparison";
      }

      $comtitle = array(
        ":bind1" => $cid,
        ":bind2" => $title
      );

      $comtitle_ = array(
        $comtitle
      );

      $compriv = array(
        ":bind3" => $cid,
        ":bind4" => $uid,
        ":bind5" => $priv,
      );

      $compriv_ = array(
        $compriv
      );

      // Queries: INSERT Operation

      executeBoundSQL("INSERT INTO MAKECOMTITLE (CID, TITLE) VALUES (:bind1, :bind2)", $comtitle_);
      executeBoundSQL("INSERT INTO MAKECOMPRIV (CID, \"uid\", privilege) VALUES (:bind3, :bind4, :bind5)", $compriv_);

      if (isset($_POST['selectedItems']) && is_array($_POST['selectedItems'])) {
        $selectedItems = $_POST['selectedItems'];

        foreach ($selectedItems as $selectedItem) {
          $betw = array(":bind6" => $cid, ":bind7" => $selectedItem);
          $betw_ = array($betw);
          executeBoundSQL("INSERT INTO \"BETWEEN\" (cid, model) VALUES (:bind6, :bind7)", $betw_);
          debugAlertMessage("Selected: " . $selectedItem . "", "success");
        }
      } else {
        debugAlertMessage("No checkboxes selected", "warning");
      }

      debugAlertMessage("Created new table: " . $title . "", "success");
      OCICommit($db_conn);
    }


    function handleLoadComparison()
    {
      $selectedCID = $_GET['selectedCID'];
      $title = executePlainSQL("SELECT title FROM MAKECOMTITLE WHERE cid = $selectedCID");
      $resultingTable = executePlainSQL(
        "SELECT
            PHONEPRICE.MODEL,
            MAX(PHONEPRICE.STORAGESIZE) AS STORAGESIZE,
            MAX(PHONEPRICE.MEMORY) AS MEMORY,
            MAX(PHONEPRICE.PRICE) AS PRICE,
            MAX(PHONEWEIGHT.RELEASEDATE) AS RELEASEDATE,
            MAX(PHONEWEIGHT.WEIGHT) AS WEIGHT,
            MAX(PRODUCESCOMPANY.COMPANYNAME) AS COMPANYNAME,
            MAX(SPECSOS.OS) AS OS,
            MAX(SPECSDISPLAY.LENGTH) AS LENGTH,
            MAX(SPECSDISPLAY.WIDTH) AS WIDTH,
            MAX(SPECSDISPLAY.DISPLAYTYPE) AS DISPLAYTYPE,
            MAX(SPECSPROCESSOR.PROCESSOR) AS PROCESSOR,
            MAX(SPECSOS.CHARGINGPORT) AS CHARGINGPORT
            FROM
            PHONEPRICE,
            SPECSPROCESSOR,
            PRODUCESCOMPANY,
            PHONEWEIGHT,
            SPECSOS,
            SPECSDISPLAY,
            \"BETWEEN\"
            WHERE
            PHONEPRICE.MODEL = PHONEWEIGHT.MODEL
            AND SPECSPROCESSOR.PROCESSOR = SPECSOS.PROCESSOR
            AND SPECSPROCESSOR.LENGTH = SPECSDISPLAY.LENGTH
            AND SPECSPROCESSOR.WIDTH = SPECSDISPLAY.WIDTH
            AND SPECSPROCESSOR.DISPLAYTYPE = SPECSDISPLAY.DISPLAYTYPE
            AND PHONEPRICE.MODEL = SPECSPROCESSOR.MODEL
            AND PHONEPRICE.MODEL = PRODUCESCOMPANY.MODEL
            AND PHONEPRICE.MODEL = \"BETWEEN\".MODEL
            AND \"BETWEEN\".CID = $selectedCID
            GROUP BY
            PHONEPRICE.MODEL"
      );

      if (($row = oci_fetch_row($title)) != false) {
        echo "<h1 class='dark:text-white text-3xl pb-2'>" . $row[0] . "</h1>";
        echo '<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Phone Model
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price (in CAD)
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Release Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Weight
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Storage
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Memory
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Operating System
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Phone Length
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Phone Width
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Display Type
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Processor Chip
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Charging Port
                        </th>
                    </tr>
                    </thead>
                    <tbody>' . parseTableRows($resultingTable) . '
                    </tbody>
                </table>
            </div>';
        echo "<div class='flex mt-4'>
            <form action='index.php' method='POST'>
                <input type='hidden' name='deleteTable' value='" . htmlentities($selectedCID) . "'>
                <button style='background:red;color:white;border-radius: 6px;padding: 8px 25px;' type='submit'>Delete Table</button>
            </form>
            <form action='index.php' class='flex ml-2' method='POST'>
                <input type='hidden' name='updateTitle' value='" . htmlentities($selectedCID) . "'>
                  <button style='background:#384454;color:white;border-radius: 6px;padding: 8px 25px;' type='submit'>Update Title</button>
                  <input type='text' name='newTitle' placeholder='New Title' class='ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' required>
                  </form>
      </div>";
      echo "<p> *Refresh the page after updating your table title via the 'Refresh Page' button to see it in other page functions</p>";
      }
      debugAlertMessage("Loading Comparison", "success");
    }

    /* function handleSearchTable()
    {
      global $db_conn;
      $result = executePlainSQL("
        SELECT
          PHONEPRICE.MODEL,
          MAX(PHONEPRICE.STORAGESIZE) AS STORAGESIZE,
          MAX(PHONEPRICE.MEMORY) AS MEMORY,
          MAX(PHONEPRICE.PRICE) AS PRICE,
          MAX(PHONEWEIGHT.RELEASEDATE) AS RELEASEDATE,
          MAX(PHONEWEIGHT.WEIGHT) AS WEIGHT,
          MAX(PRODUCESCOMPANY.COMPANYNAME) AS COMPANYNAME,
          MAX(SPECSOS.OS) AS OS,
          MAX(SPECSDISPLAY.LENGTH) AS LENGTH,
          MAX(SPECSDISPLAY.WIDTH) AS WIDTH,
          MAX(SPECSDISPLAY.DISPLAYTYPE) AS DISPLAYTYPE,
          MAX(SPECSPROCESSOR.PROCESSOR) AS PROCESSOR,
          MAX(SPECSOS.CHARGINGPORT) AS CHARGINGPORT
        FROM
          PHONEPRICE,
          SPECSPROCESSOR,
          PRODUCESCOMPANY,
          PHONEWEIGHT,
          SPECSOS,
          SPECSDISPLAY
        WHERE
          PHONEPRICE.MODEL = PHONEWEIGHT.MODEL
          AND SPECSPROCESSOR.PROCESSOR = SPECSOS.PROCESSOR
          AND SPECSPROCESSOR.LENGTH = SPECSDISPLAY.LENGTH
          AND SPECSPROCESSOR.WIDTH = SPECSDISPLAY.WIDTH
          AND SPECSPROCESSOR.DISPLAYTYPE = SPECSDISPLAY.DISPLAYTYPE
          AND PHONEPRICE.MODEL = SPECSPROCESSOR.MODEL
          AND PHONEPRICE.MODEL = PRODUCESCOMPANY.MODEL
          AND (PHONEPRICE.MODEL LIKE %" . $_GET['searchTable'] . "%
              OR SPECSOS.OS LIKE %" . $_GET['searchTable'] . "%
              OR SPECSOS.CHARGINGPORT LIKE %" . $_GET['searchTable'] . "%
              OR PRODUCESCOMPANY.COMPANYNAME LIKE %" . $_GET['searchTable'] . "%)
        GROUP BY
          PHONEPRICE.MODEL;
      ");
    }*/

    function handlePriceBelow()
    {
      // Aggregation HAVING
      $res = executePlainSQL("SELECT companyName, MAX(price) as PRICE
                              FROM PRODUCESCOMPANY JOIN PHONEPRICE
                              ON PRODUCESCOMPANY.model = PHONEPRICE.model
                              GROUP BY companyName
                              HAVING MAX(price) < " . $_GET['statsPriceBelow']);
      $html = '';
      while ($row = OCI_Fetch_Array($res, OCI_ASSOC + OCI_RETURN_NULLS)) {
        $html .= "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'><td class='px-6 py-4'>" . $row["COMPANYNAME"] . "</td>";
        $html .= "<td class='px-6 py-4'>" . $row["PRICE"] . "</td></tr>";
      }
      echo "<script type='text/javascript'>
            document.getElementById('statsPriceBelowTable').innerHTML = \"" . $html . "\"
            </script>";
    }

    function handleFindCamera()
    {
      $model = $_GET['selectedPhone'];

      $result = executePlainSQL("SELECT type, cameraModel, mp FROM CAMERA WHERE phoneModel = '$model'");

      echo "<h1 class='dark:text-white text-3xl pb-2'>Camera Table for: " . $model . "</h1>";
      echo '<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all-search" type="checkbox"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    Camera Type
                </th>
                <th scope="col" class="px-6 py-3">
                    Position on Phone
                </th>
                <th scope="col" class="px-6 py-3">
                    Camera MP
                </th>
            </tr>
            </thead>
            <tbody>
            ' . getCameraResults($result) . '
            </tbody>
        </table>
    </div>';
    }

    function getCameraResults($result)
    {
      $tableContent = '';

      while ($row = OCI_Fetch_Array($result, OCI_ASSOC)) {
        $tableContent .=
          "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>
            <td class='w-4 p-4'>
              <div class='flex items-center'>
                <input id='checkbox-table-search-1' type='checkbox' name='selectedItems[]' value='" . $row["CAMERAMODEL"] . "' class='w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'>
                <label for='checkbox-table-search-1' class='sr-only'>checkbox</label>
              </div>
            </td>
      <th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>" . $row["CAMERAMODEL"] . "</th>
          <td class='px-6 py-4'>
            " . $row["TYPE"] . "
          </td>
          <td class='px-6 py-4'>
            " . $row["MP"] . "
          </td>
          ";
      }

      return $tableContent;
    }

    // deletes currently selected table. Satisfies DELETE - ON CASCADE DELETE from MAKECOMPRIV in BETWEEN
    function handleDeleteTable()
    {
      global $db_conn;
      $selectedCID = $_POST['deleteTable'];

      // Queries: DELETE Operation
      executePlainSQL("DELETE FROM MAKECOMTITLE WHERE CID = $selectedCID");
      executePlainSQL("DELETE FROM MAKECOMPRIV WHERE CID = $selectedCID");

      debugAlertMessage("Table deleted", "success");
      OCICommit($db_conn);
    }

    function handleUpdateCompTitle()
    {
      global $db_conn;
      $selectedCID = $_POST['updateTitle'];
      $newTitle = $_POST['newTitle'];

      if ($newTitle == NULL) {
        $newTitle = "Comparison";
      }

      $update = array(
        ":bind1" => $selectedCID,
        ":bind2" => $newTitle
      );

      $update_ = array(
        $update
      );

      // Queries: UPDATE Operation
      executeBoundSQL("UPDATE MAKECOMTITLE SET TITLE = :bind2 WHERE CID = :bind1", $update_);
      debugAlertMessage("Table " . $selectedCID . " updated to " . $newTitle . "", "success");
      OCICommit($db_conn);
    }

    // joins Phone_Price and Specs_OS table to find models and price of all phones for a specific operating system
    // the user would be able to select the operating system which would be used in the WHERE clause
    function handleJoin()
    {
      global $db_conn;
      $selectedCondition = $_POST['joinCondition'];

      if (!empty($selectedCondition)) {
        $convertedCondition = "'" . $selectedCondition . "'";

        $tableTitle = ucfirst($selectedCondition);

        $result = executePlainSQL(
          "SELECT PHONEPRICE.MODEL, PHONEPRICE.PRICE
               FROM PHONEPRICE, SPECSOS, SPECSPROCESSOR
               WHERE SPECSPROCESSOR.PROCESSOR = SPECSOS.PROCESSOR
               AND PHONEPRICE.MODEL = SPECSPROCESSOR.MODEL
               AND SPECSOS.OS = $convertedCondition"
        );

        echo '<h2 id="tableTitle" class="dark:text-white text-3xl pb-2">' . $tableTitle . '</h2>';
        echo '<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">';
        echo '<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">';
        echo '<tr>';
        echo '<th scope="col" class="px-6 py-3">Phone Model</th>';
        echo '<th scope="col" class="px-6 py-3">Price</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = OCI_Fetch_Array($result, OCI_ASSOC + OCI_RETURN_NULLS)) {
          echo '<tr>';
          echo '<td class="px-6 py-4">' . $row['MODEL'] . '</td>';
          echo '<td class="px-6 py-4">' . $row['PRICE'] . '</td>';
          echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
      } else {
        debugAlertMessage("No join condition selected", "warning");
      }
    }


    ?>
  </div>
</body>
