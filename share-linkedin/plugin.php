<?php
/*
Plugin Name: Share LinkedIn
Plugin URI: https://github.com/popnt/yourls-linkedin-share
Description: Adds LinkedIn to the Quick Share Box. 
Version: 1.0.0.1
Author: Julia Greaven
Author URI: //popnt.com
*/


yourls_add_action( 'share_links', 'linkedin_share_url' );
function linkedin_share_url( $args ) {
    list( $longurl, $shorturl, $title, $text ) = $args;
    $shorturl = rawurlencode( $shorturl );
    $title = rawurlencode( htmlspecialchars_decode( $title ) );
    
    // Plugin URL (no URL is hardcoded)
    $pluginurl = YOURLS_PLUGINURL . '/'.yourls_plugin_basename( dirname(__FILE__) );
    $icon = $pluginurl.'/linkedin.png';
    echo <<<LINKEDIN
    <style type="text/css">
    #share_linkedin{
        background: transparent url("$icon") left center no-repeat;
    }
    </style>
    <a id="share_linkedin"
        href="https://www.linkedin.com/shareArticle?url=$shorturl&title=$title"
        title="Share on LinkedIn"
        onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600');return false;">LinkedIn
    </a>
    <script type="text/javascript">
    // Dynamically update LinkedIn link
    // when user clicks on the "Share" Action icon, event $('#tweet_body').keypress() is fired, so we'll add to this
    $('#tweet_body').keypress(function(){
        var url = encodeURIComponent( $('#copylink').val() );
        var linkedin = 'https://www.linkedin.com/shareArticle?url='+url;
        $('#share_linkedin').attr('href', linkedin);        
    });
    </script>
LINKEDIN;
}
