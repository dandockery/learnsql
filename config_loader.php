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