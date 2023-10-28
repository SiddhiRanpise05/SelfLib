document.addEventListener("DOMContentLoaded", function() {
  var currentIndex = 0;
  var images = document.querySelectorAll(".carousel img");
  var previousBtn = document.createElement("span");
  var nextBtn = document.createElement("span");

  previousBtn.className = "carousel-btn previous";
  nextBtn.className = "carousel-btn next";
  previousBtn.innerHTML = "&#10094;";
  nextBtn.innerHTML = "&#10095;";

  previousBtn.addEventListener("click", showPreviousImage);
  nextBtn.addEventListener("click", showNextImage);

  document.querySelector(".carousel").appendChild(previousBtn);
  document.querySelector(".carousel").appendChild(nextBtn);

  showImage(currentIndex);

  function showImage(index) {
    if (index >= images.length) {
      currentIndex = 0;
    } else if (index < 0) {
      currentIndex = images.length - 1;
    } else {
      currentIndex = index;
    }

    for (var i = 0; i < images.length; i++) {
      images[i].classList.remove("active");
    }

    images[currentIndex].classList.add("active");
  }

  function showPreviousImage() {
    showImage(currentIndex - 1);
  }

  function showNextImage() {
    showImage(currentIndex + 1);
  }
});
