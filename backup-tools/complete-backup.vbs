Set WinScriptHost = CreateObject("WScript.Shell")
WinScriptHost.Run Chr(34) & "C:\xampp\htdocs\project\backup-tools\complete-backup.bat" & Chr(34), 0
Set WinScriptHost = Nothing