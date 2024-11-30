$(document).ready(function () {
  // navigation section
  if (window.innerWidth <= 770) {
    $(".nav-btn").on("click", function () {
      $(".navigation").removeClass("md-max:-left-full");
      $(".navigation").addClass("md-max:left-0");
    });

    $(".navigation, .nav-close").on("click", function (e) {
      if (
        $(".navigation").children("*").is(e.target) ||
        $(".navigation").children("*").children("*").is(e.target) ||
        $(".navigation").children("*").children("*").children("*").is(e.target)
      ) {
      } else {
        $(".navigation").removeClass("md-max:left-0");
        $(".navigation").addClass("md-max:-left-full");
      }
    });

  }

  // Hero title slider
  const titles = ["Supply Chain", "Financing", "Agriculture"];
  let index = 0;

  function showTitle() {
    setTimeout(() => {
      $(".hero-title").removeClass("scale-100").addClass("scale-0");
    }, 500);

    setTimeout(() => {
      $(".hero-title")
        .html(titles[index])
        .removeClass("scale-0")
        .addClass("scale-100");

      index = (index + 1) % titles.length;
    }, 1000);
  }

  setInterval(showTitle, 3000);
});


document.querySelectorAll(".counter").forEach((element) => {
  let value = parseFloat(element.getAttribute('data-count'));
  let end = parseFloat(element.getAttribute("data-end"));
  let increment = parseFloat(element.getAttribute("data-increment"));
  let interval = parseFloat(element.getAttribute("data-interval"));

  let intervalId = setInterval(() => {
    value += increment;
    element.innerHTML = value;

    if(value >= end)
        clearInterval(intervalId);

  }, 10);
});
