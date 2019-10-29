function checklvlup() {
	var statpts = parseInt(document.getElementById("caption").innerHTML, 10);
	var lvl = parseInt(document.getElementById("lvl").innerHTML, 10);

	if (statpts > 0) {
		alert("Spend all of your stat points.");
		return false;
	}

	if (lvl > 9) {
		alert("Unit cannot pass level 9 yet.");
		return false;
	}
}