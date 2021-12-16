$(function() {
    $('.js_selectpicker').selectpicker();
});

////////////////////////////////////////////////////

const filterAdaptiveMenu = document.querySelector("#category__filter-adaptive-menu")
const filterAdaptiveMenuBtn = document.querySelector("#category__filter-adaptive-menu-btn")

filterAdaptiveMenuBtn.addEventListener(('click'), (e) => {
    filterAdaptiveMenu.classList.toggle("category__filter-adaptive-menu--active")
})

///////////////////////////////////////////////////

const categoryCardBtns = document.querySelectorAll(".add-to-favorite-btn")

categoryCardBtns.forEach((btn) => {
    btn.addEventListener(('click'), (e) => {
        btn.classList.toggle("add-to-favorite-btn--active")
    })
})

////////////////////////////////////////////////////

const filterBoxBtns = document.querySelectorAll(".filter-box__btn")
const resetFilterBtns = document.querySelectorAll(".filter-box__reset-btn")

filterBoxBtns.forEach((btn) => {
    btn.addEventListener(('click'), (e) => {
        btn.classList.toggle("filter-box__btn--active")
    })
})

resetFilterBtns.forEach((btn) => {
    console.log("foreach")
    btn.addEventListener(('click'), (e) => {
        filterBoxBtns.forEach((btn) => {
            btn.classList.remove("filter-box__btn--active")
        })
    })
})