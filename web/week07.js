function isIdentical() {
	var item1 = document.getElementById("p1").value
	var item2 = document.getElementById("p2").value

	if (item1.length != item2.length) {
		alert("Passwords Not Identical");
		return false;
	}

	if (item1.length < 7) {
		alert("Password is too short");
		return false;
	}

	for (var i = 0; i < item1.length; i++) {
		if (item1.charAt(i) != item2.charAt(i)) {
			alert("Passwords Not Identical");
			return false;
		}
	}
}

function checkPassword() {
	var item1 = document.getElementById("p1").value
	var item2 = document.getElementById("p2").value
	var isSame = true;
	var numCount = 0;
	var charCount = 0;

	if (item1.length != item2.length && item1.length < 7) {
		isSame = false;
	}

	for (var i = 0; i < item1.length; i++) {
		if (item1.charAt(i) != item2.charAt(i)) {
			isSame = false;
		}

		if (isNaN(item1.charAt(i))) { charCount++; } else { numCount++; }
	}

	if (!isSame) {
		document.getElementById('error').innerHTML = "Passwords not identical.<br>";
	}	

	if (isSame) {
		document.getElementById('error').innerHTML = "";
	}

	if (numCount < 0) {
		document.getElementById('error2').innerHTML = "Password needs to be at least 7 characters long and contain a number.<br>";
	}


}