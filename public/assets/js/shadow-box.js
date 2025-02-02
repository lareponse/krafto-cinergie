'use strict';

/* accessible modal, using dom fragment */
export default class ShadowBox {
  static FOCUSABLE =
    'button, [href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])';

  constructor(shadow_template_id, origin) {
    this.close = this.close.bind(this);
    this.open = this.open.bind(this);
    this.handleKeyEvents = this.handleKeyEvents.bind(this);
    this.origin = origin;
    this.modal = this.cloneTemplate(shadow_template_id);
    console.log(this.modal.tagName);
    this.backdrop = this.makeBackdrop();
    this.focusableElements = this.modal.querySelectorAll(ShadowBox.FOCUSABLE);

    let btn;
    // test if the modal is a FORM
    if (this.modal.tagName === 'FORM') {
      this.modal.addEventListener('invalid', (e) => {
        e.preventDefault();
      });

      this.modal.addEventListener('submit', (e) => {
        e.preventDefault();
        const formClone = this.modal.cloneNode(true);
        formClone.style.display = 'none'; // Hide the clone (optional)
        document.body.appendChild(formClone);
        formClone.submit();
        this.close();
      });
    } else {
      btn = this.modal.querySelector('.btn-confirm-modal');
      if (btn) btn.addEventListener('click', this.close);
    }

    btn = this.modal.querySelector('.btn-cancel-modal');
    if (btn) btn.addEventListener('click', this.close);
  }

  static listen(selector) {
    document.querySelectorAll(selector).forEach(function (elt) {
      elt.addEventListener('click', function (e) {
        e.preventDefault();
        const shadowBox = new ShadowBox(
          this.getAttribute('data-shadow-box-template'),
          e.target
        );
        shadowBox.open();
      });
    });
  }

  allowNativeClose() {
    let btn = this.modal.querySelector('.btn-cancel-modal');
    if (btn) btn.addEventListener('click', this.close);
  }

  html() {
    return this.modal;
  }

  backdrop() {
    return this.backdrop;
  }

  open() {
    document.body.appendChild(this.backdrop);
    document.body.appendChild(this.modal);

    this.modal.setAttribute('aria-hidden', 'false');
    this.modal.setAttribute('aria-expanded', 'true');

    this.backdrop.setAttribute('aria-hidden', 'false');

    this.modal.querySelector(ShadowBox.FOCUSABLE).focus();
    document.addEventListener('keydown', this.handleKeyEvents);
  }

  close() {
    this.modal.blur();
    this.origin.focus();

    this.modal.setAttribute('aria-hidden', 'true');
    this.modal.setAttribute('aria-expanded', 'false');

    this.backdrop.setAttribute('aria-hidden', 'true');

    document.removeEventListener('keydown', this.handleKeyEvents);

    document.body.removeChild(this.backdrop);
    document.body.removeChild(this.modal);
  }

  handleKeyEvents(event) {
    if (event.key === 'Escape') this.close();
    if (event.key === 'Tab') this.trapFocus(event);
  }

  trapFocus(event) {
    const focusableContent = Array.from(this.focusableElements);
    const firstFocusableElement = focusableContent[0];
    const lastFocusableElement = focusableContent[focusableContent.length - 1];

    if (event.shiftKey && document.activeElement === firstFocusableElement) {
      lastFocusableElement.focus();
      event.preventDefault();
    } else if (
      !event.shiftKey &&
      document.activeElement === lastFocusableElement
    ) {
      firstFocusableElement.focus();
      event.preventDefault();
    }
  }

  makeBackdrop() {
    let ret = document.createElement('div');

    ret.setAttribute('id', 'shadow-box-backdrop');
    ret.setAttribute('aria-hidden', 'true');
    ret.addEventListener('click', () => {
      this.close();
    });

    Object.assign(ret.style, {
      position: 'fixed',
      top: '0',
      left: '0',
      width: '100%',
      height: '100%',
      background: 'rgba(0, 0, 0, 0.5)',
      zIndex: '999',
    });

    return ret;
  }

  cloneTemplate(shadow_template_id) {
    let clone;

    clone = document.getElementById(shadow_template_id);

    if (clone == null || !'content' in clone) {
      throw new Error('Shadow template not found: ' + shadow_template_id);
    }

    clone = document.importNode(clone.content, true);

    clone = clone.querySelector(':first-child');
    clone.setAttribute('role', 'dialog');
    clone.setAttribute('aria-modal', 'true');
    clone.setAttribute('aria-hidden', 'true');
    clone.setAttribute('tabindex', '-1');
    return clone;
  }
}
