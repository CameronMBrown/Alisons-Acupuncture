;(function () {
  // --- CONFIG ---
  var THRESHOLD = 0.15
  var VISIBLE_CLASS = "is-visible"

  // --- OBSERVER ---
  var targets = document.querySelectorAll(
    ".fade-in, .slide-in-left, .slide-in-right, .slide-in-bottom, .slide-in-top",
  )

  if (!targets.length) return

  console.log({ targets })

  var observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add(VISIBLE_CLASS)
          observer.unobserve(entry.target)
        }
      })
    },
    { threshold: THRESHOLD },
  )

  targets.forEach(function (el) {
    observer.observe(el)
  })
})()
