// JavaScript Document

function create_request_string(theform)
{
var reqStr = "";

for(i=0; i < theform.elements.length; i++)
{
isformObject = false;

switch (theform.elements[i].tagName)
{
case "INPUT":

switch (theform.elements[i].type)
{
case "text":
case "hidden":
case "password":
reqStr += theform.elements[i].name + "=" + encodeURIComponent(theform.elements[i].value);
isformObject = true;
break;

case "checkbox":
if (theform.elements[i].checked)
{
reqStr += theform.elements[i].name + "=" + theform.elements[i].value;
}else{
reqStr += theform.elements[i].name + "=";
}
isformObject = true;
break;

case "radio":
if (theform.elements[i].checked)
{
reqStr += theform.elements[i].name + "=" + theform.elements[i].value;
isformObject = true;
}
}
break;

case "TEXTAREA":

reqStr += theform.elements[i].name + "=" + encodeURIComponent(theform.elements[i].value);
isformObject = true;
break;

case "SELECT":
var sel = theform.elements[i];
reqStr += sel.name + "=" + sel.options[sel.selectedIndex].value;
isformObject = true;
break;
}

if ((isformObject) && ((i+1)!= theform.elements.length))
{
reqStr += "&";
}

}

return reqStr;
} 



function submitFormInDiv(frm,divId)
	{
	if(frm.method.toUpperCase()=="POST")
		{
		loadAjax(frm.action,divId,create_request_string(frm),"Proccessing..");
		}
	else
		{
		loadAjax(frm.action+"?"+create_request_string(frm),divId,"","Proccessing..");
		}
	}

function submitFormOnFloat(frm)
	{
	if(frm.method.toUpperCase()=="POST")
		{
		loadPage(frm.action,"Proccessing..",create_request_string(frm));
		}
	else
		{
		loadPage(frm.action+"?"+create_request_string(frm),"Proccessing..");
		}
	}


function loadAjax(link1,id,send_var,loading_text)
{
		if(send_var==null)
		send_var = "";

		if(loading_text==null)
		loading_text = "";

var request=null;
request=createRequest();

request.open("POST",link1,true);
request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
request.setRequestHeader("Content-length", send_var.length);
request.setRequestHeader("Connection", "close");

//request.open("GET",link1,true);
//request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
request.onreadystatechange=function()
			{
				showDiv(id);
				document.getElementById(id).innerHTML='<img src="/images/wait.gif" /> '+loading_text;
				if(request.readyState==4)
				{
									var strVal=request.responseText;
										if(strVal.substr(0,5)=="link:")
											{
											hideDiv(id);
											window.location=strVal.substr(5);
											return;
											}
										else if(strVal.substr(0,5)=="exit:")
											{
											hideDiv(id);
											return;
											}
										else if(strVal.substr(0,7)=="script:")
											{
											hideDiv(id);
											eval(strVal.substr(7));
											return;
											}
										else
											{
											showDiv(id);
											document.getElementById(id).innerHTML=strVal;
											}
				}
			}; 
request.send(send_var);
}

function createRequest()
{
		try
		  {
		  // Firefox, Opera 8.0+, Safari
		  return request=new XMLHttpRequest();
		  }
		catch (e)
		  {
		  // Internet Explorer
		  try
			{
			return request=new ActiveXObject("Msxml2.XMLHTTP");
			}
		  catch (e)
			{
			return request=new ActiveXObject("Microsoft.XMLHTTP");
			}
		  }
		return request;
}
