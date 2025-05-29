document.addEventListener("DOMContentLoaded", function () {
  // Инициализация слайдеров в ленте
  document.querySelectorAll(".post__slider").forEach((slider) => {
    const slides = slider.querySelectorAll(".post__slide");
    if (slides.length <= 1) return;

    const prevBtn = slider.querySelector(".post__slider-button--prev");
    const nextBtn = slider.querySelector(".post__slider-button--next");
    const currentSlide = slider.querySelector(".current-slide");

    slider.dataset.currentIndex = "0";

    function updateSlider() {
      const currentIndex = parseInt(slider.dataset.currentIndex);
      slides.forEach((slide, index) => {
        slide.classList.toggle("active", index === currentIndex);
      });
      if (currentSlide) currentSlide.textContent = currentIndex + 1;
    }

    if (prevBtn && nextBtn) {
      prevBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        let currentIndex = parseInt(slider.dataset.currentIndex);
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        slider.dataset.currentIndex = currentIndex;
        updateSlider();
      });

      nextBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        let currentIndex = parseInt(slider.dataset.currentIndex);
        currentIndex = (currentIndex + 1) % slides.length;
        slider.dataset.currentIndex = currentIndex;
        updateSlider();
      });
    }

    slides.forEach((slide, index) => {
      slide.addEventListener("click", () => {
        openModal(slider.id, parseInt(slider.dataset.currentIndex));
      });
    });

    updateSlider();
  });

  // Инициализация модального окна
  const modal = document.getElementById("imageModal");
  const modalSlider = modal.querySelector(".modal__slider");

  document
    .querySelector(".modal__slider-button--prev")
    .addEventListener("click", function (e) {
      e.stopPropagation();
      navigateModalSlide(-1);
    });

  document
    .querySelector(".modal__slider-button--next")
    .addEventListener("click", function (e) {
      e.stopPropagation();
      navigateModalSlide(1);
    });

  document.querySelector(".modal__close").addEventListener("click", closeModal);

  // Закрытие модального окна по ESC
  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
      closeModal();
    }
  });
});

// Модальное окно
let currentModalImages = [];
let currentModalIndex = 0;
let activePostSlider = null;

function openModal(sliderId, activeIndex) {
  const slider = document.getElementById(sliderId);
  if (!slider) return;

  const slides = slider.querySelectorAll(".post__slide");
  const images = Array.from(slides).map(
    (slide) => slide.querySelector("img").src
  );

  // Скрываем элементы управления слайдера
  activePostSlider = slider;
  const prevBtn = slider.querySelector(".post__slider-button--prev");
  const nextBtn = slider.querySelector(".post__slider-button--next");
  const indicator = slider.querySelector(".post__slider-indicator");

  if (prevBtn) prevBtn.style.display = "none";
  if (nextBtn) nextBtn.style.display = "none";
  if (indicator) indicator.style.display = "none";

  const modal = document.getElementById("imageModal");
  const modalSlider = modal.querySelector(".modal__slider");
  const modalCurrentSlide = modal.querySelector("#modalCurrentSlide");
  const modalTotalSlides = modal.querySelector("#modalTotalSlides");

  modalSlider.innerHTML = "";

  images.forEach((imgSrc, index) => {
    const slide = document.createElement("div");
    slide.className = `modal__slide ${index === activeIndex ? "active" : ""}`;
    slide.innerHTML = `<img src="${imgSrc}" alt="Увеличенное изображение поста" />`;
    modalSlider.appendChild(slide);
  });

  modalTotalSlides.textContent = images.length;
  modalCurrentSlide.textContent = activeIndex + 1;
  currentModalImages = images;
  currentModalIndex = activeIndex;
  modal.style.display = "flex";
  document.body.style.overflow = "hidden";
}

function closeModal() {
  const modal = document.getElementById("imageModal");
  modal.style.display = "none";
  document.body.style.overflow = "auto";

  if (activePostSlider) {
    const prevBtn = activePostSlider.querySelector(
      ".post__slider-button--prev"
    );
    const nextBtn = activePostSlider.querySelector(
      ".post__slider-button--next"
    );
    const indicator = activePostSlider.querySelector(".post__slider-indicator");

    if (prevBtn) prevBtn.style.display = "block";
    if (nextBtn) nextBtn.style.display = "block";
    if (indicator) indicator.style.display = "flex";

    activePostSlider = null;
  }
}

function navigateModalSlide(direction) {
  const slides = document.querySelectorAll(".modal__slide");
  if (slides.length === 0) return;

  const newIndex =
    (currentModalIndex + direction + slides.length) % slides.length;

  slides[currentModalIndex].classList.remove("active");
  slides[newIndex].classList.add("active");
  currentModalIndex = newIndex;
  document.getElementById("modalCurrentSlide").textContent = newIndex + 1;
}
