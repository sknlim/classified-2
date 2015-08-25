// JavaScript Document
var old_window_onload = (window.onload) ? window.onload :  function(){};
window.onload = function() {
	old_window_onload();
	addDropDowns();
	};
	

var initDropDown=0;
var classElements;
var timeoutvar=0;
function addDropDowns()
	{
	classElements=document.getElementsByClassName("floatDropDown");
	for(dropDownCounter=0;dropDownCounter<classElements.length;dropDownCounter++)
		{
		dropDownObj=document.getElementsByClassName("floatDropDown")[dropDownCounter];
		childNodesCount=dropDownObj.childNodes.length;
		for(i=0;i<childNodesCount;i++)
			{
				if(dropDownObj.childNodes[i].tagName=="SPAN")
							spanObj=dropDownObj.childNodes[i];
				else if(dropDownObj.childNodes[i].tagName=="UL")	
							ulObj=dropDownObj.childNodes[i];
			}
		spanObj.id="floatDropDownSpan"+dropDownCounter;
		floatDivContent='<ul>'+ulObj.innerHTML+'</ul>';
		spanObj.innerHTML+=' <a class="arrowFloatDropDown" href="javascript:;" onClick="showFloatDropDown(event,\''+dropDownCounter+'\')"><spacer type="block" width="16" height="16"></a>';
		dropDownDiv=document.createElement('DIV');
		dropDownDiv.id="floatDropDown"+dropDownCounter;
		dropDownDiv.style.left=getXObj(spanObj)+"px";
		dropDownDiv.className="floatDropDownDiv";
		dropDownDiv.style.top=(getYObj(spanObj)+spanObj.offsetHeight+3)+"px";
		//spanObj.style.border="1px solid #000";
		dropDownDiv.style.position="absolute";
		//dropDownDiv.style.border="1px solid #000";
		dropDownDiv.style.display="none";
		dropDownDiv.innerHTML=floatDivContent;
		dropDownDiv.onmouseover=function()
			{
				clearTimeout(timeoutvar);
			};
		dropDownDiv.onmouseout=function()
			{
				timeoutvar=setTimeout("hideAllFloatDropDown()",500);
			};

		document.getElementsByTagName('BODY')[0].appendChild(dropDownDiv);
		}
	}
function hideAllFloatDropDown()
	{
		for(dropDownCounter=0;dropDownCounter<classElements.length;dropDownCounter++)
			{
			hideDiv("floatDropDown"+dropDownCounter);
			}

	}
function showFloatDropDown(e,dropDownCounterSelected)
	{
		hideAllFloatDropDown();
		dropDownDiv=document.getElementById("floatDropDown"+dropDownCounterSelected);
		spanObj=document.getElementById("floatDropDownSpan"+dropDownCounterSelected);
		dropDownDiv.style.left=getXObj(spanObj)+"px";
		dropDownDiv.style.top=(getYObj(spanObj)+spanObj.offsetHeight+3)+"px";
		dropDownDiv.style.zIndex=document.getNextHighestZIndex();
		toggleFade("floatDropDown"+dropDownCounterSelected);
		//document.getElementById("floatDropDown"+dropDownCounterSelected).style.left=getXY(e)[0]+"px";
		//document.getElementById("floatDropDown"+dropDownCounterSelected).style.top=getXY(e)[1]+"px";
	}