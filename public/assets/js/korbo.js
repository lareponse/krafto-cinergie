class Korbo {
  constructor() {
    this.items = this.load() || [];
    this.customer = localStorage.getItem("customer") || { name: "", email: "" };
  }

  add(basket_item) {
    // detect if the item is already in the basket, if so, increase the quantity
    let found = this.items.find((item) => item.id === basket_item.id);
    if (found) {
      ++found.quantity;
      this.save();
      return;
    }
    basket_item.quantity = 1;
    this.items.push(basket_item);
    this.save();
  }

  remove(basket_item) {
    this.items = this.items.filter((item) => item !== basket_item);
    this.save();
  }

  clear() {
    this.items = [];
    this.save();
  }

  save() {
    localStorage.setItem("korbo", JSON.stringify(this.items));

    if (this.count() === 0) {
      this.hideBasketTrigger();
    } else {
      this.showBasketTrigger();
    }
  }

  showBasketTrigger() {
    document.querySelector(".korbo-trigger").classList.remove("hidden");
  }

  hideBasketTrigger() {
    document.querySelector(".korbo-trigger").classList.add("hidden");
  }

  load() {
    let res = localStorage.getItem("korbo");
    if (res !== null) {
      return JSON.parse(res);
    }
    return null;
  }

  items() {
    return this.items;
  }

  count() {
    return this.items.length;
  }

  total() {
    return this.items.reduce((total, item) => total + item.price, 0);
  }
}

export default Korbo;
