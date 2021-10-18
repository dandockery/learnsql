<?php

$SQL_QUERY_CHECKS = array();

if ($sql_text > "") 
{
    # Check if pulling all columns wildcard
    if (strpos(strtolower($sql_text), addSlashes("select *"))!==false) 
    {
        $SQL_QUERY_CHECKS += ['SELECT_STAR' => '1'];
    }
    else
    {
        $SQL_QUERY_CHECKS += ['SELECT_STAR' => '0'];
    }
}

?>