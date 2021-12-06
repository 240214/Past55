$(function() {
    $('.js_selectpicker').selectpicker();
});

const filterAdaptiveMenu = document.querySelector("#category__filter-adaptive-menu")
const filterAdaptiveMenuBtn = document.querySelector("#category__filter-adaptive-menu-btn")

filterAdaptiveMenuBtn.addEventListener(('click'), (e) => {
    console.log(e)
    filterAdaptiveMenu.classList.toggle("category__filter-adaptive-menu--active")
})