<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/includes.php';
    if ($GLOBALS['loggedIn'] == false) {
		exit('<meta http-equiv="refresh" content="0; URL=https://www.rhodum.xyz/" />');
	}
    
?>
<!DOCTYPE html>
<style>
.raritycorner {
  width: 0; 
  height: 0; 
  border-top: 150px solid #ffcc00;
  border-bottom: 150px solid transparent;
  border-right: 150px solid transparent;
}

.raritycorner span {
  position:absolute;
  top: 35px;
  width: 100px;
  left: 5px;
  text-align: center;
  font-size: 16px;
  font-family: arial;
  transform: rotate(-45deg);
  display:block;
}
</style>


<html>
	<head>
		<title><?php echo config::getName();?> | Catalog</title>
		<?php html::buildHead();?>
	</head>
	<body>
		<script>
			function loadMoreItems(type, page) {
				$(".loadMore").remove();
				$.get("/core/func/api/catalog/getItems.php?type=" + type + "&page=" + page, function(data) {
					$("#itemsContainer").append(data);
				});
			}
		</script>
		<script>var page = 0;</script>
		<?php html::getNavigation();?>
		<div class="modal" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModaal" aria-hidden="true">
				<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content center">
					<h4 class="modal-title">Error</h4>
					<div class="modal-body" id="miniProfileContent">
						<p>Please enter something to search.</p>
					</div>
				</div>
				</div>
			</div>
		<div class="container">
			<div class="col-xs-12 col-sm-12 col-md-2">
				<div class="adContainer">
					<?php html::buildAds();?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-10">
				<h3>Catalog</h3>
				<script src="/core/func/js/catalog.js?v=555"></script>
				<div class="btn-group btn-group-justified">
					<a id="typeHats" class="btn">Hats</a>
					<a id="typeHeads" class="btn">Heads</a>
					<a id="typeFaces" class="btn">Faces</a>
					<a id="typetshirts" class="btn">T-Shirt</a>
					<a id="typeshirts" class="btn">Shirts</a>
					<a id="typepants" class="btn">Pants</a>
					<a id="typeGear" class="btn">Gear</a>
					<a id="typeDecals" class="btn">Decals</a>
				</div>
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Item name" id="searchCValue">
						<span class="input-group-btn">
							<button class="btn btn-default" id="doSearch" onclick="page = 0; searchItem();" type="button">Search</button>
						</span>
					</div>
				</div>
				<div class="well profileCard">
					<div id="itemsContainer"></div>
				</div>
			</div>
		</div>
		<?php html::buildFooter();?>
	</body>
</html>