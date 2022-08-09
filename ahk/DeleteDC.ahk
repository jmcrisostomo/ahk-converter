Escape::
ExitApp
Return

^d::
Loop, 100000
{
	send, {Up}
sleep, 200
	send, ^a
	
	send, {BS}
	send, {Enter}
	send, {Enter}
	sleep, 300
	send, {WheelUp}
}
Return