;(function () {
  var modal = document.getElementById('office-directions-modal')
  if (!modal) return

  var triggers = document.querySelectorAll('.js-office-directions-trigger')
  var closers = modal.querySelectorAll('.js-office-directions-close')
  var prevBtn = modal.querySelector('.js-office-directions-prev')
  var nextBtn = modal.querySelector('.js-office-directions-next')
  var slides = modal.querySelectorAll('.office-directions-slide')
  var closeBtn = modal.querySelector('.office-directions-close')

  var currentIndex = 0
  var lastTrigger = null
  var touchStartX = null
  var SWIPE_THRESHOLD = 40

  function render() {
    slides.forEach(function (slide, i) {
      slide.classList.toggle('is-active', i === currentIndex)
    })
    prevBtn.disabled = currentIndex === 0
    nextBtn.disabled = currentIndex === slides.length - 1
  }

  function openModal(trigger) {
    lastTrigger = trigger
    currentIndex = 0
    modal.hidden = false
    render()
    closeBtn.focus()
    document.addEventListener('keydown', onKeydown)
  }

  function closeModal() {
    modal.hidden = true
    document.removeEventListener('keydown', onKeydown)
    if (lastTrigger) lastTrigger.focus()
  }

  function goPrev() {
    if (currentIndex === 0) return
    currentIndex--
    render()
  }

  function goNext() {
    if (currentIndex === slides.length - 1) return
    currentIndex++
    render()
  }

  function onKeydown(e) {
    if (e.key === 'Escape') closeModal()
    if (e.key === 'ArrowLeft') goPrev()
    if (e.key === 'ArrowRight') goNext()
  }

  triggers.forEach(function (trigger) {
    trigger.addEventListener('click', function () {
      openModal(trigger)
    })
  })

  closers.forEach(function (closer) {
    closer.addEventListener('click', closeModal)
  })

  prevBtn.addEventListener('click', goPrev)
  nextBtn.addEventListener('click', goNext)

  modal.addEventListener('touchstart', function (e) {
    touchStartX = e.changedTouches[0].clientX
  })

  modal.addEventListener('touchend', function (e) {
    if (touchStartX === null) return
    var delta = e.changedTouches[0].clientX - touchStartX
    if (delta <= -SWIPE_THRESHOLD) goNext()
    if (delta >= SWIPE_THRESHOLD) goPrev()
    touchStartX = null
  })
})()
