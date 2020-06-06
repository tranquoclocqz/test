<?php

$lang_file = file_get_contents(_source."lang_".$lang.".txt", "r");
foreach (json_decode($lang_file,true) as $key => $value) {
	@define( $value['name'] ,$value['value'] );
}
