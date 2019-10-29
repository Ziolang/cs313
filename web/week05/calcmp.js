function calculateMP() {
	var mp1 = 3;

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

	if (document.getElementsByName("s1status")[0].value != 0) {mp1 += 2;}
	
	if (document.getElementsByName("s1buff")[0].value != 0) {
		temp = document.getElementsByName("s1buffamt")[0].value / 10;
		string = "" + document.getElementsByName("s1buffstat")[0].value;
		if (string.length > 3) {
			temp *= 2;
		}

		mp1 += temp;
		temp = 0;
	}

	other = document.getElementsByName("s1other")[0];
	if (other.value != 0) {
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

	r = document.getElementsByName("s1range")[0].value;
	if (r >= 3) {
		mp1 += r - 2;
	}

	document.getElementById("s1mpview").innerHTML = mp1;
	document.getElementsByName("s1mp")[0].value = mp1;
}