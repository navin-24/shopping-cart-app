<?php
$articles = json_encode($this->config->item('articles'));
?>
<div id="box-6"  class="" data-loader='<?= $articles;?>'></div>