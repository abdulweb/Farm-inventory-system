/*=========================================================================================
    File Name: clndr.js
    Description: clndr
    --------------------------------------------------------------------------------------
    Item Name: Modern Admin - Clean Bootstrap 4 Dashboard HTML Template
   Version: 3.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(document).ready(function() {
  var currentMonth = moment().format("YYYY-MM");
  var nextMonth = moment()
    .add("month", 1)
    .format("YYYY-MM");

  var events = [
    {
      date: currentMonth + "-" + "10",
      title: "Persian Kitten Auction",
      location: "Center for Beautiful Cats"
    },
    {
      date: currentMonth + "-" + "19",
      title: "Cat Frisbee",
      location: "Jefferson Park"
    },
    {
      date: currentMonth + "-" + "23",
      title: "Kitten Demonstration",
      location: "Center for Beautiful Cats"
    },
    {
      date: nextMonth + "-" + "07",
      title: "Small Cat Photo Session",
      location: "Center for Cat Photography"
    }
  ];

  /****************************************
   *				Multiday				*
   ****************************************/
  var multidayArray = [
    {
      title: "Appointment Day 1",
      location: "Appointment with a patient at 5:00pm",
      startDate: moment().format("YYYY-MM-") + "12",
      endDate: moment().format("YYYY-MM-") + "17"
    },
    {
      title: "Appointment Day 2",
      location:
        "Appointment With a patient For Consultation about Skin Problems",
      startDate: moment().format("YYYY-MM-") + "24",
      endDate: moment().format("YYYY-MM-") + "27"
    }
  ];

  $("#clndr-multiday").clndr({
    template: $("#clndr-template").html(),
    events: multidayArray,
    multiDayEvents: {
      endDate: "endDate",
      startDate: "startDate"
    }
  });

  // Map
  new GMaps({
    div: "#basic-map",
    lat: 40.758896,
    lng: -73.98513,
    zoom: 19,
    height: 400,
    mapTypeControl: false,
    zoomControl: false,
    scaleControl: true,
    fullscreenControl: false
  });
});
