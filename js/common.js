/* $Id : common.js 4865 2007-01-31 14:04:10Z paulgao $ */

/* *
 * 添加商品到购物车
 */
function addToCart(goodsId, parentId)
{
  var goods        = new Object();
  var spec_arr     = new Array();
  var fittings_arr = new Array();
  var number       = 1;
  var formBuy      = document.forms['ECS_FORMBUY'];

  // 检查是否有商品规格
  if (formBuy)
  {
    spec_arr = getSelectedAttributes(formBuy);

    if (formBuy.elements['number'])
    {
      number = formBuy.elements['number'].value;
    }
  }

  goods.spec     = spec_arr;
  goods.goods_id = goodsId;
  goods.number   = number;
  goods.parent   = (typeof(parentId) == "undefined") ? 0 : parseInt(parentId);

  Ajax.call('flow.php?step=add_to_cart', 'goods=' + goods.toJSONString(), addToCartResponse, 'POST', 'JSON');
}

/**
 * 获得选定的商品属性
 */
function getSelectedAttributes(formBuy)
{
  var spec_arr = new Array();
  var j = 0;

  for (i = 0; i < formBuy.elements.length; i ++ )
  {
    var prefix = formBuy.elements[i].name.substr(0, 5);

    if (prefix == 'spec_' && (
      (formBuy.elements[i].type == 'radio' && formBuy.elements[i].checked) ||
      formBuy.elements[i].tagName == 'SELECT'))
    {
      spec_arr[j] = formBuy.elements[i].value;
      j++ ;
    }
  }

  return spec_arr;
}

/* *
 * 处理添加商品到购物车的反馈信息
 */
function addToCartResponse(result)
{
  if (result.error > 0)
  {
    // 如果需要缺货登记，跳转
    if (result.error == 2)
    {
      if (confirm(result.message))
      {
        location.href = 'user.php?act=add_booking&id=' + result.goods_id;
      }
    }
    // 没选规格，跳到商品详情页
    else if (result.error == 6)
    {
      if (confirm(result.message))
      {
        location.href = 'goods.php?id=' + result.goods_id;
      }
    }
    else
    {
      alert(result.message);
    }
  }
  else
  {
    var cartInfo = document.getElementById('ECS_CARTINFO');

    if (cartInfo)
    {
      cartInfo.innerHTML = result.content;
    }

    if (result.one_step_buy == '1')
    {
      location.href = 'flow.php?step=checkout';
    }
    else
    {
      switch(result.confirm_type)
      {
        case '1' :
          if (confirm(result.message)) location.href = 'flow.php?step=checkout';
          break;
        case '2' :
          if (!confirm(result.message)) location.href = 'flow.php?step=checkout';
          break;
        case '3' :
          location.href = 'flow.php?step=checkout';
          break;
        default :
          break;
      }
    }
  }
}

/* *
 * 添加商品到收藏夹
 */
function collect(goodsId)
{
  Ajax.call('user.php?act=collect', 'id=' + goodsId, collectResponse, 'GET', 'JSON');
}

/* *
 * 处理收藏商品的反馈信息
 */
function collectResponse(result)
{
  alert(result.message);
}

/* *
 * 处理会员登录的反馈信息
 */
function signInResponse(result)
{
  toggleLoader(false);

  var done    = result.substr(0, 1);
  var content = result.substr(2);

  if (done == 1)
  {
    document.getElementById('member-zone').innerHTML = content;
  }
  else
  {
    alert(content);
  }
}

/* *
 * 评论的翻页函数
 */
function gotoPage(page, id, type)
{
  Ajax.call('comment.php?act=gotopage', 'page=' + page + '&id=' + id + '&type=' + type, gotoPageResponse, 'GET', 'JSON');
}

function gotoPageResponse(result)
{
  document.getElementById("ECS_COMMENT").innerHTML = result.content;
}

/* *
 * 取得格式化后的价格
 * @param : float price
 */
function getFormatedPrice(price)
{
  if (currencyFormat.indexOf("%s") > - 1)
  {
    return currencyFormat.replace('%s', advFormatNumber(price, 2));
  }
  else if (currencyFormat.indexOf("%d") > - 1)
  {
    return currencyFormat.replace('%d', advFormatNumber(price, 0));
  }
  else
  {
    return price;
  }
}

