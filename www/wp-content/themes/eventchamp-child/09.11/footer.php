	
<footer class="footer footer-style2 remove-gap" id="Footer">
<div class="container">							
<div class="footer-content">
							
	
<div id="footer-sidebar" class="secondary">
<div id="footer-sidebar1 " class=" col-xs-12 col-sm-6 col-md-3">
<?php
if(is_active_sidebar('footer-sidebar-1')){
dynamic_sidebar('footer-sidebar-1');
}
?>
</div>
<div id="footer-sidebar2 " class=" col-xs-12 col-sm-6 col-md-3">
<?php
if(is_active_sidebar('footer-sidebar-2')){
dynamic_sidebar('footer-sidebar-2');
}
?>
</div>
<div id="footer-sidebar3" class=" col-xs-12 col-sm-6 col-md-3">
<?php
if(is_active_sidebar('footer-sidebar-3')){
dynamic_sidebar('footer-sidebar-3');
}
?>
</div>
<div id="footer-sidebar4" class=" col-xs-12 col-sm-6 col-md-3">
<?php
if(is_active_sidebar('footer-sidebar-4')){
dynamic_sidebar('footer-sidebar-4');
}
?>
</div>
</div>						
							
</div></div></footer>
	<?php eventchamp_content_after(); ?>
	<?php eventchamp_wrapper_after(); ?>


	<?php wp_footer(); ?>
	</body>
</html>