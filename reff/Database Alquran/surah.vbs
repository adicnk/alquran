Option Explicit
dim rs, iim1, mySQL
dim scriptName, scriptPath, connstring
dim iret
dim a,b,x
dim var1,var2,var3,i
dim message 

message = "This script demonstrates how to read data from a website content into mySQL database" + VbCrLf + VbCrLf + VbCrLf
message = message + "Enjoy it !"
MsgBox (message)

scriptName = WScript.ScriptFullName
scriptPath = Left(scriptName, InstrRev(scriptName, "\"))

'MsgBox (scriptName) 'This script filename
'MsgBox (scriptPath) 'This script path of the filename

'Setting up mySQL Database
set rs = CreateObject("ADODB.Connection")
connstring = "DRIVER={MySQL ODBC 8.0 Unicode Driver};"_
	& "SERVER=localhost;"_
	& "DATABASE=alquran;"_
	& "UID=root;PWD=qbidb; OPTION=3"	
rs.Open (connstring)

'Create object of imacros
set iim1= CreateObject ("imacros")
iret = iim1.iimOpen("")
iret = iim1.iimDisplay("Submitting Data from Web to MySQL")

a = 1 'Default is 1
b = 0 'Default is 0
DO UNTIL a=115
	'Create variable for imacros
	if a = 1 then
		iret = iim1.iimSet("VAR2", 28)
	else
		b = b  + 1
		if a > 38 then 
			iret = iim1.iimSet("VAR2", 30 + b * 8)
			if a > 76 then iret = iim1.iimSet("VAR2", 32 + b * 8)
		else
			iret = iim1.iimSet("VAR2", 28 + b * 8)
		end if		
	end if
		
	iret = iim1.iimSet("VAR1", a)
	iret = iim1.iimDisplay("Get Surah Title, Please Wait !")	
	
	'Saving Data to File
	iret = iim1.iimPlay("C:\Users\Y.S Riyadi\OneDrive\Documents\iMacros\Macros\" & "AlquranGetSurah.iim")
   
	'Get the variable from Web and clean the "'", "()" and number / char(39) for "'"
	var1 = iim1.iimGetExtract(1)
	var2 = iim1.iimGetExtract(2)
	var3 = iim1.iimGetExtract(3)
	
	var2 = Replace(var2, chr(39),"")
	var3 = Replace(var3, chr(39),"") 

	var2 = Replace(var2, "(", "", 1, 3)
	var2 = Replace(var2, "1", "", 1, 3)
	var2 = Replace(var2, "2", "", 1, 3)
	var2 = Replace(var2, "3", "", 1, 3)
	var2 = Replace(var2, "4", "", 1, 3)
	var2 = Replace(var2, "5", "", 1, 3)
	var2 = Replace(var2, "6", "", 1, 3)	
	var2 = Replace(var2, "7", "", 1, 3)	
	var2 = Replace(var2, "8", "", 1, 3)	
	var2 = Replace(var2, "9", "", 1, 3)	
	var2 = Replace(var2, "0", "", 1, 3)	
	var2 = Replace(var2, ")", "", 1, 3)
	
	'Saving Data to mySQL
	mySQL = "INSERT INTO surah (arabic,latin) VALUES ('" & iim1.iimGetExtract(1) & "','" & var2 & "')"
	rs.Execute(mySQL)

	mySQL = "INSERT INTO surah_translate (language_id, content) VALUES (1 , '" & var3 & "')"	
	rs.Execute(mySQL)
	
	a = a + 1
LOOP

iim1.iimClose(30)
WScript.Quit(iret)