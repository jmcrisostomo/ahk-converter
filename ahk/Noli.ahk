Noli:=[]



Counter := 1
DeleteCout := 1

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

    Send, % Noli[ Counter ]
    SetKeyDelay, 5000
    ; SetKeyDelay, 600
    Send, {Enter}

    Counter += 1

    ; DeleteCout += 1

    If ( Counter = Noli.MaxIndex() ){
      Counter := 1
    }
    
    If ( DeleteCout = 5 ){
        Loop, 10
        {
            send, {Up}
            send, ^a
            send, {BS}
            send, {Enter}
            send, {Enter}
            sleep, 500
            send, {WheelUp}
        }
        DeleteCout := 1
    }
Return

deleteChat:
    Loop, 10
    {
	    send, {Up}
        send, ^a
        send, {BS}
        send, {Enter}
        send, {Enter}
        sleep, 500
        send, {WheelUp}
    }
Return