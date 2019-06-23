/*轮播图实现*/
$(function(){
		var $li=$(".content>ul>li")
		var count=0;
	$(".arrow-right").click(function(){
			count++;
			if (count==4){
			    count=0;}
		 $li.eq(count).fadeIn(1000).siblings().fadeOut(1000); 
	});

		$(".arrow-left").click(function(){
			count--;
			if (count==-1){
			    count=3;}
		 $li.eq(count).fadeIn(1000).siblings().fadeOut(1000); 
	});  

	setInterval(function(){
		$(".arrow-left").click();	
	},3000)
	  	
});// JavaScript Document