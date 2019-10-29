function checklvlup() {
	var statpts = parseInt(document.getElementById("caption").innerHTML, 10);
	var lvl = parseInt(document.getElementById("lvl").innerHTML, 10);

	if (statpts > 0) {
		alert("Spend all of your stat points.");
		return false;
	}

	if (lvl > 10) {
		alert("Unit cannot pass level 10 yet.");
		return false;
	}
}