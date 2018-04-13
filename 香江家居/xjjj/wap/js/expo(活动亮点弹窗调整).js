/**
 * 特惠预约
 */

$(document).on("click", ".J_GoodsReserve", function() {
    var _this = $(this);
    var id = _this.attr('data-id');
    base.openReserve('sale', id, function() {
      _this.text("已预约");
    });
  });


$(document).on("click", ".J_HotSaleReserve", function() {
    var _this = $(this);
    var id = _this.attr('data-id');
    base.openReserve('Hotsale', id, function() {
      _this.text("已预约");
      _this.css('background','#d2c9c9');
      _this.removeClass('J_HotSaleReserve');
    });
  });

/**
 * 亮点弹框
 */

function onClickEdge(title,content){
    $("#activity-light").css("display","block");
    $("#activity-light").css("position","fixed");
    $("#activity-light").css("top",150);
    $("#activity-light").css("left","50%");
    $("#activity-light").css("height","auto");
    $("#activity-light").css("margin-top","-7rem");
    $("#activity-light").css("margin-left","-8.49rem");
    $("#activity-light .rule-title").text(title);
    $("#activity-light .rule-list div").text(content);
    // $.modal({
    //   title:  title,
    //   text: content,
    //   buttons: [
    //     {
    //       text: '我知道了',
    //       onClick: function() {
    //         //$.alert('You clicked first button!')
    //       }
    //     }
    //   ]
    // })
}
function activity_light_close(){
    // $("#activity-light").slideDown();
    $("#activity-light").animate({height:'13.2rem'}).css("display","none");
    // $("#activity-light").css("display","none");
    // $("#activity-light .rule-title").text("");
    // $("#activity-light .rule-list div").text("");
}