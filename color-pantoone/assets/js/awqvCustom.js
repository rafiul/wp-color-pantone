
jQuery(document).ready(function ($id) {
	'use strict';
		jQuery(".open-modal").on('click', function(){
			$id = jQuery(this).data('id');
			
			jQuery.ajax({
					type: "get",
					url:'http://localhost/oncue/wp-content/themes/astra/header.php',

					data: {
						'id': $id,
					},
					success: function(msg){
						jQuery('#msg').html(msg.id);

					}
				});
			

		});
		
	jQuery(".my-modal").wgModal({
			triggerElement: '.open-modal',
			//remote:'http://localhost/oncue/wp-content/plugins/awsome-woo-quick-viewer/includes/modal-content.php',
	});
		
});