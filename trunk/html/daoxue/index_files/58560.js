function ObjectAD() {
  /* Define  Variables*/
  this.ADID        = 0;
  this.ADType      = 0;
  this.ADName      = "";
  this.ImgUrl      = "";
  this.ImgWidth    = 0;
  this.ImgHeight   = 0;
  this.FlashWmode  = 0;
  this.LinkUrl     = "";
  this.LinkTarget  = 0;
  this.LinkAlt     = "";
  this.Priority    = 0;
  this.CountView   = 0;
  this.CountClick  = 0;
  this.InstallDir  = "";
  this.ADDIR       = "";
  this.OverdueDate = "";
}

function CodeZoneAD(_id) {
  /* Define Common Variables*/
  this.ID          = _id;
  this.ZoneID      = 0;

  /* Define Unique Variables*/

  /* Define Objects */
  this.AllAD       = new Array();
  this.ShowAD      = null;

  /* Define Functions */
  this.AddAD       = CodeZoneAD_AddAD;
  this.GetShowAD   = CodeZoneAD_GetShowAD;
  this.Show        = CodeZoneAD_Show;

}

function CodeZoneAD_AddAD(_AD) {
  var date = new Date();
  var getdate = date.getFullYear() + "/" + (date.getMonth() + 1) + "/" + date.getDate();
  var today = new Date(getdate);
  var overdueDate = new Date(_AD.OverdueDate);
  if(today <= overdueDate)
  {
    this.AllAD[this.AllAD.length] = _AD;
  }
}

function CodeZoneAD_GetShowAD() {
  if (this.ShowType > 1) {
    this.ShowAD = this.AllAD[0];
    return;
  }
  var num = this.AllAD.length;
  var sum = 0;
  for (var i = 0; i < num; i++) {
    sum = sum + this.AllAD[i].Priority;
  }
  if (sum <= 0) {return ;}
  var rndNum = Math.random() * sum;
  i = 0;
  j = 0;
  while (true) {
    j = j + this.AllAD[i].Priority;
    if (j >= rndNum) {break;}
    i++;
  }
  this.ShowAD = this.AllAD[i];
}

function CodeZoneAD_Show() {
  if (!this.AllAD) {
    return;
  } else {
    this.GetShowAD();
  }

  if (this.ShowAD == null) return false;
  document.write(this.ShowAD.ADIntro);
}var ZoneAD_13=new CodeZoneAD("ZoneAD_13");var objAD = new ObjectAD();
objAD.ADID= 23;objAD.ADType= 4;objAD.ADName= "淘寶網搜索表單";objAD.ImgUrl= "";objAD.ImgWidth       = 0;objAD.ImgHeight      = 0;objAD.FlashWmode     = 0;objAD.ADIntro ="<script type=\'text/javascript\'>\r\nalimama_pid=\'mm_12577083_0_0\';\r\nalimama_type=\'g\';\r\nalimama_tks={};\r\nalimama_tks.style_i=1;\r\nalimama_tks.lg_i=1;\r\nalimama_tks.w_i=572;\r\nalimama_tks.h_i=69;\r\nalimama_tks.btn_i=1;\r\nalimama_tks.txt_s=\'\';\r\nalimama_tks.hot_i=1;\r\nalimama_tks.hc_c=\'#999999\';\r\nalimama_tks.c_i=1;\r\nalimama_tks.cid_i=0;\r\nchanet_tks = {};\r\nchanet_tks.a = \'54845\';// \r\nchanet_tks.d = \'73650\';// fixed\r\nchanet_tks.e = \'\';// must be number\r\nchanet_tks.u = \'\';// must be number or letters\r\nalimama_tks.unid_s = \'a\'+chanet_tks.a+\'d\'+chanet_tks.d+\'e\'+chanet_tks.e+\'u\'+chanet_tks.u;\r\nalimama_tks.unid_s  = alimama_tks.unid_s.substring(0, 32);\r\n</script>\r\n<script type=\'text/javascript\' src=\'http://a.alimama.cn/inf.js\'></script>";objAD.LinkUrl        = "";objAD.LinkTarget     = 0;objAD.LinkAlt        = "";objAD.Priority       = 1;objAD.CountView      = false;objAD.CountClick     = false;objAD.OverdueDate    = "2010/05/10";objAD.InstallDir     = "/";objAD.ADDIR= "IAA";ZoneAD_13.AddAD(objAD);var objAD = new ObjectAD();
objAD.ADID= 16;objAD.ADType= 4;objAD.ADName= "携程旅行网CPS成果";objAD.ImgUrl= "";objAD.ImgWidth       = 0;objAD.ImgHeight      = 0;objAD.FlashWmode     = 0;objAD.ADIntro ="<a href=\"http://count.chanet.com.cn/click.cgi?a=54845&d=55581&u=&e=&url=http://www.ctrip.com/smartlink/smartlink.asp?c=adway188\" target=\"_blank\"><IMG SRC=\"http://file.chanet.com.cn/image.cgi?a=54845&d=55581&u=&e=\" width=\"468\" height=\"60\"  border=\"0\"></a>";objAD.LinkUrl        = "";objAD.LinkTarget     = 0;objAD.LinkAlt        = "";objAD.Priority       = 1;objAD.CountView      = false;objAD.CountClick     = false;objAD.OverdueDate    = "2009/09/10";objAD.InstallDir     = "/";objAD.ADDIR= "IAA";ZoneAD_13.AddAD(objAD);var objAD = new ObjectAD();
objAD.ADID= 13;objAD.ADType= 4;objAD.ADName= "淘宝客-主题推广";objAD.ImgUrl= "";objAD.ImgWidth       = 0;objAD.ImgHeight      = 0;objAD.FlashWmode     = 0;objAD.ADIntro ="<a href=\"http://count.chanet.com.cn/click.cgi?a=54845&d=73651&u=&e=&url=http://cam.taoke.alimama.com/event.php?pid=12577083&eventid=100247&unid=[SID]\" target=\"_blank\"><img src=\'http://img.alimama.cn/topicfile/2009-02-26/10024709492611493928.jpg\'></a>";objAD.LinkUrl        = "";objAD.LinkTarget     = 0;objAD.LinkAlt        = "";objAD.Priority       = 1;objAD.CountView      = false;objAD.CountClick     = false;objAD.OverdueDate    = "2010/05/08";objAD.InstallDir     = "/";objAD.ADDIR= "IAA";ZoneAD_13.AddAD(objAD);ZoneAD_13.ZoneID=13;ZoneAD_13.ZoneWidth=468;ZoneAD_13.ZoneHeight=60;ZoneAD_13.ShowType=1;ZoneAD_13.Show();