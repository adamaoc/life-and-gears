      </div>
    </div>

     <div id="footer">
      <div class="container">
        <p class="text-muted credit">
			&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. <?php _e('Powered by', 'ampnetmedia'); ?> 
			<a href="//ampnetmedia.com" title="ampnet media - Dallas Website Development">ampnet(media)</a>.
        </p>
      </div>
    </div>
  
    <script src="<?php bloginfo('template_url'); ?>/assets/js/jquery.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/assets/js/bootstrap.min.js"></script>
    <?php wp_footer(); ?>
    
    <!-- analytics -->
    <script>
    (function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
    (f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
    l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
    ga('send', 'pageview');
    </script>
</body>

</html>
