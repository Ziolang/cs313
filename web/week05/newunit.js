function calculateMP() {
	var mp1 = 3;
	var mp2 = 3;

	var temp = 0;

	if (document.getElementById("s1damage").value != 0) {
		temp = document.getElementById("s1buffamt").value / 10;

		if (document.getElementById("s1buffamt").value >= 200)
			temp *= 2;

		mp1 += temp;
		temp = 0;
	}
	if (document.getElementById("s2damage").value != 0) {
		temp = document.getElementById("s2buffamt").value / 10;

		if (document.getElementById("s2buffamt").value >= 200)
			temp *= 2;

		mp2 += temp;
		temp = 0;
	}

	if (document.getElementById("s1status").value != "none") {mp1 += 2;}
	if (document.getElementById("s2status").value != "none") {mp2 += 2;}
	
	if (document.getElementById("s1buff").value != "none") {
		temp = document.getElementById("s1buffamt").value / 10;
		if (document.getElementById("s1buffstat").value.length > 3) {
			temp *= 2;
		}

		mp1 += temp;
		temp = 0;
	}
	if (document.getElementById("s2buff").value != "none") {
		temp = document.getElementById("s2buffamt").value / 10;
		if (document.getElementById("s2buffstat").value.length > 3) {
			temp *= 2;
		}

		mp2 += temp;
		temp = 0;
	}

	var other = document.getElementById("s1other");
	if (other.value != "none") {
		var r = document.getElementById("s1range").value;
		if (other.value == "Knockback") { mp1 += 2; }
		if (other.value == "Hits 2 times") { mp1 *= 2;}
		if (other.value == "1 cell AoE") { mp1 += 2; }
		if (other.value == "Line-Shape Area") { mp1 += (r - 2); }
		if (other.value == "2 cell AoE") { mp1 += 5; }
		if (other.value == "Cone-Shape Area") { 
			mp1 += (r * (r - 1)) - 1;
		}
	}
	var other = document.getElementById("s2other");
	if (other.value != "none") {
		var r = document.getElementById("s2range").value;
		if (other.value == "Knockback") { mp2 += 2; }
		if (other.value == "Hits 2 times") { mp2 *= 2;}
		if (other.value == "1 cell AoE") { mp2 += 2; }
		if (other.value == "Line-Shape Area") { mp2 += (r - 2); }
		if (other.value == "2 cell AoE") { mp2 += 5; }
		if (other.value == "Cone-Shape Area") { 
			mp2 += (r * (r - 1)) - 1;
		}
	}

	document.getElementById("s1mp").innerHTML = "MP: " + mp1 + ".";
	document.getElementById("s2mp").innerHTML = "MP: " + mp2 + ".";
}