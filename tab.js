$(function(){
 $(".tab_span span").mouseenter(function(){
  $(this).addClass("on").siblings().removeClass("on"); //切换选中的按钮高亮状态

    var index=$(this).index(); //获取被按下按钮的索引值，需要注意index是从0开始的

	$(".tab_practice > div").eq(index).show().siblings().hide(); //在按钮选中时在下面显示相应的内容，同时隐藏不需要的框架内容

 });
});
