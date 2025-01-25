class Korbo {
  constructor(container_id, template_id) {
    this.items = this.load() || [];
    this.customer = localStorage.getItem('customer') || { name: '', email: '' };
    this.ui = new KorboUI(this, container_id, template_id);
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

  remove(basket_item_id) {
    let basket_item = this.items.find((item) => item.id === basket_item_id);
    if (!basket_item) {
      return;
    }
    this.items = this.items.filter((item) => item !== basket_item);
    this.save();
  }

  clear() {
    this.items = [];
    this.save();
  }

  save() {
    localStorage.setItem('korbo', JSON.stringify(this.items));
    this.ui.refresh();
  }

  load() {
    let res = localStorage.getItem('korbo');
    if (res !== null) {
      return JSON.parse(res);
    }
    return null;
  }

  export() {
    return this.items;
  }

  update(id, props) {
    if ('quantity' in props && props.quantity < 1) {
      console.debug('removing item with quantity < 1');
      this.remove(id);
    }

    console.debug('updating qty from ${item.quantity} to ${props.quantity}');
    let item = this.items.find((item) => item.id === id);
    if (item) {
      Object.assign(item, props);
      this.save();
      this.ui.refresh();
    }
  }

  count() {
    return this.items.length;
  }

  total() {
    return this.items.reduce((total, item) => total + item.price, 0);
  }
}

class KorboUI {
  constructor(korbo, container_id, template_id) {
    this.korbo = korbo;
    this.lineContainer = document.querySelector(container_id);
    this.lineTemplate = document.querySelector(template_id);

    this.refresh();
  }

  refresh() {
    let korboTrigger = document.querySelector('.korbo-trigger');
    if (this.korbo.count() === 0) {
      korboTrigger.classList.add('hidden');
    } else {
      korboTrigger.classList.remove('hidden');
    }

    this.setLines();
  }

  setLines() {
    if (this.lineContainer !== null && this.lineTemplate !== null) {
      this.lineContainer.innerHTML = '';
      this.korbo.items.forEach((item) => {
        let row = this.lineElement(item);
        this.lineContainer.appendChild(row);
      });

      this.lineContainer.addEventListener('change', (e) => {
        let id = e.target.closest('.korbo-item').dataset.itemId;
        this.korbo.update(id, {
          quantity: e.target.value,
        });
      });

      this.lineContainer.addEventListener('click', (e) => {
        if (e.target.closest('.btn-delete-item')) {
          console.log('delete item', e.target.closest('.btn-delete-item'));
          let elt = e.target.closest('.korbo-item');
          let id = elt.dataset.itemId;
          this.korbo.remove(id);
          elt.remove();
        }
      });
    }
  }

  lineElement(item) {
    let row = this.lineTemplate.content.cloneNode(true);
    row = row.querySelector('.korbo-item');

    row.classList.add('korbo-item');
    row.setAttribute('data-item-id', item.id);
    row.querySelector('[data-kx-id="title"]').textContent = item.title;
    row.querySelector('[data-kx-id="price"]').textContent = item.price;
    row.querySelector('[data-kx-id="delivery"]').textContent = item.deliveryBe;
    row.querySelector('[data-kx-id="quantity"]').value = item.quantity;
    row.querySelector('[data-kx-id="total"]').textContent =
      parseInt(item.quantity) *
      (parseFloat(item.price) + parseFloat(item.deliveryBe));

    return row;
  }
}

export default Korbo;
