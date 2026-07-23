;(function () {
  'use strict'

  if (!window.dataLayer || typeof window.gtag !== 'function') return

  var SECTION_IDS = ['hero', 'hours', 'about', 'services', 'contact']

  function sectionLocation(el) {
    var section = el.closest(SECTION_IDS.map(function (id) { return '#' + id }).join(','))
    if (section) return section.id
    if (el.closest('.site-footer')) return 'footer'
    if (el.closest('.main-navigation')) return 'nav'
    return 'other'
  }

  function track(buttonName, location, priority) {
    gtag('event', 'button_click', {
      button_name: buttonName,
      button_location: location,
      priority: priority,
    })
  }

  document.addEventListener('click', function (e) {
    var el = e.target

    var bookNow = el.closest('#patient-cal-book-now-button')
    if (bookNow) {
      track('book_now', 'contact', 1)
      return
    }

    var phone = el.closest('.nav-phone-link, .call-now-mobile')
    if (phone) {
      track('call_phone', 'nav', 2)
      return
    }

    var heroCta = el.closest('.primary-cta')
    if (heroCta) {
      track('book_appointment_hero', 'hero', 3)
      return
    }

    var directions = el.closest('.js-office-directions-trigger')
    if (directions) {
      track('locate_office', 'hours', 4)
      return
    }

    var other = el.closest('button, a.btn')
    if (other) {
      var label = (other.textContent || '').trim().toLowerCase().replace(/\s+/g, '_').slice(0, 50)
      track(label || 'unlabeled', sectionLocation(other), 'low')
    }
  })
})()
