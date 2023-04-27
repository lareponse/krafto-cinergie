<div class="row otto-tags" id="otto-praxis">
  <div class="col-xl-6">
    <ul class="list-group otto-list mb-3"></ul>
  </div>
  <div class="col-xl-6">
    <input class="form-control otto-search" data-filter-parent="professional_praxis" type="search" placeholder="Ajouter" />
    <ul class="list-group list-group-flush otto-suggestions"></ul>
  </div>
</div>

<script>
  const existingPraxis = <?= json_encode(array_map(function ($praxis) {
                            return ['id' => $praxis->getID(), 'label' => $praxis->__toString()];
                          }, array_values($controller->formModel()->praxis()))); ?>
  
  document.addEventListener("DOMContentLoaded", function() {
      const container = document.getElementById('otto-praxis')
      makeList(container, existingPraxis);
      listenToSearch(container);
  });

  const makeSuggestion = (container, {id,label}) => {
    let item = document.createElement('li')
    item.className = 'list-group-item d-flex justify-content-between align-items-center'
    item.innerHTML = label

    item.addEventListener('click', () => {
      console.log(id,label)
      container.querySelector('.otto-list').appendChild(makeListItem(id, label))
      container.querySelector('.otto-suggestions').innerHTML = ''
      container.querySelector('.otto-search').value = ''
    })

    return item
  }

  const showSuggestions = (container, results) => {

    const suggestionList = container.querySelector('.otto-suggestions')
    suggestionList.innerHTML = ''
    results.map(res => {
      suggestionList.append(makeSuggestion(container, res))
    })
    suggestionList.classList.remove('d-none')
  }

  const makeListItem = (id, label) => {
    // Create the text node for the label
    label = document.createTextNode(label)

    // Create the <input> element
    const input = Object.assign(document.createElement('input'), {type: 'hidden',name: 'praxis_ids[]', value: id});
    
    // Create the <a> element
    const a = Object.assign(document.createElement('a'), {
      href: '#',
      class: 'unlink',
      innerHTML: '<?= $this->icon('delete') ?>',
      onclick: (e) => {
        e.preventDefault();
        removeFromExisting(e.target);
      },
    });
    
    
    // Create the <li> element
    const li = document.createElement('li')
    li.setAttribute('class', 'list-group-item current-items d-flex justify-content-between align-items-center')
    li.appendChild(label);
    li.appendChild(input);
    li.appendChild(a);

    return li
  }
  
  const removeFromExisting = (target) => {
    do {
      target = target.parentNode
    } while (target.tagName != 'LI')

    target.remove()
  }

  const makeList = (container, items) => {
    let list = container.querySelector('.otto-list')
    items.forEach(function(item){
      list.append(makeListItem(item.id, item.label))
    })
  }

  const listenToSearch = (container) => {
    container.querySelectorAll('.otto-search').forEach(function(input) {
      input.addEventListener('input', function(e) {
        const target = e.target
        const searchTerm = target.value
        const searchContextValue = target.getAttribute('data-filter-parent');
        const url = '/api/tag/parent/' + searchContextValue + '/term/' + searchTerm + '/tags.json';
        fetch(url)
          .then(response => response.json())
          .then(results => {
            // console.log(results)
            showSuggestions(container, results)
          })

      })
    })
  }


</script>