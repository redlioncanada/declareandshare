	
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-4">
				<div class="footer-box">
					<h4><?=lang('gift_giver_title')?></h4>
					<p><?=lang('gift_giver_text')?></p>
					<a href="/share/enter/" class="btn" onclick="te('common','skip-share','');"><?=lang('gift_giver_link')?></a>
				</div>
			</div>
			<div class="col-xs-12 col-md-4">
				<div class="footer-box">
					<h4><?=lang('what_color_title')?></h4>
					<p><?=lang('what_color_text')?></p>
					<a href="http://kitchenaidcolourology.ca/" target="_blank" class="btn" onclick="te('common','external-link','colourology');"><?=lang('what_color_link')?></a>
				</div>
			</div>
			<div class="col-xs-12 col-md-4">
				<div class="footer-box">
					<h4><?=lang('where_to_buy_title')?></h4>
					<p><?=lang('where_to_buy_text')?></p>
					<a href="/<?=dblang('where-to-buy')?>.pdf" class="btn" onclick="te('common','where-to-buy','');"><?=lang('where_to_buy_link')?></a>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12">
				<div class="links text-center">
					<a href="http://www.kitchenaid.ca/<?=lang('lang_code')?>/" class="space" onclick="te('common','external-link','kitchenaid-ca');">KitchenAid.ca</a>
					<a href="http://blog.kitchenaid.ca/declare-share-rules-regulations/" target="_blank" class="space" onclick="te('common','external-link','kablog-contest-rules');"><?=lang('contest')?></a>
					<a href="<?=lang('privacy_link')?>" onclick="te('common','privacy','');"><?=lang('privacy')?></a>
				</div>
				<div class="legal text-center"><?=lang('legal')?></div>
			</div>
		</div>
	</div>
	
	<div id="fb-root"></div>
	
	<script src="/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<?php if (isset($scrollanal)) : ?>
	<script src="/js/min/scrolldepth-min.js"></script>
	<script>
		$(function() {
			$.scrollDepth({pixelDepth: false});
		});
	</script>
	<? endif; ?>
	<script src="/js/min/dandc-min.js"></script>
  </body>
</html>