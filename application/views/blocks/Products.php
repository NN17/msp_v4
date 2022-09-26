<div class="container py-5">

	<h3 class="text-center text-dark-blue text-uppercase mb-5">Products</h3>

	<div class="row">
		
		<?php 
			$products = $this->main_model->get_front_page_product(); 
			foreach($products as $prod):
		?>

			<div class="col-md-3">
				
				<div class="product my-3">
					<div class="product-header text-center">
						<strong><?=$prod['title']?></strong>
					</div>
					<div class="product-body text-center">
					<?php
						preg_match_all('/<img[^>]*src=([\'"])(?<src>.+?)\1[^>]*>/i',$prod['text'], $result); 

					?>
						<div class="imgDiv" style="background: url('<?=$result['src'][0]?>');"></div>
					</div>
					<div class="product-footer text-center">
						<!-- <div class="summary-text"><small><?=$prod['summary']?></small></div> -->
						
						<a href="content-detail/<?=$prod['Id']?>" class="btn btn-dark-blue mt-3">Product Detail .. <i class="fa fa-chevron-circle-right"></i></a>
					</div>
				</div>
			</div>

		<?php 
			endforeach; 
		?>
	</div>
	
</div>