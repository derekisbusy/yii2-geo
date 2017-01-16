<?php

$state_code = $county->state->state_code;

$this->title="{$county->county} County, {$state_code}";


?>

<div id="page-county">
<h2><?php echo $county->county.' County '.$county->state->state?></h2>
