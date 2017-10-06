
var d = new Date();
months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
month_days = [31,28,31,30,31,30,31,31,30,31,30,31];
days = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRU', 'SAT'];
month_init = d.getMonth(); //0-11
year_init = d.getFullYear();

/* Setting up calendar elements for easy access */

var calendar = [];

var weeks = [
  $('#week0')[0],
  $('#week1')[0],
  $('#week2')[0],
  $('#week3')[0],
  $('#week4')[0],
  $('#week5')[0],
]

$.each(weeks, function (i, v) {
  var week = [];

  $.each(v.children, function(j, w) {
    week.push(w);
  });

  calendar.push(week);
});

var currentMonth = new Month(year_init, month_init);

$('#addEvent').addClass("hide");
$('#logout_btn').addClass("hide");
$('#login').removeClass("hide");
$('#register').removeClass("hide");

function updateCalendar(){
  var month = currentMonth.month;
  var year = currentMonth.year;

  //weeks are the [][] for 6*7;
  var weeks = currentMonth.getWeeks();
  for (var w in weeks){
    var days = weeks[w].getDates();

    for (var d in days) {
      var day = days[d];
      var date = day.getDate();

      var tdObj = calendar[w][d];

      if (day.getMonth() != month) {
        tdObj.textContent = "";
      } else {
        tdObj.textContent = date;
        //tdObj.classList.remove('other-month');
      }
    }
  }

  if (weeks.length < 6){
    for (var d in days) {
      var tdObj = calendar[5][d];
      tdObj.textContent = "";
      tdObj.classList.add("hide");
    }
  }
  else {
    for (var d in days) {
      var tdObj = calendar[5][d];
      tdObj.classList.remove("hide");
    }
  }

  document.getElementById("display_month").textContent = "" + months[month] + " " + year;
}


document.getElementById("prev_month_btn").addEventListener('click', function(){
  currentMonth = currentMonth.prevMonth();
  updateCalendar();
}, false);

document.getElementById("next_month_btn").addEventListener('click', function(){
  currentMonth = currentMonth.nextMonth();
  updateCalendar();
}, false);

document.addEventListener("DOMContentLoaded", updateCalendar, false);
