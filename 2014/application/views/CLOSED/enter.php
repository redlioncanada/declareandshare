<div id="share">
	<div id="header">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="mainbox">
						<h2 style="margin-left: 40px; margin-right: 40px;"><?=lang('entry_title')?></h2>
						<form action="/share/thanks" method="post" id="entryform">
						<input type="hidden" name="lang" value="<?=lang('short')?>" />
						<div class="row">
							<div class="col-xs-12 col-md-5 text-right">
								<p>*<?=lang('entry_required')?></p>
							</div>
						</div>
						
						<div class="sr-only">
							<label for="input_body">If you see or hear this, leave this form field blank.</label>
							<input type="text" name="body" id="input_body" value="" />
						</div>
						
						<div class="row m_t form-group">
							<div class="col-xs-3 col-md-5 text-right">
								<label for="input_firstname"><?=lang('entry_first')?>*</label>
							</div>
							<div class="col-xs-9 col-md-7">
								<input type="text" id="input_firstname" class="form-control" name="first_name" placeholder="<?=lang('entry_first_ph')?>" />
								<p class="text-danger invisible"><?=lang('entry_first_error')?></p>
							</div>
						</div>
						
						<div class="row m_t form-group">
							<div class="col-xs-3 col-md-5 text-right">
								<label for="input_lastname"><?=lang('entry_last')?>*</label>
							</div>
							<div class="col-xs-9 col-md-7">
								<input type="text" id="input_lastname" class="form-control" name="last_name" placeholder="<?=lang('entry_last_ph')?>" />
								<p class="text-danger invisible"><?=lang('entry_last_error')?></p>
							</div>
						</div>
						
						<div class="row m_t form-group">
							<div class="col-xs-3 col-md-5 text-right">
								<label for="input_email"><?=lang('entry_email')?>*</label>
							</div>
							<div class="col-xs-9 col-md-7">
								<input type="text" id="input_email" class="form-control" name="email" placeholder="<?=lang('entry_email_ph')?>" />
								<p class="text-danger invisible"><?=lang('entry_email_error')?></p>
								
							</div>
						</div>
						
						<div class="row m_t form-group">
							<div class="col-xs-3 col-md-5 text-right">
								<label for="input_email_confirm"><?=lang('entry_conf')?>*</label>
							</div>
							<div class="col-xs-9 col-md-7">
								<input type="text" id="input_email_confirm" class="form-control" name="email_check" placeholder="<?=lang('entry_conf_ph')?>" />
								<p class="text-danger invisible"><?=lang('entry_conf_error')?></p>
							</div>
						</div>
						
						<div class="row m_t form-group">
							<div class="col-xs-3 col-md-5 text-right">
								<label for="input_"><?=lang('entry_choose')?>*</label>
							</div>
							<div class="col-xs-9 col-md-7">
								<select name="product_id" id="input_product_id" class="form-control">
									<option value="0"><?=lang('entry_choose_select')?></option>
									<? foreach ($products as $product) : ?>
									<option value="<?=$product['id']?>" data-slug="<?=$product['slug']?>" <?=($selected_product == $product['slug'])?'selected="selected"':''?>><?=$product[dblang('name')]?></option>
									<? endforeach; ?>
								</select>
								<p class="text-danger invisible"><?=lang('entry_choose_error')?></p>
							</div>
						</div>
						
						<div class="row m_t">
							<div class="col-xs-3 col-md-5 text-right">
								<label for="input_"><?=lang('entry_color')?>*</label>
							</div>
							<div class="col-xs-9 col-md-7">
								<select name="color_id" id="input_color_id" class="form-control"<? if (!count($colors)) echo 'disabled="disabled"'?>>
									<option value="0"><?=lang('entry_color_select')?></option>
									<? if (count($colors)) : foreach ($colors as $product_color) : ?>
									<option value="<?=$product_color['id']?>" <?=($selected_color == $product_color['slug'])?'selected="selected"':''?>><?=$product_color[dblang('name')]?></option>
									<? endforeach; endif; ?>
								</select>
								<p class="text-danger invisible"><?=lang('entry_color_error')?></p>
							</div>
						</div>
						
						<div class="row m_t form-group">
							<div class="col-xs-12 col-md-9 col-md-offset-3">
								<input type="checkbox" id="input_terms" name="terms_and_conditions" />
								<label for="input_terms"><span></span><?=lang('entry_terms')?>*</label>
								<p class="text-danger invisible"><?=lang('entry_terms_error')?></p>
							</div>
						</div>
						
						<div class="row m_t form-group">
							<div class="col-xs-12 col-md-9 col-md-offset-3">
								<input type="checkbox" id="input_optin" name="optin" /> 
								<label for="input_optin"><span></span><?=lang('entry_optin')?></label>
							</div>
						</div>
						
						<div class="row m_t">
							<div class="col-xs-12 text-center">
								<button class="btn red" id="enter_now" style="width: <? if (lang('short') == 'fr') : ?>250<? else : ?>150<? endif; ?>px;"><?=lang('entry_enter_now')?></button>
							</div>
						</div>
						<div class="row m_t">
							<div class="col-xs-10 col-md-6">
								<a onclick="te('entry-form','entry-back','')" href="/share/index/<?=$selected_product?>" class="btn">&laquo; <?=lang('back')?></a>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<select id="color-sets" name="color-sets">
	<? 
	$product = NULL;
	foreach ($colorsets as $color) : 
		if ($product != $color['slug']) :
			if ($product) echo "</optgroup>";
			$product = $color['slug']; ?>
	<optgroup label="<?=$product?>" id="<?=$product?>"><option value="0"><?=lang('entry_color_select')?></option>
		<? endif; ?>
		<option value="<?=$color['id']?>"><?=$color['name']?></option>
	<? endforeach; ?>
</select>