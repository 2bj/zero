  <?php if ( get_theme_mod( 'zero_og_disqus' ) ) : ?>
  <div class="comments">
    <div class="comments__wrapper">
      <div id="disqus_thread"></div>
      <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = '<?php echo get_theme_mod( 'zero_og_disqus' ); ?>'; // required: replace example with your forum shortname
        var disqus_disable_mobile = true;
        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
          var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
          dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
          (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
      </script>
      <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    </div>
  </div>
  <?php endif; ?>