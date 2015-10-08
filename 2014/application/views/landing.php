	<div id="home-header">
		<p>&nbsp;</p>
		<div id="snowy-hill">
			<img id="banner" src="/img/layout/home/declare-and-share-<?=dblang('banner')?>.png" alt="declare-and-share-banner">
			<img id="candy" src="../../img/layout/home/candy-canes-md.png" alt="candy-canes-md">
			<p><?=lang('sugar_plums')?></p>
			<img id="scroll" src="/img/layout/home/<?=dblang('scroll-down')?>.jpg" alt="Scroll to select your appliance">
		</div>
	</div>
	
	<div class="container">
		<div class="row">
			<?php foreach ($products as $product) : ?>
			<div class="col-xs-12 col-md-6">
				<div class="product-box">
					<div class="product_img">
						<img src="/img/product/<?=$product['slug']?>.jpg" alt="<?=$product[dblang('name')]?>" />
					</div>
					<p>&nbsp;</p>
					<h3><?=$product[dblang('name')]?></h3>
					<ul>
						<?=$product[dblang('features')]?>
					</ul>
					<a href="/share/index/<?=$product['slug']?>" class="btn home-click" data-product="<?=$product['slug']?>"><?=lang('declare_btn')?></a>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>