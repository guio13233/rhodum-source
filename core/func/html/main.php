<?php
	// This file will contain everything HTML related.
	class html {
		public static function buildHead() {
			include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/html/views/head.php';
		}
		
		public static function getNavigation() {
			include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/html/views/navigation.php';
		}
		
		public static function buildFooter() {
			include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/html/views/footer.php';
		}
		
		public static function buildAds() {
			$rand = rand(0, 1);
			if ($rand == 0) {
				echo '<div style="margin:10px 0px 0px;text-align: center;">
<iframe data-aa="1656779" src="//ad.a-ads.com/1656779?size=160x600" scrolling="no" style="width:160px; height:600px; border:0px; padding:0; overflow:hidden" allowtransparency="true"></iframe>
				</div>';
			}elseif ($rand == 1) {
				echo '<div style="margin:10px 0px 0px;text-align: center;">
<iframe data-aa="1656779" src="//ad.a-ads.com/1656779?size=160x600" scrolling="no" style="width:160px; height:600px; border:0px; padding:0; overflow:hidden" allowtransparency="true"></iframe>
				</div>';
			}
		}
		
		public static function buildMatched() {
			echo '<div style="margin:10px 0px 0px;text-align: center;"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
					<ins class="adsbygoogle"
						 style="display:block;max-height:100px"
						 data-ad-format="auto"
						 data-ad-client="ca-pub-"
						 data-ad-slot="1784583416"></ins>
					<script>
						 setTimeout(function(){(adsbygoogle = window.adsbygoogle || []).push({})}, 500);
					</script></div>';
		}
	}
?>