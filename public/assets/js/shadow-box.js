"use strict";

/* accessible modal, using shadow dom */
class ShadowBox {
  static FOCUSABLE =
    'button, [href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])';

  constructor(shadow_template_id, origin) {
    // clone template
    this.origin = origin;

    this.modal = document.getElementById(shadow_template_id);
    this.modal = document.importNode(this.modal.content, true);
    this.modal = this.modal.querySelector(".shadow-box");
    this.modal.setAttribute("role", "dialog");
    this.modal.setAttribute("aria-modal", "true");
    this.modal.setAttribute("aria-hidden", "true");

    this.backdrop = this.makeBackdrop();

    this.handleKeyEvents = this.handleKeyEvents.bind(this);

    this.focusableElements = this.modal.querySelectorAll(ShadowBox.FOCUSABLE);
  }

  allowNativeClose() {
    let btn = this.modal.querySelector(".btn-cancel-modal");
    if(btn)
      btn.addEventListener("click", () => {
      this.close();
    } );
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

    this.modal.setAttribute("aria-hidden", "false");
    this.modal.setAttribute("aria-expanded", "true");

    this.backdrop.setAttribute("aria-hidden", "false");

    this.modal.querySelector(ShadowBox.FOCUSABLE).focus();
    document.addEventListener("keydown", this.handleKeyEvents);
  }

  close() {
    this.modal.blur();
    this.origin.focus();

    this.modal.setAttribute("aria-hidden", "true");
    this.modal.setAttribute("aria-expanded", "false");

    this.backdrop.setAttribute("aria-hidden", "true");

    document.removeEventListener("keydown", (event) => {
      this.handleKeyEvents(event);
    });

    document.body.removeChild(this.backdrop);
    document.body.removeChild(this.modal);
  }

  handleKeyEvents(event) {
    if (event.key === "Escape") this.close();
    if (event.key === "Tab") this.trapFocus(event);
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
    let ret = document.createElement("div");

    ret.setAttribute("id", "shadow-box-backdrop");
    ret.setAttribute("aria-hidden", "true");
    ret.addEventListener("click", () => {
      this.close();
    });

    ret.style.position = "fixed";
    ret.style.top = "0";
    ret.style.left = "0";
    ret.style.width = "100%";
    ret.style.height = "100%";
    ret.style.background = "rgba(0, 0, 0, 0.5)";
    ret.style.zIndex = "999";

    return ret;
  }
}

export default ShadowBox;
