const emptyContainer = container => {
  container.innerHTML = ''
}

const makeSuggestion = (reference, {id, label}) => {
  let item = document.createElement('li')
  item.className = 'list-group-item d-flex justify-content-between align-items-center'
  item.innerHTML = label

  item.addEventListener('click', () => {
    document.getElementById(reference).setAttribute('value', id)
    document.querySelector('label[for="' + reference + '"] span').innerHTML = label
    document.getElementById(reference + '-suggestions').innerHTML = ''
  })

  return item
}

const showSuggestions = (reference, results) => {
  
  const container = document.getElementById(reference + '-suggestions')
  
  const suggestionList = document.createElement("ul")
  suggestionList.className = 'list-group list-group-flush'
  
  
  results.map(res => {
    suggestionList.append(makeSuggestion(reference, res))
  })

  emptyContainer(container)
  container.append(suggestionList)


  // populate with lis
}

document.addEventListener("DOMContentLoaded", function() {
  
    document.querySelectorAll('.otto-complete').forEach(function(input){
      input.addEventListener('input', function (e){
        const target = e.target
        const searchTerm = target.value 
        const [searchTable, searchField] = target.getAttribute('data-filter-on').split('.')
        const url = '/api/'+searchTable+'/'+searchField+'/'+searchTerm;
        fetch(url)
        .then(response => response.json())
        .then(results => {           
            showSuggestions(target.getAttribute('data-filter-to'), results)
        })
        
      })
    })
});