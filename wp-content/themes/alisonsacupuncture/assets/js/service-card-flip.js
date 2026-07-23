;(function () {
  // Matches the .service-card-inner transition duration in _services.scss.
  var LEG_MS = 300

  var reduceMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)",
  ).matches

  // Touch devices can fire synthetic mouseenter/mouseleave on tap, which
  // would fight with the click handler. Only wire up hover on devices that
  // have real hover + a fine pointer (i.e. not touch).
  var supportsHover = window.matchMedia(
    "(hover: hover) and (pointer: fine)",
  ).matches

  var cards = document.querySelectorAll(".service-card")

  cards.forEach(function (card) {
    var flipped = false
    // Set by click/keyboard activation. While locked, hover no longer
    // controls the flip state — only another click/keypress does.
    var locked = false
    var animating = false

    function setFlipped(next) {
      if (next === flipped || animating) return

      if (reduceMotion) {
        flipped = next
        card.classList.toggle("is-flipped", flipped)
        return
      }

      animating = true
      card.classList.add("is-squashing")

      setTimeout(function () {
        flipped = next
        card.classList.toggle("is-flipped", flipped)
        card.classList.remove("is-squashing")
      }, LEG_MS)

      setTimeout(function () {
        animating = false
      }, LEG_MS * 2)
    }

    function activate() {
      locked = !locked
      setFlipped(locked)
    }

    card.addEventListener("click", activate)

    card.addEventListener("keydown", function (e) {
      if (e.key === "Enter" || e.key === " ") {
        e.preventDefault()
        activate()
      }
    })

    if (supportsHover) {
      card.addEventListener("mouseenter", function () {
        if (!locked) setFlipped(true)
      })

      card.addEventListener("mouseleave", function () {
        if (!locked) setFlipped(false)
      })
    }
  })
})()
