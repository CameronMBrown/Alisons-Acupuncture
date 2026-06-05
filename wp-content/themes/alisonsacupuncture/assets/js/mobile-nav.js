;(function () {
  var menuToggle = document.getElementById('menu-toggle')
  var nav = document.getElementById('site-navigation')

  if (!menuToggle || !nav) return

  document.querySelectorAll('.menu a').forEach(function (link) {
    link.addEventListener('click', function () {
      menuToggle.checked = false
    })
  })

  document.addEventListener('click', function (e) {
    if (menuToggle.checked && !nav.contains(e.target)) {
      menuToggle.checked = false
    }
  })
})()
