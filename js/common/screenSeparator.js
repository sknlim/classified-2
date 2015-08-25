// JavaScript Document
/*
"coordinates.js" REQUIRED
"../../common/preLoadWidgets.php" REQUIRED
*/
function isIE()
	{
		if(window.navigator.appName=="Microsoft Internet Explorer") return true;
		else return false;
	}
function showScreenSeparator()
	{
		if(isShowingScreenSeparator())
			{
				separatorDiv=document.getElementById('screenSeparator');
				separatorDiv.style.zIndex=document.getNextHighestZIndex();
				if(isIE())
					{
					separatorDivIFrame=document.getElementById('screenSeparatorIFrame');
					separatorDivIFrame.style.zIndex=document.getNextHighestZIndex();
					}
				return;
			}
		separatorDiv=document.createElement("DIV");
		separatorDiv.id="screenSeparator";
		separatorDiv.style.background="#000";
		separatorDiv.style.zIndex=document.getNextHighestZIndex();
		document.body.appendChild(separatorDiv);
		maxWidthHeight("screenSeparator");
		if(isIE())
			{
			separatorDivIFrame=document.createElement("IFRAME");
			separatorDivIFrame.id="screenSeparatorIFrame";
			separatorDivIFrame.style.background="#000";
			separatorDivIFrame.style.border="none";
			separatorDivIFrame.style.zIndex=document.getNextHighestZIndex();
			document.body.appendChild(separatorDivIFrame);
			maxWidthHeight("screenSeparatorIFrame");
			changeOpac(0, "screenSeparatorIFrame");
			};
	}
function maxWidthHeight(id) {
	obj=document.getElementById(id);
	obj.style.position="absolute";
	obj.style.left="0";
	obj.style.top="0";
	obj.style.width="100%";
	obj.style.height=getPageSize()[1]+"px";
	changeOpac(65, id);
}
function isShowingScreenSeparator()
	{
		if(document.getElementById("screenSeparator")) return true;
		else return false;
	}
function hideScreenSeparator()
	{
		ZIndexPage=parseInt(document.getElementById('floatingPage').style.zIndex);
		ZIndexScreenSeparator=parseInt(document.getElementById("screenSeparator").style.zIndex);
		if((ZIndexPage<ZIndexScreenSeparator) && document.getElementById('floatingPage').style.display=="block")
			{
				document.getElementById('floatingPage').style.zIndex=document.getNextHighestZIndex();
				return;
			}
		if(isShowingScreenSeparator())
			{
			removeObj("screenSeparator");
			if(isIE())
				{
				removeObj("screenSeparatorIFrame");
				}
			}
	}
	
// alertBox	(can be removed, if not required)
function alertBox(alertMessage)
	{
		var alertBox=document.getElementById("alertBox");
		showScreenSeparator();

		alertBox.style.zIndex=document.getNextHighestZIndex();
		changeOpac(0,"alertBox");
		showDiv("alertBox");
		centerPage("alertBox");
		var alertBoxContent=document.getElementById('alertBoxContent');
		var alertBoxOkButton=document.getElementById('alertBoxOkButton');
		var alertBoxClose=document.getElementById('alertBoxClose');
		alertBoxContent.innerHTML=alertMessage;
		alertBoxOkButton.onclick=alertBoxClose.onclick=function()
			{
				hideDiv("alertBox");
				hideScreenSeparator();
			}
		hideDiv("alertBox");
		toggleFade("alertBox");
	}

// messageBox	(can be removed, if not required)
function messageBox(alertMessage, functionVar)
	{
		if(functionVar==null) functionVar=function() { };
		var messageBox=document.getElementById("messageBox");
		showScreenSeparator();

		messageBox.style.zIndex=document.getNextHighestZIndex();
		changeOpac(0,"messageBox");
		showDiv("messageBox");
		centerPage("messageBox");
		var messageBoxContent=document.getElementById('messageBoxContent');
		var messageBoxOkButton=document.getElementById('messageBoxOkButton');
		var messageBoxClose=document.getElementById('messageBoxClose');
		messageBoxContent.innerHTML=alertMessage;
		messageBoxOkButton.onclick=messageBoxClose.onclick=function()
			{
				functionVar();
				hideDiv("messageBox");
				hideScreenSeparator();
			}
		hideDiv("messageBox");
		toggleFade("messageBox");
	}

function confirmBox(alertMessage, onOkEvent, onCancelEvent)
	{
		var confirmBox=document.getElementById("confirmBox");
		showScreenSeparator();
		
		confirmBox.style.zIndex=document.getNextHighestZIndex();		
		changeOpac(0,"confirmBox");
		showDiv("confirmBox");
		centerPage("confirmBox");
		var confirmBoxContent=document.getElementById('confirmBoxContent');
		var confirmBoxOkButton=document.getElementById('confirmBoxOkButton');
		var confirmBoxCancelButton=document.getElementById('confirmBoxCancelButton');
		var confirmBoxClose=document.getElementById('confirmBoxClose');
		confirmBoxContent.innerHTML=alertMessage;
		confirmBoxOkButton.onclick=function()
			{
				hideDiv("confirmBox");
				hideScreenSeparator();
				onOkEvent();
			}
		confirmBoxCancelButton.onclick=function()
			{
				hideDiv("confirmBox");
				hideScreenSeparator();
				onCancelEvent();
			}
		confirmBoxClose.onclick=function()
			{
				hideDiv("confirmBox");
				hideScreenSeparator();				
			}
		hideDiv("confirmBox");
		toggleFade("confirmBox");
	}



	
// loadPage (can be removed, if not required)
function loadPage(url,lable_text,send_var)
{
	if(lable_text==null || lable_text=='')
		lable_text = "Loading...";
	if(send_var==null)
		send_var = "";

//hideDiv('floatingPage');
showScreenSeparator();
showLoading(lable_text);
var request=null;
request=createRequest();
request.open("POST",url,true);
request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
request.setRequestHeader("Content-length", send_var.length);
request.setRequestHeader("Connection", "close");
request.onreadystatechange=function()
									{
							//		alert(request.readyState);
									if(request.readyState==4)
										{
									//	alert(request.responseText);
										var strVal=request.responseText;
										if(strVal.substr(0,5)=="link:")
											{
											showLoading("Redirecting...");
											window.location=strVal.substr(5);
											return;
											}
										else if(strVal.substr(0,7)=="script:")
											{
											hideLoading();
											hideScreenSeparator();
											eval(strVal.substr(7));
											return;
											}
										else
											{
											document.getElementById("floatingContent").innerHTML=strVal;
											document.getElementById("floatingPage").style.zIndex=document.getNextHighestZIndex();
											showDiv('floatingPage');
											centerPage('floatingPage');
											hideLoading();
											if(!isShowingScreenSeparator()) showScreenSeparator();
											}
										}
									};
request.send(send_var);
}
function closePage()
	{
	hideDiv('floatingPage');	
	hideLoading();
	hideScreenSeparator();
	}
function showLoading(caption)
	{
		document.getElementById("floatingLoaderContent").innerHTML=caption;
		document.getElementById("floatingLoader").style.zIndex=document.getNextHighestZIndex();
		showDiv("floatingLoader");
		centerPage("floatingLoader");
	}
function hideLoading()
	{
		hideDiv("floatingLoader");
	}

