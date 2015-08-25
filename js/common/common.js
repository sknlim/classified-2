// JavaScript Document
function wordseparator(st)
    {
    var ar = st.split(" ");
   // alert(ar.length);
	var i=0;
    for(i=0;i<=ar.length-1;i++)
        {
        	if(ar[i].length>32)
			{
			//alert("Invalid Words");
			return false;
			}
        }
	return true;	
    }

// JavaScript Document
function trim(sString)
{
	while (sString.substring(0,1) == ' ')
	{
	sString = sString.substring(1, sString.length);
	}

	while (sString.substring(sString.length-1, sString.length) == ' ')
	{
	sString = sString.substring(0,sString.length-1);
	}
	return sString;
}

function validNum(no)
	{
		return(/^[0-9]+$/.test(no.toString()));
	}

function validURL(s) {
	var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	return regexp.test(s);
}


function validAlphaNum(name)
	{
		return(/^([a-zA-Z0-9\s])+$/.test(name.toString()));;
	}

function validemailid(email)
	{
	return(/^[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9\.-]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$/.test(email.toString()));
	}

function checkField(obj,type,mess)
	{
		var objField=obj;
		
		while(obj.className!="checkStatus")
			{
				obj=obj.nextSibling;
			}
		obj.style.padding="5px";
		obj.style.fontSize='11px';
		obj.style.color="#FF0000";
		
			
		switch(type)
		{
			case "email":
			// empty validation
				if(trim(objField.value)=="")
				{
					obj.innerHTML='<img src="images/icons/alert.gif"> ' + "Email empty";
					return false;
				}
				else
					obj.innerHTML='<img src="images/icons/tick_16.gif"> ';
				
				

			// email validation
				if(!validemailid(trim(objField.value)))
				{
					obj.innerHTML='<img src="images/icons/alert.gif"> ' + "Invalid email";
					return false;
				}
				else
					obj.innerHTML='<img src="images/icons/tick_16.gif"> ';
		
			break;
			
	
			case "password":
			
			// empty validation
				
				if(trim(objField.value)=="")
				{
					obj.innerHTML='<img src="images/icons/alert.gif"> ' + "Password empty";
					return false;
				}
				else
					obj.innerHTML='<img src="images/icons/tick_16.gif"> ';
				
				

			// length validation
				
				if(trim(objField.value).length<5 || trim(objField.value).length>10)
				{
					obj.innerHTML='<img src="images/icons/alert.gif"> ' + "Invalid password length";
					return false;
				}
				else
					obj.innerHTML='<img src="images/icons/tick_16.gif"> ';
		
			
			break;
			
			case "string":

			
			if(trim(objField.value)=="")
				{
					obj.innerHTML='<img src="images/icons/alert.gif"> ' + "Value empty";
					return false;
				}
				else
					obj.innerHTML='<img src="images/icons/tick_16.gif"> ';
				
				

			// length validation
				
				if(!validAlphaNum(objField.value))
				{
					obj.innerHTML='<img src="images/icons/alert.gif"> ' + "Invalid value";
					return false;
				}
				else
					obj.innerHTML='<img src="images/icons/tick_16.gif"> ';
			
			
			break;
			
			case "number":

			// empty validation
			
			if(trim(objField.value)=="")
				{
					obj.innerHTML='<img src="images/icons/alert.gif"> ' + "Number empty";
					return false;
				}
				else
					obj.innerHTML='<img src="images/icons/tick_16.gif"> ';
			
			// number validation
			
			if(trim(objField.value)=="")
				{
					obj.innerHTML='<img src="images/icons/alert.gif"> ' + "Invalid number";
					return false;
				}
				else
					obj.innerHTML='<img src="images/icons/tick_16.gif"> ';	

			
			break;
			
			case "zip":

			// empty validation
			
			if(trim(objField.value)=="")
				{
					obj.innerHTML='<img src="images/icons/alert.gif"> ' + "Zip empty";
					return false;
				}
				else
					obj.innerHTML='<img src="images/icons/tick_16.gif"> ';
			
			// number validation
			
			if(!validNum(trim(objField.value)))
				{
					obj.innerHTML='<img src="images/icons/alert.gif"> ' + "Invalid zip";
					return false;
				}
				else
					obj.innerHTML='<img src="images/icons/tick_16.gif"> ';	

			// length validation
			
			if(trim(objField.value).length<4 || trim(objField.value).length>6 )
				{
					obj.innerHTML='<img src="images/icons/alert.gif"> ' + "Invalid zip length";
					return false;
				}
				else
					obj.innerHTML='<img src="images/icons/tick_16.gif"> ';	
			
		
			break;
			
			case "url":
			
			break;
			
			case "custom":
			
					obj.innerHTML='<img src="images/icons/alert.gif"> ' +mess;
			
					
			break;
			
			case "empty":
			// empty validation
				
				if(trim(objField.value)=="")
				{
					obj.innerHTML='<img src="images/icons/alert.gif"> ' + "Value empty";
					return false;
				}
				else
					obj.innerHTML='<img src="images/icons/tick_16.gif"> ';
			break;
			
			case "checkbox":
			// checked validation
					
				if(objField.checked==false)
				{
					obj.innerHTML='<img src="images/icons/alert.gif"> ' + "Must be checked";
					return false;
				}
				else
					obj.innerHTML='<img src="images/icons/tick_16.gif"> ';
			break;
			
			case "listbox":
				if(objField.value=="0")
				{
					obj.innerHTML='<img src="images/icons/alert.gif"> ' + "Select one";
					return false;
				}
				else
					obj.innerHTML='<img src="images/icons/tick_16.gif"> ';
			break;
			

		}

		return true;
		
	}



