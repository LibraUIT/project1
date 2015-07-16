<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title; ?></title>
	<meta charset="UTF-8">
	<meta name="description" content="<?php  echo $description; ?>">
	<meta name="keywords" content="<?php echo $key_work; ?>">
	<meta name="author" content="Quân Nguyễn - facebok.com/librauit">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- include jquery -->
	<script type="text/javascript" src="<?php echo base_url(); ?>public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<!-- end include jquery -->
	<!-- include bootstrap -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.js"></script>
	<!-- end include bootstrap -->
	<!-- custom css stylesheet -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/store/stylesheet.css">
	<!-- end -->
</head>
<body id="<?php switch ($template['id']) {
	case 'product_page':
		echo 'product_page';
		break;
	case 'contact_page':
		echo 'contact_page';
		break;		
	default:
		echo 'home_page';;
		break;
} ?>" class="theme no_transition">
<!-- Header -->
<?php $this->load->view("common/header"); ?>
<!-- End Header -->
<!-- Main -->
<div id="content" class="strip">
      <div class="canvas fade_in">
      		<?php
      			if(isset($template['child_menu']) && $template['child_menu'] == "true"){
				    $this->load->view("child_menu");
				}
      			$this->load->view($template['page'],$data); 
      		?>
      </div>
</div>      
<!-- End Main -->

<!-- Related Product -->
<?php
	$count = count($dataRelatedPro);
	if( $count > 0 && ($dataRelatedPro['pro'] != NULL && is_array($dataRelatedPro))){
		$this->load->view("related_product",$dataRelatedPro);
	}
?>
<!-- End Related Product -->

<!-- Footer -->
<?php $this->load->view("common/footer"); ?>
<!-- End Footer -->
</body>
</html>
