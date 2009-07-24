 var OptionID = 0;
 var OptionsNum = 4;
 var ScrollNum = 1;
 var ScrollTime;
 var arrLink;
 
 arrLink = new Array(4);
 
 arrLink[0] = "172/270/";
 arrLink[1] = "50/107/";
 arrLink[2] = "171/175/";
 arrLink[3]	= "63/373/";
 arrLink[4]	= "50/80/";

 function ScrollType()
 {
 	ScrollNum += 1;
 	if (ScrollNum == OptionsNum + 2)
 	{
 		ScrollNum = 1;	
 	}
 	ChangeType(ScrollNum - 1);
	//alert(ScrollNum);
 	ScrollTime = setTimeout("ScrollType()",3000)
 }
 
 function ScrollStop()
{
	clearTimeout(ScrollTime);
}

 function ChangeType(divID)
 {
	 //return ;
 	if(divID != OptionID)
 	{
	 	//document.getElementById("co_" + divID).style.display = "";
	 	document.getElementById("cn_" + divID).className = "zib1_active";
	 	document.getElementById("ct_" + divID).style.background = "url(index-image/tab2-image/i-on.gif)";
		document.getElementById("ct_" + divID).style.color = "#D50000";
	 	document.getElementById("ct_" + divID).className = "ct";
	 	document.getElementById("cl_" + divID).style.display = "";
	 	//document.getElementById("cu_" + divID).style.display = "";
	 	//document.getElementById("cLink").href = "http://class.studyget.com/" + arrLink[divID] + "c_1.shtml";
	 	
	 	//document.getElementById("co_" + OptionID).style.display = "none";
	 	document.getElementById("cn_" + OptionID).className = "zib1";
	 	document.getElementById("ct_" + OptionID).style.background = "url(index-image/tab2-image/i-out1.gif)";
		
		document.getElementById("ct_" + OptionID).className = "";
		document.getElementById("ct_" + divID).style.color = "#000000";
	 	document.getElementById("ct_" + OptionID).style.bgColor = "";
	 	document.getElementById("cl_" + OptionID).style.display = "none";
	 	//document.getElementById("cu_" + OptionID).style.display = "none";
		
	 }
	 
 	OptionID = divID;
	if (divID > 0){
		document.getElementById("ct_0").style.background = "url(ImagesN/i-out4.gif)";
	}
	if (divID == 1){
		document.getElementById("ct_0").style.background = "url(ImagesN/i-out3.gif)";
	}
	switch(divID){
			case 0:
			document.getElementById("ct_" + (0)).style.background = "url(index-image/tab2-image/i-on.gif)";
			document.getElementById("ct_" + (1)).style.background = "url(index-image/tab2-image/i-out.gif)";
			document.getElementById("ct_" + (2)).style.background = "url(index-image/tab2-image/i-out.gif)";
			document.getElementById("ct_" + (3)).style.background = "url(index-image/tab2-image/i-out.gif)";
			document.getElementById("ct_" + (4)).style.background = "url(index-image/tab2-image/i-out1.gif)";
			break;
			case 1:
			document.getElementById("ct_" + (0)).style.background = "url(index-image/tab2-image/i-out3.gif)";
			document.getElementById("ct_" + (1)).style.background = "url(index-image/tab2-image/i-on.gif)";
			document.getElementById("ct_" + (2)).style.background = "url(index-image/tab2-image/i-out.gif)";
			document.getElementById("ct_" + (3)).style.background = "url(index-image/tab2-image/i-out.gif)";
			document.getElementById("ct_" + (4)).style.background = "url(index-image/tab2-image/i-out1.gif)";
			break;
			case 2:	
			document.getElementById("ct_" + (0)).style.background = "url(index-image/tab2-image/i-out5.gif)";
			document.getElementById("ct_" + (1)).style.background = "url(index-image/tab2-image/i-out1.gif)";
			document.getElementById("ct_" + (2)).style.background = "url(index-image/tab2-image/i-on.gif)";
			document.getElementById("ct_" + (3)).style.background = "url(index-image/tab2-image/i-out.gif)";
			document.getElementById("ct_" + (4)).style.background = "url(index-image/tab2-image/i-out1.gif)";
			break;
			case 3:
		    document.getElementById("ct_" + (0)).style.background = "url(index-image/tab2-image/i-out5.gif)";
			document.getElementById("ct_" + (1)).style.background = "url(index-image/tab2-image/i-out6.gif)";
			document.getElementById("ct_" + (2)).style.background = "url(index-image/tab2-image/i-out1.gif)";
			document.getElementById("ct_" + (3)).style.background = "url(index-image/tab2-image/i-on.gif)";
			document.getElementById("ct_" + (4)).style.background = "url(index-image/tab2-image/i-out1.gif)";
			break;
			case 4:
		    document.getElementById("ct_" + (0)).style.background = "url(index-image/tab2-image/i-out5.gif)";
			document.getElementById("ct_" + (1)).style.background = "url(index-image/tab2-image/i-out6.gif)";
			document.getElementById("ct_" + (2)).style.background = "url(index-image/tab2-image/i-out6.gif)";
			document.getElementById("ct_" + (3)).style.background = "url(index-image/tab2-image/i-out1.gif)";
			document.getElementById("ct_" + (4)).style.background = "url(index-image/tab2-image/i-on.gif)";
			
			break;
	}
	
	if (divID != 4){
		document.getElementById("ct_4").style.background = "url(index-image/tab2-image/i-out2.gif)";
	}

 }