function wrongStatus(obj1,mess)
{
		formElement=obj1;
		while(obj1.className!="checkStatus" && obj1.nextSibling)
			{
				obj1=obj1.nextSibling;
			}
		if(obj1.className!="checkStatus") return false;
		
		if(formElement.attributes["errormessage"])
			{
			obj1.innerHTML="<span class='wrongStatus'><span class='wrongStatusIcon'></span>"+formElement.attributes["errormessage"].value+"</span>";
			}
		else
			{
			obj1.innerHTML="<span class='wrongStatus'><span class='wrongStatusIcon'></span>"+mess+"</span>";
			}
}


function correctStatus(obj1,mess)
{
		while(obj1.className!="checkStatus" && obj1.nextSibling)
			{
				obj1=obj1.nextSibling;
			}
		if(obj1.className!="checkStatus") return false;
		
		obj1.style.padding="5px";
		obj1.style.fontSize='11px';
		obj1.style.color="#F00";
		obj1.innerHTML="";
}


function compareField(obj1,obj2,mess)
{
	var objField1=obj1;
	var objField2=obj2;
		while(obj1.className!="checkStatus")
			{
				obj1=obj1.nextSibling;
			}
		obj1.style.padding="5px";
		obj1.style.fontSize='11px';
		obj1.style.color="#F00";
		
		while(obj2.className!="checkStatus")
			{
				obj2=obj2.nextSibling;
			}
		obj2.style.padding="5px";
		obj2.style.fontSize='11px';
		obj2.style.color="#F00";
		
		if(trim(objField1.value)==trim(objField2.value))
			{
				obj1.innerHTML='<img src="images/icons/tick_16.gif"> ';	
				obj2.innerHTML='<img src="images/icons/tick_16.gif"> ';
				return true;
			}
			else
			{
				obj1.innerHTML='<img src="images/icons/alert.gif"> ' + mess;
				obj2.innerHTML='<img src="images/icons/alert.gif"> ' + mess;
				return false;				
			}
		
}

