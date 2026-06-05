;(function () {
  "use strict"

  var DAYS = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"]

  function getNextDateForDay(dayLabel) {
    var targetIndex = DAYS.indexOf(dayLabel.toLowerCase())
    if (targetIndex === -1) return null

    var today = new Date()
    today.setHours(0, 0, 0, 0)

    var minDate = new Date(today)
    minDate.setDate(minDate.getDate() + 7)

    var currentDayIndex = minDate.getDay()
    var daysUntilTarget = targetIndex - currentDayIndex
    if (daysUntilTarget <= 0) {
      daysUntilTarget += 7
    }

    var result = new Date(minDate)
    result.setDate(minDate.getDate() + daysUntilTarget)
    return result
  }

  function formatDate(date) {
    return date.toLocaleDateString("en-US", {
      month: "long",
      day: "numeric",
      year: "numeric",
    })
  }

  function getAdjustedHours(hoursStr) {
    var parts = hoursStr.split(" - ")
    if (parts.length !== 2) return hoursStr

    var openStr = parts[0].trim()
    var closeStr = parts[1].trim()

    var closeMatch = closeStr.match(/(\d+):(\d+)\s*(AM|PM)/i)
    if (!closeMatch) return hoursStr

    var hour = parseInt(closeMatch[1], 10)
    var minute = parseInt(closeMatch[2], 10)
    var ampm = closeMatch[3].toUpperCase()

    // Convert to 24-hour
    if (ampm === "PM" && hour !== 12) hour += 12
    if (ampm === "AM" && hour === 12) hour = 0

    // Subtract 1 hour
    hour -= 1
    if (hour < 0) hour += 24

    // Convert back to 12-hour
    var newAmpm = hour >= 12 ? "PM" : "AM"
    var newHour = hour % 12
    if (newHour === 0) newHour = 12

    var minuteStr = String(minute)
    if (minute < 10) minuteStr = "0" + minuteStr

    return openStr + " - " + newHour + ":" + minuteStr + " " + newAmpm
  }

  function toggleButtons() {
    var textarea = document.getElementById("contact-message")
    if (!textarea) return

    var hasContent = textarea.value.trim() !== ""
    document.querySelectorAll(".hours-book-btn").forEach(function (btn) {
      btn.style.display = hasContent ? "none" : ""
    })
  }

  document.addEventListener("DOMContentLoaded", function () {
    var textarea = document.getElementById("contact-message")

    if (textarea) {
      textarea.addEventListener("input", toggleButtons)
      toggleButtons()
    }

    document.querySelectorAll(".hours-book-btn").forEach(function (btn) {
      btn.addEventListener("click", function () {
        if (textarea && textarea.value.trim() !== "") return

        var dayLabel = this.getAttribute("data-day-label")
        var tr = this.closest("tr")
        var hours = tr ? tr.getAttribute("data-hours") : ""
        var nextDate = getNextDateForDay(dayLabel)

        if (!nextDate || !hours || !textarea) return

        var dateStr = formatDate(nextDate)
        var adjustedHours = getAdjustedHours(hours)
        var message =
          "Hello, \nI would like to book an appointment for next " +
          dayLabel +
          " on " +
          dateStr +
          " sometime between " +
          adjustedHours +
          ". \nThanks!"

        document.getElementById("contact").scrollIntoView({ behavior: "smooth" })

        setTimeout(function () {
          textarea.value = message
          textarea.focus()
          toggleButtons()
        }, 500)
      })
    })
  })
})()
