<br />
<h1 class="title"><?php echo $this->lang->line('portfolio_menu_collection'); ?></h1>
<div class="link-list show-links">
<?php
foreach($collections as $value)
{
?>
<a class="title" href="<?php echo base_url(); ?>portfolio/collection/<?php echo $value['collection_id']; ?>"><?php echo $value['collection_name']; ?></a> <br>
<?php
}
?>
</div>