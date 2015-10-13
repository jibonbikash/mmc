/**
 * Created by Mazba on 6/1/15.
 */
(function($) {
// FOR showing the date
var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
var hour = ['12 AM','1 AM','2 AM','3 AM','4 AM','5 AM','6 AM','7 AM','8 AM','9 AM','10 AM','11 AM',
           '12 PM','1 PM','2 PM','3 PM','4 PM','5 PM','6 PM','7 PM','8 PM','9 PM','10 PM','11 PM'
            ];
Date.prototype.getMonthName = function() {
    return months[ this.getMonth() ];
};
Date.prototype.getDayName = function() {
    return days[ this.getDay() ];
};

// add 0 if the time single number
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
// interval function
function startTime() {
//    var today = new Date();
//    var h = today.getHours();
//    var m = today.getMinutes();
//    var s = today.getSeconds();
//
//    var date = today.getDate();
//    var dayName = today.getDayName();
//    var month = today.getMonthName();
//    var year = today.getFullYear();
//
//    // add a zero in front of numbers<10
//    m = checkTime(m);
//    s = checkTime(s);
//
//    document.getElementById('time-info').innerHTML = dayName+', '+month+', '+date+' '+year+' at '+hour[h]+': '+m+': '+s;
//
//    t = setTimeout(function () {
//        startTime()
//    }, 500);
}
startTime();

}(jQuery));