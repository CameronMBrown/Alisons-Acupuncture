;(function () {
  // Respect the user's OS "reduce motion" setting — skip parallax entirely.
  if (
    window.matchMedia &&
    window.matchMedia("(prefers-reduced-motion: reduce)").matches
  )
    return

  var MAX_TRANSLATE = 300

  var section = document.getElementById("about")
  if (!section) return

  var bg = section.querySelector(".about-bg")
  if (!bg) return

  function update() {
    var rect = section.getBoundingClientRect()
    var vh = window.innerHeight
    if (rect.bottom < 0 || rect.top > vh) return
    var raw = (vh - rect.top) / (rect.height + vh)
    var p = Math.max(0, Math.min(1, raw))
    bg.style.transform = "translateY(" + -p * MAX_TRANSLATE + "px)"
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
