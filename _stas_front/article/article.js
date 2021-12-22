const articleContentBtn = document.querySelector(".article-content__open-tab-btn")
const articleAuthorBtn = document.querySelector(".article-author__open-tab-btn")

articleContentBtn.addEventListener(('click'), (e) => {
    articleContentBtn.classList.toggle("article-content__open-tab-btn--active")
})

articleAuthorBtn.addEventListener(('click'), (e) => {
    articleAuthorBtn.classList.toggle("article-author__open-tab-btn--active")
})