/*alitab
author:alicn-wd-ym
*/
var slideTabIndex=1;
var sTabList = document.getElementById("slideBox").getElementsByTagName("li");
for(var i=0;i<sTabList.length;i++){
var obj = sTabList[i].getElementsByTagName("a")[0];
sTabList[i].getElementsByTagName("a")[0].id="slideBtn_"+(i+1);
if (obj.addEventListener) {
obj.addEventListener( "mouseover", overSlide, false );
}
else if (obj.attachEvent) {
obj.attachEvent( "onmouseover", overSlide );
}
}
function overSlide(e){
e = window.event || e;
var srcElement = e.srcElement || e.target;
var newTabIndex=srcElement.id.replace("slideBtn_","");
var pos = srcElement.parentNode.className;
if(newTabIndex==""||pos.indexOf("_h")!=-1)return;
document.getElementById("slideBtn_"+slideTabIndex).parentNode.className=document.getElementById("slideBtn_"+slideTabIndex).parentNode.className.replace("_h","");
document.getElementById("sc_"+slideTabIndex).className="hide";
document.getElementById("sc_"+newTabIndex).className="cont_"+pos;
srcElement.parentNode.className = pos+"_h";
slideTabIndex=newTabIndex;
}
