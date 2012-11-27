<div class="UserNetworksContainer">
	<a href="#" class="UserNetworksToggle">Show networks</a>
	<dl class="UserNetworks">
	<?php foreach( $this->UserNetworks as $key => $val ) : ?>
		<?php if( $val ) : ?>
			<dt><?php echo $key; ?></dt>
			<dd><?php echo $val; ?></dt>
		<?php endif; ?>
	<?php endforeach; ?>
	</dl>
</div>