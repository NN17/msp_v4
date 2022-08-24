<div class="container">
	
	<div class="mid-padding contentView">
		<?php if($this->session->userdata('loginState') == true):?>
		<div class="text-right">
			<a href="content-edit/<?=$contentData['Id']?>/<?=$contentData['contentTypeId']?>" class="text-warning"><i class="fa fa-edit"></i></a>
		</div>
		<?php endif;?>

		<h3 class='text-center text-info my-3'><?=$contentData['title']?></h3>
		
		<div class="mt-5"><?=$contentData['text']?></div>

		<div class="text-right">
			<a href="<?=$this->agent->referrer()?>" class="btn btn-warning btn-rounded"> <i class="fa fa-chevron-circle-left"></i> Back</a>
		</div>
	</div>
</div>