/* *
 * 夺宝奇兵会员出价
 */

function bid(step)
{
  var price = '';
  var msg   = '';
  if (step != - 1)
  {
    var frm = document.forms['formBid'];
    price   = frm.elements['price'].value;
    id = frm.elements['snatch_id'].value;
    if (price.length == 0)
    {
      msg += price_not_null + '\n';
    }
    else
    {
      var reg = /^[\.0-9]+/;
      if ( ! reg.test(price))
      {
        msg += price_not_number + '\n';
      }
    }
  }
  else
  {
    price = step;
  }

  if (msg.length > 0)
  {
    alert(msg);
    return;
  }

  Ajax.call('snatch.php?act=bid&id=' + id, 'price=' + price, bidResponse, 'POST', 'JSON')
}

/* *
 * 夺宝奇兵会员出价反馈
 */

function bidResponse(result)
{
  if (result.error == 0)
  {
    document.getElementById('ECS_SNATCH').innerHTML = result.content;
    if (document.forms['formBid'])
    {
      document.forms['formBid'].elements['price'].focus();
    }
    newPrice(); //刷新价格列表
  }
  else
  {
    alert(result.content);
  }
}

/* *
 * 夺宝奇兵最新出价
 */

function newPrice(id)
{
  Ajax.call('snatch.php?act=new_price_list&id=' + id, '', newPriceResponse, 'GET', 'TEXT');
}

/* *
 * 夺宝奇兵最新出价反馈
 */

function newPriceResponse(result)
{
  document.getElementById('ECS_PRICE_LIST').innerHTML = result;
}

/* *
 *  返回属性列表
 */
function getAttr(cat_id)
{
  var tbodies = document.getElementsByTagName('tbody');
  for (i = 0; i < tbodies.length; i ++ )
  {
    if (tbodies[i].id.substr(0, 10) == 'goods_type')tbodies[i].style.display = 'none';
  }

  var type_body = 'goods_type_' + cat_id;
  try
  {
    document.getElementById(type_body).style.display = '';
  }
  catch (e)
  {
  }
}

/* *
 * 截取小数位数
 */
function advFormatNumber(value, num) // 四舍五入
{
  var a_str = formatNumber(value, num);
  var a_int = parseFloat(a_str);
  if (value.toString().length > a_str.length)
  {
    var b_str = value.toString().substring(a_str.length, a_str.length + 1);
    var b_int = parseFloat(b_str);
    if (b_int < 5)
    {
      return a_str;
    }
    else
    {
      var bonus_str, bonus_int;
      if (num == 0)
      {
        bonus_int = 1;
      }
      else
      {
        bonus_str = "0."
        for (var i = 1; i < num; i ++ )
        bonus_str += "0";
        bonus_str += "1";
        bonus_int = parseFloat(bonus_str);
      }
      a_str = formatNumber(a_int + bonus_int, num)
    }
  }
  return a_str;
}

function formatNumber(value, num) // 直接去尾
{
  var a, b, c, i;
  a = value.toString();
  b = a.indexOf('.');
  c = a.length;
  if (num == 0)
  {
    if (b != - 1)
    {
      a = a.substring(0, b);
    }
  }
  else
  {
    if (b == - 1)
    {
      a = a + ".";
      for (i = 1; i <= num; i ++ )
      {
        a = a + "0";
      }
    }
    else
    {
      a = a.substring(0, b + num + 1);
      for (i = c; i <= b + num; i ++ )
      {
        a = a + "0";
      }
    }
  }
  return a;
}

/* *
 * 根据当前shiping_id设置当前配送的的保价费用，如果保价费用为0，则隐藏保价费用
 *
 * return       void
 */
