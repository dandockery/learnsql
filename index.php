<html>

<head>

<title>Learn SQL</title>
<link rel="stylesheet" href="css/prism.css" />
<style>
   body {
      font-family: arial;
      background-color: #ccc;
      color: #333;
   }
   div#main {
      display: inline-block;
      width: 700px;
      border-left: 1px solid white;
      padding-left: 50px;
      text-align: left;
   }
   div#left {
      display: inline-block;
      width: 250px;
      text-align: left;
      vertical-align: top;
   }
   .section_item, .section_header {
      border: 1px solid white;
      border-top: 0px;
      padding: 10px;
      text-align: left;
   }
   .section_header {
      font-weight: bold;
   }
   .section_item {
      padding-left: 20px;
   }
   .CodeMirror {
      font-size: 12px;
      height: auto;
   }
   table {
      background-color: #222;
      color: #ccc;
      border-collapse: collapse;
   }
   table tr {

   }
   table tr:first-child {
      background-color: #111;
   }
   table tr:first-child th {
      border-radius: 5px 5px 0px 0px;
      border: 1px solid #ccc;
   }
   table tr th {
      font-weight: bold;
   }
   table tr td,th {
      border: 1px solid #ccc;
      padding-left: 5px;
      padding-right: 5px;
      width: 1%;
      white-space: nowrap;
   }
   #submit_button {
      background-color: green;
      color: white;
      border: 1px solid darkgreen;
      border-radius: 5px;
      padding: 5px;
   }
</style>

<script src="lib/codemirror.js"></script>
<script src="mode/sql/sql.js"></script>
<link rel="stylesheet" href="lib/codemirror.css">
<link rel="stylesheet" href="theme/ambiance.css">

</head>

<body>

<?php
	// Load Configuration Settings 
	function loadConfig( $vars = array() ) {
	    foreach( $vars as $v ) {
	        define( $v, get_cfg_var( "learnsql.cfg.$v" ) );
	    }
	}

	// Load Database Connection Info
	$cfg = array( 'DB_HOST', 'DB_USER', 'DB_PASS' );
	loadConfig( $cfg );
?>

   <div id="left">
      <div class="section_header">Simple Queries</div>
      <div class="section_item">Simple Queries 1</div>
      <div class="section_item">Simple Queries 2</div>
      <div class="section_item">Simple Queries 3</div>
      <div class="section_header">Filtering Queries</div>
      <div class="section_item">The WHERE clause</div>
      <div class="section_item">IN Operator</div>
      <div class="section_item">AND...OR Logic</div>
      <div class="section_header">Advanced Queries</div>
      <div class="section_item">Grouping and Aggregates</div>
   </div>
   <div id="main">
   <h2>CSCI 3410 Introduction to Databases</h2>
   <p>Learning SQL</p>
   <pre><code class="language-sql">USE Chattahoochee;</code></pre>
   <form action="" method="post">
   <textarea id="code" name="code" spellcheck="false"><?php echo($_POST["code"]); ?></textarea>
   <br /><br />
   <input id="submit_button" type="submit" name"submit" />
   <br /><br />
   <?php
	if ( $_SERVER['REQUEST_METHOD'] == 'POST') {

	$options = [
	    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
	    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
	    \PDO::ATTR_EMULATE_PREPARES   => false,
	];

	$dsn = constant("DB_HOST");

	try {
	     $pdo = new PDO($dsn, constant("DB_USER"), constant("DB_PASS"), $options);
	$sql_text = $_POST["code"];
	$sql = $pdo->query($sql_text);
	$keys = array();
	$data = "";
	$headerData = "";
	while($row=$sql->fetch())
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
	echo '<table>';
	echo $headerData;
	echo $data;
	echo '</table>';


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
    theme: "ambiance"
  });
  
};
</script>


<script src="js/prism.js"></script>
</body>

</html>
