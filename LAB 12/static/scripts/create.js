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
        images.push({
          fileObject: file,
          preview: event.target.result,
        });

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

    images.forEach((imgData, index) => {
      const slide = document.createElement("div");
      slide.className = `post__slide ${
        index === currentSlideIndex ? "active" : ""
      }`;
      slide.innerHTML = `<img src="${imgData.preview}" alt="Загруженное изображение" />`;
      imageSlider.appendChild(slide);
    });

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

    prevButton.style.display = images.length > 1 ? "block" : "none";
    nextButton.style.display = images.length > 1 ? "block" : "none";
    indicator.style.display = images.length > 1 ? "flex" : "none";
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
      shareButton.style.cursor = "pointer";
      shareButton.style.backgroundColor = "#222222";
    } else {
      shareButton.classList.remove("active");
      shareButton.disabled = true;
      shareButton.style.cursor = "not-allowed";
      shareButton.style.backgroundColor = "#b4b4b4";
    }
  }
  function resetForm() {
    images = [];
    currentSlideIndex = 0;
    captionInput.value = "";
    captionText = "";
    fileInput.value = "";

    updateSlider();
    updateEmptyState();
    updateShareButton();
  }

  shareButton.addEventListener("click", async function () {
    if (!this.disabled) {
      const originalText = this.textContent;
      this.textContent = "Отправка...";
      this.disabled = true;

      try {
        const formData = new FormData();
        formData.append("caption", captionText);

        images.forEach((imgData) => {
          formData.append("images[]", imgData.fileObject);
        });

        const response = await fetch("api/save_post.php", {
          method: "POST",
          body: formData,
        });

        if (!response.ok) {
          throw new Error(`Ошибка сервера: ${response.status}`);
        }

        const result = await response.json();

        if (!result.success) {
          throw new Error(result.error || "Неизвестная ошибка сервера");
        }

        const messageContainer = document.getElementById("messageContainer");
        messageContainer.textContent = "Пост успешно сохранен!";
        messageContainer.className = "message-container success";
        messageContainer.style.display = "flex";
        document.getElementById("formContent").style.display = "none";

        resetForm();
      } catch (error) {
        const messageContainer = document.getElementById("messageContainer");
        messageContainer.textContent = `Ошибка: ${error.message}`;
        messageContainer.className = "message-container error";
        messageContainer.style.display = "block";

        this.textContent = originalText;
        this.disabled = false;
        updateShareButton();
      }
    }
  });
  updateShareButton();
});
