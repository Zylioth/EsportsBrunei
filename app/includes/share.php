<?php 
    // pass web-site url
    $site_url  = "http://www.EsportBrunei/blog";
    // post title
    $site_title  = "EsportBrunei";
?>

<!-- <a> tab for http://www.onlinecode/blog share link for social media -->
<div id="button_share">
   
    <!-- Email Social Media -->
    <a href="mailto:?Subject=<?=$site_title?>&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 <?=$site_url?>">
        <img src="<?php echo BASE_URL . '/assets/logo/email.png' ?>" alt="Email share link" style = "max-width:20px" />
    </a>
 
    <!-- Facebook Social Media -->
    <a href="http://www.facebook.com/sharer.php?u=<?=$site_url?>" target="_blank">
        <img src="<?php echo BASE_URL . '/assets/logo/fb.png' ?>" alt="Facebook share link" style = "max-width:20px" />
    </a>
    
    <!-- Google+ Social Media -->
    <a href="https://plus.google.com/share?url=<?=$site_url?>" target="_blank">
        <img src="<?php echo BASE_URL . '/assets/logo/google.png' ?>" alt="Google share link" style = "max-width:20px" />
</a>
    <!-- Twitter Social Media -->
    <a href="https://twitter.com/share?url=<?=$site_url?>&amp;text=Simple%20Share%20Buttons&amp;hashtags=simplesharebuttons" target="_blank">
        <img src="<?php echo BASE_URL . '/assets/logo/twitter.png' ?>" alt="Twitter share link" style = "max-width:20px" />
    </a>

    
</div>

     
