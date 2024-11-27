document.querySelectorAll('.content-scroll-container').forEach(scrollContainer => {
  const scrollSensitivity = 3;
  let isDragging = false;
  let startX = 0;
  let scrollMomentum = 0;

  function scrollBy(deltaX) {
      const newScrollLeft = scrollContainer.scrollLeft + deltaX;
      scrollContainer.scrollLeft = Math.max(0, Math.min(scrollContainer.scrollWidth - scrollContainer.clientWidth, newScrollLeft));
  }

  scrollContainer.addEventListener('mousedown', (e) => {
      isDragging = true;
      startX = e.clientX;
      e.preventDefault();
  });

  document.addEventListener('mousemove', (e) => {
      if (isDragging) {
          const deltaX = -(e.clientX - startX) / scrollSensitivity;
          startX = e.clientX;
          scrollBy(deltaX);
      }
  });

  document.addEventListener('mouseup', () => {
      if (isDragging) {
          isDragging = false;

          let momentumDecay = 0.9;
          const animateMomentum = () => {
              scrollBy(scrollMomentum);
              scrollMomentum *= momentumDecay;
              if (Math.abs(scrollMomentum) > 1) {
                  requestAnimationFrame(animateMomentum);
              }
          };
          animateMomentum();
      }
  });

  scrollContainer.addEventListener('click', (e) => {
      if (!isDragging) {
          const clickedElement = e.target.closest('a');
          if (clickedElement) {
              window.location.href = clickedElement.href;
          }
      }
  });
});
