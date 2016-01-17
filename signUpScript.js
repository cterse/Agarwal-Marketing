function validateForm(){
	document.getElementById('no_pass_match').innerHTML = "Passwords Don't Match";
	var email = name = comp_qt = password1 = password2 = tnc = "";
	var err = 0;
	email = document.getElementById('email').value;
	name = document.getElementById('username').value;
	comp_qt = document.getElementById('comp_qt').value;
	password1 = document.getElementById('password1').value;
	password2 = document.getElementById('password2').value;
	tnc = document.getElementById('tnc').value;

	if (email == "" || email == null) {
		document.getElementById('email_span').style.display = "inline";
		err = 1;
	} else {
		document.getElementById('email_span').style.display = "none";
	}
	if (name == "" || name == null) {
		document.getElementById('name_span').style.display = "inline";
		err = 1;
	} else {
		document.getElementById('name_span').style.display = "none";
	}
	if (comp_qt == "yes" || comp_qt == "no") {
		document.getElementById('qt_span').style.display = "none";
	} else {
		document.getElementById('qt_span').style.display = "inline";
		err = 1;
	}
	if (password1 == "" || password1 == null) {
		document.getElementById('pass1_span').style.display = "inline";
		err = 1;
	} else {
		document.getElementById('pass1_span').style.display = "none";
	}
	if (password2 == "" || password2 == null) {
		document.getElementById('pass2_span').style.display = "inline";
		err = 1;
	} else {
		document.getElementById('pass2_span').style.display = "none";
	}
	if (tnc != "true") {
		document.getElementById('tnc_span').style.display = "inline";
		err = 1;
	} else {
		document.getElementById('tnc_span').style.display = "none";
	}
	if(password1 == password2){
		document.getElementById('no_pass_match').style.display = "none";
		if(password2.length < 6){
			document.getElementById('no_pass_match').innerHTML = "Password Too Small";
			document.getElementById('no_pass_match').style.display = "inline";
			err = 1;
		}else{
			re = /[0-9]/;
			if(!re.test(password2)){
				document.getElementById('no_pass_match').innerHTML = "Please include at least one number.";
				document.getElementById('no_pass_match').style.display = "inline";
				err = 1;
			}
		}
	} else {
		document.getElementById('no_pass_match').style.display = "inline";
		err = 1;
	}
	if(err == 1)
		return false;
	else return true;
}

function checkEmailAlreadyPresent(str){
	if(str == ""){
		document.getElementById("email_ok_span").style.display = "none";
	} else {
		var xmlhttp = new XMLHttlRequest();
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readystate == 4 && xmlhttp.status == 200){
				document.getElementById("email_ok_span").style.display = xmlhttp.responseText;
			}
		}
		xmlhttp.open("get","checkEmail.php?q=" + str,"true");
		xmlhttp.send();
	}
}