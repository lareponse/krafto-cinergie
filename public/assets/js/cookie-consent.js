class CookieConsent {
  constructor() {
    this.defaultPreferences = {
      necessary: true,
      analytics: true,
      marketing: true,
    };
    this.localStorageIndex = "cookie-consent-preferences";
    this.modal = document.getElementById("cookie-modal");

    this.init();
  }

  init() {
    // Links to modify preferences
    document.querySelectorAll(".cookie-preferences").forEach((link) => {
      link.addEventListener("click", (e) => {
        e.preventDefault();
        this.openModal();
      });
    });

    // Check for stored preferences on page load
    this.storedPreferences = this.loadPreferences();

    if (this.storedPreferences) {
      // Hide banner
      this.hideBanner();

      // Load Analytics and Marketing features based on preferences
      if (this.storedPreferences.analytics === true) {
        this.loadAnalytics();
      }
      if (this.storedPreferences.marketing === true) {
        this.loadThirdPartyContent();
      }
    } else {
      // activate banner buttons
      this.initBannerButtons();
    }
  }

  initBannerButtons() {
    document
      .querySelector("#cookie-banner .cookie-banner-buttons")
      .addEventListener("click", (e) => {
        e.preventDefault();
        switch (e.target.id) {
          case "cookie-banner-accept-all":
            this.actionAcceptAll();
            break;
          case "cookie-banner-decline-all":
            this.actionDeclineAll();
            break;
          case "cookie-banner-customize":
            this.openModal();
            break;
        }
      });
  }

  actionAcceptAll() {
    this.storePreferences({
      necessary: true,
      analytics: true,
      marketing: true,
    });
    this.hideBanner();
    this.loadAnalytics();
    this.loadThirdPartyContent();
  }

  actionDeclineAll() {
    this.storePreferences({
      necessary: true,
      analytics: false,
      marketing: false,
    });
    this.hideBanner();
  }

  actionSavePreferences() {
    let preferences = {
      necessary: true, // Always true for necessary cookies
      analytics: document.getElementById("analytics-cookies").checked,
      marketing: document.getElementById("marketing-cookies").checked,
    };

    this.storePreferences(preferences);

    this.closeModal();
    this.hideBanner();

    if (preferences.analytics) {
      this.loadAnalytics();
    }
    if (preferences.marketing) {
      this.loadThirdPartyContent();
    } else {
      this.removeThridPartyContent();
    }
  }

  openModal() {
    const focusableElements =
      'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';

    let preferences = this.loadPreferences();
    if (!preferences) {
      preferences = this.defaultPreferences;
    }
    //load and clone template #cookie-modal-template
    let template = document.getElementById("cookie-modal-template");
    template = document.importNode(template.content, true);
    this.modal = template.querySelector("#cookie-modal");
    this.modal.querySelector("#analytics-cookies").checked =
      preferences.analytics;
    this.modal.querySelector("#marketing-cookies").checked =
      preferences.marketing;

    document.getElementById("backdrop").classList.add("active");
    
    // Handle "Close"
    this.modal
      .querySelector("#btn-close-modal")
      .addEventListener("click", () => {
        this.closeModal();
      });
    // Save Preferences
    this.modal
      .querySelector("#btn-save-preferences")
      .addEventListener("click", () => {
        this.actionSavePreferences();
      });

    // accessibility
    this.modal.querySelector(focusableElements).focus();
    document.addEventListener("keydown", (event) => {
      this.handleKeyEvents(event);
    });

    // append modal to body
    document.body.appendChild(this.modal);
    this.modal.style.display = "block";
    this.modal.setAttribute("aria-hidden", "true");
    this.modal.focus();
  }

  closeModal() {
    // loose focus from cookie-modal
    this.modal.setAttribute("aria-hidden", "false");
    this.modal.blur();
    this.modal.style.display = "none";
    document.getElementById("backdrop").classList.remove("active");

    // set focus to #cookie-banner
    document.getElementById("cookie-banner").focus();

    // remove the event listeners
    this.modal
      .querySelector("#btn-close-modal")
      .removeEventListener("click", () => {
        this.closeModal();
      });

    this.modal
      .querySelector("#btn-save-preferences")
      .removeEventListener("click", () => {
        this.actionSavePreferences();
      });

    document.removeEventListener("keydown", (event) => {
      this.handleKeyEvents(event);
    });

    this.modal.parentNode.removeChild(this.modal);
  }

  handleKeyEvents(event) {
    if (event.key === "Escape") this.closeModal();
    if (event.key === "Tab") this.trapFocus(event);
  }

  trapFocus(event) {
    const focusableElements = this.modal.querySelectorAll(
      'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
    );
    const firstElement = focusableElements[0];
    const lastElement = focusableElements[focusableElements.length - 1];

    if (event.shiftKey && document.activeElement === firstElement) {
      event.preventDefault();
      lastElement.focus();
    } else if (!event.shiftkey && document.activeElement === lastElement) {
      event.preventDefault();
      firstElement.focus();
    }
  }

  // Store preferences in localStorage
  storePreferences(prefs) {
    if (!this.validatePreferences(prefs)) {
      throw new Error("Invalid preferences");
    }

    localStorage.setItem(this.localStorageIndex, JSON.stringify(prefs));
  }

  loadPreferences() {
    try {
      let preferences;

      preferences = localStorage.getItem(this.localStorageIndex);
      if (preferences === null) {
        return null;
      }

      preferences = JSON.parse(preferences);
      if (this.validatePreferences(preferences)) {
        return preferences;
      }
    } catch (e) {
      console.error(e);
    }

    return null;
  }

  validatePreferences(prefs) {
    return "necessary" in prefs && "analytics" in prefs && "marketing" in prefs;
  }

  // Hide banner
  hideBanner() {
    let banner = document.getElementById("cookie-banner");
    banner.classList.add("cookie-informed");
    banner.style.display = "none";
  }

  // Load Google Analytics script
  loadAnalytics() {
    // const script = document.createElement('script');
    // script.src = 'https://www.googletagmanager.com/gtag/js?id=YOUR_GA_TRACKING_ID';
    // script.async = true;
    // document.head.appendChild(script);
    // window.dataLayer = window.dataLayer || [];
    // function gtag() {
    //   dataLayer.push(arguments);
    // }
    // gtag('js', new Date());
    // gtag('config', 'YOUR_GA_TRACKING_ID');
  }

  removeThridPartyContent() {
    document
      .querySelectorAll(".thirdPartyContent")
      .forEach((thirdPartyContent) => {
        // remove the node
        thirdPartyContent.parentNode.removeChild(thirdPartyContent);
      });
  }

  // Load embedded videos (YouTube, Vimeo, Dailymotion)
  loadThirdPartyContent() {
    document
      .querySelectorAll(".thirdPartyContent")
      .forEach((thirdPartyContent) => {
        let template = thirdPartyContent.getAttribute("data-consent-template");
        template = document.getElementById(template);
        // clone and replace with the template
        let clone = document.importNode(template.content, true);
        thirdPartyContent.parentNode.replaceChild(clone, thirdPartyContent);
      });
  }
}

export default CookieConsent;
