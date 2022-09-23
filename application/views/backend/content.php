<div class="container py-5">

<!-- <h3 class="text-info"><?=$linkStructure['name']?></h3>
<hr/> -->

<?php if(!empty($contentDatas)):?>

	<?php foreach($contentDatas as $contentData):?>
		
		<?php if($this->session->userdata('loginState') == true):?>
		<div class="text-right">
			<a href="content-edit/<?=$contentData['Id']?>/<?=$contentData['contentTypeId']?>" class="text-warning"><i class="fa fa-edit"></i></a>
		</div>
		<?php endif;?>

		<div class="pr-3 my-3 clearfix">
		
		<?php if(!empty($contentData['summary'])):?>
			<div class="row content-data">
				<div class="col-md-4 summary-img">
				<?php
					preg_match_all('/<img[^>]+>/i',$contentData['text'], $result); 
					foreach($result as $img){
						if (!empty($img)){
							print $img[0];
						}
							else{
								echo '<img src="upload_img/no-preview-available.png" class="center-block"/>';
							}
						
					}
				?>
				</div>
				<div class="col-md-8 py-3">
					<h4><?=$contentData['title']?></h4>
					<?=$contentData['summary']?>
					<div class="readMore">
						<a href="content-detail/<?=$contentData['Id']?>" class="btn btn-dark-blue mt-5">Read More... <i class="fa fa-chevron-circle-right"></i></a>
						<?php if($contentData['showDate']):?>
							<p class="text-right">
								<small><i>Published at : <?=date('d-m-Y', $contentData['publishedDate'])?></i></small>
							</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php else:?>
			<?=$contentData['text']?>
		<?php endif;?>
		</div>
	<?php endforeach;?>
<?php endif;?>


<nav class="pull-right">
	<ul class="my-pagination">
      <?=$this->pagination->create_links()?>
    </ul>
</nav>

</div>