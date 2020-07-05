"use strict";

// 以下は成功
// var request = new XMLHttpRequest();

// // Open a new connection, using the GET request on the URL endpoint
// request.open(
//   "GET",
//   "https://api.themoviedb.org/3/search/movie?api_key=e160fb82cbbfe85d24559cb058f95a3c&language=en-US&query=parasite&page=1&include_adult=false&year=2019",
//   true
// );

// request.onload = function () {
//   // Begin accessing JSON data here
//   var data = this.response;
//   console.log(data);
// };

// // Send request
// request.send();

// // Begin accessing JSON data　23行目がエラーになる
// var data = JSON.parse(this.response);

// data.forEach((movie) => {
//   // Log each movie's title
//   console.log(movie.title);
// });

// ajaxで
$.ajax({
  url:
    "https://api.themoviedb.org/3/search/movie?api_key=e160fb82cbbfe85d24559cb058f95a3c&language=en-US&page=1&include_adult=false",
  data: {
    query: "parasite",
    year: "2019",
  },
})

  .done(function (data) {
    console.log(data);
  })

  .fail(function () {
    console.log("$.ajax failed");
  });
