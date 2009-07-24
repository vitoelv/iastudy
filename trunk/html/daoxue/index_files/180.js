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
}var ZoneAD_12=new CodeZoneAD("ZoneAD_12");var objAD = new ObjectAD();
objAD.ADID= 27;objAD.ADType= 4;objAD.ADName= "当当网上书店推广";objAD.ImgUrl= "";objAD.ImgWidth       = 0;objAD.ImgHeight      = 0;objAD.FlashWmode     = 0;objAD.ADIntro ="<a href=\"http://count.chanet.com.cn/click.cgi?a=54845&d=71826&u=&e=\" target=\"_blank\"><IMG SRC=\"http://file.chanet.com.cn/image.cgi?a=54845&d=71826&u=&e=\" width=\"234\" height=\"60\"  border=\"0\"></a>";objAD.LinkUrl        = "";objAD.LinkTarget     = 0;objAD.LinkAlt        = "";objAD.Priority       = 1;objAD.CountView      = false;objAD.CountClick     = false;objAD.OverdueDate    = "2010/05/10";objAD.InstallDir     = "/";objAD.ADDIR= "IAA";ZoneAD_12.AddAD(objAD);var objAD = new ObjectAD();
objAD.ADID= 11;objAD.ADType= 4;objAD.ADName= "Sephora丝芙兰 CPS 推广";objAD.ImgUrl= "";objAD.ImgWidth       = 0;objAD.ImgHeight      = 0;objAD.FlashWmode     = 0;objAD.ADIntro ="<a href=\"http://count.chanet.com.cn/click.cgi?a=54845&d=37427&u=&e=\" target=\"_blank\"><IMG SRC=\"http://file.chanet.com.cn/image.cgi?a=54845&d=37427&u=&e=\" width=\"180\" height=\"60\"  border=\"0\"></a>";objAD.LinkUrl        = "";objAD.LinkTarget     = 0;objAD.LinkAlt        = "";objAD.Priority       = 1;objAD.CountView      = false;objAD.CountClick     = false;objAD.OverdueDate    = "2010/03/25";objAD.InstallDir     = "/";objAD.ADDIR= "IAA";ZoneAD_12.AddAD(objAD);ZoneAD_12.ZoneID=12;ZoneAD_12.ZoneWidth=468;ZoneAD_12.ZoneHeight=60;ZoneAD_12.ShowType=1;ZoneAD_12.Show();