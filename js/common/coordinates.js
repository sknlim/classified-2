function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function getScrollXY() {
  var scrOfX = 0, scrOfY = 0;
  if( typeof( window.pageYOffset ) == 'number' ) {
    //Netscape compliant
    scrOfY = window.pageYOffset;
    scrOfX = window.pageXOffset;
  } else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
    //DOM compliant
    scrOfY = document.body.scrollTop;
    scrOfX = document.body.scrollLeft;
  } else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
    //IE6 standards compliant mode
    scrOfY = document.documentElement.scrollTop;
    scrOfX = document.documentElement.scrollLeft;
  }
  return [ parseInt(scrOfX), parseInt(scrOfY) ];
}
function getXY(e)
	{
	if(!e) e=window.event;
	var nn6=document.getElementById&&!document.all;
    x = nn6 ? e.clientX : event.clientX;
    y = nn6 ? e.clientY : event.clientY;
	return [ parseInt(x), parseInt(y) ];
	}
function centerPage(id)
	{
document.getElementById(id).style.left=(getScrollXY()[0]+(parseInt(getPageSize()[2])-parseInt(document.getElementById(id).offsetWidth))/2)+"px";
document.getElementById(id).style.top=(getScrollXY()[1]+(parseInt(getPageSize()[3])-parseInt(document.getElementById(id).offsetHeight))/2)+"px";
	}

function showDiv(id)
	{
		document.getElementById(id).style.display="block";
	}
function hideDiv(id)
	{
		
		document.getElementById(id).style.display="none";
	}

function getPageSize(){
	
	var xScroll, yScroll;
	
	if (window.innerHeight && window.scrollMaxY) {	
		xScroll = document.body.scrollWidth;
		yScroll = window.innerHeight + window.scrollMaxY;
	} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
		xScroll = document.body.scrollWidth;
		yScroll = document.body.scrollHeight;
	} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		xScroll = document.body.offsetWidth;
		yScroll = document.body.offsetHeight;
	}

	var windowWidth, windowHeight;
	if (self.innerHeight) {	// all except Explorer
		windowWidth = self.innerWidth;
		windowHeight = self.innerHeight;
	} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
		windowWidth = document.documentElement.clientWidth;
		windowHeight = document.documentElement.clientHeight;
	} else if (document.body) { // other Explorers
		windowWidth = document.body.clientWidth;
		windowHeight = document.body.clientHeight;
	}	
	// for small pages with total height less then height of the viewport
	if(yScroll < windowHeight){
		pageHeight = windowHeight;
	} else { 
		pageHeight = yScroll;
	}

	// for small pages with total width less then width of the viewport
	if(xScroll < windowWidth){	
		pageWidth = windowWidth;
	} else {
		pageWidth = xScroll;
	}


	arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight) 
	return arrayPageSize;
}

function removeObj(id)
	{
		var obj_del;
		obj_del=document.getElementById(id);
		obj_del.parentNode.removeChild(obj_del);
		obj_del=null;
	}

function removeObjByLinker(obj_del)
	{
		obj_del.parentNode.removeChild(obj_del);
		obj_del=null;
	}

document.getElementsByClassName = function(cl) {
var retnode = [];
var myclass = new RegExp('\\b'+cl+'\\b');
var elem = this.getElementsByTagName('*');
for (var i = 0; i < elem.length; i++) {
var classes = elem[i].className;
if (myclass.test(classes)) retnode.push(elem[i]);
}
return retnode;
};


document.getNextHighestZIndex = function() {
var highestIndex= 0;
var elem = this.getElementsByTagName('*');
for (var i = 0; i < elem.length; i++) {
if(parseInt(elem[i].style.zIndex)>highestIndex) highestIndex=parseInt(elem[i].style.zIndex);
}
highestIndex++;
return highestIndex;
};


function getXObj(obj){
    return obj.offsetLeft + (obj.offsetParent ? getXObj(obj.offsetParent) : obj.x ? obj.x : 0);
}
function getYObj(obj){
    return (obj.offsetParent ? obj.offsetTop + getYObj(obj.offsetParent) : obj.y ? obj.y : 0);
}
