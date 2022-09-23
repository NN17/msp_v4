<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	if ($this->session->userdata('loginState') == true):
?>

	<div class="backend">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Content Title</th>
					<th>Created Date</th>
					<th>Published</th>
					<th>Related Link</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i = 1; 
					foreach($contentDatas as $contentData):
				?>
					<tr>
						<td class="text-right"><?=$i?></td>
						<td><a href="page/<?=$contentData['link']?>"><?=$contentData['title']?></a></td>
						<td class="text-center"><?=date('d-m-Y',$contentData['createdDate'])?></td>
						<td class="text-center"><?php if($contentData['published'] == 1){echo 'Yes';}else{echo 'No';}?></td>
						<td><?=$this->main_model->link($contentData['link'])?></td>
						<td class="text-center"><a href="ignite/editContent/<?=$contentData['Id']?>/<?=$contentData['contentTypeId']?>"><i class="fa fa-edit text-warning"></i></a></td>
						<td class="text-center"><a href="#" data-toggle="modal" data-target="#Modal" id="confirmDelete" value="<?=$contentData['Id']?>" table="content_tbl" func="allContent"><i class="fa fa-remove text-danger"></i></a></td>
					</tr>
				<?php
					$i++; 
					endforeach;
				?>
			</tbody>
		</table>

		<nav class="pull-right">
			<ul class="my-pagination">
		      <?=$this->pagination->create_links()?>
		    </ul>
		</nav>

		<!-- Modal for New delete -->

	<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" id="cancel">&times;</span></button>

	        <h4 class="modal-title" id="myModalLabel">
	        	<div class="title text-danger"><i class="fa fa-warning text-warning"></i> Confirm Delete</div>
	        	<div class="clearfix"></div>
	        </h4>
	      </div>
	      <div class="modal-body text-center" id="block_modal">
	        	
	        	
	      </div>
	      
	      
	    </div>
	  </div>
	</div>

	</div>

<?php else:?>
    Your Login Session is expired. Please <?=anchor('login/index','Login')?> again ....
<?php endif;?>