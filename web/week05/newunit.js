window.onload = function () {
	document.getElementsByName("s1name")[0].addEventListener("change", calculateMP());
	document.getElementsByName("s1dmg")[0].addEventListener("change", calculateMP());
	document.getElementsByName("s1type")[0].addEventListener("change", calculateMP());
	document.getElementsByName("s1status")[0].addEventListener("change", calculateMP());
	document.getElementsByName("s1buff")[0].addEventListener("change", calculateMP());
	document.getElementsByName("s1buffstat")[0].addEventListener("change", calculateMP());
	document.getElementsByName("s1buffamt")[0].addEventListener("change", calculateMP());
	document.getElementsByName("s1other")[0].addEventListener("change", calculateMP());
	document.getElementsByName("s1range")[0].addEventListener("change", calculateMP());
	document.getElementsByName("s2name")[0].addEventListener("change", calculateMP());
	document.getElementsByName("s2dmg")[0].addEventListener("change", calculateMP());
	document.getElementsByName("s2type")[0].addEventListener("change", calculateMP());
	document.getElementsByName("s2status")[0].addEventListener("change", calculateMP());
	document.getElementsByName("s2buff")[0].addEventListener("change", calculateMP());
	document.getElementsByName("s2buffstat")[0].addEventListener("change", calculateMP());
	document.getElementsByName("s2buffamt")[0].addEventListener("change", calculateMP());
	document.getElementsByName("s2other")[0].addEventListener("change", calculateMP());
	document.getElementsByName("s2range")[0].addEventListener("change", calculateMP());
}

function calculateMP() {
	var mp1 = 3;
	var mp2 = 3;

	var temp = 0;
	r = 0;
	var other = "";
	var string = "";

	if (document.getElementsByName("s1dmg")[0].value >= 100) {
		temp = (document.getElementsByName("s1dmg")[0].value - 100) / 10;

		if (document.getElementsByName("s1dmg")[0].value >= 200)
			temp *= 2;

		mp1 += temp;
		temp = 0;
	}
	if (document.getElementsByName("s2dmg")[0].value >= 100) {
		temp = (document.getElementsByName("s2dmg")[0].value - 100) / 10;

		if (document.getElementsByName("s2dmg")[0].value >= 200)
			temp *= 2;

		mp2 += temp;
		temp = 0;
	}

	if (document.getElementsByName("s1status")[0].value !== "None") {mp1 += 2;}
	if (document.getElementsByName("s2status")[0].value !== "None") {mp2 += 2;}
	
	if (document.getElementsByName("s1buff")[0].value !== "None") {
		temp = document.getElementsByName("s1buffamt")[0].value / 10;
		string = "" + document.getElementsByName("s1buffstat")[0].value;
		if (string.length > 3) {
			temp *= 2;
		}

		mp1 += temp;
		temp = 0;
	}
	if (document.getElementsByName("s2buff")[0].value !== "None") {
		temp = document.getElementsByName("s2buffamt")[0].value / 10;
		string = "" + document.getElementsByName("s2buffstat")[0].value;
		if (string.length > 3) {
			temp *= 2;
		}

		mp2 += temp;
		temp = 0;
	}

	other = document.getElementsByName("s1other")[0];
	if (other.value !== "None") {
		r = document.getElementsByName("s1range")[0].value;
		if (other.value == "Knockback") { mp1 += 2; }
		if (other.value == "Hits 2 times") { mp1 *= 2;}
		if (other.value == "1 cell AoE") { mp1 += 2; }
		if (other.value == "Line-shape area") { mp1 += (r - 2); }
		if (other.value == "2 cell AoE") { mp1 += 5; }
		if (other.value == "Cone-shape area") { 
			mp1 += (r * (r - 1));
		}
	}
	other = document.getElementsByName("s2other")[0];
	if (other.value !== "None") {
		r = document.getElementsByName("s2range")[0].value;
		if (other.value == "Knockback") { mp2 += 2; }
		if (other.value == "Hits 2 times") { mp2 *= 2;}
		if (other.value == "1 cell AoE") { mp2 += 2; }
		if (other.value == "Line-shape area") { mp2 += (r - 2); }
		if (other.value == "2 cell AoE") { mp2 += 5; }
		if (other.value == "Cone-shape area") { 
			mp2 += (r * (r - 1)) - 1;
		}
	}

	r = document.getElementsByName("s1range")[0].value;
	if (r >= 3) {
		mp1 += r - 2;
	}
	r = document.getElementsByName("s2range")[0].value;
	if (r >= 3) {
		mp2 += r - 2;
	}

	document.getElementById("s1mpview").innerHTML = mp1;
	document.getElementById("s2mpview").innerHTML = mp2;
	document.getElementsByName("s1mp")[0].value = mp1;
	document.getElementsByName("s2mp")[0].value = mp2;
}