function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
/************************************************************************************/
function Popup_Center(theURL,winName,W,H,targ,selObj,restore) {	// popup เต็มจอ+scrollbars
	//var L=(screen.width)?(screen.width-W)/2:100;
	//var T=(screen.height)?(screen.height-H)/2:100;
	W=screen.width-10;
	H=screen.height-10;
	L=0;
	T=0;
	var features='width='+W+',height='+H+',left='+L+',top='+T+',scrollbars=yes,resizable=yes,dependent=yes,directories=no,location=yes,menubar=no,personalbar=no,titlebar=no,toolbar=no';
	if(selObj.options[selObj.selectedIndex].value !='choose service')	{
	ShowImageWin=window.open(selObj.options[selObj.selectedIndex].value,winName,features);
	ShowImageWin.focus();
	}
}

function Popup_Print(theURL,winName,W,H) {				// popup กลางจอ+scrollbars
	var L=(screen.width)?(screen.width-W)/2:100;
	//var T=(screen.height)?(screen.height-H)/2:100;
	var features='width='+W+',height='+H+',left='+L+',top='+0+',scrollbars=yes,resizable=yes,dependent=yes,directories=yes,location=yes,menubar=yes,personalbar=yes,titlebar=yes,toolbar=yes';
//	ShowImageWin=window.open(theURL,winName,features);
	ShowImageWin=window.open(theURL); 	
	
	ShowImageWin.focus();
}

function Popup_Admin(theURL,winName,W,H) {					// popup กลางจอ+ไม่มี scrollbars
	var L=(screen.width)?(screen.width-W)/2:100;
	var T=(screen.height)?(screen.height-H)/2:100;
	var features='width='+W+',height='+H+',left='+L+',top='+T+',scrollbars=yes,resizable=yes,dependent=yes,directories=no,location=no,menubar=no,personalbar=no,titlebar=no,toolbar=no';
	ShowImageWin=window.open(theURL,winName,features);
	ShowImageWin.focus();
}

function closewin() {																// ปิด window ลูกแล้ว refresh window แม่
	window.opener.location.reload();
	//window.opener.form1.button.value="refresh ready";
	self.close();
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0		//	คลิก drop down แล้ว redirect
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function MM_jumpMenu_Blank(selObj,winName,W,H){ 				//	คลิก drop down แล้วเปิด new window
	var L=(screen.width)?(screen.width-W)/2:100;
	var T=(screen.height)?(screen.height-H)/2:100;
	var features='width='+W+',height='+H+',left='+L+',top='+T+',scrollbars=yes,resizable=yes,dependent=yes,directories=no,location=no,menubar=no,personalbar=no,titlebar=no,toolbar=no';
  	ShowWin=window.open(selObj.options[selObj.selectedIndex].value,  winName,  features  );
  	ShowWin.focus();
}

function setBgImage(element,imageFile) {
  element.style.backgroundImage="url("+imageFile+")";
  element.style.color="#FFFFFF";
}

function setBgImageOver(element,imageFile) {
  element.style.backgroundImage="url("+imageFile+")";
  element.style.color="#FFFFFF";
}

function confirmDel(msg){					// ยืนยันก่อนทำ
	var agree=confirm(msg);
	if (agree)
		return true ;
	else
		return false ;
}

function numonly() {
	  var k = window.event.keyCode;
	  if( k >=37 && k <=40 ) return true;  // arrow left, up, right, down  
	  else if( k >=48 && k <=57 ) return true;  // key 0-9
	  else if( k >=96 && k <=105 ) return true;  // numpad 0-9
	//  else if( k ==110 || k ==190  ) return true;  // dot
	  else if( k ==8 || k ==9) return true;  // backspace, tab
	  else if( k ==45 ||  k ==46 || k ==35 || k ==36) return true;  // insert, del, end, home
	  else if( k ==13) return true;  // Enter
	  else {
	  		alert("กรุณาใส่ข้อมูลเป็นตัวเลขด้วยค่ะ");
	  		return false;
		}
}
function realonly() {
	  var k = window.event.keyCode;
	  if( k >=37 && k <=40 ) return true;  // arrow left, up, right, down  
	  else if( k >=48 && k <=57 ) return true;  // key 0-9
	  else if( k >=96 && k <=105 ) return true;  // numpad 0-9
	  else if( k ==110 || k ==190  ) return true;  // dot
	  else if( k ==8 || k ==9) return true;  // backspace, tab
	  else if( k ==45 ||  k ==46 || k ==35 || k ==36) return true;  // insert, del, end, home
	  else if( k ==13) return true;  // Enter
	  else {
	  		alert("กรุณาใส่ข้อมูลเป็นตัวเลขด้วยค่ะ");
	  		return false;
		}
}
function setPointer(theRow, thePointerColor){
    if (thePointerColor == '' || typeof(theRow.style) == 'undefined') {
        return false;
    }
    if (typeof(document.getElementsByTagName) != 'undefined') {
        var theCells = theRow.getElementsByTagName('td');
    }
    else if (typeof(theRow.cells) != 'undefined') {
        var theCells = theRow.cells;
    }
    else {
        return false;
    }
    var rowCellsCnt  = theCells.length;
    for (var c = 0; c < rowCellsCnt; c++) {
        theCells[c].style.backgroundColor = thePointerColor;
    }
    return true;
} 