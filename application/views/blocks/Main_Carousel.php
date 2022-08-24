<?php 
	$carousel = $this->main_model->get_limit_data('carousel_tbl','Id',$before_content_relatedId)->row_array();
    $imgs = $this->main_model->get_limit_data('carousel_img_tbl','carouselId',$carousel['Id'])->result_array();
?>

<!-- Bootstrap Carousel -->

<?php if($carousel['type'] == 1):?>
	<div class="wrapper">
		<div class="overlay">
			<div class="text-wrap">
				<h3 class="text-center mb-3">Our Objectives</h3>
				<p class="text-justify">
					To extend the solar power and its related products in Myanmar To provide consultancy service to the peoples from the villages in where there is no electricity availableWelcome to any companies or organisations which keen to corporate with our company.
				</p>
				<button class="btn btn-warning mx-auto d-block">Learn More</button>
			</div>
		</div>
		<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
		  <div class="carousel-inner">
		  	<?php
		      $i = 0; 
		      foreach($imgs as $row):
		    ?>
		      <div class="carousel-item <?php if($i<1){ echo 'active';}?>">
		        <img class="d-block w-100" src="<?=$row['path']?>" alt="Ignite Source">
		      </div>
		    <?php 
		      $i++;
		      endforeach;
		    ?>
		  </div>
		</div>
	</div>

<!-- Devrama Slider -->

<?php elseif($carousel['type'] == 2):?>
	<div class="animation">
	  <?php foreach($imgs as $img):?>
	   <div data-lazy-background="<?=$img['path']?>">
	       <!-- <h3 class="text-center mid-padding" data-pos="['75%', '110%', '75%', '40%']" data-duration="700" data-effect="move">
	           Caption 1
	       </h3>
	       <div class="img-text" data-pos="['50%', '10%']" data-duration="700" data-effect="fadein">
	           Kandawgyi Palace
	       </div>
	       <div class="img-text" data-pos="['60%', '13%']" data-duration="700" data-effect="fadein">
	           Hotel
	       </div> -->
	   </div>
	  <?php endforeach;?>
	  
	</div>

	<script>
	$(document).ready(function(){
	    $('.animation').DrSlider({
	      'transition': 'fade',
	      'showNavigation' : false,
	      'progressColor': '#bbb',
	      'transitionSpeed' : 2000
	      }); //Yes! that's it!
	});
	</script>
<?php elseif($carousel['type'] == 3):?>
	<?php $this->load->view('backend/owl_carousel')?>
<?php endif;?>