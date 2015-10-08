<div id="share">
	<div id="header">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="mainbox">
						
						<div class="row">
							<div class="col-xs-12 col-md-4 text-center">
								<div id="product-block">
									<img id="product-img" src="/img/product/<?=$product['slug']?>/<?=stripdash($colors[0]['slug'])?>.jpg" alt="<?=$product['name']?> Product Image" />
								</div>
							</div>
							<div class="col-xs-12 col-md-8">
								<h2 id="product_title"><?=$product[dblang('name')]?></h2>
								<p><?=$product[dblang('description')]?></p>
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-12">
								<h3><?=lang('choose_color')?></h3>
								<ul id="color-select">
									<?php foreach ($colors as $color) :?>
									<li><button class="btn color-btn" data-toggle="tooltip" data-placement="top" style=" background: #<?=$color['hex_value']?>; border: 1px solid #<?=($color['hex_value']=='ffffff')?'878787':'fff'?>; " title="<?=$color[dblang('name')]?>" data-newimage="/img/product/<?=$product['slug']?>/<?=stripdash($color['slug'])?>.jpg" data-color="<?=$color['slug']?>" data-colorname="<?=$color[dblang('name')]?>" data-image="<?=stripdash($color['slug'])?>">&nbsp;</button></li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-12">
								<h3><?=lang('choose_share')?></h3>
								<ul id="share-select">
									<li><button class="btn" id="share-facebook"><img src="/img/layout/share/facebook-icon.png" alt="facebook-icon" width="40" height="40" /></li>
									<li><button class="btn" id="share-twitter"><img src="/img/layout/share/twitter-icon.png" alt="twitter-icon" width="40" height="40" /></li>
									<li><button class="btn" id="share-pinterest"><img src="/img/layout/share/pinterest-icon.png" alt="pinterest-icon" width="40" height="40" /></li>
									<li><button class="btn" id="share-mail" data-toggle="modal" data-target="#mailShareModal"><img src="/img/layout/share/mail-icon.png" alt="mail-icon" width="40" height="40" /></li>
								</ul>
								<p style="text-align: center;"><?=lang('explain_share')?></p>
							</div>
						</div>
						
						<div class="row m_t">
							<div class="col-xs-12 col-sm-6">
								<a class="btn" style="width: 150px;" href="/" onclick="te('<?=$product['slug']?>','product-back','');">&laquo; <?=lang('back')?></a>
							</div>
							<div class="col-xs-12 col-sm-6 text-right">
								<a href="/share/enter/<?=$product['slug']?>" style="margin: 35px 40px 0 0; display: inline-block;" onclick="te('<?=$product['slug']?>','goto-contest','');"><?=lang('go_direct')?> &raquo;</a>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="mailShareModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?=lang('email_form_cancel')?></span></button>
        <h4 class="modal-title" id="myModalLabel"><?=lang('email_form_share_via')?></h4>
      </div>
      <form id="send_mail" method="post" action="#" role="form">
      <div class="modal-body">
        	<div class="alert alert-warning alert-dismissible hidden" role="alert" id="email_alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only"><?=lang('email_form_cancel')?></span></button>
	  			<?=lang('email_form_error_1')?><a href="/share/enter/<?=$product['slug']?>"><?=lang('email_form_error_2')?></a>.
	  		</div>
        	<div class="form-group">
				<label for="input_yourname"><?=lang('email_form_name')?></label>
				<input type="email" class="form-control" name="yourname" id="input_yourname" placeholder="<?=lang('email_form_enter_name')?>">
			</div>
			<div class="form-group">
				<label for="input_youremail"><?=lang('email_form_email')?></label>
				<input type="email" class="form-control" name="youremail" id="input_youremail" placeholder="<?=lang('email_form_enter_email')?>">
			</div>
			<div class="form-group">
				<label for="input_friendname"><?=lang('email_form_friend_name')?></label>
				<input type="email" class="form-control" name="friendname" id="input_friendname" placeholder="<?=lang('email_form_enter_friend_name')?>">
			</div>
			<div class="form-group">
				<label for="input_friendemail"><?=lang('email_form_friend_email')?></label>
				<input type="email" class="form-control" name="friendemail" id="input_friendemail" placeholder="<?=lang('email_form_enter_friend_email')?>">
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal"><?=lang('email_form_cancel')?></button>
        <button type="button" class="btn red" id="send_btn"><?=lang('email_form_submit')?></button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>

var server_name = "http://declareandshare.ca/";
var lang = "<?=(lang('short')=='fr')?'/french':''?>";
var product_slug = "<?=$product['slug']?>";
var color_slug = "<?=$colors[0]['slug']?>";
var color_name = "<?=$colors[0][dblang('name')]?>";
var color_image_slug = '<?=stripdash($colors[0]['slug'])?>';
var base_url = server_name+"declared/index/";
var media_base_url = server_name+"img/product/";
var forward_url = server_name+"share/enter/";
var tw_share = "<?=str_replace('[[PROD]]', html_entity_decode($product[dblang('name')]), lang('tw_desc'))?>";
var pin_share = "<?=str_replace('[[PROD]]', html_entity_decode($product[dblang('name')]), lang('pin_desc'))?>";

</script>