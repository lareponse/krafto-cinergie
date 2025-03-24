export default class OttoForm {
  /**
   * Apply pattern-based validations to all forms
   */
  static enforceFormValidations() {
    document.querySelectorAll('form [pattern]').forEach((input) => {
      input.addEventListener('input', OttoForm.smartFormat);
    });

    // Implementation for required field validation
    document.querySelectorAll('form [required]').forEach((input) => {
      input.addEventListener('blur', OttoForm.enforceRequired);
    });
  }

  static caracterCounter(selector = '[data-kx-counter]') {
    document.querySelectorAll(selector).forEach(function (element) {
      // Skip if element is already wrapped
      if (element.closest('.input-group')) {
        return;
      }

      // Ensure ID and class
      const id =
        element.id ||
        'floatingInputGroup-' + Math.random().toString(36).substr(2, 9);
      element.id = id;
      element.classList.add('form-control');

      // Create the structure
      const inputGroup = document.createElement('div');
      inputGroup.className = 'input-group mb-3';

      // Create floating div
      const formFloating = document.createElement('div');
      formFloating.className = 'form-floating';

      // Get reference to element's position
      const parent = element.parentNode;
      const nextSibling = element.nextSibling;

      // Build the structure
      formFloating.appendChild(element);

      // Do not add the label

      inputGroup.appendChild(formFloating);

      // Insert the structure
      if (nextSibling) {
        parent.insertBefore(inputGroup, nextSibling);
      } else {
        parent.appendChild(inputGroup);
      }

      // Create character counter
      const counterSpan = document.createElement('span');
      counterSpan.className = 'input-group-text';
      counterSpan.textContent = element.value.length;

      // Add the counter after the form-floating div
      inputGroup.appendChild(counterSpan);

      // Update counter on input
      element.addEventListener('input', function () {
        counterSpan.textContent = element.value.length;
      });
    });
  }
  /**
   * Format input based on pattern attribute
   * @param {Event} event - Input event
   */
  static smartFormat(event) {
    const input = event.target;
    const patternAttr = input.getAttribute('pattern');
    if (!patternAttr) return;

    const value = input.value.toUpperCase();
    const segments = OttoForm.parsePattern(patternAttr);
    let formattedValue = '';
    let valueIndex = 0;

    for (let i = 0; i < segments.length && valueIndex < value.length; i++) {
      const segment = segments[i];
      const maxChars = Math.min(segment.count, value.length - valueIndex);
      const chunk = value.substr(valueIndex, maxChars);

      // Filter characters by segment type
      const filtered = Array.from(chunk)
        .filter((char) => segment.charSet.test(char))
        .join('');

      formattedValue += filtered;
      valueIndex += chunk.length;
    }

    // Only update if changed to avoid cursor jumping
    if (input.value !== formattedValue) {
      input.value = formattedValue;
    }
  }

  /**
   * Enforce required field validation
   * @param {Event} event - Blur event
   */
  static enforceRequired(event) {
    const input = event.target;
    const isValid = input.value.trim().length > 0;

    if (!isValid) {
      input.classList.add('invalid');
      // Optional: Add error message or styling
    } else {
      input.classList.remove('invalid');
    }

    return isValid;
  }

  /**
   * Parse regex pattern into segments of character classes
   * @param {string} pattern - Regex pattern string
   * @return {Array} Array of pattern segments
   */
  static parsePattern(pattern) {
    const segments = [];
    const regex = /\[([^\]]+)\](?:\{(\d+)(?:,(\d+))?\})?/g;
    let match;

    while ((match = regex.exec(pattern)) !== null) {
      const charClass = match[1];
      const minCount = match[2] ? parseInt(match[2]) : 1;
      const maxCount = match[3] ? parseInt(match[3]) : minCount;

      // Create regex for character class with better pattern support
      let charSet;
      try {
        // Try to create a regex directly from the character class
        charSet = new RegExp(`[${charClass}]`);
      } catch (e) {
        // Fallback for common patterns
        if (charClass === 'A-Z') {
          charSet = /[A-Z]/;
        } else if (charClass === '0-9') {
          charSet = /[0-9]/;
        } else if (charClass === 'A-Za-z') {
          charSet = /[A-Za-z]/;
        } else if (charClass === 'A-Z0-9') {
          charSet = /[A-Z0-9]/;
        } else {
          // Default to alphanumeric if invalid pattern
          charSet = /[A-Za-z0-9]/;
          console.warn(`Invalid character class: ${charClass}`);
        }
      }

      segments.push({
        charSet: charSet,
        count: maxCount,
      });
    }

    return segments;
  }
}
