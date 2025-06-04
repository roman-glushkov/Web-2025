document.addEventListener("DOMContentLoaded", function () {
  // Получаем элементы DOM
  const fileInput = document.getElementById("fileInput");
  const uploadButton1 = document.getElementById("uploadButton1");
  const uploadButton2 = document.getElementById("uploadButton2");
  const uploadArea = document.getElementById("uploadArea");
  const emptyState = document.getElementById("emptyState");
  const imageSlider = document.getElementById("imageSlider");
  const shareButton = document.getElementById("shareButton");
  const captionInput = document.getElementById("captionInput");

  let images = []; // Массив для хображений в формате base64
  let currentSlideIndex = 0; // Индекс текущего слайда
  let captionText = ""; // Текст подписи к посту

  // Обработчики для кнопок загрузки изображений
  uploadButton1.addEventListener("click", function (e) {
    e.stopPropagation();
    fileInput.click();
  });

  uploadButton2.addEventListener("click", function () {
    fileInput.click();
  });

  // Обработчик ввода текста подписи
  captionInput.addEventListener("input", function () {
    captionText = this.value.trim();
    updateShareButton(); // Обновляем состояние кнопки
  });

  // Обработчик выбора файлов
  fileInput.addEventListener("change", function (e) {
    const files = Array.from(e.target.files);
    if (files.length === 0) return;

    files.forEach((file) => {
      // Проверяем тип файла (только изображения)
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

  // Функция обновления слайдера
  function updateSlider() {
    // Очищаем слайдер
    imageSlider.innerHTML = "";

    if (images.length === 0) {
      imageSlider.style.display = "none";
      return;
    }

    // Показываем слайдер
    emptyState.style.display = "none";
    imageSlider.style.display = "block";

    // Создаем слайды для всех изображений
    images.forEach((imgSrc, index) => {
      const slide = document.createElement("div");
      slide.className = `post__slide ${
        index === currentSlideIndex ? "active" : ""
      }`;
      slide.innerHTML = `<img src="${imgSrc}" alt="Загруженное изображение" />`;
      imageSlider.appendChild(slide);
    });

    // Добавляем элементы управления если изображений > 1
    if (images.length > 1) {
      // Индикатор текущего слайда
      const indicator = document.createElement("div");
      indicator.className = "post__slider-indicator";
      indicator.innerHTML = `<span class="current-slide">${
        currentSlideIndex + 1
      }</span>/<span class="total-slides">${images.length}</span>`;
      imageSlider.appendChild(indicator);

      // Кнопка "назад"
      const prevButton = document.createElement("button");
      prevButton.className = "post__slider-button post__slider-button--prev";
      prevButton.addEventListener("click", (e) => {
        e.stopPropagation();
        navigateSlide(-1);
      });
      imageSlider.appendChild(prevButton);

      // Кнопка "вперед"
      const nextButton = document.createElement("button");
      nextButton.className = "post__slider-button post__slider-button--next";
      nextButton.addEventListener("click", (e) => {
        e.stopPropagation();
        navigateSlide(1);
      });
      imageSlider.appendChild(nextButton);
    }
  }

  // Функция навигации по слайдам
  function navigateSlide(direction) {
    const slides = document.querySelectorAll(".post__slide");
    if (slides.length === 0) return;

    const newIndex =
      (currentSlideIndex + direction + images.length) % images.length;

    slides[currentSlideIndex].classList.remove("active");
    slides[newIndex].classList.add("active");
    currentSlideIndex = newIndex;

    // Обновляем индикатор
    const currentSlideElement = document.querySelector(".current-slide");
    if (currentSlideElement) {
      currentSlideElement.textContent = newIndex + 1;
    }
  }

  // Функция обновления состояния "пусто"
  function updateEmptyState() {
    emptyState.style.display = images.length === 0 ? "flex" : "none";
  }

  // Функция обновления состояния кнопки "Поделиться"
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

  // Обработчик кнопки "Поделиться"
  shareButton.addEventListener("click", function () {
    if (!this.disabled) {
      // Создаем объект поста
      const postData = {
        images: images,
        caption: captionText,
        timestamp: new Date().toISOString(),
        imageCount: images.length,
        firstImagePreview: images[0].substring(0, 50) + "...",
      };

      // Выводим информацию в консоль
      console.group("Новый пост создан");
      console.log("Текст подписи:", postData.caption);
      console.log("Количество изображений:", postData.imageCount);
      console.log("Метка времени:", postData.timestamp);
      console.log("Превью первого изображения:", postData.firstImagePreview);
      console.log("Полные данные поста:", postData);
      console.groupEnd();

      // Очищаем форму
      images = [];
      currentSlideIndex = 0;
      captionInput.value = "";
      captionText = "";
      fileInput.value = "";

      // Обновляем UI
      updateSlider();
      updateEmptyState();
      updateShareButton();

      // Показываем уведомление
      alert("Пост успешно создан!\nДанные выведены в консоль разработчика.");
    }
  });

  // Инициализация состояния кнопки при загрузке
  updateShareButton();
});
