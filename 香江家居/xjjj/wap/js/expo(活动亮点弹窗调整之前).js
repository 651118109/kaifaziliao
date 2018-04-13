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

function onClickEdge(content){
    $.modal({
      title:  '',
      text: content,
      buttons: [
        {
          text: '我知道了',
          onClick: function() {
            //$.alert('You clicked first button!')
          }
        }
      ]
    })
}