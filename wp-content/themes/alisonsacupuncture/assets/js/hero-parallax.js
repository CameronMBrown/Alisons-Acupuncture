;(function () {
  // --- CONFIG: adjust these values ---
  var SCROLL_RANGE = 1000 // px scrolled past hero top for full animation
  var TRANSLATE_LEFT_1 = 100 // trees-1 moves left (px) — least
  var TRANSLATE_LEFT_2 = 200 // trees-2 moves left (px) — most
  var TRANSLATE_RIGHT_3 = 120 // trees-3 moves right (px) — least
  var TRANSLATE_RIGHT_4 = 250 // trees-4 moves right (px) — most

  // --- DOM ---
  var hero = document.getElementById("hero")
  if (!hero) return

  var img1 = hero.querySelector(".trees-1 img")
  var img2 = hero.querySelector(".trees-2 img")
  var img3 = hero.querySelector(".trees-3 img")
  var img4 = hero.querySelector(".trees-4 img")

  if (!img1 || !img2 || !img3 || !img4) return

  // --- SCROLL ---
  var offsetTop = hero.offsetTop

  function update() {
    var scrollY = window.pageYOffset || document.documentElement.scrollTop
    var raw = (scrollY - offsetTop) / SCROLL_RANGE
    var p = Math.max(0, Math.min(1, raw))

    img1.style.transform = "translateX(-" + TRANSLATE_LEFT_1 * p + "px)"
    img2.style.transform = "translateX(-" + TRANSLATE_LEFT_2 * p + "px)"
    img3.style.transform = "translateX(" + TRANSLATE_RIGHT_3 * p + "px)"
    img4.style.transform = "translateX(" + TRANSLATE_RIGHT_4 * p + "px)"
  }

  var ticking = false
  window.addEventListener("scroll", function () {
    if (!ticking) {
      requestAnimationFrame(function () {
        update()
        ticking = false
      })
      ticking = true
    }
  })

  update()
})()
