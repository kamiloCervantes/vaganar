(function($) {
	$.fn.stopwatch = function() {
		var clock = this;
		var timer = 0;
		
		clock.addClass('stopwatch');
		
		//console.log(clock);
		
		// This is bit messy, but IE is a crybaby and must be coddled. 
		clock.html('<div class="display"><p style="display:inline">Tiempo de reto:</p> <span class="hr">00</span>:<span class="min">00</span>:<span class="sec">00</span></div>');
		clock.append('<input type="hidden" class="start" value="Start" />');
		clock.append('<input type="hidden" class="stop" value="Stop" />');
		clock.append('<input type="hidden" class="reset" value="Reset" />');
		
		//console.log(clock.html());
		
		// We have to do some searching, so we'll do it here, so we only have to do it once.
		var h = clock.find('.hr');
		var m = clock.find('.min');
		var s = clock.find('.sec');
		var start = clock.find('.start');
		var stop = clock.find('.stop');
		var reset = clock.find('.reset');
		
		stop.hide();

		start.bind('click', function() {
			timer = setInterval(do_time, 1000);
			stop.show();
			start.hide();
		});
		
		stop.bind('click', function() {
			clearInterval(timer);
			timer = 0;
			start.show();
			stop.hide();
		});
		
		reset.bind('click', function() {
			clearInterval(timer);
			timer = 0;
			h.html("00");
			m.html("00");
			s.html("00");
			stop.hide();
			start.show();
		});
		
		function do_time() {
			// parseInt() doesn't work here...
			hour = parseFloat(h.text());
			minute = parseFloat(m.text());
			second = parseFloat(s.text());
			
			second++;
			
			if(second > 59) {
				second = 0;
				minute = minute + 1;
			}
			if(minute > 59) {
				minute = 0;
				hour = hour + 1;
			}
			
			h.html("0".substring(hour >= 10) + hour);
			m.html("0".substring(minute >= 10) + minute);
			s.html("0".substring(second >= 10) + second);
		}
	};
})(jQuery);