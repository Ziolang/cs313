function upStat(stat) {
	var statpts = parseint(document.getElementById("caption").innerHTML, 10);
	var value = parseint(document.getElementById(stat).innerHTML, 10);

	if (statpts > 0) {
		value++;
		statpts--;
	}

	document.getElementById("caption").innerHTML = "" + statpts;
	document.getElementById(stat).innerHTML = "" + value;
	document.getElementById(stat + "2").value = value;
}

function downStat(stat) {
	var statpts = parseint(document.getElementById("caption").innerHTML, 10);
	var value = parseint(document.getElementById(stat).innerHTML, 10);

	if (statpts < 3) {
		value--;
		statpts++;
	}

	document.getElementById("caption").innerHTML = "" + statpts;
	document.getElementById(stat).innerHTML = "" + value;
	document.getElementById(stat + "2").value = value;
}