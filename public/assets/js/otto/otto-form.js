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
