// Menu aparecer desaparecer

const img = document.querySelector(".menu");
const menu = document.getElementById("menu");
const manuAparecer = document.getElementById("aparecer");
const media = window.matchMedia("(min-width: 1024px)");
const genderHeader = document.getElementById("gender-header");

function mirarTamaño(media) {
  if (media.matches) {
    manuAparecer.style.display = "none";
    genderHeader.style.display = "flex";
    menu.style.display = "flex";
  } else {
    menu.style.display = "none";
    genderHeader.style.display = "none";
    manuAparecer.style.display = "none";
  }
}

mirarTamaño(media);

media.addEventListener("change", mirarTamaño);

img.addEventListener("click", () => {
  let styleMenu = window.getComputedStyle(manuAparecer);
  if (styleMenu.getPropertyValue("display") === "none") {
    manuAparecer.style.display = "flex";
    manuAparecer.style.flexDirection = "row";
    manuAparecer.style.justifyContent = "center";
    menu.style.display = "none";
  } else if (styleMenu.getPropertyValue("display") === "flex") {
    manuAparecer.style.display = "none";
    genderHeader.style.display = "none";
  }
});

// Tema claro o oscuro

const tema = document.getElementById("cambiar-tema-container");
let temaOscuro = localStorage.getItem("tema");

if (temaOscuro === "true") {
    document.documentElement.classList.add("dark");
} else {
    document.documentElement.classList.remove("dark");
}

tema.addEventListener("click", () => cambiarTema());

function cambiarTema() {
    if (temaOscuro === "true") {
        document.documentElement.classList.remove("dark");
        localStorage.setItem("tema", "false");
    } else {
        document.documentElement.classList.add("dark");
        localStorage.setItem("tema", "true");
    }
    location.reload()
}

// Dropdown button

function dropdown(svgElement) {
  var dropdownContent = svgElement.parentNode.parentNode.querySelector(".dropdown-content");
  var allDropdowns = document.getElementsByClassName("dropdown-content");

  for (var i = 0; i < allDropdowns.length; i++) {
    var openDropdown = allDropdowns[i];
    openDropdown !== dropdownContent && openDropdown.classList.contains("show") ? openDropdown.classList.remove("show") : "";
  } 

  dropdownContent.classList.toggle("show");
}

window.onclick = function (event) {
  if (!event.target.matches(".drop-button") && !event.target.matches(".pathDropdown")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
};

// Update Dates Client

const asideItems = document.querySelectorAll("#asideContent ul li");

function showContent(id) {
    const contentItems = document.querySelectorAll("#contentDatesClient > div, #contentCambiarContraseña, #contentMetodosPago");
    contentItems.forEach(function(contentItem) {
        contentItem.classList.remove("show");
        contentItem.classList.add("hide");
    });
    
    const contentToShow = document.getElementById("content" + id);
    contentToShow.classList.add("show");
    contentToShow.classList.remove("hide");
}

asideItems.forEach(function(item) {
    item.addEventListener("click", function() {
        const id = this.id;
        localStorage.setItem("currentPage", id);
        showContent(id);
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const currentPage = localStorage.getItem("currentPage");
    if (currentPage) {
        showContent(currentPage);
    }
});

// Change Password

let openModalBtn = document.getElementById("openModalBtn");
let modal = document.getElementById("myModal");
let closeModalBtn = document.getElementById("closeModalBtn");
const modalContent = document.getElementById("editPasswordForm");

openModalBtn.addEventListener("click", function() {
    modal.style.display = "block";
});

closeModalBtn.addEventListener("click", function() {
    modal.style.display = "none";
});

document.addEventListener("click", function(event) {
  if (event.target && event.target.id === "openModalBtn") {
      modal.style.display = "block";
      modalContent.style.display = "block";
  }
});

// Add comment

let openModalBtnComment = document.getElementById("openModalBtnComment");
let modalComment = document.getElementById("myModalComment");
let closeModalBtnComment = document.getElementById("closeModalBtnComment");
const modalContentComment = document.querySelector(".modal-content-comment");

openModalBtnComment.addEventListener("click", function() { 
  modalComment.style.display = "block";
});

closeModalBtnComment.addEventListener("click", function() { 
  modalComment.style.display = "none";
});

document.addEventListener("click", function(event) {
  if (event.target && event.target.id === "openModalBtnComment") {
      modalComment.style.display = "block";
      modalContentComment.style.display = "block";
  }
});

// Alto Ajustable de Cesta

if (document.getElementById('cistella')) {
  console.log('El elemento "cistella" existe.');
}

// // Animacion entrar pagina que salga el elemento y modificaciones grid

document.addEventListener("DOMContentLoaded", function () {
  if (document.querySelector("header")) {
    setTimeout(function () {
      document.querySelector("#banner").classList.add("visible");
      document.querySelector("header").classList.add("visible");
    }, 100);
  }
});

// Animacion mientras haces scroll que vayan apareciendo

document.addEventListener("DOMContentLoaded", function () {
  const animatedElements = document.querySelectorAll(".animation");

  window.addEventListener("scroll", () => {
    handleScroll(animatedElements);
  });

  function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return rect.top <= window.innerHeight * 0.8 && rect.bottom >= 0;
  }

  function handleScroll(elements) {
    elements.forEach((element) => {
      const animationDirection = element.classList.contains(
        "animated-section-left-right"
      )
        ? "left_right"
        : element.classList.contains("animated-section-right-left")
        ? "right_left"
        : "down_up";

      if (isInViewport(element)) {
        element.classList.add("visible");
      }
    });
  }
});