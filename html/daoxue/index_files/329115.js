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
}var ZoneAD_14=new CodeZoneAD("ZoneAD_14");var objAD = new ObjectAD();
objAD.ADID= 20;objAD.ADType= 4;objAD.ADName= "g300100";objAD.ImgUrl= "";objAD.ImgWidth       = 0;objAD.ImgHeight      = 0;objAD.FlashWmode     = 0;objAD.ADIntro ="<a href=\"http://count.chanet.com.cn/click.cgi?a=54845&d=71610&u=&e=\" target=\"_blank\"><IMG SRC=\"http://file.chanet.com.cn/image.cgi?a=54845&d=71610&u=&e=\" width=\"329\" height=\"115\"  border=\"0\"></a>";objAD.LinkUrl        = "";objAD.LinkTarget     = 0;objAD.LinkAlt        = "";objAD.Priority       = 1;objAD.CountView      = false;objAD.CountClick     = false;objAD.OverdueDate    = "2010/03/10";objAD.InstallDir     = "/";objAD.ADDIR= "IAA";ZoneAD_14.AddAD(objAD);var objAD = new ObjectAD();
objAD.ADID= 17;objAD.ADType= 4;objAD.ADName= "DHC CPS推广";objAD.ImgUrl= "";objAD.ImgWidth       = 0;objAD.ImgHeight      = 0;objAD.FlashWmode     = 0;objAD.ADIntro ="<a href=\"http://count.chanet.com.cn/click.cgi?a=54845&d=22001&u=&e=\" target=\"_blank\"><IMG SRC=\"http://file.chanet.com.cn/image.cgi?a=54845&d=22001&u=&e=\" width=\"329\" height=\"115\"  border=\"0\"></a>";objAD.LinkUrl        = "";objAD.LinkTarget     = 0;objAD.LinkAlt        = "";objAD.Priority       = 1;objAD.CountView      = false;objAD.CountClick     = false;objAD.OverdueDate    = "2009/12/10";objAD.InstallDir     = "/";objAD.ADDIR= "IAA";ZoneAD_14.AddAD(objAD);var objAD = new ObjectAD();
objAD.ADID= 12;objAD.ADType= 4;objAD.ADName= "淘宝客-主题推广";objAD.ImgUrl= "";objAD.ImgWidth       = 0;objAD.ImgHeight      = 0;objAD.FlashWmode     = 0;objAD.ADIntro ="<a href=\"http://count.chanet.com.cn/click.cgi?a=54845&d=73651&u=&e=&url=http://cam.taoke.alimama.com/event.php?pid=12577083&eventid=100284&unid=[SID]\" target=\"_blank\"><img src=\'http://img.alimama.cn/topicfile/2009-04-02/10028409580211583813.jpg\'></a>";objAD.LinkUrl        = "";objAD.LinkTarget     = 0;objAD.LinkAlt        = "";objAD.Priority       = 1;objAD.CountView      = false;objAD.CountClick     = false;objAD.OverdueDate    = "2010/05/08";objAD.InstallDir     = "/";objAD.ADDIR= "IAA";ZoneAD_14.AddAD(objAD);ZoneAD_14.ZoneID=14;ZoneAD_14.ZoneWidth=468;ZoneAD_14.ZoneHeight=60;ZoneAD_14.ShowType=1;ZoneAD_14.Show();