function upStat(stat) {
	var statpts = parseInt(document.getElementById("caption").innerHTML, 10);
	var value = parseInt(document.getElementById(stat).innerHTML, 10);

	if (statpts > 0) {
		value++;
		if (stat == "hp" || stat == "mp")
			value = value * 5;
		statpts--;
	}

	document.getElementById("caption").innerHTML = "" + statpts;
	document.getElementById(stat).innerHTML = "" + value;
	document.getElementById(stat + "2").value = value;
}

function downStat(stat) {
	var statpts = parseInt(document.getElementById("caption").innerHTML, 10);
	var value = parseInt(document.getElementById(stat).innerHTML, 10);

	if (statpts < 3) {
		value--;
		statpts++;
	}

	document.getElementById("caption").innerHTML = "" + statpts;
	document.getElementById(stat).innerHTML = "" + value;
	document.getElementById(stat + "2").value = value;
}