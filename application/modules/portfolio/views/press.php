<br />
<h1 class="title"><?php echo $this->lang->line('portfolio_menu_press'); ?></h1>
<?php echo $this->lang->line('tap_image'); ?>
<br /><br />
<div id="selected-press">
<?php
foreach($press as $value)
{
?>
<a class="title" href="<?php echo base_url().$value['press_image_2']; ?>">
<img style="width:197px; height:207px" src="<?php echo base_url().$value['press_image_2']; ?>"></a><br />
<?php echo $value['press_name']; ?></a> <br /><br />
<?php
}
?>
</div>