class OttoFormatDate {
  static getFormat(container) {
    if (container.getAttribute('otto-format')) {
      try {
        const format = decodeURIComponent(
          container.getAttribute('otto-format')
        );
        let parsedFormat = JSON.parse(format);
        return parsedFormat;
      } catch (exception) {
        console.error('Error parsing JSON:', exception);
        console.log('Container:', container);
        console.log('parsedFormat:', parsedFormat);
      }
    }
    return { dateStyle: 'long' };
  }

  static searchAndFormat(selector = '.otto-date, .otto-date-relative') {
    let dateText, date, dateFormat;

    document.querySelectorAll(selector).forEach((container) => {
      dateText = container.innerText.trim();
      if (dateText.length !== 0) {
        date = new Date(dateText);

        if (Number.isNaN(date.getTime())) {
          console.error('Invalid dateText', container, selector);
        } else {
          if (container.classList.contains('otto-date-relative')) {
            container.innerText = OttoFormatDate.timeAgo(date);
          } else {
            dateFormat = new Intl.DateTimeFormat(
              'fr-FR',
              OttoFormatDate.getFormat(container)
            );
            container.innerText = dateFormat.format(date);
          }
        }
      }
    });
  }

  static timeAgo(date) {
    const now = new Date();
    const diffMs = date - now;
    const units = [
      { unit: 'year', divisor: 31536000000 },
      { unit: 'month', divisor: 2592000000 },
      { unit: 'week', divisor: 604800000 },
      { unit: 'day', divisor: 86400000 },
      { unit: 'hour', divisor: 3600000 },
      { unit: 'minute', divisor: 60000 },
      { unit: 'second', divisor: 1000 },
    ];

    const rtf = new Intl.RelativeTimeFormat('fr', { numeric: 'auto' });

    for (const { unit, divisor } of units) {
      const value = Math.round(diffMs / divisor);
      if (Math.abs(value) >= 1 || unit === 'second') {
        return rtf.format(value, unit);
      }
    }
  }
}

export default OttoFormatDate;
