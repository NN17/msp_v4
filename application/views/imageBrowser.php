<!DOCTYPE html>
<html>
<head>
	<title>File Browser</title>
	<base href="<?=base_url()?>" />
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/style-ignite.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/layout.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css" />

	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/ignite.js"></script>
</head>
<body>
	<div class="browser-head">
		<img src="assets/system_img/ignite-logo.png" />
		<span id="fileHeader">Ignite Source File Uploader</span>
	</div>
	<div class="browser-body mid-padding">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">
					<?=form_open_multipart('ignite/upload_img')?>
						<div class="form-group">
							<div class="fileBrowser-upload small-padding">
								<div class="col-md-12">
									<div class="fileUpload btn btn-primary">
										<span class="fa fa-image"> Browse</span>
										<?=form_upload('userfile','','class="upload" onchange="readURL(this);" accept=".jpg,.png,.gif" required="required"')?>
									</div>
								</div>
								<div class="preview-browser col-md-12">
									<img id="blah" src="#" alt="Image Preview" class="img-responsive mid-margin" />
								</div>
							</div>
						</div>
						<div class="form-group">
							<?=form_submit('submit','Upload','class="btn btn-default browse-button" id="myUpload"' )?>
						</div>
					<?=form_close()?>
					<hr/>
					<div class="form-group">
						<button class="btn btn-default browse-button small-margin"><i class="fa fa-download"></i> &nbsp; Download</button>
					</div>
					<div class="form-group">
						<button class="btn btn-default browse-button disabled" id="open" src="">Open</button>
					</div>
				</div>
				<div class="col-md-8">
					<div class="browser-content">
						<div class="row" id="img_thumb">
							<?php if(!empty($images)):?>
								<?php foreach($images as $img):?>
									<div class="col-md-3 thumb small-padding" url="<?=$img['path']?>">
										<div class="thumb-img">
											<img src="<?=$img['path']?>" class="img-responsive 
										center-block" id="thumb" />
										</div>
										<div class="small-font img-name text-center"><?=$img['name']?></div>

									</div>
								<?php endforeach;?>
							<?php endif;?>
						</div>


						<nav class="pull-right">
							<ul class="my-pagination">
						      <?=$this->pagination->create_links()?>
						    </ul>
						</nav>

						<div class="clearfix"></div>
					</div>
				</div>

			</div>
		</div>
	</div>
</body>
</html>