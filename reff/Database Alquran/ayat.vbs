Option Explicit
dim cn, rs, iim1, mySQL, connstring
dim scriptName, scriptPath
dim iret
dim char1, char2, i
dim surah_index
dim message

message = "This script demonstrates how to read data from a website content into mySQL database and vice versa" + VbCrLf + VbCrLf + VbCrLf
message = message + "Enjoy it !"
MsgBox (message)

scriptName = WScript.ScriptFullName
scriptPath = Left(scriptName, InstrRev(scriptName, "\"))

'MsgBox (scriptName) 'This script filename
'MsgBox (scriptPath) 'This script path of the filename

'Setting up mySQL Database
set cn = CreateObject("ADODB.Connection")
connstring = "DRIVER={MySQL ODBC 8.0 Unicode Driver};"_
	& "SERVER=localhost;"_
	& "DATABASE=alquran;"_
	& "UID=root;PWD=qbidb; OPTION=3"	
cn.Open (connstring)

'Create object of imacros
set iim1= CreateObject ("imacros")
iret = iim1.iimOpen("")
iret = iim1.iimDisplay("Submitting Data from MySQL to Web")

'Create the recordset for record operation
set rs = CreateObject("ADODB.Recordset")

surah_index = 1 'Indexing the surah to start

mySQL = "SELECT * FROM surah WHERE id=" & surah_index
rs.Open mySQL, cn
rs.MoveFirst
do until rs.eof
	for i = 1 to rs.Fields.Item("count")
		iret = iim1.iimDisplay("Wait for complete Surah " & rs.Fields.Item("latin") & "verse " & i )
		iret = iim1.iimSet("VAR1", rs.Fields.Item("latin"))
		iret = iim1.iimSet("VAR2", i)
		iret = iim1.iimPlay("C:\Users\Y.S Riyadi\OneDrive\Documents\iMacros\Macros\" & "AlquranGetAyat.iim")
		
		'Saving Data to mySQL
		char1 = Replace(iim1.iimGetExtract(2), chr(39),"")
		char2 = Replace(iim1.iimGetExtract(3), chr(39),"")
		
		if iim1.iimGetExtract(1)="#EANF#" then
		else
			mySQL = "INSERT INTO ayat(surah_id, arabic, ayat_index, latin) VALUES (" & surah_index &",'" & iim1.iimGetExtract(1) & "'," & i & ",'" & char1 & "')"
			cn.Execute(mySQL)
			
			mySQL = "INSERT INTO ayat_translate (tafsir_id, surah_id, ayat_index, content) VALUES (1," & surah_index & "," & i & ",'" & char2 & "')"
			cn.Execute(mySQL)
		end if
	next
	rs.MoveNext
loop

iim1.iimClose(30)
WScript.Quit(iret)