<?php
/*
Template Name: Contact Page
*/
?>
<?php get_header(); ?>

	<div class="main addPadding">
		<main role="main">
			<!-- section -->
			<section id="careers_textImage_block">
				<?php
					// none here
				  //render_textImageBlock('contact_1');
				?>
			</section>

			<section id="contact_form" class="centreColumn" ng-controller="ContactFormCtrl">
				<div class="container">
					<?php render_gradientHeader('contact_1', false) ?>
					<!-- <gradient-header id="gr_1" text="Text From Attribute"/> -->

					<div class="form-holder">
						<?php 
							gravity_form(1, false, false, false, '', true, 12);
						// [gravityform id="1" title="false" description="false" ajax="true"]
						 ?>
						<!-- Angular Form -->
		        <form action="post" name="contactForm" class="row" novalidate style="display:none;">
		          <div class="form-cell col-xs-12 col-sm-6 left">
		            <div class="field-group">
		              <label for="name">*Contact Name</label>
		              <input id="name" type="text" ng-model="feedback.name" required/>
		            </div>
		          </div>


		          <div class="form-cell col-xs-12 col-sm-6 right">
		            <div class="field-group">
		              <label for="email">* Email Address</label>
		              <input id="email" type="email" ng-model="feedback.email" required/>
		            </div>
		          </div>
				  

		          <div class="form-cell col-xs-12 col-sm-6 left">
		            <div class="field-group">
		              <label for="phone">Phone Number</label>
		              <input id="phone" ng-model="feedback.phone" type="phone"/>
		            </div>
		          </div>


		          <div class="form-cell col-xs-12 col-sm-6 right">
		            <div class="field-group">
		              <label for="topic">Area of Inquiry1 </label>
		              <select id="topic" ng-model="feedback.topic" ng-options="item.label for item in topics" required>
		              </select>
		            </div>
		          </div>


		          <div class="form-cell col-xs-12 message">
		            <div class="field-group">
		              <label for="message">* Comments</label>
		              <textarea id="message" ng-model="feedback.message" required></textarea>
		            </div>
		          </div>


		          <div class="form-cell col-xs-12 site-map" ng-cloak ng-show="feedback.topic.id == 'real_estate'">
		            <div class="field-group">
		              <label for="sitemap">* Upload Sitemap File (.pdf, .docx, .jpg, etc)</label>
		              <input id="sitemap" type="file" ng-model="feedback.sitemap" accept="application/pdf,application/vnd.ms-word,image/*,.docx" />
		            </div>
		          </div>

		          <div class="form-cell col-xs-12 submit">
		            <div class="field-group">
		              <input type="submit" value="Send Message" ng-disabled="contactForm.$invalid" />
		            </div>
		          </div>


		        </form>
					</div>
				</div>
			</section>

		<!--	<section id="contact_dividerBanner_realEstate">
				<?php render_dividerBanner('contact_2'); ?>
			</section>

			<section id="contact_dividerBanner_franchise">
				<?php render_dividerBanner('franchise_About_2'); ?>
			</section>
			
			<section id="contact_dividerBanner_careers">
				<?php render_dividerBanner('contact_3'); ?>
			</section>		-->

	<section id="contact_dividerBanner_address">
				<?php render_dividerBanner('contact_address'); ?>
			</section>
			<!-- /section -->
		</main>
	</div>		

<?//php get_sidebar(); ?>
<?php get_footer(); ?>