function trim(inputString) {
   if (typeof inputString != "string") { return inputString; }
   var retValue = inputString;
   var ch = retValue.substring(0, 1);
   while (ch == " ") {
      retValue = retValue.substring(1, retValue.length);
      ch = retValue.substring(0, 1);
   }
   ch = retValue.substring(retValue.length-1, retValue.length);
   while (ch == " ") {
      retValue = retValue.substring(0, retValue.length-1);
      ch = retValue.substring(retValue.length-1, retValue.length);
   }
   while (retValue.indexOf("  ") != -1) {
      retValue = retValue.substring(0, retValue.indexOf("  ")) + retValue.substring(retValue.indexOf("  ")+1, retValue.length);
   }
   return retValue;
}
//
function isDigit (c)
{
		 return ((c >= "0") && (c <= "9"))
}

function isInteger(iNumber)
{
	var i;
	
	for (i=0;i<iNumber.length;i++)
	{
		var c = iNumber.charAt(i);
	
		if (!isDigit(c))
		{
			return false;
		}
	}
	
  	return true;
}