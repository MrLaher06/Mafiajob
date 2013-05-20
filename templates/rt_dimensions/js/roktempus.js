window.onload = function() {
	if (document.body.id == '') {

	
			datetoday = new Date();
			timenow=datetoday.getTime();
			datetoday.setTime(timenow);
			thehour = datetoday.getHours();

			if (thehour >= 20)
			 timeofday = "night";
			else if (thehour >= 17)
			 timeofday = "dusk";
			else if (thehour >= 9)
			 timeofday = "day";
			else if (thehour >= 5)
			 timeofday = "dawn";
			else
			 timeofday = "night";

			document.body.id=timeofday;
	}
};