function set_insure_status()
{
  // 取得保价费用，取不到默认为0
  var shippingId = getRadioValue('shipping');
  var insure_fee = 0;
  if (shippingId > 0)
  {
    if (document.forms['theForm'].elements['insure_' + shippingId])
    {
      insure_fee = document.forms['theForm'].elements['insure_' + shippingId].value;
    }
    // 每次取消保价选择
    if (document.forms['theForm'].elements['need_insure'])
    {
      document.forms['theForm'].elements['need_insure'].checked = false;
    }

    // 设置配送保价，为0隐藏
    if (document.getElementById("ecs_insure_cell"))
    {
      if (insure_fee > 0)
      {
        document.getElementById("ecs_insure_cell").style.display = '';
        setValue(document.getElementById("ecs_insure_fee_cell"), getFormatedPrice(insure_fee));
      }
      else
      {
        document.getElementById("ecs_insure_cell").style.display = "none";
        setValue(document.getElementById("ecs_insure_fee_cell"), '');
      }
    }
  }
}

/* *
 * 当支付方式改变时出发该事件
 * @param       pay_id      支付方式的id
 * return       void
 */
function changePayment(pay_id)
{
  // 计算订单费用
  calculateOrderFee();
}

function getCoordinate(obj)
{
  var pos =
  {
    "x" : 0, "y" : 0
  }

  pos.x = document.body.offsetLeft;
  pos.y = document.body.offsetTop;

  do
  {
    pos.x += obj.offsetLeft;
    pos.y += obj.offsetTop;

    obj = obj.offsetParent;
  }
  while (obj.tagName.toUpperCase() != 'BODY')

  return pos;
}

function showCatalog(obj)
{
  var pos = getCoordinate(obj);
  var div = document.getElementById('ECS_CATALOG');

  if (div && div.style.display != 'block')
  {
    div.style.display = 'block';
    div.style.left = pos.x + "px";
    div.style.top = (pos.y + obj.offsetHeight - 1) + "px";
  }
}

function hideCatalog(obj)
{
  var div = document.getElementById('ECS_CATALOG');

  if (div && div.style.display != 'none') div.style.display = "none";
}

function sendHashMail()
{
  Ajax.call('user.php?act=send_hash_mail', '', sendHashMailResponse, 'GET', 'JSON')
}

function sendHashMailResponse(result)
{
  alert(result.message);
}

/* 订单查询 */
function orderQuery()
{
  var order_sn = document.forms['ecsOrderQuery']['order_sn'].value;

  var reg = /^[\.0-9]+/;
  if (order_sn.length < 10 || ! reg.test(order_sn))
  {
    alert(invalid_order_sn);
    return;
  }
  Ajax.call('user.php?act=order_query&order_sn=s' + order_sn, '', orderQueryResponse, 'GET', 'JSON');
}

function orderQueryResponse(result)
{
  if (result.message.length > 0)
  {
    alert(result.message);
  }
  if (result.error == 0)
  {
    var div = document.getElementById('ECS_ORDER_QUERY');
    div.innerHTML = result.content;
  }
}

function display_mode(str)
{
    document.getElementById('display').value = str;
	setTimeout(doSubmit, 0);
	function doSubmit() {document.forms['listform'].submit();}
}


/* 修复IE6以下版本PNG图片Alpha */
function fixpng()
{
  var arVersion = navigator.appVersion.split("MSIE")
  var version = parseFloat(arVersion[1])

  if ((version >= 5.5) && (document.body.filters))
  {
     for(var i=0; i<document.images.length; i++)
     {
        var img = document.images[i]
        var imgName = img.src.toUpperCase()
        if (imgName.substring(imgName.length-3, imgName.length) == "PNG")
        {
           var imgID = (img.id) ? "id='" + img.id + "' " : ""
           var imgClass = (img.className) ? "class='" + img.className + "' " : ""
           var imgTitle = (img.title) ? "title='" + img.title + "' " : "title='" + img.alt + "' "
           var imgStyle = "display:inline-block;" + img.style.cssText
           if (img.align == "left") imgStyle = "float:left;" + imgStyle
           if (img.align == "right") imgStyle = "float:right;" + imgStyle
           if (img.parentElement.href) imgStyle = "cursor:hand;" + imgStyle
           var strNewHTML = "<span " + imgID + imgClass + imgTitle
           + " style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";"
           + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
           + "(src=\'" + img.src + "\', sizingMethod='scale');\"></span>"
           img.outerHTML = strNewHTML
           i = i-1
        }
     }
  }
}