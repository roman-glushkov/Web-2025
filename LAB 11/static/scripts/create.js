document.addEventListener("DOMContentLoaded", function () {
  const fileInput = document.getElementById("fileInput");
  const uploadButton1 = document.getElementById("uploadButton1");
  const uploadButton2 = document.getElementById("uploadButton2");
  const uploadArea = document.getElementById("uploadArea");
  const emptyState = document.getElementById("emptyState");
  const imageSlider = document.getElementById("imageSlider");
  const shareButton = document.getElementById("shareButton");
  const captionInput = document.getElementById("captionInput");

  let images = [];
  let currentSlideIndex = 0;
  let captionText = "";
  uploadButton1.addEventListener("click", function (e) {
    e.stopPropagation();
    fileInput.click();
  });
  uploadButton2.addEventListener("click", function () {
    fileInput.click();
  });
  captionInput.addEventListener("input", function () {
    captionText = this.value.trim();
    updateShareButton();
  });

  fileInput.addEventListener("change", function (e) {
    const files = Array.from(e.target.files);
    if (files.length === 0) return;

    files.forEach((file) => {
      if (!file.type.match("image.*")) {
        alert("Пожалуйста, выберите только изображения");
        return;
      }

      const reader = new FileReader();
      reader.onload = function (event) {
        images.push(event.target.result);
        currentSlideIndex = images.length - 1;
        updateSlider();
        updateEmptyState();
        updateShareButton();
      };
      reader.readAsDataURL(file);
    });
  });

  function updateSlider() {
    imageSlider.innerHTML = "";

    if (images.length === 0) {
      imageSlider.style.display = "none";
      return;
    }
    emptyState.style.display = "none";
    imageSlider.style.display = "block";

    images.forEach((imgSrc, index) => {
      const slide = document.createElement("div");
      slide.className = `post__slide ${
        index === currentSlideIndex ? "active" : ""
      }`;
      slide.innerHTML = `<img src="${imgSrc}" alt="Загруженное изображение" />`;
      imageSlider.appendChild(slide);
    });

    if (images.length > 1) {
      const indicator = document.createElement("div");
      indicator.className = "post__slider-indicator";
      indicator.innerHTML = `<span class="current-slide">${
        currentSlideIndex + 1
      }</span>/<span class="total-slides">${images.length}</span>`;
      imageSlider.appendChild(indicator);

      const prevButton = document.createElement("button");
      prevButton.className = "post__slider-button post__slider-button--prev";
      prevButton.addEventListener("click", (e) => {
        e.stopPropagation();
        navigateSlide(-1);
      });
      imageSlider.appendChild(prevButton);

      const nextButton = document.createElement("button");
      nextButton.className = "post__slider-button post__slider-button--next";
      nextButton.addEventListener("click", (e) => {
        e.stopPropagation();
        navigateSlide(1);
      });
      imageSlider.appendChild(nextButton);
    }
  }

  function navigateSlide(direction) {
    const slides = document.querySelectorAll(".post__slide");
    if (slides.length === 0) return;

    const newIndex =
      (currentSlideIndex + direction + images.length) % images.length;

    slides[currentSlideIndex].classList.remove("active");
    slides[newIndex].classList.add("active");
    currentSlideIndex = newIndex;

    const currentSlideElement = document.querySelector(".current-slide");
    if (currentSlideElement) {
      currentSlideElement.textContent = newIndex + 1;
    }
  }

  function updateEmptyState() {
    emptyState.style.display = images.length === 0 ? "flex" : "none";
  }

  function updateShareButton() {
    const hasImages = images.length > 0;
    const hasText = captionText.length > 0;

    if (hasImages && hasText) {
      shareButton.classList.add("active");
      shareButton.disabled = false;
    } else {
      shareButton.classList.remove("active");
      shareButton.disabled = true;
    }
  }

  shareButton.addEventListener("click", function () {
    if (!this.disabled) {
      const postData = {
        images: images,
        caption: captionText,
        timestamp: new Date().toISOString(),
        imageCount: images.length,
        firstImagePreview: images[0].substring(0, 50) + "...",
      };

      console.group("Новый пост создан");
      console.log("Текст подписи:", postData.caption);
      console.log("Количество изображений:", postData.imageCount);
      console.log("Метка времени:", postData.timestamp);
      console.log("Превью первого изображения:", postData.firstImagePreview);
      console.log("Полные данные поста:", postData);
      console.groupEnd();

      images = [];
      currentSlideIndex = 0;
      captionInput.value = "";
      captionText = "";
      fileInput.value = "";

      updateSlider();
      updateEmptyState();
      updateShareButton();

      alert("Пост успешно создан!\nДанные выведены в консоль разработчика.");
    }
  });

  updateShareButton();
});
