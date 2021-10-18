<html>

<head>

<title>Learn SQL</title>

<link rel="stylesheet" href="css/prism.css" />
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" href="lib/codemirror.css">
<link rel="stylesheet" href="theme/oceanic-next.css">

<script src="lib/codemirror.js"></script>
<script src="mode/sql/sql.js"></script>

</head>

<body>

   <div id="left">
      <h3>Lessons</h3>
      <div class="section_header">Simple Queries</div>
      <div class="section_item">SELECT *</div>
      <div class="section_item">Pulling Specific Columns</div>
      <div class="section_item">Column Aliases</div>
      <div class="section_item">SELECT Distinct</div>
      <div class="section_header">Filtering Queries</div>
      <div class="section_item">The WHERE clause</div>
      <div class="section_item">IN Operator</div>
      <div class="section_item">AND...OR Logic</div>
      <div class="section_header">Intermediate Queries</div>
      <div class="section_item">Sub-Queries</div>
      <div class="section_item">Unions</div>
      <div class="section_item">Joins</div>
      <div class="section_header">Advanced Queries</div>
      <div class="section_item">Grouping and Aggregates</div>
      <div class="section_item">Common Table Expressions</div>
      <div class="section_item">Recursive Queries</div>
   </div>

   <div id="main">

      <h2>CSCI 3410 Introduction to Databases</h2>
   
      <p>Learning SQL</p>

      <pre><code class="language-sql">USE Chattahoochee;</code></pre>
   
      <form action="" method="post">
   
         <textarea id="code" name="code" spellcheck="false"><?php echo($_POST["code"]); ?></textarea>
   
         <br />
         <input type="checkbox" id="cbox_inc_output" name="cbox_inc_output" value="inc_output" checked />
         <label for=cbox_inc_output">Include Query Output</label>
         <br /><br />
   
         <input id="submit_button" type="submit" name"submit" />
   
         <br /><br />
   
   <?php
   require 'config_loader.php';

	if (( $_SERVER['REQUEST_METHOD'] == 'POST') and isset($_POST["code"])) {

      $keys = array();
      $headerData = "";
      $data = "";

      try {
         $sql_text = $_POST["code"];
         require 'db.php';   
      
         foreach($result as $row)
         {
            if(count($keys) == 0)
            {
               $headerData .= "<tr>";
               foreach($row as $k=>$v)
               {
                  $keys[] = $k;
                  $headerData .= '<th>' .$k .'</th>';
               }
               $headerData .= '</tr>';
            }
            $data .= "<tr>";
            foreach ($keys as $key)
            {
               $data .= "<td>" .$row[$key]."</td>";
            }
            $data .="</tr>";
         }
         
         $include_output = $_POST['cbox_inc_output'];
         if ($include_output == "inc_output") {
            echo '<table>';
            echo $headerData;
            echo $data;
            echo '</table>';
         }

         $hash_data = md5($data);
         $hash_headerData = md5($headerData);
         $SQL_QUERY_CHECKS = array();
         require 'check_sql.php';

         echo "<h3>Header Data Hash</h3><pre>$hash_headerData</pre>";
         echo "<h3>Data Hash</h3><pre>$hash_data</pre>";
         echo "<h3>SQL Query Checks</h3><pre>";
         foreach ($SQL_QUERY_CHECKS as $key => $value) {
            echo "Key: $key => Value: $value\n";
         }
         echo "</pre>";

      } catch (PDOException $e) {
         echo $e->getMessage();
      }
   }
   ?>

   </form>
   </div>


<script>
window.onload = function() {
  var mime = 'text/x-mysql';
  // get mime type
  if (window.location.href.indexOf('mime=') > -1) {
    mime = window.location.href.substr(window.location.href.indexOf('mime=') + 5);
  }
  window.editor = CodeMirror.fromTextArea(document.getElementById('code'), {
    mode: mime,
    indentWithTabs: true,
    smartIndent: true,
    lineNumbers: true,
    matchBrackets : true,
    autofocus: true,
    extraKeys: {"Ctrl-Space": "autocomplete"},
    theme: "oceanic-next"
  });
  
};
</script>


<script src="js/prism.js"></script>
</body>

</html>
