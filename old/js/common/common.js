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

function validno(no)
	{
		return(/^[0-9]+$/.test(no.toString()));
	}

function validname(name)
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
				
				if(!validname(objField.value))
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
			
			if(!validno(trim(objField.value)))
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


/*function correctField(obj)
	{
		while(obj.className!="checkStatus")
			{
				obj=obj.nextSibling;
			}
		obj.innerHTML='<img src="images/icons/tick_16.gif">';
		obj.style.padding="5px";
		obj.style.color="#F00";
		
	}
*/	
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

/*
function validateForm(objfrm)
{
	var check=true;
	for(i=0; i < objfrm.elements.length; i++)
	{
		if(objfrm.elements[i].className.substr(0,8)=="vldemail")
		{
			
			if(!validemailid(trim(objfrm.elements[i].value)))
					{
						wrongStatus(objfrm.elements[i],"Invalid Email");
						check=false;
					}
			else
				correctStatus(objfrm.elements[i]);
				
		}

		
		if(objfrm.elements[i].className.substr(0,7)=="vldpass")
		{
			if(trim(objfrm.elements[i].value).length<5 || trim(objfrm.elements[i].value).length>10)
			{
				wrongStatus(objfrm.elements[i],"Password Should be Minimum of 5 Characters and Maximum of 10 Characters");
				check=false;
			}
			else
				correctStatus(objfrm.elements[i]);
				
		}
		
		if(objfrm.elements[i].className.substr(0,5)=="vldmm")
		{
			if(trim(objfrm.elements[i].value)=="0" || trim(objfrm.elements[i].value)=="" )
			{
			wrongStatus(objfrm.elements[i],"Invalid date");
			check=false;
			}				 
			else
				correctStatus(objfrm.elements[i]);
		}
		
		if(objfrm.elements[i].className.substr(0,5)=="vlddd")
		{
			if(trim(objfrm.elements[i].value)=="0" || trim(objfrm.elements[i].value)=="" )
			{
			wrongStatus(objfrm.elements[i],"Invalid date");
			check=false;
			}				 
			else
				correctStatus(objfrm.elements[i]);
		}
		
		if(objfrm.elements[i].className.substr(0,7)=="vldyyyy")
		{
			if(trim(objfrm.elements[i].value)=="0" || trim(objfrm.elements[i].value)=="" )
			{
			wrongStatus(objfrm.elements[i],"Invalid date");
			check=false;
			}				 
			else
				correctStatus(objfrm.elements[i]);
		}
		
		if(objfrm.elements[i].className.substr(0,10)=="vldnoblank")
		{
			if(trim(objfrm.elements[i].value)=="")
			{
			wrongStatus(objfrm.elements[i],"Field should not be empty");
			check=false;
			}				 
			else
				correctStatus(objfrm.elements[i]);
		}
		
		if(objfrm.elements[i].className.substr(0,14)=="vldmustchecked")
		{
			if(objfrm.elements[i].checked==false)
			{
			wrongStatus(objfrm.elements[i],"Field must be checked");
			check=false;
			}				 
			else
				correctStatus(objfrm.elements[i]);
		}
		
	}
	return check;
}

*/