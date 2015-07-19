<br />
<h1 class="title"><?php echo $collection[$this->session->userdata('lang_page').'_collection_name']; ?></h1>
<div class="link-list show-links">
<?php
$replace = array("[", "]", '"');
$col = str_replace($replace, '', $collection['collection_image_list'])  ;
$col = explode(',', $col);
foreach($col as $val)
{
?>
<a href="<?php echo base_url().$val; ?>"><img style="width:100%" src="<?php echo base_url().$val; ?>"></a>
<?php
}
?>
</div>
<br />