function isIdentical() {
	var item1 = document.getElementById("p1").value
	var item2 = document.getElementById("p2").value

	if (item1.length != item2.length) {
		return false;
	}

	for (var i = 0; i < item1.length; i++) {
		if (item1.charAt(i) != item2.charAt(i)) {
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
		document.getElementById('error').innerHTML = "Passwords not identical.";
	}
}