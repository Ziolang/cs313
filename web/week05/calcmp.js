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
	if (document.getElementsByName("s2dmg")[0].value >= 100) {
		temp = (document.getElementsByName("s2dmg")[0].value - 100) / 10;

		if (document.getElementsByName("s2dmg")[0].value >= 200)
			temp *= 2;

		mp2 += temp;
		temp = 0;
	}

	if (document.getElementsByName("s1status")[0].value != 0) {mp1 += 2;}
	if (document.getElementsByName("s2status")[0].value != 0) {mp2 += 2;}
	
	if (document.getElementsByName("s1buff")[0].value != 0) {
		temp = document.getElementsByName("s1buffamt")[0].value / 10;
		string = "" + document.getElementsByName("s1buffstat")[0].value;
		if (string.length > 3) {
			temp *= 2;
		}

		mp1 += temp;
		temp = 0;
	}
}