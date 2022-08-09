Sonnet:=[]
Sonnet[1] := "1"

Counter := 1

Escape::
ExitApp
Return

F4::
    If (toggle := !toggle) {
        Send, y
        SetTimer, spamBot, 50
    }
    Else {
        SetTimer, spamBot, off
        Send, y
    }
Return

spamBot:

    ; Send, % Sonnet[ Counter ]
    SetKeyDelay, 60
    ; SetKeyDelay, 600
    Send, {Up}
    Send, ^a
    Send, {BackSpace}
    Send, {Enter}
    Send, {Enter}
    Send {Click Left}

    Counter += 1

    If ( Counter = Sonnet.MaxIndex() ){
      Counter := 1
    }
Return