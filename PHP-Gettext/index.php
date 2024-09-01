<?php
if (!isset($_GET['langID']))
  $lang = 'en';
else
  $lang = $_GET['langID'];
 
putenv("LANG=".$lang);
setlocale(LC_ALL, $lang);
$domain = "messages";
bindtextdomain($domain, "locale");
textdomain($domain);
echo gettext("welcome");
?>