class LazyLoader {
  constructor(selector) {
    const lazyImages = document.querySelectorAll(selector);

    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
            // console.log('intersecting: ', entry.target);
          const img = entry.target;
          img.src = img.dataset.src; // Load the actual image
          img.removeAttribute("loading"); // Remove the loading attribute
          observer.unobserve(img); // Stop observing the loaded image
        }
      });
    });

    lazyImages.forEach((img) => observer.observe(img));
  }
}

export default LazyLoader;
