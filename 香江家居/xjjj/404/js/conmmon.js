<?=$url?>/anda/$(function(){
	//首页产品product
	$(".product-lf ul li").click(function(){
		$("#con_one_0").hide();
	});


})




Mediabox.scanPage = function() {
	  var links = $$("a").filter(function(el) {
		return el.rel && el.rel.test(/^lightbox/i);
	  });
	  $$(links).mediabox({/* Put custom options here */}, null, function(el) {
		var rel0 = this.rel.replace(/[[]|]/gi," ");
		var relsize = rel0.split(" ");
		return (this == el) || ((this.rel.length > 8) && el.rel.match(relsize[1]));
	  });
	};
	window.addEvent("domready", Mediabox.scanPage);



//tab切换
function setTab(name,cursel,n){
 for(i=1;i<=n;i++){
  var menu=document.getElementById(name+i);
  var con=document.getElementById("con_"+name+"_"+i);
  menu.className=i==cursel?"active":"";
  con.style.display=i==cursel?"block":"none";
 }
}