// JavaScript Document
// "coordinates.js" REQUIRED
function changeOpac(opacity, id) { 
    var object = document.getElementById(id).style; 
    object.opacity = (opacity / 100); 
    object.MozOpacity = (opacity / 100); 
    object.KhtmlOpacity = (opacity / 100); 
    object.filter = "alpha(opacity=" + opacity + ")"; 
} 

function changeToOpaque(id,start,stopa)
	{
	showDiv(id);
	if(start>=stopa) return;
	changeOpac(start, id);
	start=start+7;
	setTimeout("changeToOpaque('"+id+"',"+start+","+stopa+")", 1);
	}

function changeToTransparent(id,start,stopa)
	{
	if(start<=stopa)
		{
		hideDiv(id);
		return;
		}
	changeOpac(start, id);
	start=start-7;
	setTimeout("changeToTransparent('"+id+"',"+start+","+stopa+")", 1);
	}

function changeToTransparent_noHide(id,start,stopa)
	{
	if(start<=stopa)
		{
		return;
		}
	changeOpac(start, id);
	start=start-3;
	setTimeout("changeToTransparent('"+id+"',"+start+","+stopa+")", 1);
	}


function toggleFade(id)
	{
		if(document.getElementById(id).style.display=="" || document.getElementById(id).style.display=="block")
			{
				for(i=100,x=1;i>=0;i--,x=x+3)
					{
						setTimeout('changeOpac('+i+', "'+id+'")',x);
						if(i==0) setTimeout('hideDiv("'+id+'")',(x+1));
					}
			//changeToTransparent(id,100,0);
			}
		else
			{
				showDiv(id);
				changeOpac(0,id);
				for(i=1,x=1;i<=100;i++,x=x+3)
					{
						setTimeout('changeOpac('+i+', "'+id+'")',x);
					}
			//changeToOpaque(id,0,100);
			}
	}