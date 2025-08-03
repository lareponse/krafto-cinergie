import ShadowBox from "./shadow-box.js";
class CookieConsent {
  constructor() {

    this.openModal = this.openModal.bind(this);
    this.closeModal = this.closeModal.bind(this);
    this.actionSavePreferences = this.actionSavePreferences.bind(this);
    
    this.localStorageIndex = "cookie-consent-preferences";
    this.modal = new ShadowBox("cookie-modal-template", document.activeElement);
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

  openModal(origin) {
   
    let preferences = this.loadPreferences();
    if (!preferences) {
      preferences = {
        necessary: true,
        analytics: true,
        marketing: true,
      };
    }
    
    this.modal.html().querySelector("#analytics-cookies").checked = preferences.analytics;
    this.modal.html().querySelector("#marketing-cookies").checked = preferences.marketing;

    // Handle "Close"
    this.modal.html()
      .querySelector("#btn-cancel-modal")
      .addEventListener("click", this.closeModal);

      // Save Preferences
    this.modal
      .html()
      .querySelector("#btn-confirm-modal")
      .addEventListener("click", this.actionSavePreferences);

    this.modal.open();
  }

  closeModal() {
    // remove the event listeners
    this.modal
      .html()
      .querySelector("#btn-cancel-modal")
      .removeEventListener("click", this.closeModal);

    this.modal
    .html()
      .querySelector("#btn-confirm-modal")
      .removeEventListener("click", this.actionSavePreferences);


    this.modal.close();
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
    console.log("Removing third-party content...");
    document
      .querySelectorAll(".thirdPartyContent")
      .forEach((thirdPartyContent) => {
        // remove the node
        thirdPartyContent.parentNode.removeChild(thirdPartyContent);
      });
  }

  // Load embedded videos (YouTube, Vimeo, Dailymotion)
  loadThirdPartyContent() {
    console.log("Loading third-party content...");
    document
      .querySelectorAll(".thirdPartyContent")
      .forEach((thirdPartyContent) => {
        let template = thirdPartyContent.getAttribute("data-consent-template");
        template = document.getElementById(template);
        // clone and replace with the template
        let clone = document.importNode(template.content, true);
        console.log("Replacing third-party content with template:", template);
        console.log("Clone:", clone);
        thirdPartyContent.parentNode.replaceChild(clone, thirdPartyContent);
      });
  }
}

export default CookieConsent;
