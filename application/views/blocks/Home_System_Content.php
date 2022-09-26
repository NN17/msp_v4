<div class="container py-3">

<!-- <h3 class="text-info"><?=$linkStructure['name']?></h3>
<hr/> -->

<?php if(!empty($contentDatas)):?>

	<div class="row">
	<?php foreach($contentDatas as $contentData):?>
		
		
		<?php if(!empty($contentData['summary'])):?>
				
				<div class="col-md-4">
					<?php if($this->session->userdata('loginState') == true):?>
					<div class="text-right">
						<a href="content-edit/<?=$contentData['Id']?>/<?=$contentData['contentTypeId']?>" class="text-warning"><i class="fa fa-edit"></i></a>
					</div>
					<?php endif;?>
					<div class="project my-3">
						<div class="project-header text-center">
							<div class="project-title">
							<strong><?=$contentData['title']?></strong>
							</div>
						</div>
						<div class="project-body text-center">
						<?php
							preg_match_all('/<img[^>]*src=([\'"])(?<src>.+?)\1[^>]*>/i',$contentData['text'], $result); 

						?>
							<div class="imgDiv" style="background: url('<?=$result['src'][0]?>');"></div>
						</div>
						<div class="project-footer text-center">
							<div class="summary-text"><small><?=$contentData['summary']?></small></div>
							
							<a href="content-detail/<?=$contentData['Id']?>" class="btn btn-dark-blue mt-3">Read More... <i class="fa fa-chevron-circle-right"></i></a>
						</div>
					</div>
				</div>
				
		<?php else:?>
			<?=$contentData['text']?>
		<?php endif;?>
	<?php endforeach;?>
	</div>
<?php endif;?>


<nav class="pull-right">
	<ul class="my-pagination">
      <?=$this->pagination->create_links()?>
    </ul>
</nav>

</div>