function checkDateList(dd,mm,yyyy,obj,mess)
{
		while(obj.className!="checkStatus")
			{
				obj=obj.nextSibling;
			}
		obj.style.padding="5px";
		obj.style.fontSize='11px';
		obj.style.color="#F00";
		
		
		if((dd.value=="0") || (mm.value=="0") || (yyyy.value=="0"))
			{
				obj.innerHTML='<img src="images/icons/alert.gif"> ' +mess;
				return false;
			}
				else
				obj.innerHTML='<img src="images/icons/tick_16.gif"> ';
			
}


function validateForm(objfrm)
{
	var check=true;
	for(i=0; i < objfrm.elements.length; i++)
		{
		correctStatus(objfrm.elements[i]);
		}

	for(i=0; i < objfrm.elements.length; i++)
	{
		classStr=objfrm.elements[i].className;
		classArr=classStr.split(" ");
	for(val in classArr)
		{
		classStr=classArr[val];
		if(classStr.substr(0,8)=="vldemail")
		{
			
			if(!validemailid(trim(objfrm.elements[i].value)))
					{
						wrongStatus(objfrm.elements[i],"Invalid Email");
						check=false;
					}
			
		}


		if(classStr.substr(0,11)=="vldalphanum" && objfrm.elements[i].value!="")
		{
			if(!validAlphaNum(trim(objfrm.elements[i].value)))
					{
						wrongStatus(objfrm.elements[i],"Please enter a valid value");
						check=false;
					}
			
		}



		if(classStr.substr(0,11)=="vldurl" && objfrm.elements[i].value!="")
		{
			if(!validURL(trim(objfrm.elements[i].value)))
					{
						wrongStatus(objfrm.elements[i],"Please enter a valid URL");
						check=false;
					}
			
		}


		if(classStr.substr(0,6)=="vldnum" && objfrm.elements[i].value!="")
		{
			
			if(!validNum(trim(objfrm.elements[i].value)))
					{
						wrongStatus(objfrm.elements[i],"Invalid number");
						check=false;
					}
			
		}



		if(classStr.substr(0,7)=="vldpass")
		{
			if(trim(objfrm.elements[i].value).length<5 || trim(objfrm.elements[i].value).length>10)
			{
				wrongStatus(objfrm.elements[i],"Password Should be Minimum of 5 Characters and Maximum of 10 Characters");
				check=false;
			}
				
		}
		
		if(classStr.substr(0,5)=="vldmm" && objfrm.elements[i].value!="")
		{
			fieldVal=objfrm.elements[i].value;
			if(parseInt(fieldVal)<1 || parseInt(fieldVal)>12 || !validNum(fieldVal))
			{
			wrongStatus(objfrm.elements[i],"Invalid date");
			check=false;
			}				 
		}
		
		if(classStr.substr(0,5)=="vlddd" && objfrm.elements[i].value!="")
		{
			fieldVal=objfrm.elements[i].value;
			if(parseInt(fieldVal)<1 || parseInt(fieldVal)>31 || !validNum(fieldVal))
			{
			wrongStatus(objfrm.elements[i],"Invalid date");
			check=false;
			}				 
		}
		
		/*if(classStr.substr(0,7)=="vldyyyy" && objfrm.elements[i].value!="")
		{
			if(trim(objfrm.elements[i].value)=="0" || trim(objfrm.elements[i].value)=="" )
			{
			wrongStatus(objfrm.elements[i],"Invalid date");
			check=false;
			}				 
		}*/
		
		if(classStr.substr(0,10)=="vldnoblank")
		{
			if(trim(objfrm.elements[i].value)=="")
			{
			if(objfrm.elements[i].tagName.toUpperCase()=="SELECT")
				wrongStatus(objfrm.elements[i],"Please select one");
			else
				wrongStatus(objfrm.elements[i],"Required");
			check=false;
			}				 
		}
		
	if(classStr.substr(0,14)=="vldmustchecked")
		{
			if(objfrm.elements[i].checked==false)
			{
			wrongStatus(objfrm.elements[i],"Field must be checked");
			check=false;
			}				 
		}


		//Operators
		if(classStr.substr(0,16)=="vld_fld_equalto_")
		{
			elementName=classStr.substr(16);
			if(objfrm.elements[i].value!=objfrm.elements[elementName].value)
			{
			wrongStatus(objfrm.elements[i],"Field must be same as specified earlier");
			check=false;
			}				 
		}


	if(classStr.substr(0,22)=="vld_fld_greaterthaneq_" && objfrm.elements[i].value!="")
		{
			elementName=classStr.substr(22);
			fieldVal=objfrm.elements[i].value;
			if(!validNum(fieldVal))
				{
				wrongStatus(objfrm.elements[i],"Must be a number");
				check=false;
				}
			else if(!(parseInt(fieldVal)>=parseInt(objfrm.elements[elementName].value)))
			{
			wrongStatus(objfrm.elements[i],"Value not allowed");
			check=false;
			}				 
		}



		if(classStr.substr(0,19)=="vld_fld_lessthaneq_" && objfrm.elements[i].value!="")
		{
			elementName=classStr.substr(19);
			fieldVal=objfrm.elements[i].value;
			if(!validNum(fieldVal))
				{
				wrongStatus(objfrm.elements[i],"Must be a number");
				check=false;
				}
			else if(!(parseInt(fieldVal)<=parseInt(objfrm.elements[elementName].value)))
			{
			wrongStatus(objfrm.elements[i],"Value not allowed");
			check=false;
			}				 
		}



		if(classStr.substr(0,18)=="vld_greaterthaneq_" && objfrm.elements[i].value!="")
		{
			checkVal=parseInt(classStr.substr(18));
			fieldVal=objfrm.elements[i].value;
			if(!validNum(fieldVal))
				{
				wrongStatus(objfrm.elements[i],"Must be a number");
				check=false;
				}
			else if(!(parseInt(fieldVal)>=checkVal))
				{
				wrongStatus(objfrm.elements[i],"Field must be greater than "+checkVal);
				check=false;
				}				 
		}

		if(classStr.substr(0,15)=="vld_lessthaneq_" && objfrm.elements[i].value!="")
		{
			checkVal=parseInt(classStr.substr(15));
			fieldVal=objfrm.elements[i].value;			
			if(!validNum(fieldVal))
				{
				wrongStatus(objfrm.elements[i],"Must be a number");
				check=false;
				}
			else if(!(parseInt(objfrm.elements[i].value)<=checkVal))
			{
			wrongStatus(objfrm.elements[i],"Field must be less than "+checkVal);
			check=false;
			}				 
		}

		if(classStr.substr(0,12)=="vld_between_" && objfrm.elements[i].value!="")
		{
			checkVal=classStr.substr(12);
			fieldVal=objfrm.elements[i].value;			
			if(!validNum(fieldVal))
				{
				wrongStatus(objfrm.elements[i],"Must be a number");
				check=false;
				}
			else
				{
				valArr=checkVal.split("-");
				if(parseInt(valArr[0])<parseInt(valArr[1]))
					{
						lowerVal=parseInt(valArr[0]);
						upperVal=parseInt(valArr[1]);
					}
				else
					{
						lowerVal=parseInt(valArr[1]);
						upperVal=parseInt(valArr[2]);
					}
				currentVal=parseInt(objfrm.elements[i].value);
				if(currentVal<lowerVal || currentVal>upperVal)
					{
					wrongStatus(objfrm.elements[i],"Must be in between "+lowerVal+" and "+upperVal);
					check=false;
					}
				}
		}



		}

		
	}
	return check;
}

function changeValue(movName, varName, val){
	eval('if(window.'+movName+') window.document["'+movName+'"].SetVariable(varName, val);');
	eval('if(document.'+movName+') document.'+movName+'.SetVariable(varName, val);');
}
 
 function startUpload(str)
 	{
	changeValue(str,"checkVar","upload");
	}
