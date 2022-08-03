<div class="py-5">
	<?php $data = $this->main_model->get_block_content_data(8, 2)->result();?>

	<a id="products"><h3 class="text-center text-danger">Fire Extinguisher Products</h3></a>


	<div class="row mt-5">
		<?php foreach($data as $arr): ?>
			<div class="col-md-4 py-3">
				<div class="product-item">
					<div class="text-center item-head">
						<strong class="text-center"><?=$arr->title?></strong>
					</div>
					<?=$arr->text?>
				</div>
				<?php if($this->session->userdata('loginState') == true):?>
					<div class="edit">
						<a href="ignite/editViewContent/<?=$arr->Id?>" title="Edit Block Content"><i class="fa fa-edit"></i></a>
					</div>
				<?php endif;?>
			</div>
		<?php endforeach; ?>
	</div>
</div>