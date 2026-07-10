;(function () {
  "use strict"

  // Switch the active contact/booking panel by its data-panel name.
  function activatePanel(panelName) {
    document.querySelectorAll(".contact-toggle-btn").forEach(function (btn) {
      var isMatch = btn.getAttribute("data-panel") === panelName
      btn.classList.toggle("is-active", isMatch)
      btn.setAttribute("aria-selected", isMatch ? "true" : "false")
    })
    document.querySelectorAll(".contact-panel").forEach(function (panel) {
      panel.classList.toggle("is-active", panel.getAttribute("data-panel") === panelName)
    })
  }

  document.addEventListener("DOMContentLoaded", function () {
    // Contact / Book Appointment toggle
    document.querySelectorAll(".contact-toggle-btn").forEach(function (btn) {
      btn.addEventListener("click", function () {
        activatePanel(this.getAttribute("data-panel"))
      })
    })
  })
})()
