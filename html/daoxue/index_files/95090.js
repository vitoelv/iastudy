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
}var ZoneAD_15=new CodeZoneAD("ZoneAD_15");var objAD = new ObjectAD();
objAD.ADID= 24;objAD.ADType= 4;objAD.ADName= "淘寶網-初夏美包大攻略";objAD.ImgUrl= "";objAD.ImgWidth       = 0;objAD.ImgHeight      = 0;objAD.FlashWmode     = 0;objAD.ADIntro ="<a href=\"http://count.chanet.com.cn/click.cgi?a=54845&d=73651&u=&e=&url=http://cam.taoke.alimama.com/event.php?pid=12577083&eventid=100292&unid=[SID]\" target=\"_blank\"><img src=\'http://img.alimama.cn/topicfile/2009-04-08/10029209210803210534.gif\'></a>";objAD.LinkUrl        = "";objAD.LinkTarget     = 0;objAD.LinkAlt        = "";objAD.Priority       = 1;objAD.CountView      = false;objAD.CountClick     = false;objAD.OverdueDate    = "2010/05/10";objAD.InstallDir     = "/";objAD.ADDIR= "IAA";ZoneAD_15.AddAD(objAD);var objAD = new ObjectAD();
objAD.ADID= 21;objAD.ADType= 4;objAD.ADName= "澳西奴980*85";objAD.ImgUrl= "";objAD.ImgWidth       = 0;objAD.ImgHeight      = 0;objAD.FlashWmode     = 0;objAD.ADIntro ="<a href=\"http://count.chanet.com.cn/click.cgi?a=54845&d=72619&u=&e=\" target=\"_blank\"><IMG SRC=\"http://file.chanet.com.cn/image.cgi?a=54845&d=72619&u=&e=\" width=\"950\" height=\"82\"  border=\"0\"></a>";objAD.LinkUrl        = "";objAD.LinkTarget     = 0;objAD.LinkAlt        = "";objAD.Priority       = 1;objAD.CountView      = false;objAD.CountClick     = false;objAD.OverdueDate    = "2010/03/10";objAD.InstallDir     = "/";objAD.ADDIR= "IAA";ZoneAD_15.AddAD(objAD);var objAD = new ObjectAD();
objAD.ADID= 15;objAD.ADType= 4;objAD.ADName= "淘宝客-主题推广-春季";objAD.ImgUrl= "";objAD.ImgWidth       = 0;objAD.ImgHeight      = 0;objAD.FlashWmode     = 0;objAD.ADIntro ="<a href=\"http://count.chanet.com.cn/click.cgi?a=38418&d=73651&u=&e=&url=http://cam.taoke.alimama.com/event.php?pid=12577083&eventid=100287&unid=[SID]\" target=\"_blank\"><img src=\'http://img.alimama.cn/topicfile/2009-04-03/12387282901804.jpg\'></a>";objAD.LinkUrl        = "";objAD.LinkTarget     = 0;objAD.LinkAlt        = "";objAD.Priority       = 1;objAD.CountView      = false;objAD.CountClick     = false;objAD.OverdueDate    = "2010/05/08";objAD.InstallDir     = "/";objAD.ADDIR= "IAA";ZoneAD_15.AddAD(objAD);var objAD = new ObjectAD();
objAD.ADID= 14;objAD.ADType= 4;objAD.ADName= "淘宝客-主题推广";objAD.ImgUrl= "";objAD.ImgWidth       = 0;objAD.ImgHeight      = 0;objAD.FlashWmode     = 0;objAD.ADIntro ="<a href=\"http://count.chanet.com.cn/click.cgi?a=54845&d=73651&u=&e=&url=http://cam.taoke.alimama.com/event.php?pid=12577083&eventid=100290&unid=[SID]\" target=\"_blank\"><img src=\'http://img.alimama.cn/topicfile/2009-04-07/10029009060705063330.jpg\'></a>";objAD.LinkUrl        = "";objAD.LinkTarget     = 0;objAD.LinkAlt        = "";objAD.Priority       = 1;objAD.CountView      = false;objAD.CountClick     = false;objAD.OverdueDate    = "2010/05/08";objAD.InstallDir     = "/";objAD.ADDIR= "IAA";ZoneAD_15.AddAD(objAD);ZoneAD_15.ZoneID=15;ZoneAD_15.ZoneWidth=468;ZoneAD_15.ZoneHeight=60;ZoneAD_15.ShowType=1;ZoneAD_15.Show();