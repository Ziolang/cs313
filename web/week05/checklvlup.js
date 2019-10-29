function checklvlup() {
	var statpts = parseInt(document.getElementById("caption").innerHTML, 10);

	if (statpts > 0) {
		alert("Spend all of your stat points.")
		return false;
	}
}