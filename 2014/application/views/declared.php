<div id="share">
	<div id="header">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="mainbox declared">
						<h2><?=lang('friend_wants')?></h2>
						<p><?=lang('click_below')?></p>
						<h3><?=$product[dblang('name')]?> <?=lang('in')?> <?=$color[dblang('name')]?></h3>
						
						<div class="row">
							<div class="col-xs-12 col-md-4 ">
								<img id="product-img" src="/img/product/<?=$product['slug']?>/<?=stripdash($color['slug'])?>.jpg" alt="<?=$product['name']?> Product Image" />
							</div>
							<div class="col-xs-12 col-md-8">
								<p><?=$product[dblang('description')]?></p>
							</div>
						</div>
						
						<div class="row m_t">
							<div class="col-xs-12 text-center">
								<a onclick="te('from-share','where-to-buy','')" class="btn" href="/"><?=lang('where_to_buy')?></a>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>