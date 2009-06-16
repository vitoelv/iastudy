<script language=JavaScript src=http://float2006.tq.cn/floatcard?adminid=8695345&sort=0></script>

<script type="text/javascript">

fileLoadingImage = "themes/21sj/" + fileLoadingImage;
fileBottomNavCloseImage = "themes/21sj/" + fileBottomNavCloseImage;
onload = function()
{
  initLightbox();
}

function  insert(frm)
{
  var insert = new Object;
	insert.user_name = Utils.trim(frm.elements['user_name'].value);
	insert.email = Utils.trim(frm.elements['email'].value);
	insert.telephone = Utils.trim(frm.elements['telephone'].value);
	insert.cat_id = Utils.trim(frm.elements['cat_id'].value);
	insert.value = Utils.trim(frm.elements['brand_name'].value);
	insert.value_id = frm.elements['brand_id'].value;
	insert.type = frm.elements['type'].value;
	brand_id = frm.elements['brand_id'].value;

	var msg = '';

    if (insert.user_name == '请填写真实姓名')
    {
      msg += '- 请填写真实的姓名。\n';
    }
    if (insert.telephone == '请填写真实电话号码')
    {
      msg += '- 请填写真实的电话号码。\n';
    }

	if (insert.user_name.length == 0)
	{
	  msg += '- 请填写您的名称。\n';
	}
	if (insert.email.length == 0)
	{
	  msg += '- 请填写您的邮件地址。\n';
	}

    if (!Utils.isEmail(insert.email))
    {
      msg += '- 邮件地址不符要求。\n';
    }

	if (msg.length > 0)
	{
	  alert(msg);
		return;
	}

	var Response = function (result)
	{
	  alert(result);
		frm.elements['user_name'].value = '';
		frm.elements['email'].value = '';
		frm.elements['telephone'].value = '';
	}
	Ajax.call('brand.php?act=insert&brand=' + brand_id, 'insert=' + insert.toJSONString(), Response, 'POST', 'TEXT');
	return;
}

function clear_input(obj)
{
  var name = obj.name;
  name = true;
  if (name)
  {
    obj.value = '';
		obj.style.color = '#000';
	  name = false;
  }
}

var process_request = "正在处理您的请求...";
</script>


<script type="text/javascript" src="http://sfhelp.baidu.com/msg/js/34/1339034.js" charset="gb2312"></script>


